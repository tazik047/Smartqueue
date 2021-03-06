<section id="comments" class="<?php print $classes; ?>"<?php print $attributes; ?>>
 <?php if($content['comment_form']['#node']->type != 'queue'){
	if ($content['comments'] && $node->type != 'forum'): ?>
    <?php print render($title_prefix); ?>
    <h2 class="title"><?php print t('Comments'); ?></h2>
    <?php print render($title_suffix); ?>
  <?php endif; ?>

  <?php print render($content['comments']); }
  $com_title = 'Add new comment';
  $in_que = false;
  ?>

  <?php if($content['comment_form']['#node']->type == 'queue'){
	//$com_title = 'Добавиться в очередь';
	global $user;
	if($content['comment_form']['#node']->field_active['und'][0]['value']=='0')
		$in_que = true;
	else{
		$tid = user_load($user->uid)->field_group['und'][0]['tid'];
		if($tid != $content['comment_form']['#node']->field_group['und'][0]['tid'])
			$in_que = true;
		else{
			$comments = comment_load_multiple(comment_get_thread($content['comment_form']['#node'], '', 1000000));
			if(is_in_queue($comments, $user->uid)){
				$in_que = true;
			}
		}
	}
	}?>
  <?php if (!$in_que && $content['comment_form']): ?>
    <h2 class="title comment-form"><?php print t($com_title); ?></h2>
    <?php print render($content['comment_form']);?>
  <?php endif;?>
</section>