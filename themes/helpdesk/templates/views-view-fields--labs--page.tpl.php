<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
 
global $user;
$temp = strip_tags($fields['field_group']->content);
if($temp==user_load($user->uid)->field_group['und'][0]['tid']){
	$act = strip_tags($fields['field_active']->content);
?>
<?php if($act!='0'):?>
<a href="<?php print strip_tags($fields['path']->content);?>" >
<?php endif; ?>
	<div class="rectangle" <?php if($act=='0') print ' style="background-color:rgba(216,216,216,0.5);" '?>	>
		<div class="circle1" style="background-color:<?php print get_random_color($fields['title']->raw);?>">
			 <div class = "textInCircle1"><?php print $fields['title']->content;?></div>
		</div>
		<div class = "textInRectangle1">В бригаде: <?php print strip_tags($fields['field_count_group']->content); ?>
		<br>
		Срок: <?php print strip_tags($fields['field_date']->content); ?>
		<br>В очереди: <?php print $fields['comment_count']->content;?>
		</div>
	</div>
<?php if($act!='0'):?>
</a>
<?php endif; ?>
<?php } ?>
