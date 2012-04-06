<?php 
if ($posts):
	// while ( have_posts() ):
		the_post();
?>   
	
	<?
	$pid = $post->ID;
	$format = get_custom_post_format( $pid );

	/* decide which single post template to show */
	switch( $format ):
		case 'standard':
				/* standard format posts have two subtypes */
				if( strcmp($post->post_type, "event") == 0 ):
					include("templates/single-event.php");
				else:
					include("templates/single-story.php");
				endif;
			break;
			
		case 'gallery':
				/* gallery format posts show the image caroussel */
				include('templates/single-gallery.php');
			break;
	endswitch;
	?>

	<?php 
	// endwhile;
else: 
	_e('Sorry, no posts matched your criteria.', 'wpfolio'); 
endif;
?>    
