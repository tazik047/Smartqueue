<?php 

/**
 * Page alter.
 */
function helpdesk_page_alter($page) {
	$mobileoptimized = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'MobileOptimized',
		'content' =>  'width'
		)
	);
	$handheldfriendly = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'HandheldFriendly',
		'content' =>  'true'
		)
	);
	$viewport = array(
		'#type' => 'html_tag',
		'#tag' => 'meta',
		'#attributes' => array(
		'name' =>  'viewport',
		'content' =>  'width=device-width, initial-scale=1'
		)
	);
	drupal_add_html_head($mobileoptimized, 'MobileOptimized');
	drupal_add_html_head($handheldfriendly, 'HandheldFriendly');
	drupal_add_html_head($viewport, 'viewport');
}

/**
 * Preprocess variables for html.tpl.php
 */
function helpdesk_preprocess_html(&$variables) {
  /* Color */
  $file = 'color-' . theme_get_setting('theme_color') . '-style.css';
  //drupal_add_css(path_to_theme() . '/css/'. $file, array('group' => CSS_THEME, 'weight' => 115,'browsers' => array(), 'preprocess' => FALSE));
	/**
	 * Add IE8 Support
	 */
	drupal_add_css(path_to_theme() . '/css/ie8.css', array('group' => CSS_THEME, 'browsers' => array('IE' => '(lt IE 9)', '!IE' => FALSE), 'preprocess' => FALSE));
	
	/**
	* Add Javascript for enable/disable Bootstrap 3 Javascript
	*/
	if (theme_get_setting('bootstrap_js_include', 'helpdesk')) {
	drupal_add_js(drupal_get_path('theme', 'helpdesk') . '/bootstrap/js/bootstrap.min.js');
	}
	//EOF:Javascript
	
	/**
	* Add Javascript for enable/disable scrollTop action
	*/
	if (theme_get_setting('scrolltop_display', 'helpdesk')) {

		drupal_add_js('jQuery(document).ready(function($) { 
		$(window).scroll(function() {
			if($(this).scrollTop() != 0) {
				$("#toTop").fadeIn();	
			} else {
				$("#toTop").fadeOut();
			}
		});
		
		$("#toTop").click(function() {
			$("body,html").animate({scrollTop:0},800);
		});	
		
		});',
		array('type' => 'inline', 'scope' => 'header'));
	}
	//EOF:Javascript
}

/**
 * Override or insert variables into the html template.
 */
function helpdesk_process_html(&$vars) {
	// Hook into color.module
	if (module_exists('color')) {
	_color_html_alter($vars);
	}
}

/**
 * Preprocess variables for page template.
 */
function helpdesk_preprocess_page(&$vars) {

	/**
	 * insert variables into page template.
	 */
	if($vars['page']['sidebar_first'] && $vars['page']['sidebar_second']) { 
		$vars['sidebar_grid_class'] = 'col-md-3';
		$vars['main_grid_class'] = 'col-md-6';
	} elseif ($vars['page']['sidebar_first'] || $vars['page']['sidebar_second']) {
		$vars['sidebar_grid_class'] = 'col-md-4';
		$vars['main_grid_class'] = 'col-md-8';		
	} else {
		$vars['main_grid_class'] = 'col-md-12';			
	}

	if($vars['page']['header_top_left'] && $vars['page']['header_top_right']) { 
		$vars['header_top_left_grid_class'] = 'col-md-6';
		$vars['header_top_right_grid_class'] = 'col-md-6';
	} elseif ($vars['page']['header_top_right'] || $vars['page']['header_top_left']) {
		$vars['header_top_left_grid_class'] = 'col-md-12';
		$vars['header_top_right_grid_class'] = 'col-md-12';		
	}
		
}

/**
 * Override or insert variables into the page template.
 */
function helpdesk_process_page(&$variables) {
  // Hook into color.module.
  if (module_exists('color')) {
    _color_page_alter($variables);
  }
}

/**
 * Preprocess variables for block.tpl.php
 */
function helpdesk_preprocess_block(&$variables) {
	$variables['classes_array'][]='clearfix';
}

function helpdesk_form_views_exposed_form_alter(&$form) {
  if($form["#id"]=="views-exposed-form-knowledge-article-page") {
    if($form["#info"]["filter-title"]["label"]) {
	  $form['title']['#attributes']['placeholder'] = $form["#info"]["filter-title"]["label"];
	  $form["#info"]["filter-title"]["label"] = '';
	}
	else 
	  $form['title']['#attributes']['placeholder'] = t('Search the Knowledge base');
  }
  return $form;
}
function helpdesk_form_simplenews_block_form_alter(&$form) {
  $form['mail']['#title_display'] = 'invisible';
  $form['mail']['#attributes']['placeholder'] = t('Enter your Email');
  return $form;
}
