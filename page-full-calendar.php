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
<!-- <?= $cityName ?> -->
<div class="container calendar">

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

			<?php include('templates/fragment-calendar-events.php'); ?>
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

			<?php include('templates/fragment-calendar-events.php'); ?>
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
