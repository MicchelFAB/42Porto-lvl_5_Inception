<div class="navigator-wrapper">
	<!-- Mobile Toggle -->
	<div class="theme-mobile-nav d-lg-none d-block <?php echo esc_attr(specia_sticky_menu()); ?>">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="theme-mobile-menu">
						<div class="headtop-mobi">
							<div class="headtop-shift">
								<a href="javascript:void(0);" class="header-sidebar-toggle open-toggle"><span></span></a>
								<a href="javascript:void(0);" class="header-sidebar-toggle close-button"><span></span></a>
								<div id="mob-h-top" class="mobi-head-top animated"></div>
							</div>
						</div>
						<?php 
							$mobile_logo= get_theme_mod('mobile_logo'); 	
						?>
						<div class="mobile-logo">
							<a href="<?php echo esc_url(home_url( '/' )); ?>" class="navbar-brand">
								
								<?php if($mobile_logo) { ?>
									<img src="<?php echo esc_url($mobile_logo); ?>"/>
									<?php
									}
									else { 
										echo esc_html(get_bloginfo('name'));
									}
								?>
								<?php
									$daizy_description = get_bloginfo( 'description');
								if ($daizy_description) : ?>
								<p class="site-description"><?php echo esc_html($daizy_description); ?></p>
								<?php endif; ?>
							</a>
						</div>
						<div class="menu-toggle-wrap">
							<div class="hamburger-menu">
								<a href="javascript:void(0);" class="menu-toggle">
									<div class="top-bun"></div>
									<div class="meat"></div>
									<div class="bottom-bun"></div>
								</a>
							</div>
						</div>
						<div id="mobile-m" class="mobile-menu">
							<div class="mobile-menu-shift">
								<a href="javascript:void(0);" class="close-style close-menu"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- / -->
	
	<!-- Top Menu -->
	<div class="xl-nav-area d-none d-lg-block">
		<div class="navigation transparent <?php echo esc_attr(specia_sticky_menu()); ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-12 my-auto"><div class="header-wrapper">
						<div class="brand-logo">
		                    <div class="logo">
	                            <?php
									if(has_custom_logo()) {   
										the_custom_logo();
									}
									else { ?>
		                        	<a href="<?php echo esc_url(home_url( '/' )); ?>" class="navbar-brand">
		                        		<?php echo esc_html(get_bloginfo('name')); ?>
									</a>
									<?php }
									$daizy_description = get_bloginfo( 'description');
								if ($daizy_description) : ?>
								<p class="site-description"><?php echo esc_html($daizy_description); ?></p>
		                        <?php endif; ?>
							</div>
						</div>
	                	
						<div class="theme-menu">					
							
							<nav class="menubar">
								<?php
									wp_nav_menu( 
									array(  
									'theme_location' => 'primary_menu',
									'container'  => '',
									'menu_class' => 'menu-wrap',
									'fallback_cb' => 'specia_fallback_page_menu::fallback',
									'walker' => new specia_nav_walker()
									) 
									);
								?> 
								<?php 
									$daizy_hs_nav_contact_info2 		= get_theme_mod('hs_nav_contact_info2','1');
									$daizy_hdr_nav_contact_icon2 		= get_theme_mod('hdr_nav_contact_icon2','fa-hourglass-end');
									$daizy_hdr_nav_contact_ttl2 		= get_theme_mod('hdr_nav_contact_ttl2');
									$daizy_hdr_nav_contact_subttl2 	= get_theme_mod('hdr_nav_contact_subttl2');
									$daizy_hdr_nav_contact_link2 		= get_theme_mod('hdr_nav_contact_link2');
								?>
								
							</nav>
							
							
							
						</div>
						<?php 
							$daizy_hs_nav_contact_info2 		= get_theme_mod('hs_nav_contact_info2','1');
							$daizy_hdr_nav_contact_icon2 		= get_theme_mod('hdr_nav_contact_icon2','fa-hourglass-end');
							$daizy_hdr_nav_contact_ttl2 		= get_theme_mod('hdr_nav_contact_ttl2');
							$daizy_hdr_nav_contact_subttl2 		= get_theme_mod('hdr_nav_contact_subttl2');
							$daizy_hdr_nav_contact_link2 		= get_theme_mod('hdr_nav_contact_link2');
						?>
						<div class="menu-right">
							<ul class="wrap-right">	
								<li class="search-button">
									<a href="#" id="view-search-btn" class="header-search-toggle"><i class="fa fa-search"></i></a>
									<!-- Quik search -->
									<div class="view-search-btn header-search-popup">
										<form  method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Site Search', 'daizy' ); ?>">
											<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'daizy' ); ?></span>
											<input type="search" class="search-field header-search-field" placeholder="<?php esc_attr_e( 'Type To Search', 'daizy' ); ?>" name="s" id="popfocus" value="" autofocus>
											<a href="#" class="close-style header-search-close"></a>
										</form>
									</div>
									<!-- / -->
								</li>	
								
								<?php 
									$daizy_header_cart= get_theme_mod('header_cart','1');
									if($daizy_header_cart == '1'){ ?>
									<li class="cart-wrapper">
										<div class="cart-icon-wrap">
											<a href="javascript:void(0)" id="cart"><i class="fa fa-shopping-bag"></i>
												<?php 
													if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
														$count = WC()->cart->cart_contents_count;
														$cart_url = wc_get_cart_url();
														
														if ( $count > 0 ) {
														?>
														<span><?php echo esc_html( $count ); ?></span>
														<?php 
														}
														else {
														?>
														<span><?php echo esc_html_e( '0','daizy' ); ?></span>
														<?php 
														}
													}
												?>
											</a>
										</div>
										
										<!-- Shopping Cart -->
										<?php if ( class_exists( 'WooCommerce' ) ) { ?>
											<div id="header-cart" class="shopping-cart">
												<div class="cart-body">                                            
													<?php get_template_part('woocommerce/cart/mini','cart');     ?>
												</div>
											</div>
										<?php } ?>
										<!--end shopping-cart -->
									</li>
								<?php } 
								
										$daizy_hdr_btn_hs  = get_theme_mod('header_book_hide_show','1');
                                    	$daizy_button_label= get_theme_mod('button_label');
										$daizy_button_url	= get_theme_mod('button_url');
										$daizy_button_target = get_theme_mod('button_target');
										
                                        if(($daizy_button_target)== 1) {
                                            $daizy_button_target= "target='_blank'"; 
                                        }   
                                        if($daizy_hdr_btn_hs == '1') {
                                        ?>
                                        <li class="menu-item header_btn">
                                            <a href="<?php echo esc_url($daizy_button_url); ?>" <?php echo $daizy_button_target; ?> class="bt-wave btn1"><span class="wavebtn-title"><?php echo esc_html($daizy_button_label); ?></span><div class="liquid"></div></a>
                                        </li>
                                        <?php } ?>	
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</header>
<?php 
	if ( !is_page_template( 'templates/template-homepage-one.php' )) {
		specia_breadcrumbs_style(); 
	}
	?>							