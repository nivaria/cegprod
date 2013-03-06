<?php

/**
 * Row & block theme functions
 * Adds divs to elements in page.tpl.php
 */
function cegprod_grid_row($element, $name, $class = '', $width = '', $extra = '') {
    $output = '';
    $extra = ($extra) ? ' ' . $extra : '';
    if ($element) {
        if ($class == 'full-width') {
            $output .= '<div id="' . $name . '-wrapper" class="' . $name . '-wrapper full-width">' . "\n";
            $output .= '<div id="' . $name . '" class="' . $name . ' row ' . $width . $extra . '">' . "\n";
        } else {
            $output .= '<div id="' . $name . '" class="' . $name . ' row ' . $class . ' ' . $width . $extra . '">' . "\n";
        }
        $output .= '<div id="' . $name . '-inner" class="' . $name . '-inner inner clearfix">' . "\n";
        if ($name == 'sidebar-last') {
            $output .= '<span class="sidebar-last-cap"></span>' . "\n";
        }
        $output .= $element;
        $output .= '</div><!-- /' . $name . '-inner -->' . "\n";
        $output .= '</div><!-- /' . $name . ' -->' . "\n";
        $output .= ($class == 'full-width') ? '</div><!-- /' . $name . '-wrapper -->' . "\n" : '';
    }
    return $output;
}

function cegprod_preprocess_page(&$variables) {
    $variables['pre_header_top'] = theme('grid_row', $variables['header_top'], 'header-top', 'full-width', $variables['grid_width']);
    $variables['pre_secondary_links'] = theme('grid_block', theme('links', $variables['secondary_links']), 'secondary-menu');
    $variables['pre_search_box'] = theme('grid_block', $variables['search_box'], 'search-box');
    $variables['pre_primary_links_tree'] = theme('grid_block', $variables['primary_links_tree'], 'primary-menu');
    $variables['pre_breadcrumb'] = theme('grid_block', $variables['breadcrumb'], 'breadcrumbs');
    $variables['pre_preface_top'] = theme('grid_row', $variables['preface_top'], 'preface-top', 'full-width', $variables['grid_width']);
    $variables['pre_sidebar_first'] = theme('grid_row', $variables['sidebar_first'], 'sidebar-first', 'nested', $variables['sidebar_first_width']);
    $variables['pre_preface_bottom'] = theme('grid_row', $variables['preface_bottom'], 'preface-bottom', 'nested');
    $variables['pre_help'] = theme('grid_block', $variables['help'], 'content-help');
    $variables['pre_messages'] = theme('grid_block', $variables['messages'], 'content-messages');
    $variables['pre_tabs'] = theme('grid_block', $variables['tabs'], 'content-tabs');
    $variables['pre_content_bottom'] = theme('grid_row', $variables['content_bottom'], 'content-bottom', 'nested');
    $variables['pre_sidebar_last'] = theme('grid_row', $variables['sidebar_last'], 'sidebar-last', 'nested', $variables['sidebar_last_width']);
    $variables['pre_postscript_top'] = theme('grid_row', $variables['postscript_top'], 'postscript-top', 'nested');
    $variables['pre_postscript_bottom'] = theme('grid_row', $variables['postscript_bottom'], 'postscript-bottom', 'full-width', $variables['grid_width']);
    $variables['pre_footer'] = theme('grid_row', $variables['footer'] . $variables['footer_message'], 'footer', 'full-width', $variables['grid_width']);

    //show group description if group node present
    if (isset($variables['node'])) {
        $node = $variables['node'];
        if (og_is_group_type($node->type)) {
            $variables['group_header_image'] = content_format('field_group_image', $node->field_group_image[0], 'groups_140_140_ceg_default');

            if (!empty($node->body)) {
                $variables['group_header_text'] = check_markup($node->body, $node->format);
            } else {
                $variables['group_header_text'] = check_plain($node->og_description);
            }
        }
    }
}

function cegprod_preprocess_node(&$vars) {
    $query = 'destination=' . $_GET['q'];
    $vars['answers_login'] = t('<a href="@login">Login</a> or <a href="@register">register</a> to vote', array('@login' => url('user/login', array('query' => $query)), '@register' => url('user/register', array('query' => $query))));
    // Only build custom submitted information if it was first available
    // If it's not, that indicates that it's been turned off for this
    // node type
    if ($vars['submitted']) {
        // Load the node author
        $author = user_load($vars['node']->uid);

        // Author picture
        if (theme_get_setting('toggle_node_user_picture')) {
          if (isset($vars['picture'])) {
            $picture = $vars['picture'];
            unset($vars['picture']);
          } else if (isset($author->picture) && ($author->picture!='')){
            $picture = theme_imagecache('users_50_50_ceg', $author->picture);
          }
            $submitted = ($author->uid && user_access('access user profiles')) ? l($picture, "user/{$author->uid}", array('html' => TRUE)) : $picture;
        }
        $vars['submitted_name'] = (module_exists('contributors') && _check_contributors_ctype_enabled($vars['node']->type)) ? $vars['node']->content['contributors']['#value'] : theme('username', $author);
        unset($vars['node']->content['contributors']);

        // Author information
        $submitted .= '<span class="submitted-by">';
        $submitted .= t('Submitted by !name', array('!name' => $vars['submitted_name']));
        $submitted .= '</span>';


        if (!module_exists('contributors') || !_check_contributors_ctype_enabled($vars['node']->type)) {

            // User points
            if ($author->uid && module_exists('userpoints')) {
                $points = userpoints_get_current_points($author->uid);
                $submitted .= '<span class="userpoints-value" title="' . t('!val user points', array('!val' => $points)) . '">';
                $submitted .= "{$points}". t('points');
                $submitted .= '</span>';
            }

            // User badges
            if ($author->uid && module_exists('user_badges')) {
                if (is_array($author->badges)) {
                    foreach ($author->badges as $badge) {
                        $badges[] = theme('user_badge', $badge, $author);
                    }
                }

                if (!empty($badges)) {
                    $submitted .= theme('user_badge_group', $badges);
                }
            }
        }
        // Created time
        $submitted .= '<span class="submitted-on">'. t('on ');
        $submitted .= format_date($vars['node']->created);
        $submitted .= '</span>';

        $vars['submitted'] = $submitted;
    }
}

function cegprod_og_subscribe_link($node) {
    $class = "";
    if ($node->og_selective == OG_MODERATED) {
        $txt = t('Request membership');
        $class = 'og-request';
        if (og_is_pending_member($node->nid)) {
            return '<span class="og-awaiting">' . t('Awaiting approval') . '</span>';
        }
    } elseif ($node->og_selective == OG_OPEN) {
        $txt = t('Join');
        $class = 'og-join';
    }
    if (isset($txt)) {
        return l($txt, "og/subscribe/$node->nid", array('attributes' => array('rel' => 'nofollow', 'class' => $class), 'query' => drupal_get_destination()));
    }
}


/**
 *
 * @ingroup themeable
 */
function cegprod_tidy_node_links_list_item($link_title, $link, $first, $last, $ref) {
  $output = '';

  //dropdown
  $title_tag = strip_tags($link_title);
  if ($first) {
    $output .= '<li class="node_link_style-dropdown-main">';
    $title_tag = '<span>' . $title_tag . '</span>';
  }
  else $output .= '<li class="node_link_style-dropdown-item">';

  if (isset($link)) {
    if (isset($link['href'])) {
  
      $output .= l($title_tag, $link['href'], $link);
  
    }
    else {
      //try to extract href from title
      $path = $ref->extract_href($link['title']);
      if ($path != $link['title']) {
        $output .= '<a href="' . $path . '">' . $title_tag . '</a>';
      } else {
        $output .= '<span>' . $title_tag . '</span>';
      }
    }
  }

  if (!$first) {


    $output .= '</li>';


  }
  if ($first && !$last) {
    $output .= '<ul>';
  }
  elseif ($last && !$first) {
      $output .= '</ul>';
  }
  if ($last) {
    $output .= '</li>';
  }

  return $output;
}

function cegprod_preprocess_mimemail_message(&$variables) {
  global $base_url;
  $variables['logo'] = $base_url . theme_get_setting('logo');
  $extension_pos = strrpos($variables['logo'], '.'); // find position of the last dot, so where the extension starts
  $variables['logo'] = substr($variables['logo'], 0, $extension_pos) . '_mail' . substr($variables['logo'], $extension_pos);
  $variables['front_page'] = url();
}

/**
 *  Theme from/to date combination on form.
 */
function cegprod_date_combo($element) {
  $field = content_fields($element['#field_name'], $element['#type_name']);
  if (!$field['todate']) {
    return $element['#children'];
  }

  // Group from/to items together in fieldset.
  $fieldset = array(
    '#title' => check_plain(t($field['widget']['label'])) .' '. ($element['#delta'] > 0 ? intval($element['#delta'] + 1) : ''),
    '#value' => $element['#children'],
    '#collapsible' => FALSE,
    '#collapsed' => FALSE,
    '#description' => $element['#fieldset_description'],
    '#attributes' => array(),
  );
  return theme('fieldset', $fieldset);
}

/**
 * Returns the taxonomy's url. If the taxonomy is one of the metagroups, returns the url of the metagroup content, otherwise, returns the taxonomy url
 * @param type $term
 * @return string 
 */
function _get_taxonomy_path($term) {
    $url = taxonomy_term_path($term);
    switch ($term->tid) {
      case 14: 
        $url = 'node/64';
        break;
      case 13:
        $url = 'node/81';
        break;
      case 12:
        $url = 'node/82';
        break;
      case 15:
        $url = 'node/83';
        break;
      default:
        break;
    }
    return $url;
}

/**
 * Theme to separate terms of taxonomy
 * @param type $node_taxonomy
 * @return type 
 */
function cegprod_separate_terms($node_taxonomy) {
  if ($node_taxonomy) { 
  //separating terms by vocabularies 
    foreach ($node_taxonomy AS $term) { 
      $links[$term->vid]['taxonomy_term_'. $term->tid] = 
        l($term->name, _get_taxonomy_path($term), array('attributes' => array(
            'rel' => 'tag', 
            'title' => strip_tags($term->description)
            )
          )
       ); 
   } //theming terms out 
 
    foreach ($links AS $key => $vid) {
      $terms[$key] = implode(', ', $vid);
    } 
  } 
  return $terms; 
}

/**
 * Theme to exclude a vocabulary from $node_taxonomy
 * @param type $node_taxonomy
 * @param type $vid
 * @return type 
 */
function cegprod_not_include_terms($node_taxonomy, $vid) {
  if ($node_taxonomy) { 
  //separating terms by vocabularies 
    foreach ($node_taxonomy AS $term) {
      if ($term->vid != $vid) {
        $links[] = l($term->name, _get_taxonomy_path($term), array('attributes' => array(
            'rel' => 'tag', 
            'title' => strip_tags($term->description)
            )
          )
        ); 
      }
   }
  } 
  $link = implode(', ', $links);
  return $link;
}


