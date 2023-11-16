<?php
/**
 * Template Name: Manage page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hello
 */

get_header();
?>

	<main id="primary" class="page-manage">

		<?php get_template_part( 'template-parts/page/manage' ); ?>

	</main><!-- #main -->

<?php
get_footer();
