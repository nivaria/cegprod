<?php
// $Id: node.tpl.php 7510 2010-06-15 19:09:36Z sheena $

?>

<div id="node-<?php print $node->nid; ?>" class="node <?php print $node_classes; ?>">
  <div class="inner">
    <?php print $picture ?>

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

   
    <div class="content clearfix">
    <?php if ($page == 0): ?>
    <h2 class="title"><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
    <?php endif; ?>
    <?php if ($terms): ?>
    <div class="terms">
      <?php print $terms; ?>
    </div>
    <?php endif;?>
    <?php if ($area_terms[5]): ?>
    <div class="area_terms">
      Area de Gestión:<?php print $area_terms[5]; ?>
    </div>
    <?php endif;?>
      <?
        if ( $node->og_public==1 ){
      ?>
          <div class="content_access <? if($terms){ print("terms_there"); } ?>">
            <span class="content_access_title" ><? print t("Contenido público"); ?></span>
            <div class="content_access_help_trigger" ><span class="content_access_help" ><? print t("Este contenido y todos sus comentarios serán visibles en la web"); ?></span></div>
          </div>
      <?
        } else {
      ?>
          <div class="content_access <? if($terms){ print("terms_there"); } ?>">
            <span class="content_access_title private_content" ><? print t("Contenido privado"); ?></span>
            <div class="content_access_help_trigger" ><span class="content_access_help" ><? print t("Este contenido y todos sus comentarios sólo serán visibles por los miembros del o los grupos a los que pertenece"); ?></span></div>
          </div>
      <?
        }
      ?>
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
