<?php @header("HTTP/1.1 404 Not found", TRUE, 404); ?>
<?php

    // calling the header.php
    get_header(); 

?>  

<!-- generated with 404.php -->

<!-- begin page -->    


<div class="container">  
	<div id="content">
	<div class="<?php wp_title('',true,''); ?> 404">

		<h2 class="sidebarHeader">Uh, oh! Seems like what you are looking for isn't here</h2>
		<br/><br/>
		<p>You can click back and try again or use the search form under the logo to find what you're looking for.</p>

		</div> 	<!-- .dynamic-title-->	    
	</div><!-- #content-->   
	<?php get_sidebar(); ?><!-- lf: i just removed all the sidebar stuff from here and placed it in sidebar.php -->
</div><!-- #container -->

<!-- end page -->     

<?php     

	// calling footer.php
    get_footer();

?>