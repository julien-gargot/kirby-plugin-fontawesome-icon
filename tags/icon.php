<?php
# site/plugins/icons/tags/icon.php


return array(
  'attr' => [
    'stack'
  ],
  'html' => function($tag) {

    // Get options
    $icons = str::split( $tag->icon, ' ' );
    $stackIcones = $tag->stack == false ? null : str::split( $tag->stack, ' ' );

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
      $i = Html::tag('i', null, [
        'class' => $icons,
        'aria-hidden' => 'true'
      ]);

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
      array_push($stackIcones, 'fa-stack-2x');

      // Add “fa” class if not present
      if( !in_array("fa", $stackIcones, TRUE) ) {
        array_unshift($stackIcones, "fa");
      }

      //
      $icon = array_diff($icons, $r);
      array_push($icon, 'fa-stack-1x');

      //
      $span = $r;
      array_push($span, 'fa-stack');

      // Create `i` tag (background)
      $i1 = Html::tag('i', null, [
        'class' => $stackIcones,
        'aria-hidden' => 'true'
      ]);

      // Create `i` tag (main icon)
      $i2 = Html::tag('i', null, [
        'class' => $icon,
        'aria-hidden' => 'true'
      ]);

      // Create `span` tag
      $i = Html::tag('span', [$i1, $i2], [
        'class' => $span,
        'aria-hidden' => 'true'
      ]);

    }

    return $i;

  }
);
