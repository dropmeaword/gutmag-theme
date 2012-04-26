<?php
/**
 * @author Luis Rodil-Fernandez <dropmeaword@gmail.com>
 */

function get_calendar_date_scrubbed( $datestr ) {
	$retval = str_replace('.', '/', $datestr);
	return $retval;
}

/** get calendar selector from cookie */
function get_calendar_from_cookie() {
	if( $_COOKIE['whichcalendar'] === 'uk') {
		return 'UK Agenda';
	} else {
		return 'NL Agenda';
	}
}

/** get city name from cookie */
function get_city_name_from_cookie() {
	if( $_COOKIE['whichcalendar'] === 'uk') {
		return 'London';
	} else {
		return 'Amsterdam';
	}
}

/** get label for event */
function get_calendar_event_label( $tags ) {
	$tags = get_tags_as_array( $tags );
	$tags = remove_functional_tags( $tags );
	return $tags[0];
}

function remove_functional_tags($tags, $to_remove = array('featured', 'reviewed', 'london', 'amsterdam') ) {
	$darr = array_diff($tags, $to_remove);
	return array_values($darr);
}

/* @lfernandez BEGIN calendar functions */
function get_query_week_calendar($now, $then, $which) {
	$cond = "(CAST(starts.meta_value AS DATE) > '{$now}') AND	(CAST(starts.meta_value AS DATE)  < '{$then}')";
	$orderby = "ORDER BY starts.meta_value ASC";
	return get_query_calendar($which, $cond, $orderby);
}

function get_query_ongoing_calendar($now, $which) {
	$cond = "(CAST(starts.meta_value AS DATE) < '{$now}') AND	(CAST(ends.meta_value AS DATE)  > '{$now}')";
	$orderby = "ORDER BY ends.meta_value ASC";
	return get_query_calendar($which, $cond, $orderby);
}

function get_query_upcoming_calendar($start, $which) {
		$cond = "(CAST(starts.meta_value AS DATE) >= '{$start}')";
		$orderby = "ORDER BY starts.meta_value ASC";
		return get_query_calendar($which, $cond, $orderby);
}

function get_query_calendar($which, $condition, $orderby) {
	if( is_admin() ) {
		$condStatus = "AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'private')";
	} else {
		$condStatus = "AND (wp_posts.post_status = 'publish')";
	}
	
	$retval = <<<SQL
SELECT SQL_CALC_FOUND_ROWS wp_posts.*,
starts.meta_value AS agenda_begins,
ends.meta_value AS agenda_ends,
which.meta_value AS agenda_which_agenda
FROM wp_posts 
INNER JOIN wp_postmeta AS starts ON (wp_posts.ID = starts.post_id AND starts.meta_key = 'agenda_begins') 
INNER JOIN wp_postmeta AS ends ON (wp_posts.ID = ends.post_id AND ends.meta_key = 'agenda_ends') 
INNER JOIN wp_postmeta AS which ON (wp_posts.ID = which.post_id AND which.meta_key = 'agenda_which_agenda') 
WHERE 1=1 
AND wp_posts.post_type = 'event' 
{$condStatus}
AND (
	{$condition}
) 
AND (CAST(which.meta_value AS CHAR) LIKE '%{$which}%') 
GROUP BY wp_posts.ID 
{$orderby}
SQL;

	return $retval;
}

function get_query_delimited_calendar($now, $then, $which) {
	$cond = "(CAST(starts.meta_value AS DATE) BETWEEN '{$now}' AND '{$then}') 
		OR (CAST(ends.meta_value AS DATE)  BETWEEN '{$now}' AND '{$then}')";
	$orderby = "ORDER BY starts.meta_value ASC";
	return get_query_calendar($which, $cond, $orderby);
}

function get_query_current_calendar_NL() {
	$now = date("Y-m-d"); // current
	$oneMonthFromNow = date("Y-m-d", strtotime("+1 month"));
	return get_query_delimited_calendar($now, $oneMonthFromNow, 'NL Agenda');
}

function get_query_current_calendar_UK() {
	$now = date("Y-m-d"); // current
	$oneMonthFromNow = date("Y-m-d", strtotime("+1 month"));
	return get_query_delimited_calendar($now, $oneMonthFromNow, 'UK Agenda');
}
/* @lfernandez END calendar functions */

?>