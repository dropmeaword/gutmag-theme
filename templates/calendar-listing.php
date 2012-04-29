<?php
global $wpdb;

switch( $region ):
	case 'uk':
		$q =  get_query_current_calendar_UK();
		break;
	case 'nl':
		$q =  get_query_current_calendar_NL();
		break;
endswitch;

$calendarPosts = $wpdb->get_results($q, OBJECT);

/* echo "query events: ".$q; */

?>

<section class="agendaArea">
    <h1 class="sidebarHeader"><a href="/calendar">Event listings</a></h1>
		<div id="citySelector">
			<ul class="tabSelector"><li id="nl" class="calendarSwitch">AMSTERDAM</li><li>X</li><li id="uk" class="calendarSwitch">LONDON</li></ul>
		</div>
		
    <div class="containsEvents" style="margin: 1em 0 1.85em 0;">
		<!-- <div class="sidebarLine">&nbsp;</div> -->
<?
if( $calendarPosts ):
			global $post;
			foreach ($calendarPosts as $post):
				setup_postdata( $post );
				
				/* in the main's page listing show only the featured posts */
				if( has_tag('featured', $post) ):
					$begins = get('agenda_begins');
					$ends = get('agenda_ends');
					if(!empty($ends)) {
						$separator = " > ";
					} else {
						$separator= "";
					}
					
					$label = get_calendar_event_label( get_the_tags() );
	?>
				<dl class="agendaItem">
					<dt class="agendaListing"><span class="label"><?= $label ?></span></dt>
					<dt class="agendaDate"><? echo $begins.$separator.$ends;  ?></dt>
					<dt class="agendaTitle agendaFrontPage"><?php the_title(); ?></dt>
					<dt><?php echo get('venue_name'); echo', '; echo get('venue_address') ?></dt>
					<dt><?php echo get('venue_price'); ?></dt>
					<dt><?php echo preg_replace('/<p>(.+?)<\/p>/','$1',get_the_excerpt()); ?></dt>
				</dl>
	<?php 
				endif;
			endforeach; 
			/*wp_reset_query(); */
else:
?>
<p>Sorry, it seems like we have no listings for your city at this moment.</p>
<?
endif;
?>

			<!--<br/>
			<a href="/calendar">See full event listings &#0187;</a> -->
			
	    </div>
	</section>
<!-- lf: end: list agenda event -->	<!-- lf end: this is the agenda section  -->

<?php /* if (function_exists('debuginfo')) { debuginfo("Main"); } */  ?>

