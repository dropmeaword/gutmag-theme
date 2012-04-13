	<div class="authorBio">
	<h2>About <?php the_author_meta('display_name', $_GET['author']); ?></h2>
	<?php the_author_meta('description', $_GET['author']); ?>
	</div>
	
	<div id="authorContributions">
	<p>GUTmag has published the following contributions by <?php the_author_meta('display_name', $_GET['author']); ?>.</p>
		<?php
			if( have_posts() ):
				while (have_posts()): the_post(); 
		?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<dt class="agendaDate" style="margin-bottom: 8px;"><?php the_time('d.m.Y'); ?></dt>
				<h2 class="post-title"><a href="<? the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="space"></div>
			</div> <!-- #post-id -->

		<?php 
				endwhile;
			else:
				_e('No posts by this author were found.');
			endif;
		?>
	</div>