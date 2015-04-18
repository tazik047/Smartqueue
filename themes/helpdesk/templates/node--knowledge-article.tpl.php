<article id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php if ($title_prefix || $title_suffix || $display_submitted || !$page): ?>
  <header>
    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
      <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
    <?php print render($title_suffix); ?>

      <div class="header-info">
        <div class="article-create-date"><i class="fa fa-clock-o themecolor-text"></i><span class="label"><?php print t("Create"); ?>: </span><?php print date('m/d/Y',$node->created); ?></div>
        <div class="article-author"><i class="fa fa-user themecolor-text"></i><span class="label"><?php print t("Author"); ?>: </span><?php print $node->name; ?></div>
        <div class="article-category"><i class="fa fa-sitemap themecolor-text"></i><?php print render($content['field_category']); ?></div>
        <div class="article-sharethis"><?php print render($content['field_share_this']); ?></div>
      </div>        
  </header>
  <?php endif; ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_tags']);
      hide($content['field_category']);
      hide($content['field_share_this']);
      print render($content);
    ?>
  </div>

  <?php if (!empty($content['field_tags']) || !empty($content['links'])): ?>
    <footer>
    <?php print render($content['field_tags']); ?>
    <?php print render($content['links']); ?>
    </footer>
  <?php endif; ?>

  <?php print render($content['comments']); ?>

</article>