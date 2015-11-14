<?php

/***************************************************************
* erh_Nav_Walker
* Customize the WP walker Menu for wp_nav_menu()
* Function based on Roots theme
***************************************************************/

/**
 * Cleaner walker for wp_nav_menu()
 *
 * Walker_Nav_Menu (WordPress default) example output:
 *   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
 *   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
 *
 * Roots_Nav_Walker example output:
 *   <li class="menu-home"><a href="/">Home</a></li>
 *   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
 */

class erh_Nav_Walker extends Walker_Nav_Menu {
  function check_current($classes) {
    return preg_match('/(current[-_])|active|dropdown/', $classes);
  }

  function start_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "\n<ul class=\"dropdown-menu\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $item_html = '';
    parent::start_el($item_html, $item, $depth, $args);

    if ($item->is_dropdown && ($depth === 0)) {
      $item_html = str_replace('<a', '<a class="dropdown-toggle"', $item_html);
    }

    $item_html = apply_filters('erh_wp_nav_menu_item', $item_html);
    $output .= $item_html;
  
  }

  function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
    $element->is_dropdown = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

    if ($element->is_dropdown) {
      $element->classes[] = 'dropdown';
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }
}


/***************************************************************
 * function erh_nav_menu_css_class
 * Remove the id="" on nav menu items
 * Return 'menu-slug' for nav menu classes
***************************************************************/

function erh_nav_menu_css_class($classes, $item) {
  $slug = sanitize_title($item->title);
  $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', 'active', $classes);
  $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

  $classes[] = 'menu-item ' . $slug;

  $classes = array_unique($classes);

  return array_filter($classes);
}

add_filter('nav_menu_css_class', 'erh_nav_menu_css_class', 10, 2);
add_filter('nav_menu_item_id', '__return_null');

/***************************************************************
 * function erh_nav_menu_args
 * Clean up wp_nav_menu_args
 * Remove the container
 * Use Custom Walker by default
***************************************************************/

function erh_nav_menu_args($args = '') {
  $erh_nav_menu_args['container'] = false;
  $erh_nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
  $erh_nav_menu_args['walker'] = new erh_Nav_Walker();

  return array_merge($args, $erh_nav_menu_args);
}

add_filter('wp_nav_menu_args', 'erh_nav_menu_args');