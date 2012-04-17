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
	$retval = "";
	if(!empty($ends)) {
		$retval = "$begins > $ends";
	} else {
		$retval= "$begins";
	}
	
	return $retval;
}

function get_events_week_calendar( $which ) {
	$now = date("Y-m-d", strtotime("last monday"));
	$then = date("Y-m-d", strtotime("next sunday"));
	return get_query_delimited_calendar($now, $then, $which);
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
<!-- <?= $cityName ?> -->
<div class="container calendar">

		<?php /* public_submission_form(true); */ ?>

		<?php
		/* ************************************************************************************************* */
		/* THIS WEEK */
		/* ************************************************************************************************* */
		$qry = get_events_week_calendar( $filter );
		$calendarPosts = $wpdb->get_results($qry, OBJECT);
		if( $calendarPosts ):
					global $post;
		?>
		<div id="eventsThisWeek" class="eventRegion">
		<h2 class="post-title calendar-header">This week</h2>
		<?php
					/*date_default_timezone_set('Europe/Amsterdam');*/
					$i = 1;
					foreach ($calendarPosts as $post):
						setup_postdata( $post );
						
						// print date information
						$begins = get_calendar_date_scrubbed( get('agenda_begins') );
						$ends = get_calendar_date_scrubbed( get('agenda_ends') );
						$dp = date_parse_from_format("d/m/Y", $begins);
						$startOfEvent = mktime(0, 0, 0, $dp['month'], $dp['day'], $dp['year']);
						$dayOfWeek =  date("l", $startOfEvent );
						// find out if event already hapenned
						$today = strtotime(date("Y-m-d"));
						//print_r($today." > ".$startOfEvent);
						if( $today > $startOfEvent ) {
							$alreadyHappened = true;
						} else {
							$alreadyHappened = false;
						}
						
						// get the label
						$tags = get_the_tags();
						$tags = get_tags_as_array( $tags );
						$tags = remove_functional_tags( $tags );
						$label = $tags[0];

						if( has_post_thumbnail() ):
							?><div class="eventArea withImage">
									<a class="gallery_eventpage" href="#"><?php the_post_thumbnail('calendar-thumbnail'); ?></a>
							<?php
						else:
							?><div class="eventArea"><?php
						endif;
		?>
				<?php if( isset($alreadyHappened) && ($alreadyHappened == true) ): ?>
					<div class="eventMeta greyOut">
						<span class="label greyOutBg"><?= $label ?></span>
				<?php else: ?>
					<div class="eventMeta">
						<span class="label"><?= $label ?></span>
				<?php endif; ?>
					<dl>
					<dt class="agendaDateBig" style="margin-bottom: 8px;"><?= $dayOfWeek; ?></dt>
					<dt class="agendaDate"><?= get_calendar_string($begins, $ends); ?></dt>
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
		<?php /*include('templates/fragment-calendar-events.php');*/ ?>
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
		?>
		<div id="eventsOngoing" class="eventRegion">
		<h2 class="post-title calendar-header">Ongoing</h2>
		<?php
					$i = 1;
					foreach ($calendarPosts as $post):
						setup_postdata( $post );
						$begins = get_calendar_date_scrubbed( get('agenda_begins') );
						$ends = get_calendar_date_scrubbed( get('agenda_ends') );
						// get the label
						$tags = get_the_tags();
						$tags = get_tags_as_array( $tags );
						$tags = remove_functional_tags( $tags );
						$label = $tags[0];

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
					<dt class="agendaDateBig" style="margin-bottom: 8px;"><?= $ends; ?></dt>
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
			?>
			<div id="eventsUpcoming"  class="eventRegion">
			<h2 class="post-title calendar-header">Upcoming</h2>

				<?php include('templates/fragment-calendar-events.php'); ?>
			</div><!-- /eventsUpcoming -->
			<?php
			endif;
			?>

</div>

<?php get_footer(); ?>
