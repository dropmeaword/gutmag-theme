<?php 
	get_header();
?> 

<div class="container">  
	<div id="content">
		<div class="notable">	
	  	 
			<?php
			if ( have_posts() ):
				if ( is_author() ):
					include('templates/archive-author.php');
				elseif ( is_tag() ):
					include('templates/archive-tag.php');
				endif; // is author or tag
			else: 
				_e('Sorry, no posts matched your criteria.', 'wpfolio'); 
			endif; // have posts
			?>
		
			</div>
	</div><!-- #content -->
</div> <!-- /container -->
<?php 
		get_sidebar(); 
    get_footer();
?>