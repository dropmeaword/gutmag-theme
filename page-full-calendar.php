<?php
/*
Template Name: Full Calendar Page
*/
?>
<?php
$region = $_COOKIE['whichcalendar'];
$filter = get_calendar_from_cookie( $region );
$cityName = get_city_name_from_cookie( $region );

function get_calendar_string($begins, $ends) {
	if(!empty($ends)) {
		$separator = "<br/>";
	} else {
		$separator= "";
	}
	
	return "$begins $separator $ends";
}

function get_events_week_calendar( $which ) {
	$now = date("Y-m-d"); // current
	$oneMonthFromNow = date("Y-m-d", strtotime("+1 week"));
	return get_query_delimited_calendar($now, $oneMonthFromNow, $which);
}

function get_events_upcoming_calendar( $which ) {
	$now = date("Y-m-d", strtotime("+1 week"));
	$oneMonthFromNow = date("Y-m-d", strtotime("+1 month"));
	return get_query_upcoming_calendar($now, $which);
}

function get_events_ongoing_calendar( $which ) {
	$now = date("Y-m-d");
	return get_query_ongoing_calendar($now, $which);
}

$g_show_backlink = 'calendar';
get_header(); 
?>

<div class="container calendar">

		<?php
		/* ************************************************************************************************* */
		/* THIS WEEK */
		/* ************************************************************************************************* */
		$qry = get_events_week_calendar( $filter );
		$calendarPosts = $wpdb->get_results($qry, OBJECT);
		if( $calendarPosts ):
					global $post;
					$i = 1;
		?>
		<h2>This week in <?= $cityName ?></h2>

		<div id="eventsThisWeek" class="eventRegion clearfix">
		<?php
					foreach ($calendarPosts as $post):
						setup_postdata( $post );
						$begins = get('agenda_begins');
						$ends = get('agenda_ends');

						if( has_post_thumbnail() ):
							?><div class="eventArea withImage">
									<a class="gallery_eventpage" href="#"><?php the_post_thumbnail('calendar-thumbnail'); ?></a>
							<?php
						else:
							?><div class="eventArea"><?php
						endif;
		?>
				<div class="eventMeta">
					<dt class="agendaDateBig"><?= get_calendar_string($begins, $ends); ?></dt>
					<dt class="agendaTitle"><?php the_title(); ?></dt>
					<dt class="agendaVenue"><?php echo get('venue_name'); echo', '; echo get('venue_address') ?></dt>
					<dt class="agendaVenue"><?php echo get('venue_price'); ?></dt>
					<dt class="agendaVenue"><?php the_excerpt(); ?></dt>
				</div>
			</div>
			<?php
					/* put a blank after block, except every third */
					if( ($i % 3) != 0 ) { echo '<div class="emptyArea">	</div>'; } 
			?>
		<?php
					$i++;
					endforeach;
		?>
			</div><!-- /eventsThisWeek -->
		<?php
		endif;
		?>

		<?php
		/* ************************************************************************************************* */
		/* ONGOING */
		/* ************************************************************************************************* */
		$qry = get_events_ongoing_calendar( $filter );
		$calendarPosts = $wpdb->get_results($qry, OBJECT);
		if( $calendarPosts ):
					global $post;
					$i = 1;
		?>
		<h2>Ongoing in <?= $cityName ?></h2>

		<div id="eventsOngoing" class="eventRegion clearfix">
		<?php
					foreach ($calendarPosts as $post):
						setup_postdata( $post );
						$begins = get('agenda_begins');
						$ends = get('agenda_ends');

						if( has_post_thumbnail() ):
							?><div class="eventArea withImage">
									<a class="gallery_eventpage" href="#"><?php the_post_thumbnail('calendar-thumbnail'); ?></a>
							<?php
						else:
							?><div class="eventArea"><?php
						endif;
		?>
				<div class="eventMeta">
					<dt class="agendaDateBig"><?= get_calendar_string($begins, $ends); ?></dt>
					<dt class="agendaTitle"><?php the_title(); ?></dt>
					<dt class="agendaVenue"><?php echo get('venue_name'); echo', '; echo get('venue_address') ?></dt>
					<dt class="agendaVenue"><?php echo get('venue_price'); ?></dt>
					<dt class="agendaVenue"><?php the_excerpt(); ?></dt>
				</div>
			</div>
			<?php
					/* put a blank after block, except every third */
					if( ($i % 3) != 0 ) { echo '<div class="emptyArea">	</div>'; } 
			?>
		<?php
					$i++;
					endforeach;
		?>
			</div><!-- /eventsOngoing -->
		<?php
		endif;
		?>


			<?php
			/* ************************************************************************************************* */
			/* Upcoming */
			/* ************************************************************************************************* */
			$qry = get_events_upcoming_calendar( $filter );
			$calendarPosts = $wpdb->get_results($qry, OBJECT);
			if( $calendarPosts ):
						global $post;
						$i = 1;
			?>
			<h2>Upcoming in <?= $cityName ?></h2>
			<div id="eventsUpcoming"  class="eventRegion clearfix">
			<?php
						foreach ($calendarPosts as $post):
							setup_postdata( $post );
							$begins = get('agenda_begins');
							$ends = get('agenda_ends');

							if( has_post_thumbnail() ):
								?><div class="eventArea withImage">
										<a class="gallery_eventpage" href="#"><?php the_post_thumbnail('calendar-thumbnail'); ?></a>
								<?php
							else:
								?><div class="eventArea"><?php
							endif;
			?>
					<div class="eventMeta">
						<dt class="agendaDateBig"><?= get_calendar_string($begins, $ends); ?></dt>
						<dt class="agendaTitle"><?php the_title(); ?></dt>
						<dt class="agendaVenue"><?php echo get('venue_name'); echo', '; echo get('venue_address') ?></dt>
						<dt class="agendaVenue"><?php echo get('venue_price'); ?></dt>
						<dt class="agendaVenue"><?php the_excerpt(); ?></dt>
					</div>
				</div>
				<?php
						/* put a blank after block, except every third */
						if( ($i % 3) != 0 ) { echo '<div class="emptyArea">	</div>'; } 
				?>
			<?php
						$i++;
						endforeach;
			?>
				</div><!-- /eventsUpcoming -->
			<?php
			endif;
			?>

</div>

<?php get_footer(); ?>
