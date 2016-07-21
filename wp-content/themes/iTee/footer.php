			</div>
			<!-- /inner -->
			
			<!-- footer -->
			<footer class="footer" role="contentinfo">
				
				<ul id="social">
					<li class="linkedin"><a href="<?php $options = get_option( 'tp_theme_options' ); echo $options['tp_textbox_socLinkedin']; ?>" target="_blank">LinkedIn</a></li>
					<?php /*<li class="google"><a href="<?php $options = get_option( 'tp_theme_options' ); echo $options['tp_textbox_socGoogle']; ?>">Google+</a></li>*/?>
					<li class="twitter"><a href="<?php $options = get_option( 'tp_theme_options' ); echo $options['tp_textbox_socTwitter']; ?>" target="_blank">Twitter</a></li>
					<?php /*<li class="facebook"><a href="<?php $options = get_option( 'tp_theme_options' ); echo $options['tp_textbox_socFacebook']; ?>">Facebook</a></li>*/?>
					<li class="instagram"><a href="<?php $options = get_option( 'tp_theme_options' ); echo $options['tp_textbox_socInstagram']; ?>" target="_blank">Instagram</a></li>
				</ul>
				
				<ul id="cta">
					<!--
<li class="register"><a href="">Register</a></li>
					<li class="login"><a href="">Login</a></li>
-->
					<li><?php $options = get_option( 'tp_theme_options' ); echo $options['tp_textbox_phoneNumber']; ?></li>
				</ul>
				
				<nav>
					<?php ifc_nav2(); ?>
				</nav>
				
				<p>&copy; Copyright <?php echo date("Y"); ?> iTee Systems Limited | <a href="http://www.ianfarrellcreative.com" target="_blank">Website by IFC</a></p>

			</footer>
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

	</body>
</html>
