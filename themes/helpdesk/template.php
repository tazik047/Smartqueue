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
  drupal_add_css(path_to_theme() . '/css/'. $file, array('group' => CSS_THEME, 'weight' => 115,'browsers' => array(), 'preprocess' => FALSE));
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
  if($form["#id"]=="views-exposed-form-knowledge-article-page" || $form["#id"]=="views-exposed-form-knowledge-indexed-page" ) {

    if($form["#info"]["filter-search_api_views_fulltext"]["label"]) {
	  $form['search_api_views_fulltext']['#attributes']['placeholder'] = $form["#info"]["filter-search_api_views_fulltext"]["label"];
	  $form["#info"]["filter-search_api_views_fulltext"]["label"] = '';
	}
	else 
	  $form['search_api_views_fulltext']['#attributes']['placeholder'] = t('Search the Knowledge base');
  }
  return $form;
}
function helpdesk_form_simplenews_block_form_alter(&$form) {
  $form['mail']['#title_display'] = 'invisible';
  $form['mail']['#attributes']['placeholder'] = t('Enter your Email');
  return $form;
}

function helpdesk_form_comment_form_alter(&$form, &$form_state) {
	/*print '<pre>';
	print_r($form);
	die();*/
	if($form['#node']->type=='queue'){
		array_unshift($form['#validate'], 'my_comment_validate');
		$form['comment_body']['#after_build'][] = 'my_customize_comment_form';
	}
}

function my_customize_comment_form(&$form, &$form_state){
	global $user;
	$comments = comment_load_multiple(comment_get_thread($form_state['complete form']['#node'], '', 1000000));
	if(is_in_queue($comments, $user->uid)){
		return;
	}
	$res = array();
	print '<style>.views-field-field-group{display:none;}</style>';
	
	$form_state['complete form']['#node']->content['links']['comment']['#links']['comment-add']['title'] = 'Добавиться в очередь';
	$gr = user_load($user->uid)->field_group['und'][0]['tid'];
	foreach($form_state['complete form']['field_students']['und']['#options'] as $l=>$val){
		$temp = explode('  ',strip_tags($val));
		$temp = trim($temp[count($temp)-1]);
		if($user->uid==$l || $temp!=$gr || is_in_queue($comments, $l)){
			unset($form_state['complete form']['field_students']['und'][$l]);
			continue;
		}
		$res[$l] = $val;
	}
	$form_state['complete form']['subject']['#access'] = 
	$form_state['complete form']['actions']['preview']['#access'] = 
	$form_state['complete form']['author']['#access'] = 0;
	$form_state['complete form']['field_students']['und']['#options'] = $res;
}

function my_comment_validate(&$form, &$form_state){
	if(trim($form_state['values']['field_index']['und'][0]['value'])!=''){
		$ind = (int)$form_state['values']['field_index']['und'][0]['value'];
		if($ind<1 || $form_state['values']['field_index']['und'][0]['value']!=$ind){
			form_set_error('№ в очереди', '№ в очереди должен быть целым положительным числом');
			return;
		}
		$max_c = (int)$form['#node']->field_count_group['und'][0]['value'];
		if($max_c<(1 + count($form['field_students']['und']['#value']))){
			form_set_error('Бригада', 'В бригаде должно быть не больше '.$max_c. ' человек'.($max_c==1?'a':''));
			return;
		}
		foreach(comment_load_multiple(comment_get_thread($form_state['complete form']['#node'], '', 1000000)) as $l=>$val){
			/*print '<pre>';
			print_r($val->field_index['und']['0']['value']);
			die();*/
			if($val->field_index['und']['0']['value'] == $ind){
				form_set_error('Позиция', 'Этот номер уже занят');
				return;
			}
		}/*
		print '<pre>';
		print_r($form_state['complete form']);
		die();*/
	}
}

function is_in_queue($comments, $uid){
	foreach($comments as $l=>$val){
		$temp = get_arrr_in_queue($val);
		if(in_array($uid, $temp)){
			return true;
		}
	}
	return false;
}

function get_arrr_in_queue($comment){
	$queue = array();
	$queue[] = $comment->uid;
	//print_r($comment->field_students['und'][0]);
	if(!isset($comment->field_students['und'])) return $queue;
	foreach($comment->field_students['und'][0] as $l=>$val){
			$queue[] = $val;
	}
	return $queue;
}
