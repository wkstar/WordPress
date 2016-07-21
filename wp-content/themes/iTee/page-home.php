<?php 
// Template name: Home Template
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
					
					<?php $promo = get_secondary_content(); ?>
				<?php endwhile; ?>
				<?php endif; ?>
				
			</div>
			
		</section>
		
		<?php 
			$args = array( 'post_type' => 'home_clusters', 'posts_per_page' => 10 );
			$loop = new WP_Query( $args );
			$count = 1;
			
			while ( $loop->have_posts() ) : $loop->the_post();
				$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405 ), false, '' );

				echo '<div class="home_cluster" style="background-image: url(', $src[0], ');">';

			  //echo '<div class="home_cluster" data-parallax="scroll" data-image-src="', $src[0], '">';
			  echo '<div class="inner">';
			  echo '<div class="copy">';
			  echo '<h2>', the_title(), '</h2>';
			  the_content();
			  echo '<p class="moreLink"><a href="/features', print_custom_field('link_slug') ,'">Find out more</a></p>';
			  echo '</div>';
			  echo '</div>';
			  echo '</div>';
			  
			  // Spit out secondary content promo after 2nd cluster
			  if($count == 2){
			  	echo '<section class="promo"><div class="inner">';
			  	echo $promo;
			  	echo '</div></section>';
			  }
			  
			  $count++;
			endwhile;
		?>
		
	</main>

<?php get_footer(); ?>
