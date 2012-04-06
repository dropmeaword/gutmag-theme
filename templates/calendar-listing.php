<?php

global $wpdb;
$q =  get_query_current_calendar_NL();
$calendarPosts = $wpdb->get_results($q, OBJECT);
/* echo "query events: ".$q; */

?>

<section class="agendaArea">
    <h1 class="sidebarHeader">Coming Up</h1>
		<!-- <h5 class="city"><span class="highlight">AMSTERDAM</span> X LONDON</h5> -->
		<div id="citySelector">
			<ul class="tabSelector"><li class="highlight">AMSTERDAM</li><li>X</li><li><a href="#">LONDON</a></li></ul>
		</div>
		
    <div class="containsEvents" style="margin: 1em 0 1.85em 0;">
		<!-- <div class="sidebarLine">&nbsp;</div> -->
<?
if( $calendarPosts ):
			global $post;
			foreach ($calendarPosts as $post):
				setup_postdata( $post );
			
				$begins = get('agenda_begins');
				$ends = get('agenda_ends');
				if(!empty($ends)) {
					$separator = " > ";
				} else {
					$separator= "";
				}
?>
			<dl style="margin: 0.90em 0 0 0;">
				<dt class="agendaDate"><? echo $begins.$separator.$ends;  ?></dt>
				<dt><a class="agendaTitle" href="<?php the_permalink() ?>"><?php the_title(); ?></a></dt>
				<dt class="agendaVenue"><?php echo get('venue_name'); echo', '; echo get('venue_address') ?></dt>
				<dt class="agendaListing"><? the_tags('', '&nbsp;', ''); ?></dt>
				<!-- <dt class="agendaExc""><?php echo preg_replace('/<p>(.+?)<\/p>/','$1',get_the_excerpt()); ?> <a href="<?php the_permalink() ?>" class="more-link"><?php _e('Read more', 'ia3'); ?></a></dt> -->
			</dl>
<?php 
			endforeach; 
			/*wp_reset_query(); */
else:
?>
<p>Sorry, it seems like we have no listings for your city at this moment.</p>
<?
endif;
?>
	    </div>
	</section>
<!-- lf: end: list agenda event -->	<!-- lf end: this is the agenda section  -->

<?php /* if (function_exists('debuginfo')) { debuginfo("Main"); } */  ?>

