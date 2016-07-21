<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.png" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		
		<link href="http://fonts.googleapis.com/css?family=Raleway:600,800,400,300" rel="stylesheet" type="text/css">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

		<!-- analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-64604843-1', 'auto');
			ga('send', 'pageview');			
		</script>
	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header clear" role="banner" style="background-image: url(<?php echo $image_src = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?><?php if( is_404() ){ $options = get_option( 'tp_theme_options' ); echo $options['tp_generic_image']; } ?>);">

					<div class="topImage">
					<?php 
						/*
if( is_front_page() ){
	
							//if you need image for front page
						}
*/
						/*
if( is_singular() ){						
							if( have_posts() ){
							 	while( have_posts() ){
							        	the_post();
										the_post_thumbnail( 'full','style=max-width:100%;height:auto;');
							    	}
							}
							rewind_posts();
						}
*/
						
						
					?>
					
						<!-- post thumbnail -->
						<?php /*if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
							<?php the_post_thumbnail(); // Declare pixel size you need inside the array ?>
							
						<?php endif;*/ ?>
						<!-- /post thumbnail -->
						
						<?php
							if( is_front_page() ){
								echo '<div class="text">';
								$options = get_option( 'tp_theme_options' ); 
								echo "<h1>". $options['tp_textbox_topTitle'] . "</h1>";
								echo '<p class="one">'. $options['tp_textbox_topCopy'] . '</p>';
								echo '<p class="two">'. $options['tp_textbox_topCopy2'] . '</p>';
								echo '</div>';
								echo '<span class="homeHeaderImage" style="background-image: url(' . $options['tp_textbox_topImage'] . ');"></span>';
							}
						?>
						
						
					</div>
					<span class="tint"></span>
					
					<!-- logo -->
					<div class="logo">
						<a href="<?php echo home_url(); ?>">
							<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
						</a>
					</div>
					<!-- /logo -->

					<!-- nav -->
					<nav class="nav" role="navigation">
						<a href="/" id="mobileLogo">iTee Systems</a>
						<a id="nav-toggle" href="#"><i>Menu</i> <span></span></a>
						<?php ifc_nav(); ?>
					</nav>
					<!-- /nav -->

			</header>
			<!-- /header -->
			
			<div class="inner">
			
			
			
			
			
			
			
			
			
			
			
