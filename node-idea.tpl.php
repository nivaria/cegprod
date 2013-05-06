<?php
// $Id: node-answer.tpl.php $
?>

<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">
    <?php print $picture ?>
    <?php if ($page == 0): ?>
      <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
      <span class="comment-count"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $comment_count ?></a></span>
    <?php if ($node_top && !$teaser): ?>
    <div id="node-top" class="node-top row nested">
      <div id="node-top-inner" class="node-top-inner inner">
        <?php print $node_top; ?>
      </div><!-- /node-top-inner -->
    </div><!-- /node-top -->
    <?php endif; ?>
    <?php if ($submitted): ?>
    <div class="meta">
      <span class="submitted"><?php print $submitted ?></span>
    </div>
    <?php endif; ?>
    <?php if ($terms): ?>
    <div class="terms">
      <?php print $terms; ?>
    </div>
    <?php endif;?>
    <!-- Idea classifiction -->
    <?php if ($area_terms[8]): ?>
    <div class="idea_clas">
      <?php print $area_terms[8]; ?>
    </div>
    <?php endif;?>
    <?php print $node->classify_challenge; ?>
    <?php print $ongoing ?>
    <?php print $challenge_date ?>
    <div class="content clearfix">
      <?php print $content ?>
    </div>
    
    <?php if ($links && $page ==1): ?>
    <div class="links">
      <?php print $links; ?>
    </div>
    <?php endif; ?>

  </div><!-- /inner -->

  <?php if ($node_bottom && !$teaser): ?>
  <div id="node-bottom" class="node-bottom row nested">
    <div id="node-bottom-inner" class="node-bottom-inner inner">
      <?php print $node_bottom; ?>
    </div><!-- /node-bottom-inner -->
  </div><!-- /node-bottom -->
  <?php endif; ?>
</div><!-- /node-<?php print $node->nid; ?> -->
