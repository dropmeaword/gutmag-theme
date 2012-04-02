<?php 
$g_show_gallery_backlink = true;
get_header();
?> 

<div class="container">  
	<div id="content">

	<div class="coda-slider-wrapper">
		<div class="coda-slider preload" id="coda-slider-1">

<? /* then we get all other images attached to this post */ ?>
<?
$imagetags = get_all_gallery_images( get_the_ID() );
if( $imagetags && !empty($imagetags) ):
	foreach($imagetags as $itag):
?>
				<div class="panel">
					<div class="panel-wrapper">
						<?= $itag ?>
					</div>
				</div>
<? 
	endforeach;
endif; 
?>
		</div><!-- .coda-slider -->

		<div id="sliderController gallery">
			<div class="coda-nav-left" id="coda-nav-left-1"><a href="#" title="Previous">previous</a></div>
			<div class="coda-nav-right" id="coda-nav-right-1"><a href="#" title="Next">next</a></div>	
			<span class="gallery_counter">1/13</span><span class="gallery_counter"> _ </span>
			<div class="gallery_description">Photo descriptions can beplaced here.</div><br>
		</div>

	</div> <!-- /coda-slider-wrapper -->
	</div> <!-- /content -->
<!-- sidebar would go here -->
</div> <!-- /container -->

