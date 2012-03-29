<!-- lf begin: this is out sidebar, defined in sidebar.php -->
<div id="sidebar">
	&uarr; <a class="back" href="<?php echo get_option('home'); ?>">back</a> 
	<div class="line">&nbsp;</div>
	<span class='commentSidebar'>more from this author:</span>
	<dl class="articlesAuthorArea"> 
		<dt class="articleTitle"><a href="source">Things that mind their own business</a></dt>
		<dt class="articleTitle"><a href="source">Contrary to populair believe</a></dt>
		<dt class="articleTitle"><a href="source">Article title this</a></dt>
		<dt class="articleTitle"><a href="source">Article title that</a></dt>
	</dl>
	<div class="line">&nbsp;</div>
	<span class='commentSidebar'>similar articles:</span>
	<dl class="articlesAuthorArea"> 
		<dt class="articleTitle"><a href="source">Summer Flea Prevention and Control </a></dt>
		<dt class="articleTitle"><a href="source">Stop: Don't Declaw Your Cat</a></dt>
		<dt class="articleTitle"><a href="source">About Different Diets for Your Cat</a></dt>
		<dt class="articleTitle"><a href="source">Is the Cat the True "Man's Best Friend?</a></dt>
	</dl>
	
	
	
	<div class="line">&nbsp;</div>
	<? include('templates/social-buttons.php'); ?>
	
	
	
	
	
	<div class='footerSidebar'><?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer sidebar') ) ; ?> </div>
	
</div>
<!-- lf end: this is out sidebar, defined in sidebar.php -->
