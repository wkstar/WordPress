<?php 
// Template name: Contact Template
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
				
				<div class="contactWrap">
					<div class="left">
						<div class="map">
							<?php $options = get_option( 'tp_theme_options' ); echo $options['tp_textbox_mapIframe']; ?>
						</div>
						<div class="addressDetails">
							<?php the_secondary_content(); ?>
						</div>
					</div>
					
					<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
					
				</div>			
				
				
				
				
			</div>
		</section>
		
	</main>

<?php get_footer(); ?>
