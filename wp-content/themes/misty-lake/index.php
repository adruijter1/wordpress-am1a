<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Misty Lake
 * @since Misty Lake 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="updateable site-content" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php mistylake_get_template_part(); ?>

			<?php endwhile; ?>

			<?php mistylake_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php
get_sidebar();
get_footer();
