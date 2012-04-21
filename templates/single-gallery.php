<?php 
$g_show_backlink = 'gallery';
get_header();
?> 

<script type="text/javascript">
jQuery(document).ready(function() {
	scrollToId('galleryScrollPoint');
});
</script>

<div class="container">
 	<h3><?= the_title() ?> by <?php the_author_posts_link(); ?></h3>
<!--	<div id="content">-->
	<a id="galleryScrollPoint"></a>
	<div id="sliderControllergallery">
		<span id="photoLocatorPlaceholder" class="gallery_counter">1/13</span><span class="gallery_counter"> &nbsp;|&nbsp; </span>
		<div class="coda-nav-left" id="coda-nav-left-1"><a href="#" title="Previous">previous</a> /&nbsp; </div> 
		<div class="coda-nav-right" id="coda-nav-right-1"><a href="#" title="Next"> next</a>&nbsp;|</div>	
		<div id="captionPlaceholder" class="gallery_description">Photo descriptions can beplaced here. And they might be rather long too, but maybe not too long.</div>
	</div>

	<div class="coda-slider-wrapper">
		<div class="coda-slider preload" id="coda-slider-1">

			<? /* then we get all other images attached to this post */ ?>
			<?
			$images = get_all_gallery_images( get_the_ID() );
			if( $images && !empty($images) ):
				foreach($images as $i):
			?>
			<div class="panel">
				<div class="panel-wrapper">
					<h2><?= $i['caption'] ?></h2>
					<?= $i['imgtag'] ?>
				</div>
			</div>
			<? 
				endforeach;
			endif; 
			?>
		</div><!-- .coda-slider -->
	</div> <!-- /coda-slider-wrapper -->
<!--	</div>--> <!-- /content -->
<!-- sidebar would go here -->
</div> <!-- /container -->

