<?php
/**
Template Name: Blog Masonry
**/

get_header();
?>

<!-- Blog & Sidebar Section -->
<section class="page-wrapper">
	<div class="container">
		<div class="row padding-top-60 padding-bottom-60">
			
			<!--Blog Detail-->
			<div class="col-md-12 col-sm-12 masonry" >
					
				<?php 
				$specia_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$specia_args  = array( 'post_type' => 'post','paged'=>$specia_paged );	
				$specia_loop  = new WP_Query( $specia_args );
				?>
				
				<?php if( $specia_loop->have_posts() ): ?>
				
					<?php while( $specia_loop->have_posts() ): $specia_loop->the_post(); ?>
					
					<div class="masonry-column wow pulse">
						<?php get_template_part('template-parts/content','page'); ?>
					</div>
					
					<?php endwhile; ?>
					
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
