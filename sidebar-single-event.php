<!-- lf begin: this is out sidebar, defined in sidebar.php -->
<div id="sidebar">

	<!-- lf begin: this is the agenda section  -->
	<!-- lf: begin: list agenda event -->
	<?
	$region = $_GET['whichcalendar'];
	if(isset($region)):
		$filter = $region;
		include('templates/calendar-listing.php');
	else:
		$filter = 'none';
		include('templates/calendar-listing.php');
	endif;
    ?>
	
	
	<div class="line">&nbsp;</div>
	<? include('templates/social-buttons.php'); ?>
	
	
	
	
	
	<div class='footerSidebar'><?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer sidebar') ) ; ?> </div>
	
</div>
<!-- lf end: this is out sidebar, defined in sidebar.php -->

