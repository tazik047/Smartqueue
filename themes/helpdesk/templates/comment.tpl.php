<article class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="comment-author">
      <?php print $picture; ?>
      <?php if ($signature): ?><?php print $signature; ?><?php endif; ?>
  </div>
  <div class="comment-content">
  <header class="clearfix">

    <?php print render($title_prefix); ?>
    <?php if ($title): ?>
      <h3<?php print $title_attributes; ?>>
        <?php print $title; ?>
        <?php if ($new): ?>
          <mark class="new label label-default"><?php print $new; ?></mark>
        <?php endif; ?>
      </h3>
    <?php elseif ($new): ?>
      <mark class="new label-default"><?php print $new; ?></mark>
    <?php endif; ?>
    <?php print render($title_suffix); ?>
  </header>
  <div class="clearfix">
   
    <span class="submitted">
      <i class="fa fa-clock-o"></i> Sent by <?php print $author ?> <span class="text-label"> <?php print t('on');?> </span><?php print format_interval(time()-$comment->created) . ' ' . t("ago"); ?>
    </span>
  </div>
  <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['links']);
    print render($content);
  ?>

  
    <footer class="clearfix">
      <?php print render($content['links']) ?>
    </footer>
  </div>
</article>