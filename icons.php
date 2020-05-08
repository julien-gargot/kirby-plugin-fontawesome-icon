<?php
/**
 * Kirby Fontawesome Icons plugin
 *
 * @version   1.2.0
 * @author    Julien Gargot <julien@g-u-i.net>
 * @copyright Julien Gargot <julien@g-u-i.net>
 * @link      https://github.com/julien-gargot/kirby-plugin-fontawesome-icon
 * @license   CC BY-SA
 */

// date tag
kirbytext::$tags['icon'] = array(
  'attr' => array('stack'),
  'html' => function($tag) {

    // Get options
    $icons = str::split( $tag->attr('icon'), ' ' );
    $stackIcones = $tag->attr('stack') == false ? null : str::split( $tag->attr('stack'), ' ' );

    // Add “fa-” prefix to each option when not present
    $icons = array_map(function($value){
      preg_match( '/^(.?$|[^f].+|f[^a].*|fa[^-].+)/', $value, $matches);
      return $matches ? 'fa-' . $value : $value;
    }, $icons);

    // Add “fa” class if not present
    if( !in_array("fa", $icons, TRUE) ) {
      array_unshift($icons, "fa");
    }

    if( $stackIcones === null )
    {

      // Create `i` tag
      $i = new Brick('i');
      $i->addClass( $icons );
      $i->attr( 'aria-hidden', "true" );

    }
    else
    {

      // Look for a size option “fa” class if not present
      $r = array_intersect($icons, array('fa-lg','fa-2x','fa-3x','fa-4x','fa-5x'));

      // Add “fa-” prefix to each option when not present
      $stackIcones = array_map(function($value){
        preg_match( '/^(.?$|[^f].+|f[^a].*|fa[^-].+)/', $value, $matches);
        return $matches ? 'fa-' . $value : $value;
      }, $stackIcones);

      // Add “fa” class if not present
      if( !in_array("fa", $stackIcones, TRUE) ) {
        array_unshift($stackIcones, "fa");
      }

      // Create `span` tag
      $i = new Brick('span');
      $i->addClass( 'fa-stack' );
      $i->addClass( $r );
      $i->attr( 'aria-hidden', "true" );

      // Create `i` tag (background)
      $i1 = new Brick('i');
      $i1->addClass( $stackIcones );
      $i1->addClass( 'fa-stack-2x' );

      // Create `i` tag (main icon)
      $i2 = new Brick('i');
      $i2->addClass( array_diff($icons, $r) );
      $i2->addClass( 'fa-stack-1x' );

      $i->append($i1);
      $i->append($i2);

    }

    return $i;

  }
);

// link tag (override original one)
kirbytext::$tags['link'] = array(
  'attr' => array(
    'text',
    'class',
    'role',
    'title',
    'rel',
    'lang',
    'target',
    'popup',
    'icon',
    'stack'
  ),
  'html' => function($tag) {

    $link = url($tag->attr('link'), $tag->attr('lang'));
    $text = $tag->attr('text');

    if(!empty($tag->attr('icon'))) {
      $icon = kirbytext( '(icon: '. $tag->attr('icon') . ' stack: '. $tag->attr('stack') .')' );
      $icon = str::substr($icon, 3, -4);
      $text = $icon . ' ' . $text;
    }

    if(empty($text)) {
      $text = $link;
    }

    if(str::isURL($text)) {
      $text = url::short($text);
    }

    return html::a($link, $text, array(
      'rel'    => $tag->attr('rel'),
      'class'  => $tag->attr('class'),
      'role'   => $tag->attr('role'),
      'title'  => $tag->attr('title'),
      'target' => $tag->target(),
    ));

  }
);

// file tag (override original one)
kirbytext::$tags['file'] = array(
  'attr' => array(
    'text',
    'class',
    'title',
    'rel',
    'target',
    'popup',
    'icon',
    'stack'
  ),
  'html' => function($tag) {

    // build a proper link to the file
    $file = $tag->file($tag->attr('file'));
    $text = $tag->attr('text');

    if(!empty($tag->attr('icon'))) {
      $icon = kirbytext( '(icon: '. $tag->attr('icon') . ' stack: '. $tag->attr('stack') .')' );
      $icon = str::substr($icon, 3, -4);
      $text = $icon . ' ' . $text;
    }

    if(!$file) return $text;

    // use filename if the text is empty and make sure to
    // ignore markdown italic underscores in filenames
    if(empty($text)) $text = str_replace('_', '\_', $file->name());

    return html::a($file->url(), html($text), array(
      'class'  => $tag->attr('class'),
      'title'  => html($tag->attr('title')),
      'rel'    => $tag->attr('rel'),
      'target' => $tag->target(),
    ));

  }
);
