<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hello
 */

 $post_obj = get_post( get_the_ID() );
 if ( $post_obj->post_author != get_current_user_id() ) { // && !current_user_can('administrator')
   echo '<script> window.location.href = "/dashboard"</script>';
 }

get_header();
?>

	<main id="primary" class="page-dashboard">

		<?php
    		while ( have_posts() ) :
    			the_post();

    			get_template_part( 'template-parts/single/content', 'candidates' );

    		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
