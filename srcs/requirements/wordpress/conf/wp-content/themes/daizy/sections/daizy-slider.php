<?php 
	$daizy_hs_slider		= get_theme_mod('hide_show_slider','on');
	if( $daizy_hs_slider == 'on' ): 
?>

<?php 
	for($slide =1; $slide<4; $slide++) 
	{
		if( get_theme_mod('slider-page'.$slide)) 
		{
			$slidequery = new WP_query('page_id='.get_theme_mod('slider-page'.$slide,true));
			while( $slidequery->have_posts() ) 
			{ 
				$slidequery->the_post();
				$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
				$img_arr[] = $image;
				$id_arr[] = $post->ID;
			}    
		}
	}
?>

<?php if(!empty($id_arr))
	{ ?>
	<section id="slider-section" class="slider-wrapper-daizy slider-section-daizy">
		<div class="main-slider-daizy arrows-small arrows-transparent" data-slider-id="1">
			<?php 
				$i=1;
				foreach($id_arr as $id)
				{ 
					$title	= get_the_title( $id ); 
					$post	= get_post($id); 
					
					$content = $post->post_content;
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]>', $content);
				?>  
				
				<div class="item">
					
					<?php
						$image 			= wp_get_attachment_url( get_post_thumbnail_id($post->ID));
						$thumbnail_id 	= get_post_thumbnail_id( $post->ID );
						$alt 			= get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
					?>
					<img src="<?php echo esc_url($image);?>" alt="<?php echo esc_attr($alt); ?>">
					
					<div class="specia-slider <?php echo esc_attr(get_post_meta( get_the_ID(),'slider_caption_align', true)); ?>" style="background: rgba(0,0,0,0.55);">
						<div class="specia-table">
							<div class="specia-table-cell">
								<div class="container">                                
									<div class="specia-content">
										<h1 data-animation="fadeInRight" data-delay="90ms"><span><?php echo wp_filter_post_kses($title); ?></span></h1>
										
										<span data-animation="fadeInUp" data-delay="650ms">
											<?php echo wp_kses_post($content); ?>
										</span>
										
										<?php if( get_post_meta(get_the_ID(),'slidebutton', true ) ): ?>
										<a data-animation="fadeInUp" data-delay="850ms" href="<?php echo esc_url( get_post_meta( get_the_ID(),'slidebuttonlink', true) ); ?>" class="bt-wave btn1"><span class="wavebtn-title"><?php echo esc_html( get_post_meta( get_the_ID(),'slidebutton', true) ); ?></span><div class="liquid"></div></a>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php $i++; } ?> 
		</div>
	</section>
	
	<div class="clearfix"></div>
	
<?php } wp_reset_postdata(); endif; ?>




