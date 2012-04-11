<!-- lf begin: this is out sidebar, defined in sidebar.php -->
<div id="sidebar">
	&uarr; <a class="back" href="<?php echo get_option('home'); ?>">back</a> 
	<div class="line">&nbsp;</div>
	<span class='commentSidebar'>more from this author:</span>
	<?php
		$authorId = get_the_author_meta('ID');
		//print_r($authorId);
		//print_r($post->ID);
		$morePosts = get_other_posts_by_author($authorId, $post->ID);
		if( !empty($morePosts) ):
	?>
	<dl class="articlesAuthorArea">
	<?php
		foreach( $morePosts as $otherPost ):
	?>
		<dt><a href="<?= $otherPost['permalink'] ?>"><?= $otherPost['title'] ?></a></dt>
	<?php
		endforeach;
	?>
	</dl>
	<?php
		endif;
	?>
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
