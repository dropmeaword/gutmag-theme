<div class="container">  
	<div id="content">
		<div class="notable">	
			<!-- begin post -->
			<?php query_posts(array('post_type' => array('event'), 'showposts' => 9)); 
				if (have_posts()): ?>
			
			<?php while(have_posts()): the_post(); ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!--POST TITLE-->
		 			
					<?php
						//print_r($post);
						//if(has_attachment($post->ID)):
						//$attachments = get_attachment($post->ID);
						if( has_post_thumbnail() ):
					?>
					<!--
					<div class="gallery_top"><?php the_post_thumbnail(); ?>
					<div class="gallery_counter">1/13 _ previous / next / go to gallery </div>
					<div class="gallery_description"> Photo descriptions can beplaced here.</div>
					</div>
					-->
					<?php
						endif;
					?>
					
					<div class="title-area">
						<h2> <a class="post-title" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
						<div class="line">&nbsp;</div>
						<dl class="post_info">
							<dt class="agendaListing" style="margin-bottom: 0.85em;"><? the_tags('', '&nbsp;', ''); ?></dt>
							<dt class="authorName" >by <?php the_author(); ?></dt>
						</dl>
						<!-- <div class="item social"><? include('templates/social-buttons.php'); ?></div> -->
					</div><!--END POST TITLE-->
					
					
					<?php the_content('read on'); ?>  

					<div class="line">&nbsp;</div>
					<div class="space"></div>
				</div> <!-- #post-id -->
				
				
			<?php endwhile; wp_reset_query(); ?>
			
			<?php endif; ?>
			
			
			
			

		</div><!-- .notable -->

	</div><!-- #content -->

	<?php get_sidebar(); ?><!-- lf: i just removed all the sidebar stuff from here and placed it in sidebar.php -->

	<!-- end post-->

</div><!-- #container -->	
