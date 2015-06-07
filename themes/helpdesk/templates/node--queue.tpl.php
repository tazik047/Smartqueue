<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

<?php 
	if(stristr(current_path(), 'taxonomy') === FALSE) {
?>

<style>
		#rectangle {
            max-width: 688px;
            height: 485px;
            border: 1px #979797 solid;
            -moz-border-radius: 22px; /* закругление для старых Mozilla Firefox */
            -webkit-border-radius: 22px; /* закругление для старых Chrome и Safari */
        }
        #circle {
            width: 48px;
            height: 48px;
            border: 1px #979797 solid;
            background-color: <?php print get_random_color($node->title);?>;
            position: relative;
            top: -1px;
            left: -1px;
            -moz-border-radius: 60px;
            -webkit-border-radius: 60px;
            border-radius: 60px;
        }
        #textInCircle {
            font-family: Helvetica;
            font-weight: 300;
            font-size: 13px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
            top: 10px;
            text-align: center;
        }
        .mainText {
            font-family: Helvetica;
            font-weight: 400;
            font-size: 20px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
            top: -50px;
            text-align: center;
        }
        #conditionText {
            font-family: Helvetica;
            font-weight: 300;
            font-size: 12px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
            top: -65px;
            text-align: center;
        }
    </style>
	
<div id = "rectangle">
    <div id="circle">
        <div id = "textInCircle"><?php print $node->title; ?></div>
    </div>
    <p class = "mainText" style="margin-top:20px;">Задание</p>
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
		if(isset($content['comments']))
			$arr = $content['comments']['comments'];
		else{
			$arr = comment_load_multiple(comment_get_thread($content['field_count_group']['#object'], '', 1000000));
			//debug_my_my($arr, true);
		}
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
<?php print render($content['comments']); ?>
<?php } else{?>
	<h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
<?php } ?>
</article>