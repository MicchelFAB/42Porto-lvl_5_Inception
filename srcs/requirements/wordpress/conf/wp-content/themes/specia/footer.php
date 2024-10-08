
<!--======================================
    Footer Section
========================================-->
<?php if ( is_active_sidebar( 'footer-widget-area' ) ) { ?>
	<footer class="footer-sidebar" role="contentinfo">     
		<div class="background-overlay">
			<div class="container">
				<div class="row padding-top-60 padding-bottom-60">
					<?php  dynamic_sidebar( 'footer-widget-area' ); ?>
				</div>
			</div>
		</div>
	</footer>
<?php } ?>

<div class="clearfix"></div>

<!--======================================
    Footer Copyright
========================================-->
<?php
	$specia_hide_show_copyright		= get_theme_mod('hide_show_copyright','on'); 
	$specia_hide_show_payment 		= get_theme_mod('hide_show_payment','on');
?>
<?php if($specia_hide_show_copyright == 'on' || $specia_hide_show_payment == 'on'): ?>
	<section id="specia-footer" class="footer-copyright">
		<div class="container">
			<div class="row padding-top-20 padding-bottom-10 ">
				<div class="col-md-6 text-left">
					<?php 
						$specia_copyright_content= get_theme_mod('copyright_content','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]'); 
					?>
					<?php if($specia_hide_show_copyright == 'on') : ?>
						<p class="copyright">
						<?php 
							$specia_copyright_allowed_tags = array(
								'[current_year]' => date_i18n('Y'),
								'[site_title]'   => get_bloginfo('name'),
								'[theme_author]' => sprintf(__('<a href="https://speciatheme.com/" target="_blank">Specia WordPress Theme</a>', 'specia')),
							);	
							echo apply_filters('specia_footer_copyright', wp_kses_post(specia_str_replace_assoc($specia_copyright_allowed_tags, $specia_copyright_content)));
						?>
						</p>
					<?php endif; ?>
				</div>

				<div class="col-md-6">
					<?php 
						$specia_icon_one	= get_theme_mod('icon_one',''); 
						$specia_icon_two	= get_theme_mod('icon_two',''); 
						$specia_icon_three	= get_theme_mod('icon_three',''); 
						$specia_icon_four	= get_theme_mod('icon_four',''); 
						$specia_icon_five	= get_theme_mod('icon_five',''); 
					?>
					
					<?php if($specia_hide_show_payment == 'on') { ?>
						<ul class="payment-icon">
							<?php if($specia_icon_one) { ?> 
								<li><a href="<?php echo esc_url($specia_icon_one); ?>"><i class="fa fa-cc-paypal"></i></a></li>
							<?php } ?>
							
							<?php if($specia_icon_two) { ?> 
								<li><a href="<?php echo esc_url($specia_icon_two); ?>"><i class="fa fa-cc-visa"></i></a></li>
							<?php } ?>
								
							<?php if($specia_icon_three) { ?> 
								<li><a href="<?php echo esc_url($specia_icon_three); ?>"><i class="fa fa-cc-mastercard"></i></a></li>
							<?php } ?>
								
							<?php if($specia_icon_four) { ?> 
								<li><a href="<?php echo esc_url($specia_icon_four); ?>"><i class="fa fa-cc-amex"></i></a></li>
							<?php } ?>
							
							<?php if($specia_icon_five) { ?> 
								<li><a href="<?php echo esc_url($specia_icon_five); ?>"><i class="fa fa-cc-stripe"></i></a></li>
							<?php } ?>
						</ul>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<!--======================================
    Top Scroller
========================================-->
<a href="#" class="top-scroll"><i class="fa fa-hand-o-up"></i></a> 
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>
