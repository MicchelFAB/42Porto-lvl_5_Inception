<?php 
	$specia_hs_features				= get_theme_mod('hide_show_features','on'); 
	$specia_features_title			= get_theme_mod('features_title'); 
	$specia_features_description	= get_theme_mod('features_description'); 
	$specia_features_bg_setting		= get_theme_mod('features_background_setting',esc_url(get_template_directory_uri() .'/images/features.jpg'));  	
	if($specia_hs_features == 'on') {
?>

<section id="specia-feature" class="features-version-one" style="background: url('<?php echo esc_url($specia_features_bg_setting); ?>') no-repeat fixed 0 0 / cover rgba(0, 0, 0, 0);">

    <div class="features-overlay">
        <div class="container">
            
            <div class="row text-center padding-top-60 padding-bottom-30">
                <div class="col-sm-12">
					<?php if ($specia_features_title)  : ?>
						<h2 class="section-heading wow zoomIn"><?php echo wp_filter_post_kses($specia_features_title); ?></span></h2>
					<?php endif; ?>
					
					<?php if ($specia_features_description)  : ?>
						<p class="section-description"><?php echo esc_html($specia_features_description); ?></p>
					<?php endif; ?>
                </div>
            </div>
			
			<?php 
				if( is_active_sidebar('specia_feature_widget') ) :
					echo '<div class="row padding-bottom-30">';
						dynamic_sidebar( 'specia_feature_widget' );
					echo '</div>';
				endif;
			?>
		
		</div>
    </div>
</section>
<div class="clearfix"></div>
<?php } ?>