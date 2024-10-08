<?php
// code for custom post type slider
		 
		function specia_client() {
	
			$specia_client_slug = get_theme_mod('client_slug','client'); 
			register_post_type( 'specia_client',
				array(
						'labels' => array(
						'name' => __('Client', 'specia-companion'),
						'singular_name' => __('Client', 'specia-companion'),
						'add_new' => __('Add New', 'specia-companion'),
						'add_new_item' => __('Add New','specia-companion'),
						'edit_item' => __('Add New ','specia-companion'),
						'new_item' => __('New Link','specia-companion'),
						'all_items' => __('All Client','specia-companion'),
						'view_item' => __('View Link','specia-companion'),
						'search_items' => __('Search Links','specia-companion'),
						'not_found' =>  __('No Links found','specia-companion'),
						'not_found_in_trash' => __('No Links found in Trash','specia-companion'), 
						
					),
						'supports' => array('title','thumbnail','editor','comments'),
						'show_in_nav_menus' => false,
						'public' => true,
						'menu_position' => 20,
						'rewrite' => array('slug' => $specia_client_slug),
						'menu_icon' => 'dashicons-admin-site-alt3',
						
				)
			);
		}
		add_action( 'init', 'specia_client' );

		// meta box

		function specia_client_init()
		{
			
							
			add_meta_box('my_all_meta', 'Client Description', 'specia_meta_client','specia_client', 'normal', 'high');
			
			
			add_action('save_post','specia_meta_client_save');
		}


		add_action('admin_init','specia_client_init');		
				

				
		function specia_meta_client()
		{
			global $post;
			
			$client_icon_class = sanitize_text_field( get_post_meta( get_the_ID(),'client_icon_class', true ));
		?>
			
			
			<div class="inside">	
				<p><label><?php esc_html_e('Client Icon Class','specia-companion');?></label></p>
				<p><input style="width:100%; height:40px; padding: 10px;" name="client_icon_class" placeholder="<?php esc_attr_e('client icon class','specia-companion');?>" type="text" value="<?php if(!empty($client_icon_class)) echo esc_attr($client_icon_class); ?>"></p>	
			</div>
			
		<?php 	
		}


		function specia_meta_client_save($post_id) 
		{
			if(isset( $_POST['post_ID']))
			{ 	
				$post_ID = $_POST['post_ID'];				
				$post_type=get_post_type($post_ID);
				if($post_type=='specia_client')
				{	
			
					update_post_meta($post_ID, 'client_icon_class', sanitize_text_field($_POST['client_icon_class']));
				
				}
			}
		}
?>