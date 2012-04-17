<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml">   
<head profile="http://gmpg.org/xfn/11">  

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- calling monthly archives -->
<?php wp_get_archives('type=monthly&format=link'); ?>  
 <?php global $settings; ?>
    	
<!-- done calling monthly archives -->
	<title>
	<?php if ( is_page() ) { ?><?php bloginfo('name'); ?><?php wp_title('&otimes;'); ?><?php } ?>
	<?php if ( is_home() ) { ?><?php bloginfo('name'); ?><?php } ?>
	<?php if ( is_single() ) { ?><?php wp_title(''); ?>&nbsp;&otimes;&nbsp;<?php bloginfo('name'); ?><?php } ?>
	<?php if ( is_category() ) { ?><?php bloginfo('name'); ?>&nbsp;&otimes;&nbsp;<?php single_cat_title(); ?><?php } ?>
	<?php if ( is_year() ) { ?><?php bloginfo('name'); ?>&nbsp;&otimes;&nbsp;<?php the_time('Y'); ?><?php } ?>
	<?php if ( is_tax() ) { ?><?php bloginfo('name'); ?>&nbsp;&otimes;&nbsp;Media: <?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?><?php } ?>
	<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php bloginfo('name'); ?>&nbsp;&otimes;&nbsp;<?php  single_tag_title("Tag Archive:", true); } } ?>
	</title>  

	<link rel="stylesheet" href="<?= THEME_ROOT; ?>/css/coda-slider-2.0.css" type="text/css" media="screen" />
	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css" />

<!-- calling wp_head -->
<?php wp_head(); ?> 

</head>   

<body <?php body_class(); ?>>
	
	<div id="left"></div>
	<div id="right"></div>
	<div id="top"></div>
	<div id="bottom"></div>	

<div class='headercontainer'>
		<div class="header">
		<?
			global $g_show_backlink;
			if( isset($g_show_backlink) ):
				switch($g_show_backlink):
					case 'gallery':
						?>
							<div class="here">GALLERY</div> 
							<a href="<?php echo get_option('home'); ?>">&uarr; back</a>
						<?
						break;
					case 'calendar':
					?>
							<div class="here"><?= get_city_name_from_cookie(); ?> CALENDAR</div> 
							<a href="<?php echo get_option('home'); ?>">&uarr; back</a>
					<?
						break;
				endswitch;
		?>
	<? endif; ?>
		</div> 

	<div class="logo">
		<a href="<?php echo get_option('home'); ?>"/><img src="<?php bloginfo('template_url'); ?>/images/gutmag_logo.png"/></a>
		<div class='search'><?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Right pane search') ) ; ?> </div>
	</div>
		
</div>
	
	

