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
				<?php the_secondary_content(); ?>
				
				<div id="tabs">
					<nav>
						<?php 
							$args = array( 'post_type' => 'support_tabs', 'posts_per_page' => 10 );
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post();
							  echo '<a href="">';
							  the_title();
							  echo '</a>';
							endwhile;
						?>
					</nav>
					<div class="tabsCol">
					<?php 
						$args = array( 'post_type' => 'support_tabs', 'posts_per_page' => 10 );
						$loop = new WP_Query( $args );
						while ( $loop->have_posts() ) : $loop->the_post();
						  echo '<div class="tabWrap">';
						  the_content();
						  echo '</div>';
						endwhile;
					?>
					</div>
				</div>
				
			</div>
		</section>
		
	</main>

<?php get_footer(); ?>
