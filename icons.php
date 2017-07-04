<?php
/**
 * Kirby Fontawesome Icons plugin
 *
 * @version   1.0.0
 * @author    Julien Gargot <julien@g-u-i.me>
 * @copyright Julien Gargot <julien@g-u-i.me>
 * @link      https://github.com/julien-gargot/kirby-plugin-fontawesome-icon
 * @license   CC BY-SA
 */

// date tag
kirbytext::$tags['icon'] = array(
  'attr' => array(),
  'html' => function($tag) {

    // Convert options to array.
    $icons = str::split( $tag->attr('icon'), ' ' );

    // Add “fa-” prefix to each option when not present
    $icons = array_map(function($value){
      preg_match( '/^(.?$|[^f].+|f[^a].*)/', $value, $matches);
      return $matches ? 'fa-' . $value : $value;
    }, $icons);

    // Add “fa” class if not present
    if( !in_array("fa", $icons, TRUE) ) {
      array_unshift($icons, "fa");
    }

    // Create `i` tag
    $i = new Brick('i');
    $i->addClass( $icons );
    $i->attr( 'aria-hidden', "true" );

    return $i;

  }
);
