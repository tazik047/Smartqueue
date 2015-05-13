<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
   <style>
        .rectangle {
            width: 320px;
            height: 160px;
            border: 1px #979797 solid;
            -moz-border-radius: 22px; /* закругление для старых Mozilla Firefox */
            -webkit-border-radius: 22px; /* закругление для старых Chrome и Safari */
        }
		
		.circle1 {
            width: 98px;
            height: 98px;
            border: 1px #979797 solid;
            position: relative;
            top: 30px;
            left: 15px;
            -moz-border-radius: 60px;
            -webkit-border-radius: 60px;
            border-radius: 60px;
        }
        .textInCircle1 {
            font-family: Helvetica;
            font-weight: 300;
            font-size: 26px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
            top: 32px;
            text-align: center;
        }
        .textInRectangle1 {
            font-family: Helvetica;
            font-weight: 300;
            font-size: 20px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
            top: -56px;
            left: 130px;
        }
		
        .circle {
            width: 98px;
            height: 98px;
            border: 1px #979797 solid;
            /*background: rgba(126, 211, 33, 0.25);*/
            position: relative;
            -moz-border-radius: 60px;
            -webkit-border-radius: 60px;
            border-radius: 60px;
            float:left;
			margin-right:15px;
        }
        .textInCircle {
            font-family: Helvetica;
            font-weight: 300;
            font-size: 26px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
            top: 32px;
            text-align: center;
        }
        .dateInCircle {
            font-family: Helvetica;
            font-weight: 300;
            font-size: 16px;
            color: rgba(0, 0, 0, 0.5);
            position: relative;
            top: 40px;
            text-align: center;
        }
    </style>

<?php if (!empty($title)): ?>
  <div class="views-group-item">
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php
	$empty = true;
	/*print '<pre>';
	print_r($rows);
	die();*/
?>
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <div class="views-row-inner">
	  <?php if(!empty($row)) {
		print $row; 
		$empty = false;
	  }?>
    </div>
  </div>
<?php endforeach; ?>
<?php
	if($empty){
		print '<div>Нет ближайших очередей.</div>';
	}
?>
<?php if (!empty($title)): ?>
  </div>
<?php endif; ?>
