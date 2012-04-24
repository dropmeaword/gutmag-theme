<?php @header("HTTP/1.1 404 Not found", TRUE, 404); ?>
<?php

    // calling the header.php
    get_header(); 

?>  

<!-- generated with 404.php -->

<!-- begin page -->    


<div class="container">  
	<div id="content">
		<div class="notable">

			<div class="<?php wp_title('',true,''); ?> 404">

				<h2><?php wp_title('',true,''); ?></h2>

				<p>You can click back and try again OR search for what you're looking for:</p>

				<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
				  <div class="search">
				    <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
				    <input type="submit" id="searchsubmit" value="Search" />
				  </div><!-- .search -->
				</form>

			</div> 	<!-- .dynamic-title-->	
		</div><!-- #notable-->   			    
	</div><!-- #content-->   
</div><!-- #container-->   

<!-- end page -->     

<?php     

	// calling footer.php
    get_footer();

?>