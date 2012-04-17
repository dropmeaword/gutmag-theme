<?php
			$i = 1;
			foreach ($calendarPosts as $post):
				setup_postdata( $post );
				$begins = get_calendar_date_scrubbed( get('agenda_begins') );
				$ends = get_calendar_date_scrubbed( get('agenda_ends') );

				// get the label
				$label = get_calendar_event_label( get_the_tags() );
				
				if( has_post_thumbnail() ):
					?><div class="eventArea withImage">
							<a class="gallery_eventpage" href="#"><?php the_post_thumbnail('calendar-thumbnail'); ?></a>
					<?php
				else:
					?><div class="eventArea"><?php
				endif;
?>
		<div class="eventMeta">
			<span class="label"><?= $label ?></span>
			<dl>
			<dt class="agendaDateBig" style="margin-bottom: 8px;"><?= $begins; ?></dt>
			<?php if(!empty($ends)): ?>
				<dt class="agendaDate"><?= get_calendar_string($begins, $ends); ?></dt>
			<? endif; ?>
			<dt class="agendaTitle"><?php the_title(); ?></dt>
			<dt><?php echo get('venue_name'); echo', '; echo get('venue_address') ?></dt>
			<dt><?php echo get('venue_price'); ?></dt>
			<dt><?php the_excerpt(); ?></dt>
			</dl>
		</div>
	</div>
	<?php
			/* put a blank after block, except every third */
			/*if( ($i % 3) != 0 ) { echo '<div class="emptyArea">	</div>'; } */
	?>
<?php
			$i++;
			endforeach;
?>
