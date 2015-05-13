<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<style>
        #rectangle {
            width: 688px;
            height: 485px;
            border: 1px #979797 solid;
            -moz-border-radius: 22px; /* закругление для старых Mozilla Firefox */
            -webkit-border-radius: 22px; /* закругление для старых Chrome и Safari */
        }
        #circle {
            width: 48px;
            height: 48px;
            border: 1px #979797 solid;
            background: <?php print get_random_color($node->title);?>;
            position: relative;
            top: -1px;
            left: -1px;
            -moz-border-radius: 60px;
            -webkit-border-radius: 60px;
            border-radius: 60px;
        }
        #textInCircle {
            /*font-family: Helvetica;*/
            font-weight: 300;
            font-size: 13px;
            /*color: rgba(0, 0, 0, 0.5);*/
            position: relative;
            top: 12px;
            text-align: center;
        }
        .mainText {
            /*font-family: Helvetica;*/
            font-weight: 400;
            font-size: 20px;
            /*color: rgba(0, 0, 0, 0.5);*/
            position: relative;
            top: -50px;
            text-align: center;
        }
        #conditionText {
            /*font-family: Helvetica;*/
            font-weight: 300;
            font-size: 12px;
            /*color: rgba(0, 0, 0, 0.5);*/
            position: relative;
            top: -65px;
            text-align: center;
        }
    </style>

<?php 	
	function get_index_from_queue($queue){
		return $queue['field_index']['#items'][0]['value'];
	}
	
	function get_students_from_queue($queue){
		
		$author = user_load($queue['#comment']->uid);
		$res = $author->field_surname['und'][0]['value'];
		if(isset($author->field_name['und'][0]['value'])){
			$res = $res.' '.$author->field_name['und'][0]['value'];
		}
		if(isset($queue['field_students'])){			
			foreach($queue['field_students']['#object']->field_students['und'] as $val1){
				$res = $res.', '.$val1['user']->field_surname['und'][0]['value'];
				if(isset($val1['user']->user->field_name['und'][0]['value'])){
					$res = $res.' '.$val1['user']->user->field_name['und'][0]['value'];
				}
			}
		}
		return $res;
	}
	
	function my_cmp($a, $b) {
	$a = get_index_from_queue($a);
	$b = get_index_from_queue($b);
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}
?>
	
<div id = "rectangle">
    <div id="circle">
        <div id = "textInCircle"><?php print $node->title; ?></div>
    </div>
    <p class = "mainText" style="margin-top:5px;">Задание</p>
    <p id = "conditionText">Выполнение в бригадах до <?php print $node->field_count_group['und']['0']['value'];?> человек(а)</p>
    <div class = "mainText" style="top: -70px; font-size: 16px; margin-bottom:15px;">
	<?php 
		print render($content['field_task']);
		print render($content['field_files']);
	?>
	</div>
    <p class = "mainText" style="top: -80px; font-size: 16px">Очередь</p>
	<ol style="/*color: rgba(0, 0, 0, 0.5);*/ position: relative; top: -80px;">
	<?php
		$arr = $content['comments']['comments'];
		//print '<pre>';
		unset($arr['#sorted']); unset($arr['pager']);
		//print_r($arr);
		//die();
		usort($arr,'my_cmp');
		$i = 1;
		foreach($arr as $l=>$value1){
			print '<li>';
			while(get_index_from_queue($value1)!=$i){
				print '</li><li>';
				$i++;
			}
			print get_students_from_queue($value1);
			$i++;
			print '</li>';
		}
		
	?>    
    </ol>

</div>
<!--
<?php /*die();*/?>
  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

    <?php if ($display_submitted): ?>
      <div class="submitted">
        <?php //print $user_picture; ?>
        <span class="glyphicon glyphicon-calendar"></span> <?php print $submitted; ?>
      </div>
    <?php endif; ?>
  </header>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
    <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>
-->
</article>