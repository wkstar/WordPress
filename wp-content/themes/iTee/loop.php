<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="date">
			<span>
				<?php the_time('j'); ?>
			</span><br/>
			<?php the_time('F \'y'); ?>
		</div>

		

		<!-- post title -->
		<h2>
			<?php the_title(); ?>
		</h2>
		<!-- /post title -->

		<?php the_content(); // Build your custom callback length in functions.php ?>


	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
