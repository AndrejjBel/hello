<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hello
 */

?>

<div class="dashboard">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', ' #' . $post->ID . '</a></h1>' ); ?>
		</header><!-- .entry-header -->

		<?php hello_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			// the_content();
			the_excerpt();

			?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->

</div>
