<?php
define( 'HELLO_CAND', 'candidates' );
define( 'HELLO_CAND_POS', 'candidates-position' );
define( 'HELLO_POSIT', 'positions' );
define( 'HELLO_POSIT_LEV', 'positions-level' );
define( 'HELLO_RESPONS', 'responses' );

require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/functions-generated.php';
require get_template_directory() . '/inc/pdfparser.php';
// Adds a main styles and scripts within in Admin.
// add_action('admin_enqueue_scripts', 'hello_admin_style');
// function hello_admin_style() {
//     wp_enqueue_style('admin-styles', get_stylesheet_directory_uri() . '/css/admin.css',	array(),
//       filemtime( get_stylesheet_directory() . '/css/admin.css' )
//     );
// }

// Adds a main styles and scripts.
add_action( 'wp_enqueue_scripts', 'hello_main_scripts_old', 99 );
function hello_main_scripts_old() {
    $bundle_obj = [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('hello-nonce'),
        'action' => 'hello_form'
    ];
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/dist/main.min.css',	array(),
        filemtime( get_stylesheet_directory() . '/dist/main.min.css' )
    );

    wp_enqueue_script('main', get_stylesheet_directory_uri() . '/dist/bundle.js',	array('jquery'),
        filemtime( get_stylesheet_directory() . '/dist/bundle.js' ), [ 'strategy' => 'defer' ]
    );
    wp_enqueue_script('position', get_stylesheet_directory_uri() . '/js/position.js',	array('jquery'),
        filemtime( get_stylesheet_directory() . '/js/position.js' ), [ 'strategy' => 'defer' ]
    );

    wp_add_inline_script( 'main', 'var hello_ajax = ' . wp_json_encode( $bundle_obj ), 'before' );
}

add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );

add_filter('show_admin_bar', '__return_false');

add_filter('login_redirect', 'hello_lgn_redirect');
function hello_lgn_redirect() {
   return '/manage-positions';
}

$error_request = __( 'Request error', 'hello' );
$error_user = __( 'Error no user', 'hello' );
$error_post_id = __( 'Error no post_id', 'hello' );
$error_email = __( 'Error no Email', 'hello' );
$error_email_invalid = __( 'Invalid Email', 'hello' );

add_action( 'init', 'hello_noadmin' );
function hello_noadmin() {
	if ( is_admin() && !current_user_can('administrator') && !wp_doing_ajax() ) {
		wp_redirect(home_url( '/auth/' ));
		exit;
	}
}

function hello_custom_login_page() {
  $new_login_page_url = home_url( '/auth/' ); // new login page
  global $pagenow;
  if( $pagenow == 'wp-login.php' && $_SERVER['REQUEST_METHOD'] == 'GET'  && !wp_doing_ajax() ) {
    wp_redirect($new_login_page_url);
    exit;
  }
}
if( !is_user_logged_in() ){
  add_action('init', 'hello_custom_login_page');
}

// Leave the user on the same page when entering an incorrect login/password in the authorization form wp_login_form()
add_action( 'wp_login_failed', 'hello_front_end_login_fail' );
function hello_front_end_login_fail( $username ) {
	$referrer = $_SERVER['HTTP_REFERER'];
	// If there's a referrer and it's not a page wp-login.php
	if( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin')  && !wp_doing_ajax() ) {
		wp_redirect( add_query_arg('login', 'failed', $referrer ) );  // redirect and add a query parameter ?login=failed
		exit;
	}
}

add_action( 'template_redirect', 'hello_template_redirect' );
function hello_template_redirect(){
  if( is_page_template( array('page-auth.php', 'forgot-password.php', 'page-reg.php', 'remember-page.php') ) && is_user_logged_in() ){
		wp_redirect( home_url( '/dashboard' ) );
		exit();
	}
}

// Регистраниция пользователей
add_action('wp_ajax_hello_register', 'hello_register_func');
add_action('wp_ajax_nopriv_hello_register', 'hello_register_func');
function hello_register_func() {
  $error = array();

  $user_name = $_POST['user_name'];
  $email = $_POST['email_reg'];
  $password = $_POST['password'];
  $account_type = $_POST['account_type'];
  $nonce = $_POST['nonce'];
  if ( !wp_verify_nonce( $nonce, 'hello_nonce' ) ) {
    $error['empty_nonce'] = __( 'Problems encountered, try again later.', 'hello' );
  }
  if ( !$user_name ) {
	  $error['user_name'] = __( 'No name given.', 'hello' );
  }
  if ( email_exists( $email ) ) {
    $error['yes_email'] = __( 'The user with the specified E-mail is already registered.', 'hello' );
  }
  if ( !is_email( $email ) ) {
	  $error['email_error'] = __( 'Incorrect E-mail is specified.', 'hello' );
  }
  if ( !$password ) {
	  $error['password_error'] = __( 'No password specified.', 'hello' );
  }

  // if ( !$account_type ) {
	//   $error['account_type_error'] = 'Не указан тип аккаунта.';
  // }
  if ( count( $error ) > 0 ) {
    $error['class'] = 'errors';
    $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
    echo $error_fin;
    wp_die();
  } else {
    $login = preg_replace("/^(.+?)@.+$/", '\\1', $email);
  	$userdata = array(
  		'user_login' => $login,
  		'user_pass' => $password,
  		'user_email' => $email,
        'nickname' => $login,
  	);
  	$user_id = wp_insert_user( $userdata ) ;
    if( ! is_wp_error( $user_id ) ) {
      $new_userdata = array(
          'ID' => $user_id,
          'display_name' => $user_name,
      );
      wp_update_user( $new_userdata );
    }
    $error['success_send_mail'] = __( 'An email with instructions has been sent to the specified email address', 'hello' );
    $error['class'] = 'success';
    $error['login'] = $login;
    $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
    echo $error_fin;
    wp_die();
  }
}

function hello_questions( $count, $position, $min, $max ) {
    $position = 'Engineering Manager';
    if (!empty($_COOKIE['position'])) {
        $position = $_COOKIE['position'];
    }
    $arr=[];
    while( count($arr) < $count ){
        $num = rand( $min, $max );
        $arr[$num] = $num;
    }
    $i = 1;
    foreach  ($arr as $key => $num ) {
        echo '<p id="' . $i . '" class="question-item">' . $i . '. ' . __( 'Question', 'hello' ) . ' <span id="question-position-text">' . $position . '</span>: ' . $num . '</p>';
        ++$i;
    }
    //echo implode(',', $arr);
}

add_action('wp_ajax_render_questions', 'hello_render_questions');
add_action('wp_ajax_nopriv_render_questions', 'hello_render_questions');
function hello_render_questions($position, $return=0) {
    require get_template_directory() . '/inc/questions/questions-all.php';
    $count = 3;
    $min = 0;
    $max = 100;
    $postId = '';
    if ( $_POST ) {
        if ( $_POST['postId'] ) {
            $postId = $_POST['postId'];
        }

        if ( $_POST['position'] ) {
            $position = $_POST['position'];
        }
    }

    if ( $position == 'Java' ) {
        $questions = $java;
    } elseif ( $position == 'Python' ) {
        $questions = $python;
    } elseif ( $position == 'PHP' ) {
        $questions = $php;
    } elseif ( $position == 'Javascript' ) {
        $questions = $javascript;
    } elseif ( $position == 'Go' ) {
        $questions = $go;
    } elseif ( $position == 'Product Manager' ) {
        $questions = $product_manager;
    } elseif ( $position == 'Engineering Manager' ) {
        $questions = $engineering_manager;
    } elseif ( $position == 'QA Engineer' ) {
        $questions = $qa_engineering;
    }

    $arr = array_random($questions, 3);
    $question = '';
    $i = 1;
    foreach  ($arr as $num ) { // $key => $num
        $question .= '<p id="' . $i . '" class="question-item">' . $num . '</p>';
        ++$i;
    }
    if ( $postId ) {
        $questions = [];
        $i = 1;
        foreach  ($arr as $num ) {
            $questions[] = '<p id="' . $i . '" class="question-item">' . $num . '</p>';
            ++$i;
        }
    }
    if ($return) {
        return $question;
    } else {
        echo $question;
    }
    wp_die();
}

function array_random($array, $amount = 1){
    shuffle($array);
    $keys = array_rand($array, $amount);
    if ($amount == 1) {
        return $array[$keys];
    }
    $results = [];
    foreach ($keys as $key) {
        $results[] = $array[$key];
    }
    return $results;
    //return shuffle($results);
}

// Add post Candidates
add_action('wp_ajax_add_candidates', 'hello_add_post_candidates');
add_action('wp_ajax_nopriv_add_candidates', 'hello_add_post_candidates');
function hello_add_post_candidates() {
    $author_id = $_POST['author'];
    $title = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['candidates_position'];
    $level = $_POST['level'];
    $answer = $_POST['answer'];
    $nonce = $_POST['nonce'];

    $questions = [];
    $questions = explode("?,", $_POST['questions']);

    $error = array();
    if ( !wp_verify_nonce( $nonce, 'hello_nonce' ) ) {
        $error['empty_nonce'] = $error_request;
    }

    if ( !$author_id ) {
        $error['empty_author_id'] = $error_user;
    }
    if ( !$title ) {
        $error['empty_title'] = __( 'Fill in the field - Full name', 'hello' );
    }
    if ( !$email  ) {
        $error['empty_email'] = __( 'Fill in the field - E-mail', 'hello' );
    }
    if ( !is_email( $email ) ) {
        $error['email_error'] = __( 'Incorrect E-mail is specified', 'hello' );
    }
    if ( !$position ) {
        $error['empty_position'] = __( 'Select Position', 'hello' );
    }
    if ( !$level ) {
        $error['empty_level'] = __( 'Select Level', 'hello' );
    }
    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $post_data = array(
            'post_author'   => $author_id,
            'post_status'   => 'publish',
            'post_type'     => 'candidates',
            'post_title'    => $title,
        );
        $post_id = wp_insert_post( $post_data );
        if ($post_id) {
            wp_set_object_terms( $post_id, $position, 'candidates-position' );
            update_post_meta( $post_id, 'email', $email );
            update_post_meta( $post_id, 'position', $position );
            update_post_meta( $post_id, 'level', $level );
            update_post_meta( $post_id, 'questions', $questions );
            update_post_meta( $post_id, 'status', __( 'Not set', 'hello' ) );
            update_post_meta( $post_id, 'answer', $answer );
            update_post_meta( $post_id, 'position_candidat_id', $_POST['position_candidat_id'] );
            if ( $_POST['salary'] ) {
                update_post_meta( $post_id, 'salary', $_POST['salary'] );
                update_post_meta( $post_id, 'currency', $_POST['currency'] );
            }

            if ( !empty( $_FILES['file_cv']['tmp_name'] ) and $_FILES['file_cv']['error'] == 0 ) {
                $attachment_id = media_handle_upload( 'file_cv', 0 );

            	if ( is_wp_error( $attachment_id ) ) {
            		echo "Media upload error.";
                    $error['upload_error'] = 'Media upload error';
            	} else {
                    update_post_meta( $post_id, 'file_cv', $attachment_id );
                    $url = wp_get_attachment_url( $attachment_id );
                    $file_cv_text = pdf_text($url);
                    update_post_meta( $post_id, 'file_cv_text', $file_cv_text );

            		$error['file_success'] = "The media file has been successfully uploaded!";
            	}
            }

            $post_url = get_permalink($post_id);

            $error['success'] = 'Success';
            $error['questions'] = $questions;
            $error['post_url'] = wp_unslash($post_url);
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
        }
        wp_die();
    }
    wp_die();
}

// Update post Candidates
add_action('wp_ajax_update_candidates', 'hello_update_post_candidates');
add_action('wp_ajax_nopriv_update_candidates', 'hello_update_post_candidates');
function hello_update_post_candidates() {
    $author_id = $_POST['author'];
    $post_id = $_POST['post_id'];
    $title = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['candidates_position'];
    $level = $_POST['level'];
    $answer = $_POST['answer'];
    $status = $_POST['status'];
    $result = $_POST['result'];
    $nonce = $_POST['nonce'];

    $questions = [];
    $questions = explode("?,", $_POST['questions']);

    $error = array();
    if ( !wp_verify_nonce( $nonce, 'hello_nonce' ) ) {
        $error['empty_nonce'] = $error_request;
    }
    if ( !$author_id ) {
        $error['empty_author_id'] = $error_user;
    }
    if ( !$post_id ) {
        $error['empty_post_id'] = $error_post_id;
    }
    $post_obj = get_post( $post_id );
    if ( $post_obj->post_author != $author_id ) {
        $error['empty_post_author'] = __( 'Error user does not have permission to edit this record', 'hello' );
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {

        $my_args = array(
            'ID'		=> $post_id,
            'post_title'    => $title
        );
        wp_update_post( $my_args );

        update_post_meta( $post_id, 'email', $email );
        update_post_meta( $post_id, 'position', $position );
        update_post_meta( $post_id, 'level', $level );
        update_post_meta( $post_id, 'questions', $questions );
        update_post_meta( $post_id, 'answer', $answer );
        update_post_meta( $post_id, 'status', $status );
        if ( $_POST['salary'] ) {
            update_post_meta( $post_id, 'salary', $_POST['salary'] );
            update_post_meta( $post_id, 'currency', $_POST['currency'] );
        }
        if ($_POST['position_candidat_id'] == 0) {
            $position_candidat_id = get_post_meta( $post_id, 'position_candidat_id', true );
            if ($position_candidat_id) {
                delete_post_meta( $post_id, $key );
            }
        } else {
            update_post_meta( $post_id, 'position_candidat_id', $_POST['position_candidat_id'] );
        }

        if ( !empty( $_FILES['file_cv']['tmp_name'] ) and $_FILES['file_cv']['error'] == 0 ) {
            $attachment_id = media_handle_upload( 'file_cv', 0 );

            if ( is_wp_error( $attachment_id ) ) {
                echo "Media upload error.";
                $error['upload_error'] = 'Media upload error';
            } else {
                update_post_meta( $post_id, 'file_cv', $attachment_id );

                $url = wp_get_attachment_url( $attachment_id );
                $file_cv_text = pdf_text($url);
                update_post_meta( $post_id, 'file_cv_text', $file_cv_text );
                $error['file_success'] = "The media file has been successfully uploaded!";
            }
        }

        $error['success'] = 'Success';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;

    }
    wp_die();
}

// Evaluated post Candidates
add_action('wp_ajax_evaluated_candidates', 'hello_evaluated_candidates');
add_action('wp_ajax_nopriv_evaluated_candidates', 'hello_evaluated_candidates');
function hello_evaluated_candidates() {
    $author_id = $_POST['author'];
    $post_id = $_POST['post_id'];
    $evaluated = $_POST['evaluated'];
    $nonce = $_POST['nonce'];

    $error = array();
    if ( !wp_verify_nonce( $nonce, 'hello_nonce' ) ) {
        $error['empty_nonce'] = $error_request;
    }
    if ( !$author_id ) {
        $error['empty_author_id'] = $error_user;
    }
    if ( !$post_id ) {
        $error['empty_post_id'] = $error_post_id;
    }
    $post_obj = get_post( $post_id );
    if ( $post_obj->post_author != $author_id ) {
        $error['empty_post_author'] = __( 'Error user does not have permission to edit this record', 'hello' );
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        update_post_meta( $post_id, 'evaluated', $evaluated );

        $error['success'] = 'Success';
        $error['evaluated'] = $evaluated;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;

    }
    wp_die();
}

function hello_dashboard_score($result) {
    $score = preg_replace('/[^0-9]/', '', $result);
    if ( $result ) {
        $score_count = iconv_strlen($score);
        if ( $score_count > 2 ) {
            $score_res = mb_substr($score, 0, 2);
        } else {
            $score_res = $score;
        }
        if ( $score_res <= 60 ) {
            echo 'LOW';
        } elseif ( $score_res >= 90 ) {
            echo 'TOP';
        } else {
            echo 'MEDIUM';
        }
    } else {
        echo '';
    }
}

function hello_render_table_new($cur_user) {
    $my_posts_new = get_posts( array(
        'post_type' => 'candidates',
        'posts_per_page' => -1,
        'author' => $cur_user,
        'meta_query' => [
            [
                'key'   => 'grade',
                'compare' => 'NOT EXISTS'
            ],
            [
                'key'   => 'status',
                'value'   => 'Not set',
                'compare' => 'LIKE',
            ]
        ],
    ));
    return $my_posts_new;
}

function hello_render_table_grade($cur_user) {
    $my_posts_grade = get_posts( array(
        'post_type' => 'candidates',
        'posts_per_page' => -1,
        'author' => $cur_user,
        'meta_query' => [
    		[
    			'key'   => 'grade',
    			'value' => 'yes',
    		],
            [
                'key'   => 'status',
                'value'   => 'Not set',
                'compare' => 'LIKE',
            ]
    	],
    ));
    return $my_posts_grade;
}

function hello_render_table_archive($cur_user) {
    $my_posts_archive = get_posts( array(
        'post_type' => 'candidates',
        'posts_per_page' => -1,
        'author' => $cur_user,
        'meta_query' => [
            'relation' => 'OR',
            [
                'key'   => 'status',
                'value'   => 'Scheduled',
                'compare' => 'LIKE',
            ],
            [
                'key'   => 'status',
                'value'   => 'Rejected',
                'compare' => 'LIKE',
            ]
    	],
    ));
    return $my_posts_archive;
}

function hello_aside_nav($item) {
    global $post;
    if ( $post->post_name == $item ) {
        return [
            'style_item' => ' active',
            'style_link' => ' style="pointer-events: none;"'
        ];
    } else {
        return [
            'style_item' => '',
            'style_link' => ''
        ];
    }
    // if ( is_singular($item) == $item ) {
    //     return [
    //         'style_item' => ' active',
    //         'style_link '=> ' style="pointer-events: none;"'
    //     ];
    // }
}

function hello_aside_add() {
    if ( is_page('manage-positions') || is_singular( HELLO_POSIT ) ) {
        $link = '/add-position';
        $tooltip = __( 'Add a new position', 'hello' );
    } else {
        $link = '/add-candidates';
        $tooltip = __( 'Add a new candidate', 'hello' );
    }
    return [
        'link' => $link,
        'tooltip' => $tooltip
    ];
}

function hello_aside_dl() {
    if ( is_page('dashboard') ) {
        return '#';
    } else {
        return '/dashboard';
    }
}

// Positions
// Add post positions
add_action('wp_ajax_add_positions', 'hello_add_post_positions');
add_action('wp_ajax_nopriv_add_positions', 'hello_add_post_positions');
function hello_add_post_positions() {
    $author_id = $_POST['current_user_id'];
    $title = $_POST['name'];
    $nonce = $_POST['hello_nonce'];

    $error = array();
    if ( !wp_verify_nonce( $nonce, 'hello_nonce' ) ) {
        $error['empty_nonce'] = $error_request;
    }
    if ( !$author_id ) {
        $error['empty_author_id'] = $error_user;
    }
    if ( !$title ) {
        $error['empty_title'] = __( 'Fill in the field - Full name', 'hello' );
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        if ( $_POST['open_position'] ) {
            $post_content = $_POST['open_position'];
        } else {
            $post_content = '';
        }
        $post_data = array(
            'post_author'   => $author_id,
            'post_status'   => 'publish',
            'post_type'     => 'positions',
            'post_title'    => $title,
            'post_content'  => $post_content,
        );
        $post_id = wp_insert_post( $post_data );
        if ($post_id) {
            // wp_set_object_terms( $post_id, $position, 'candidates-position' );
            if ( $_POST['key_words'] ) {
                update_post_meta( $post_id, 'key_words', $_POST['key_words'] );
            }
            if ( $_POST['about_company'] ) {
                update_post_meta( $post_id, 'about_company', $_POST['about_company'] );
            }
            if ( $_POST['offer'] ) {
                update_post_meta( $post_id, 'offer', $_POST['offer'] );
            }
            if ( $_POST['additional_info'] ) {
                update_post_meta( $post_id, 'additional_info', $_POST['additional_info'] );
            }
            if ( $_POST['candidates_position'] ) {
                update_post_meta( $post_id, 'position', $_POST['candidates_position'] );
            }
            if ( $_POST['level'] ) {
                update_post_meta( $post_id, 'level', $_POST['level'] );
            }
            if ( $_POST['open_position'] ) {
                update_post_meta( $post_id, 'open_position', $_POST['open_position'] );
            }
            if ( $_POST['refusals_auto'] ) {
                update_post_meta( $post_id, 'refusals_auto', $_POST['refusals_auto'] );
            }
            if ( $_POST['paid_response'] ) {
                update_post_meta( $post_id, 'paid_response', $_POST['paid_response'] );
            }

            $post_url = get_permalink($post_id);

            $error['success'] = 'Success';
            $error['questions'] = $questions;
            $error['post_url'] = wp_unslash($post_url);
            $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            echo $error_fin;
        }
        wp_die();
    }
    wp_die();
}

// Update post positions
add_action('wp_ajax_update_positions', 'hello_update_post_positions');
add_action('wp_ajax_nopriv_update_positions', 'hello_update_post_positions');
function hello_update_post_positions() {
    $author_id = $_POST['current_user_id'];
    $post_id = $_POST['post_id'];
    $title = $_POST['name'];
    $nonce = $_POST['hello_nonce'];

    $error = array();
    if ( !wp_verify_nonce( $nonce, 'hello_nonce' ) ) {
        $error['empty_nonce'] = $error_request;
    }
    if ( !$author_id ) {
        $error['empty_author_id'] = $error_user;
    }
    if ( !$post_id ) {
        $error['empty_post_id'] = $error_post_id;
    }
    if ( !$title ) {
        $error['empty_title'] = __( 'Fill in the field - Full name', 'hello' );
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        if ( $_POST['open_position'] ) {
            $post_content = $_POST['open_position'];
        } else {
            $post_content = '';
        }
        $my_args = array(
            'ID'		=> $post_id,
            'post_title'    => $title,
            'post_content'  => $post_content
        );
        wp_update_post( $my_args );

        if ( $_POST['key_words'] ) {
            update_post_meta( $post_id, 'key_words', $_POST['key_words'] );
        } else {
            delete_post_meta( $post_id, 'key_words' );
        }
        if ( $_POST['about_company'] ) {
            update_post_meta( $post_id, 'about_company', $_POST['about_company'] );
        } else {
            delete_post_meta( $post_id, 'about_company' );
        }
        if ( $_POST['offer'] ) {
            update_post_meta( $post_id, 'offer', $_POST['offer'] );
        } else {
            delete_post_meta( $post_id, 'offer' );
        }
        if ( $_POST['additional_info'] ) {
            update_post_meta( $post_id, 'additional_info', $_POST['additional_info'] );
        } else {
            delete_post_meta( $post_id, 'additional_info' );
        }
        if ( $_POST['candidates_position'] ) {
            update_post_meta( $post_id, 'position', $_POST['candidates_position'] );
        }
        if ( $_POST['level'] ) {
            update_post_meta( $post_id, 'level', $_POST['level'] );
        } else {
            delete_post_meta( $post_id, 'level' );
        }
        if ( $_POST['open_position'] ) {
            update_post_meta( $post_id, 'open_position', $_POST['open_position'] );
        } else {
            delete_post_meta( $post_id, 'open_position' );
        }
        if ( $_POST['refusals_auto'] ) {
            update_post_meta( $post_id, 'refusals_auto', $_POST['refusals_auto'] );
        } else {
            delete_post_meta( $post_id, 'refusals_auto' );
        }
        if ( $_POST['paid_response'] ) {
            update_post_meta( $post_id, 'paid_response', $_POST['paid_response'] );
        } else {
            delete_post_meta( $post_id, 'paid_response' );
        }

        $error['success'] = 'Success';
        $error['post'] = $_POST;
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;

    }
    wp_die();
}

// Update post positions status
add_action('wp_ajax_update_positions_status', 'hello_update_positions_status');
add_action('wp_ajax_nopriv_update_positions_status', 'hello_update_positions_status');
function hello_update_positions_status() {
    $error = array();
    if ( !wp_verify_nonce( $_POST['hello_nonce'], 'hello_nonce' ) ) {
        $error['empty_nonce'] = $error_request;
    }
    if ( !$_POST['current_user_id'] ) {
        $error['empty_author_id'] = $error_user;
    }
    if ( !$_POST['position_id'] ) {
        $error['empty_post_id'] = $error_post_id;
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $my_args = array(
            'ID'		=> $_POST['position_id'],
            'post_status'    => $_POST['post_status']
        );
        wp_update_post( $my_args );

        $error['success'] = 'Success';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;

    }
    wp_die();
}

function hello_render_table_position($cur_user) {
    $my_posts_new = get_posts( array(
        'post_type' => 'positions',
        'posts_per_page' => -1,
        'author' => $cur_user,
        'post_status' => 'publish'
    ));
    wp_reset_postdata();
    return $my_posts_new;
}

function hello_render_table_position_arhive($cur_user) {
    $my_posts_new = get_posts( array(
        'post_type' => 'positions',
        'posts_per_page' => -1,
        'author' => $cur_user,
        'post_status' => 'draft'
    ));
    wp_reset_postdata();
    return $my_posts_new;
}

function hello_render_list_position() {
    $cur_user = get_current_user_id();
    $positions_list = get_posts( array(
        'post_type' => 'positions',
        'posts_per_page' => -1,
        'author' => $cur_user,
        'post_status' => 'publish'
    ));
    echo '<span id="0">' . __( 'Select open position', 'hello' ) . '</span>';
    foreach( $positions_list as $position ){
        echo '<span id="' . $position->ID . '">' . $position->post_title . ' #' . $position->ID . '</span>';
    }
    wp_reset_postdata();
}

// $error_request = __( 'Request error', 'hello' );
// $error_user = __( 'Error no user', 'hello' );
// $error_post_id = __( 'Error no post_id', 'hello' );
// $error_email = __( 'Error no Email', 'hello' );
// $error_email_invalid = __( 'Invalid Email', 'hello' );

// Add post response
add_action('wp_ajax_add_response', 'hello_add_post_response');
add_action('wp_ajax_nopriv_add_response', 'hello_add_post_response');
function hello_add_post_response() {

    $error = array();
    if ( !wp_verify_nonce( $_POST['hello_nonce'], 'hello_nonce' ) ) {
        $error['empty_nonce'] = $error_request;
    }
    if ( !$_POST['post_id'] ) {
        $error['empty_post_id'] = $error_post_id;
    }
    if ( !$_POST['email'] ) {
        $error['empty_email'] = __( 'No Email', 'hello' );
    }
    if ( $_POST['email'] && !is_email( $_POST['email'] ) ) {
        $error['empty_email_invalid'] = __( 'Invalid Email', 'hello' );
    }
    if ( !$_POST['name'] ) {
        $error['empty_name'] = __( 'Fill in the field - Full name', 'hello' );
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $position = get_post($_POST['post_id']);
        $post_data = array(
            'post_author'   => $position->post_author,
            'post_status'   => 'publish',
            'post_type'     => 'candidates',
            'post_title'    => $_POST['name'],
            'post_content'  => '',
        );
        $post_id = wp_insert_post( $post_data );
        // $post_id = 0;
        if ($post_id) {
            if ( $_POST['email'] ) {
                update_post_meta( $post_id, 'email', $_POST['email'] );
            }
            if ( $position->position ) {
                update_post_meta( $post_id, 'position', $position->position );
            }
            if ( $position->level ) {
                update_post_meta( $post_id, 'level', $position->level );
            }
            update_post_meta( $post_id, 'status', __( 'Not set', 'hello' ) );
            update_post_meta( $post_id, 'position_candidat_id', $_POST['post_id'] );

            if ( !empty( $_FILES['file_cv']['tmp_name'] ) and $_FILES['file_cv']['error'] == 0 ) {
                $attachment_id = media_handle_upload( 'file_cv', 0 );

            	if ( is_wp_error( $attachment_id ) ) {
            		echo "Media upload error.";
                    $error['upload_error'] = 'Media upload error';
            	} else {
                    update_post_meta( $post_id, 'file_cv', $attachment_id );
                    $url = wp_get_attachment_url( $attachment_id );
                    $file_cv_text = pdf_text($url);
                    update_post_meta( $post_id, 'file_cv_text', sanitize_text_field($file_cv_text) );

            		$error['file_success'] = "The media file has been successfully uploaded!";
            	}
            }

            // $error['new_questions'] = json_encode(hello_render_questions($position->position, 1), JSON_UNESCAPED_UNICODE); // json_encode(hello_render_questions($position->position, 1), JSON_UNESCAPED_UNICODE);
            // $error['response_match'] = hello_curl_api_response_match($file_cv_text, $position->open_position);
            //
            // $error['success'] = 'Success';
            // $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
            // echo $error_fin;

            $new_questions = hello_render_questions($position->position, 1); // json_encode(hello_render_questions($position->position, 1), JSON_UNESCAPED_UNICODE);
            $response_match = hello_curl_api_response_match($file_cv_text, $position->open_position);
            // $response_cv_text = $file_cv_text;
            $questions = explode("?,", $new_questions);
            update_post_meta( $post_id, 'questions', $questions );

            $success = 'Success';

            echo json_encode(array('success' => $success, 'new_questions' => $new_questions, 'response_match' => $response_match, 'post_id' => $post_id));

            // echo implode(", ", $new_questions);
        }
        wp_die();
    }
    wp_die();
}

// Update post response
add_action('wp_ajax_update_response', 'hello_update_post_response');
add_action('wp_ajax_nopriv_update_response', 'hello_update_post_response');
function hello_update_post_response() {

    $error = array();
    // if ( !wp_verify_nonce( $_POST['hello_nonce'], 'hello_nonce' ) ) {
    //     $error['empty_nonce'] = $error_request;
    // }
    if ( !$_POST['post_id'] ) {
        $error['empty_post_id'] = $error_post_id;
    }
    if ( !$_POST['answer'] ) {
        $error['empty_answer'] = __( 'Fill in the field - answer', 'hello' );
    }

    if ( count( $error ) > 0 ) {
        $error['class'] = 'errors';
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
        wp_die();
    } else {
        $post_cand = get_post($_POST['post_id']);
        $position = get_post($post_cand->position_candidat_id);
        // $questions = [];
        // $questions = explode("?,", $_POST['questions']);
        update_post_meta( $_POST['post_id'], 'questions', $_POST['questions'] );
        update_post_meta( $_POST['post_id'], 'answer', $_POST['answer'] );
        if ( $_POST['salary'] ) {
            update_post_meta( $_POST['post_id'], 'salary', $_POST['salary'] );
            update_post_meta( $_POST['post_id'], 'currency', $_POST['currency'] );
        }

        hello_curl_api_new_new_response($_POST['answer'], $post_cand->position, $post_cand->level, $_POST['post_id']);

        hello_curl_api_dop_questions($_POST['post_id']); //$post_cand->file_cv_text, $position->open_position,

        // $generating_questions = hello_curl_api_dop_questions($post_cand->file_cv_text, $position->open_position, $_POST['post_id']);

        $error['success'] = 'Success';
        // $error['generating_questions'] = $generating_questions;
        // $error['answer'] = $_POST['answer'];
        $error_fin = json_encode($error, JSON_UNESCAPED_UNICODE);
        echo $error_fin;
    }
    wp_die();
}
