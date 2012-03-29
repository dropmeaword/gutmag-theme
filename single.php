<?php 
if ($posts):
	// while ( have_posts() ):
		the_post();?>   
	
	<?
	if( strcmp($post->post_type, "event") == 0 ):
		include("templates/single-event.php");
	else:
		include("templates/single-story.php");
	endif;
	?>
	

	<?php 
	// endwhile;
else: 
	_e('Sorry, no posts matched your criteria.', 'wpfolio'); 
endif;
?>    
