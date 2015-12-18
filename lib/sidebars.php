<?php

/***************************************************************
* Function erh_widgets_init
* Register sidebars and widgets
***************************************************************/

function erh_widgets_init() {

  register_sidebar(array(
    'name' => 'Main Sidebar',
    'id' => 'main-sidebar',
    'description' => __('Widget Area for the Sidebar', 'erh_starter'),
    'before_widget' => '<div class="widget %1$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));

}

add_action('widgets_init', 'erh_widgets_init');