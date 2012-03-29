<?php get_header(); ?> 

<div class="container">  
	<div id="content">
		<div class="notable">	
			<!-- begin post -->

			<?php 
			if ($posts):
				while ( have_posts() ):
					the_post();?>   
				
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!--POST TITLE-->
						
						<div class="title-area-page">
							<h2 class="post-title"><?php the_title(); ?></h2>
							<div class="line">&nbsp;</div>
						</div><!--END POST TITLE-->
						
						<?php the_content('continue...'); ?>  

					</div> <!-- #post-id --> 
			

				<?php 
				endwhile;
			else: 
				_e('Sorry, no posts matched your criteria.', 'wpfolio'); 
			endif;
			?>    
		</div><!-- .notable -->

	</div><!-- #content -->

	<?php get_sidebar(); ?><!-- lf: i just removed all the sidebar stuff from here and placed it in sidebar.php -->

	<!-- end post-->

</div><!-- #container -->
	
<?php get_footer();?>

