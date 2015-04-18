<?php
/**
 * @file
 * Template file for the example display.
 *
 * Variables available:
 * 
 * $plugin: The pager plugin object. This contains the view.
 *
 * $plugin->view
 *   The view object for this navigation.
 *
 * $nav_title
 *   The formatted title for this view. In the case of block
 *   views, it will be a link to the full view, otherwise it will
 *   be the formatted name of the year, month, day, or week.
 *
 * $prev_url
 * $next_url
 *   Urls for the previous and next calendar pages. The links are
 *   composed in the template to make it easier to change the text,
 *   add images, etc.
 *
 * $prev_options
 * $next_options
 *   Query strings and other options for the links that need to
 *   be used in the l() function, including rel=nofollow.
 */
?>
<?php if (!empty($pager_prefix)) print $pager_prefix; ?>
<div class="date-nav-wrapper clearfix<?php if (!empty($extra_classes)) print $extra_classes; ?>">
  <div class="date-nav item-list">
    <div class="date-heading"><h3><?php    
    $arr = explode(',', $nav_title);
    $arr2 = explode(' ', $arr[1]);
    if($nav_title[1]=='a' || strpos($prev_url, 'month') !== false){
    	switch($arr2[1])
    	{
    		case t('January'): $arr2[1] = 'Январь';	break;
    		case t('February'): $arr2[1] = 'Февраль';break;
    		case t('March'): $arr2[1] = 'Март';	break;
    		case t('April'): $arr2[1] = 'Апрель';	break;
    		case t('May'): $arr2[1] = 'Май';	break;
    		case t('June'): $arr2[1] = 'Июнь';	break;
    		case t('July'): $arr2[1] = 'Июль';	break;
    		case t('August'): $arr2[1] = 'Август'; break;
    		case t('September'): $arr2[1] = 'Сентябрь';break;
    		case t('October'): $arr2[1] = 'Октябрь';break;
    		case t('November'): $arr2[1] = 'Ноябрь'; break;
    		case t('December'): $arr2[1] = 'Декабрь';break;
    	}
    	print $arr2[1];
		if($nav_title[1]!='a')
			print ', '.$arr[2];
	}
	elseif (strpos($prev_url, 'week') !== false){
		switch($arr2[1])
		{
			case t('January'): $arr2[1] = 'Январь';	break;
			case t('February'): $arr2[1] = 'Февраль';break;
			case t('March'): $arr2[1] = 'Март';	break;
			case t('April'): $arr2[1] = 'Апрель';	break;
			case t('May'): $arr2[1] = 'Май';	break;
			case t('June'): $arr2[1] = 'Июнь';	break;
			case t('July'): $arr2[1] = 'Июль';	break;
			case t('August'): $arr2[1] = 'Август'; break;
			case t('September'): $arr2[1] = 'Сентябрь';break;
			case t('October'): $arr2[1] = 'Октябрь';break;
			case t('November'): $arr2[1] = 'Ноябрь'; break;
			case t('December'): $arr2[1] = 'Декабрь';break;
		}
		print $arr2[1].', '.$arr[2];
		$temp1 = explode('-',explode('?',$prev_url)[1]);
		$week_number1 = substr($temp1[1], 1);
		$temp2 = explode('-',explode('?',$next_url)[1]);
		$week_number2 = substr($temp2[1], 1);
		
		if($week_number1>$week_number2){
			$year1 = explode('=', $temp1[0])[1];
			$year2 = explode('=', $temp2[0])[1];
			$prev_url = explode('?',$prev_url)[0].'?week='.(intval($year2)-1).'-W'.$week_number1;
		}
		else{
			if($temp1[0]!=$temp2[0]){
				$year2 = explode('=', $temp2[0])[1];
				$next_url = explode('?',$next_url)[0].'?week='.(intval($year2)-1).'-W'.$week_number2;
			}
		}
	}
	elseif (strpos($prev_url, 'day') !== false){
		print $arr2[2].' '.$arr2[1]. ', '. $arr[2];		
	}
    ?></h3>
    </div>
    
    <ul class="pager">
    <?php if (!empty($next_url)) : ?>
      <li class="date-next">
        <?php print l('<div class="arrow" style=\'background-image: url('. base_path() . drupal_get_path('theme', 'creative_responsive_theme') . '/images/arrows.png'.');\'></div>'/*($mini ? '' : t('Next', array(), array('context' => 'date_nav')) . ' ') . '&raquo;'*/, $next_url, $next_options); ?>
      </li>
    <?php endif; ?>
    <?php if (!empty($prev_url)) : ?>
      <li class="date-prev">
        <?php print l('<div class="arrow" style=\'background-image: url('. base_path() . drupal_get_path('theme', 'creative_responsive_theme') . '/images/arrows.png'.');\'></div>'/*'&laquo;' . ($mini ? '' : ' ' . t('Prev', array(), array('context' => 'date_nav')))*/, $prev_url, $prev_options); ?>
      </li>
    <?php endif; ?>
    </ul>
  </div>
   <?php if($nav_title[1]=='a'): ?>
    	<i style="font-style: italic;"><a href = "<?php $_SERVER['HTTP_HOST'] .$_SERVER['REQUEST_URI'];?>?month=<?php print date("Y-m");?>">
    	<?php print t('Today').' '.date("d.m.Y");?>
    	</a></i>
    <?php endif;?>
</div>