<script type="text/javascript"> 
  $(function() {
    moveScroller();
  });
</script>
<!-- lf begin: this is out sidebar, defined in sidebar.php -->
<div id="sidebar">
	<div id="scroller-anchor"></div> 
  <div id="scroller" style="width: 270px">
	&uarr; <a class="back" href="<?php echo get_option('home'); ?>">back</a> 

	<!-- <div class="line">&nbsp;</div> -->
	<div class="sidebarAuthorBio">
		<span class="label">About <?php the_author_meta('display_name'); ?></span>
		<p><?php the_author_meta('description'); ?></p>
	</div>

	<div class="relatedcontent">
		<div class="line">&nbsp;</div>
		<span class='commentSidebar'>more from this author:</span>
		<?php
			$authorId = get_the_author_meta('ID');
			//print_r($authorId);
			//print_r($post->ID);
			$morePosts = get_other_posts_by_author($authorId, $post->ID);
			if( !empty($morePosts) ):
		?>
		<div class="line">&nbsp;</div>
		<span class='commentSidebar'>more from this author:</span>
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

		<div class="relatedPostsArea"> 
		<?php do_action('erp-show-related-posts', array('title'=>'related contributions:', 'num_to_display'=>5, 'no_rp_text'=>'<p class="no-related-found">No related contributions were found</p>')); ?>
		</div>
	</div>
	
	<? include('templates/social-share-buttons.php'); ?>
	
	<div class='footerSidebar'><?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer sidebar') ) ; ?> </div>
	</div> <!-- /scroller -->
</div>
<!-- lf end: this is out sidebar, defined in sidebar.php -->
