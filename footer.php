<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hello
 */

?>

</div><!-- #page -->

<form id="hello-form">
    <input type="hidden" id="post_id" name="post_id" value="<?php the_ID(); ?>">
    <input type="hidden" id="current_user_id" name="current_user_id" value="<?php echo get_current_user_id(); ?>">
    <?php wp_nonce_field('hello_nonce', 'hello_nonce'); ?>
</form>

<?php wp_footer(); ?>

</body>
</html>
