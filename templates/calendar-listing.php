<?php

global $wpdb;
$q =  get_query_current_calendar_NL();
$calendarPosts = $wpdb->get_results($q, OBJECT);
/* echo "query events: ".$q; */


if( $calendarPosts ):
?>
<section class="agendaArea">
    <h1 class="sidebarHeader"><a href="templates/single-event.php")">Coming Up</a></h1>
	<h5 class="city" style="margin: 1em 0 0 0;"><span class="highlight">AMSTERDAM</span> X LONDON</h5>

    <div class="containsEvents" style="margin: 1em 0 1.85em 0;">
		<!-- <div class="sidebarLine">&nbsp;</div> -->


<?php
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
?>
    </div>
</section>
<?php 
endif;
?>
<!-- lf: end: list agenda event -->	<!-- lf end: this is the agenda section  -->

<?php /* if (function_exists('debuginfo')) { debuginfo("Main"); } */  ?>

