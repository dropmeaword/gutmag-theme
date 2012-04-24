		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php
			if( has_post_thumbnail() ):
		?>
		<div class="gallery_top">
			<?php the_post_thumbnail(); ?>
			<div class="title-area-img">
				<h2><a class="post-title-img post-title" href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
			</div>
		</div>
		<?php
			endif;
		?>
<!--<div class="line">&nbsp;</div>-->
<div class="space"></div>
</div>
