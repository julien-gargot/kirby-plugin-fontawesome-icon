<?php
# site/plugins/icons/tags/link.php

return [
  'attr' => [
    'class',
    'rel',
    'role',
    'target',
    'title',
    'text',
    'icon',
    'stack',
  ],
  'html' => function ($tag) {

    if(!empty($tag->icon)) {
      $icon = kirbytext( '(icon: '. $tag->icon . ' stack: '. $tag->stack .')' );
      $icon = str::substr($icon, 3, -4);
      $text = $icon . ' ' . $text;
    }

    return Html::a($tag->value, [$icon, $tag->text], [
      'rel'    => $tag->rel,
      'class'  => $tag->class,
      'role'   => $tag->role,
      'title'  => $tag->title,
      'target' => $tag->target,
    ]);
  }
];
