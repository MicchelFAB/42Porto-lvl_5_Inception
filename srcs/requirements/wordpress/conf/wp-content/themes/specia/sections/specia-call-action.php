<?php 
	$specia_hs_cta				= get_theme_mod('hide_show_call_actions','on'); 
	$specia_cta_bg_setting		= get_theme_mod('call_action_background_setting',esc_url(get_template_directory_uri() .'/images/cta.jpg'));
	$specia_cta_btn_lbl			= get_theme_mod('call_action_button_label');
	$specia_cta_btn_link		= get_theme_mod('call_action_button_link');
	$specia_cta_btn_target		= get_theme_mod('call_action_button_target');
	$specia_cta_btn_middle_text	= get_theme_mod('call_action_btn_middle_text');
	$specia_cta_button_label2	= get_theme_mod('call_action_button_label2');
	$specia_cta_button_link2	= get_theme_mod('call_action_button_link2');
	if($specia_hs_cta == 'on') :
?>
<section id="cta-unique" class="call-to-action-one specia wow fadeInDown">
	<div class="background-overlay" style="background-image:url('<?php echo esc_url($specia_cta_bg_setting); ?>'); background-attachment: fixed;">
        <div class="container">
            <div class="row padding-top-25 padding-bottom-25">                
                <div class="col-md-8">
					<?php 
						$specia_aboutusquery1 = new wp_query('page_id='.get_theme_mod('call_action_page',true)); 
						if( $specia_aboutusquery1->have_posts() ) 
						{   while( $specia_aboutusquery1->have_posts() ) { $specia_aboutusquery1->the_post(); 
					?>
                    <h2 class="demo1"> <?php the_title(); ?> <span class="rotate"> <?php the_content(); ?></span> </h2>
					
					<?php } } wp_reset_postdata(); ?>
                </div>				
				
                <div class="col-md-4 text-md-right flexing flexing-end">
					<?php if($specia_cta_btn_lbl) :?>
						<a href="<?php echo esc_url($specia_cta_btn_link); ?>" <?php if(($specia_cta_btn_target)== 1){ echo "target='_blank'"; } ?> class="bt-primary bt-effect-1 call-btn-1 bt-white"><?php echo esc_html($specia_cta_btn_lbl); ?></a>
					<?php endif; ?>
					
					<?php if(!empty($specia_cta_btn_middle_text)): ?>
						<span class="cta-or"><?php echo wp_kses_post($specia_cta_btn_middle_text); ?></span>
					<?php endif; ?>
					
					<?php if(!empty($specia_cta_button_label2)): ?>
						<div class="call-wrapper">
							<div class="cta-info">
								<div class="call-phone"><a href="<?php echo esc_url($specia_cta_button_link2); ?>"><?php echo wp_kses_post($specia_cta_button_label2); ?></a></div>
							</div>
						</div>
					<?php endif; ?>
                </div>
				
            </div>
        </div>
    </div>
</section>
<div class="clearfix"></div>
<?php endif; ?>
