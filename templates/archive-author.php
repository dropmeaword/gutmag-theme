	<div class="authorBio">
	<h3>About <?php the_author(); ?></h3>
	<?php the_author_meta('description', $_GET['author']); ?>
	</div>
	
		<?php 
		while (have_posts()) : the_post(); 
		?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="title-area">
				<h2 class="post-title" ><?php the_title(); ?></h2>
				<!-- <div class="line">&nbsp;</div> -->
				<dl class="post_info">
					<dt class="agendaListing" style="margin-bottom: 0.85em;"><? the_tags('', '&nbsp;', ''); ?></dt>
					<dt class="agendaDate" style="margin-bottom: 8px;"><?php the_date('d.m.Y'); ?></dt>
					<dt class="author" >by <?php the_author(); ?></dt>
				</dl>
				<!-- <div class="item social"><? include('templates/social-buttons.php'); ?></div> -->
			</div><!--END POST TITLE-->
			
			
			<?php the_content(); ?>  

			<div class="line">&nbsp;</div>
			<div class="space"></div>
		</div> <!-- #post-id -->

		<?php endwhile; ?>
