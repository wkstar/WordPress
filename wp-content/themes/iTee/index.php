<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>
			<div class="inner">

				<?php
					$include = get_pages('include='. 13);
					$content = apply_filters('the_title',$include[0]->post_title);
					echo '<h1>', $content, '</h1>';
				?>
				<?php
					$include = get_pages('include='. 13);
					$content = apply_filters('the_content',$include[0]->post_content);
					echo $content;
				?>
				
			</div>

		</section>
		<!-- /section -->
		
		<!-- section -->
		<section id="blue">
			<div class="inner">
			
				<div class="newsWrap">
					<div class="articleWrap">
						<?php get_template_part('loop'); ?>
						<?php get_template_part('pagination'); ?>
					</div>
					
					<?php get_sidebar(); ?>
				</div>
				
			</div>
		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
