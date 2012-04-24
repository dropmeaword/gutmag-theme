<?php get_header(); ?> 

<div class="container">  
	<div id="content">
		<div class="notable">	
			<!-- begin post -->
			<?php query_posts(array('post_type' => array('post'), 'showposts' => 1)); 
				if (have_posts()): ?>
			
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!--POST TITLE-->
		 			
					<?php
						//print_r($post);
						//if(has_attachment($post->ID)):
						//$attachments = get_attachment($post->ID);
						if( has_post_thumbnail() ):
					?>
					<div class="gallery_top"><?php the_post_thumbnail(); ?></div>
					<?php
						endif;
					?>
					
					<div class="title-area">
						<h2 class="post-title" ><?php the_title(); ?></h2>
						<!-- <div class="line">&nbsp;</div> -->
						<dl class="post_info">
							<!-- <dt class="agendaListing" style="margin-bottom: 0.85em;"><? the_tags('', '&nbsp;', ''); ?></dt> -->
							<dt class="agendaDate" style="margin-bottom: 3px;"><?php the_date('d/m/Y'); ?></dt>
							<dt class="authorName" >by <?php the_author(); ?></dt>
						</dl>
						<!-- <div class="item social"><? include('templates/social-buttons.php'); ?></div> -->
					</div><!--END POST TITLE-->
					
					
					<?php the_content(); ?>  

				</div> <!-- #post-id -->
				
				
			<?php endif; ?>
			
		</div><!-- .notable -->

	</div><!-- #content -->

	<?php get_sidebar('single-story'); ?>

	<!-- end post-->

</div><!-- #container -->	


