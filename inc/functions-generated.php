<?php
// Openai
require get_template_directory() . '/includes/Openai.php';

add_action('wp_ajax_text_generated', 'hello_curl_api_new');
add_action('wp_ajax_nopriv_text_generated', 'hello_curl_api_new');
function hello_curl_api_new() {
	$openai = New Openai();

	$text = $_POST['text'];
	$position = $_POST['position'];
	$level = $_POST['level'];
	$enLsChek = $_POST['enLsChek'];
	$post_id = $_POST['post_id'];

	if ( $enLsChek == 'yes' ) {
		$en_text = 'also rating the English level skills by the CEFR range from A1 to C2';
	} else {
		$en_text = '';
	}

	$zapros = 'Evaluate this answer on position ' . $level . ' ' . $position . ' scoring 0 to 100 where 100 is the highest score ' . $en_text . ': ' . $text . '.';
	$number = iconv_strlen($zapros)/4;
	$number = round($number);

	if ( $number > 3900 ) {
		$number = 3900;
	}

	$result = $openai->complit("text-davinci-003", $zapros, $number);

	$obj = json_decode($result, true);
	$result = str_replace($zapros, '', $obj[choices][0][text]);
    $result_fin = preg_replace('/\d/','',$result);
	echo $result;
	update_post_meta( $post_id, 'grade', 'yes' );
	update_post_meta( $post_id, 'result', $result );
	wp_die();
}

add_action('wp_ajax_text_generated_new', 'hello_curl_api_new_new');
add_action('wp_ajax_nopriv_text_generated_new', 'hello_curl_api_new_new');
function hello_curl_api_new_new() {
	$openai = New Openai();

	$text = $_POST['text'];
	$position = $_POST['position'];
	$level = $_POST['level'];
	$enLsChek = $_POST['enLsChek'];
	$post_id = $_POST['post_id'];

	if ( $enLsChek == 'yes' ) {
		$en_text = 'also rating the English level skills by the CEFR range from A1 to C2';
	} else {
		$en_text = '';
	}

	$zapros = 'Evaluate this answer on position ' . $level . ' ' . $position . ' scoring 0 to 100 where 100 is the highest score ' . $en_text . ': ';

	$result = $openai->questions($zapros, $text );

	$obj = json_decode($result, true);
	$result = str_replace($zapros, '', $obj['choices'][0]['message']['content']);
    $result_fin = preg_replace('/\d/','',$result);
	echo $result;
	update_post_meta( $post_id, 'grade', 'yes' );
	update_post_meta( $post_id, 'result', $result );
	wp_die();
}

add_action('wp_ajax_position_generated', 'hello_curl_api_position_generated');
add_action('wp_ajax_nopriv_position_generated', 'hello_curl_api_position_generated');
function hello_curl_api_position_generated() {
	$openai = New Openai();

    $parameter = $_POST['parameter'];

	$text = $_POST['position_text'];
	$job_title = $_POST['name'];
	$level = $_POST['level'];
	$key_words = $_POST['key_words'];
    $about_company = $_POST['about_company'];
    $offer = $_POST['offer'];

	$post_id = $_POST['post_id'];

    $text = 'Generate a job description based on the following information and using Key Words for creating Tasks and Responsibilities of this job description. Make sure the JD contains all of the information below including generated Tasks and Responsibilities. make this job description appealing and modern for the applicant:';
    // $zapros = 'Generate a job description based on the following information using Key Words for creating Tasks and';
    // $zapros = $parameter;
    $zapros = 'Job Title: ' . $job_title . ' ';
    $zapros .= 'Level: ' . $level . ' ';
    $zapros .= 'Key Words: ' . $key_words . ' ';
    $zapros .= 'About the company: ' . $about_company . ' ';
    $zapros .= 'What we offer: ' . $offer . ' ';

	$result = $openai->questions( $text, $zapros );

    // $result = $openai->complit_new("gpt-4", $zapros, 3900);

    if ($result) {
        $obj = json_decode($result, true);
        // $result = str_replace($zapros, '', $obj['choices'][0]['text']);
    	$result = str_replace($zapros, '', $obj['choices'][0]['message']['content']);
        // $result_fin = preg_replace('/\d/','',$result);
    	echo $result;
        // echo $obj;
    } else {
        echo 'WARNING';
    }
	wp_die();
}

function hello_curl_api_response_match($cv, $position_applied) {
	$openai = New Openai();

    $text = 'You are an IT recruiter helper. Match CV and Open position and answer with one word true or false if the applicant is suitable for this open position.';

    $zapros = 'CV: ' . $cv . ' ';
    $zapros .= 'Position applied: ' . $position_applied . ' ';

	$result = $openai->questions( $text, $zapros );

    if ($result) {
        $obj = json_decode($result, true);
        // $result = str_replace($zapros, '', $obj['choices'][0]['text']);
    	$result = str_replace($zapros, '', $obj['choices'][0]['message']['content']);
        // $result_fin = preg_replace('/\d/','',$result);
    	return $result;
        // echo $obj;
    } else {
        echo 'WARNING';
    }
	wp_die();
}

function hello_curl_api_new_new_response($text, $position, $level, $post_id) {
	$openai = New Openai();

	$zapros = 'Evaluate this answer on position ' . $level . ' ' . $position . ' scoring 0 to 100 where 100 is the highest score : ';

	$result = $openai->questions($zapros, $text );

	$obj = json_decode($result, true);
	$result = str_replace($zapros, '', $obj['choices'][0]['message']['content']);
    $result_fin = preg_replace('/\d/','',$result);
	update_post_meta( $post_id, 'grade', 'yes' );
	update_post_meta( $post_id, 'result', $result );
}

function hello_curl_api_dop_questions($post_id) { //$cv, $position_applied,
	$openai = New Openai();

	$post_cand = get_post($post_id);

	$cv = get_post_meta( $post_id, 'file_cv_text', true );

	$position_applied = get_post_meta( $post_cand->position_candidat_id, 'open_position', true );

    $text = 'You are an IT recruiter helper. Generate questions for a pre-screening interview with IT recruiter which lasts no more than 15 minutes highlighting discrepancies in the CV based on the following CV and Job Description : ';

    $zapros = 'CV: ' . $cv . ' ';
    $zapros .= 'Job Description: ' . $position_applied . ' ';

	$result = $openai->questions( $text, $zapros );

    if ($result) {
        $obj = json_decode($result, true);
    	$result_fin = str_replace($zapros, '', $obj['choices'][0]['message']['content']);
		update_post_meta( $post_id, 'generating_questions', $result_fin );
    } else {
        return 'WARNING';
		wp_die();
    }
}

add_action('wp_ajax_dop_questions_test', 'hello_curl_api_dop_questions_test');
add_action('wp_ajax_nopriv_dop_questions_test', 'hello_curl_api_dop_questions_test');
function hello_curl_api_dop_questions_test() { //$cv, $position_applied, $post_id
	$openai = New Openai();

	$post_cand = get_post($_POST['post_id']);

	$cv = get_post_meta( $_POST['post_id'], 'file_cv_text', true );

	$position_applied = get_post_meta( $post_cand->position_candidat_id, 'open_position', true );

    $text = 'You are an IT recruiter helper. Generate questions for a pre-screening interview with IT recruiter which lasts no more than 15 minutes highlighting discrepancies in the CV based on the following CV and Job Description : ';

    $zapros = 'CV: ' . $cv . ' ';
    $zapros .= 'Job Description: ' . $position_applied . ' ';

	$result = $openai->questions( $text, $zapros );

    if ($result) {
        $obj = json_decode($result, true);
    	$result_fin = str_replace($zapros, '', $obj['choices'][0]['message']['content']);
		update_post_meta( $_POST['post_id'], 'generating_questions', $result_fin );
		echo $result_fin;
		wp_die();
    } else {
        return 'WARNING';
		wp_die();
    }
}
