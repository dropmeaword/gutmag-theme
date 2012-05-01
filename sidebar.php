<!-- lf begin: this is out sidebar, defined in sidebar.php -->
<div id="sidebar">
	
	<? include('templates/social-home-buttons.php'); ?>
	<!-- mh: menu widget 'right pane menu' in bottom of sidebar-->
	<ul class="rightPaneMenu">
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Right pane menu')) ; ?> 
	</ul>

	<div class="issues">
		<div class="issuesSidebar">
			<h1 class="sidebarHeader">Issues</h1>
				<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Issues')) ; ?>
				<? /*include('templates/sidebar-issues.php');*/ ?>
		</div>
	</div>

	<!-- lf begin: this is the agenda section  -->
	<!-- lf: begin: list agenda event -->
	<?
	//$region = get_calendar_region_param();
	$region = get_calendar_region_param();
	if(isset($region)):
		//$filter = $region;
		$filter = get_calendar_from_region( $region );
		$cityName = get_city_name_from_region( $region );
		include('templates/calendar-listing.php');
	else:
		include('templates/calendar-not-set.php');
	endif;
  ?>
	
	<!-- <div class="line">&nbsp;</div> -->

	<!--
	<div class="adFreeBlock">
		<a href="http://www.adfreeblog.org/" target="_blank"><img src="http://www.adfreeblog.org/art_not_ads.jpg"></a>
	</div>
	-->
	
	<div class='footerSidebar'><?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Footer sidebar') ) ; ?> </div>
	
</div>
<!-- lf end: this is out sidebar, defined in sidebar.php -->
