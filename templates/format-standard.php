<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>><!--POST TITLE-->
	
	<?php
		//print_r($post);
		//if(has_attachment($post->ID)):
		//$attachments = get_attachment($post->ID);
		if( has_post_thumbnail() ):
	?>
	<div class="gallery_top"><?php the_post_thumbnail(); ?>
	</div>
	<?php
		endif;
	?>
	
	<div class="title-area">
		<h2> <a class="post-title" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
		<!-- <div class="line">&nbsp;</div>-->
		<dl class="post_info">
			<!-- <dt class="agendaListing" style="margin-bottom: 0.85em;"><? the_tags('', '&nbsp;', ''); ?></dt> -->
			<dt class="authorName" >by <?php the_author_posts_link(); ?>  <!--<?php the_author(); ?>-->  </dt>
		</dl>
	</div><!--END POST TITLE-->
	
	
	<?php
		$blurb = get_the_excerpt();
		if(empty($blurb)) {
			$blurb = get_the_content('continues &#0187;');
			$blurb = apply_filters('the_content', $blurb);
			$blurb = str_replace(']]>', ']]&gt;', $blurb);
		} else {
			$permalnk = get_permalink();
			$blurb = $blurb." <a href='$permalnk' class='more-link'>continues &#0187;</a>";
		}
		
		echo $blurb;
	?>  

	<div class="line">&nbsp;</div>
	<div class="space"></div>
</div> <!-- #post-id -->
