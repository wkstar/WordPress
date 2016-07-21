<?php 
// Template name: Support Template
get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>
			<div class="inner">

				<h1><?php the_title(); ?></h1>
	
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		
					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
						<?php the_content(); ?>
		
					</article>
					<!-- /article -->
		
				<?php endwhile; ?>
				<?php endif; ?>
			
			</div>
		</section>
		<!-- /section -->
		
		<section id="blue">
			<div class="inner">
				
				<?php 
					$args = array( 'post_type' => 'features', 'posts_per_page' => 10 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						echo '<div class="featureWrap">';
							echo '<span id="';
								print_custom_field('deeplink'); 
							echo '"></span>';
							the_post_thumbnail();
							echo '<div class="featureContent">';
								echo '<h2>';
								the_title();
								echo '</h2>';
								the_content();
							echo '</div>';
						echo '</div>';
					endwhile;
				?>
				
			</div>
		</section>
		
	</main>

<?php get_footer(); ?>
