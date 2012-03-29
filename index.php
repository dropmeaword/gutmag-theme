<?php get_header(); ?> 

<div class="container">  
	<div id="content">
		<div class="notable">	
			<!-- begin post -->
			<?php query_posts(array('post_type' => array('post'), 'showposts' => 8)); 
				if (have_posts()): ?>
			
			<?php 
				while(have_posts()): 
					the_post();

					$postFormat = get_post_format();
					switch($postFormat) {
						case 'gallery':
							include('templates/format-gallery.php');
							break;
						default:
							include('templates/format-standard.php');
							break;
					}

				endwhile; 
				wp_reset_query(); 
			endif;
			?>
			
			
			
			

		</div><!-- .notable -->

	</div><!-- #content -->

	<?php get_sidebar(); ?><!-- lf: i just removed all the sidebar stuff from here and placed it in sidebar.php -->

	<!-- end post-->

</div><!-- #container -->	


