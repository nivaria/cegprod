<?php
// $Id: node-answer.tpl.php $
?>

<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">
    <?php print $picture ?>
    <?php if ($page == 0): ?>
      <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
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
    
    <?php if ($node->links['comment_add']): ?>
    <div class="links">
      <div class="comment_clear_style answer-add-comment">
        <a href="<?php print base_path() . $node->links['comment_add']['href'] . '#' . $node->links['comment_add']['fragment']; ?>" title="Share your thoughts and opinions related to this posting.">Comment</a>
      </div>
      <?php if ($node->comment_count > 0): ?>
      <div class="comment_clear_style answer-comment-count">
         <a href="<?php print base_path() . $node->links['comment_add']['href'] . '#' . $node->links['comment_add']['fragment']; ?>" title="<?php print t('Share your thoughts and opinions related to this posting.') ?>"><?php print t('Comment') ?></a>
      </div>
      <?php endif; ?>
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
