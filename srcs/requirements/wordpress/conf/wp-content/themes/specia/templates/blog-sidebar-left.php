<?php
/**
Template Name: Blog Left Sidebar
**/
get_header();
?>

<!-- Blog & Sidebar Section -->
<section class="page-wrapper">
	<div class="container">
		<div class="row padding-top-60 padding-bottom-60">
			
			<!--Blog Detail-->
			<?php get_sidebar(); ?>
			
			<div class="<?php esc_attr(specia_post_column()); ?>" >
					
					<?php 
					$specia_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$specia_args = array( 'post_type' => 'post','paged'=>$specia_paged );	
					$specia_loop = new WP_Query( $specia_args );
					?>
					
					<?php if( $specia_loop->have_posts() ): ?>
					
						<?php while( $specia_loop->have_posts() ): $specia_loop->the_post(); ?>
						
							<?php get_template_part('template-parts/content','page'); ?>
					
						<?php endwhile; ?>
						
						<div class="paginations">
							<?php			
							$GLOBALS['wp_query']->max_num_pages = $specia_loop->max_num_pages;						
							// Previous/next page navigation.
							the_posts_pagination( array(
							'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
							'next_text'          => '<i class="fa fa-angle-double-right"></i>',
							) ); ?>
						</div>
					<?php 
						wp_reset_postdata(); 
						endif; 
					?>
					
			
			</div>
			<!--/End of Blog Detail-->
		
		</div>	
	</div>
</section>
<!-- End of Blog & Sidebar Section -->
 
<div class="clearfix"></div>

<?php get_footer(); ?>
