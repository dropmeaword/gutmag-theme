<?php

    // calling the header.php
    get_header(); 

?> 

<!-- generated with search.php -->

<div class="container">  
	<div id="content" class="search_results">
<!-- begin post -->

		<h2 class="pagetitle">Search Result for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = esc_html($s, 1); $count = $allsearch->post_count; _e('', 'wpfolio'); _e('<span class="search-terms">', 'wpfolio'); echo $key; _e('</span>', 'wpfolio'); _e(' &mdash; ', 'wpfolio'); echo $count . ' '; _e('articles', 'wpfolio'); wp_reset_query(); ?></h2> <!-- Pagetitle shows number of search results-->
		<div class="space"></div>
		
	<?php 	
		if (! empty($display_stats) ) { 		
			get_stats(1); 		echo "<br />"; 	
		} 	else if (($posts & empty($display_stats)) ): 
			foreach ($posts as $post): 
				the_post(); 
	?>   

		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<dt class="agendaDate" style="margin-bottom: 8px;"><?php the_time('d.m.Y'); ?></dt>
			<h2 class="post-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt('continue...'); ?>
			<div class="space"></div>
		</div> <!-- #post-id -->


   
<?php endforeach; else: ?> 
	
	<div class="notable-post">
	<h2><?php _e('Sorry, nothing matched your search. Try again.', 'wpfolio'); ?></h2>
	</div><!-- .notable-post -->
<?php endif; ?>    

	</div><!-- #search_results  --> 

	</div><!-- #content -->

	<?php get_sidebar(); ?><!-- lf: i just removed all the sidebar stuff from here and placed it in sidebar.php -->

</div><!-- #container -->
<?php     

	// calling footer.php
    get_footer();

?>