<?php get_header(); ?> 

<div class="container">  
	<div id="content">
		<div class="notable">	
			<!-- begin post -->
			<?php query_posts(array('post_type' => array('events'), 'showposts' => 1)); 
				if (have_posts()): ?>
			
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!--POST TITLE-->
		 			
					<?php
						//print_r($post);
						//if(has_attachment($post->ID)):
						//$attachments = get_attachment($post->ID);
						if( has_post_thumbnail() ):
					?>
					<div class="gallery_top"><?php the_post_thumbnail(); ?>
					</php>
					
					<div class="gallery_counter">1/13 _ previous / next / go to gallery </div>
					<div class="gallery_description"> Photo descriptions can beplaced here.</div>
					</div>
					<?php
						endif;
					?>
					
					<div class="title-area">
						<h2 class="post-title" ><?php the_title(); ?></h2>
						<div class="line">&nbsp;</div>
						<dl class="post_info">
							<dt class="agendaListing" style="margin-bottom: 0.85em;"><? the_tags('', '&nbsp;', ''); ?></dt>
							<dt class="author" >by <?php the_author(); ?></dt>
						</dl>
						<!-- <div class="item social"><? include('templates/social-buttons.php'); ?></div> -->
					</div><!--END POST TITLE-->
					
					
					<?php the_content(); ?>  

					<div class="line">&nbsp;</div>
					<div class="space"></div>
				</div> <!-- #post-id -->
				
				
			<?php wp_reset_query(); ?>
			
			<?php endif; ?>
			
			
			
			
			
		</div><!-- .notable -->

	</div><!-- #content -->

	<?php get_sidebar('single-story'); ?>

	<!-- end post-->

</div><!-- #container -->	


