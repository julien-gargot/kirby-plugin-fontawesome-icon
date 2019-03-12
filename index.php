<?php
/**
 * Kirby Fontawesome Icons plugin
 *
 * @version   2.0.0
 * @author    Julien Gargot <julien@g-u-i.net>
 * @copyright Julien Gargot <julien@g-u-i.net>
 * @link      https://github.com/julien-gargot/kirby-plugin-fontawesome-icon
 * @license   CC BY-SA
 */

Kirby::plugin('julien-gargot/icons', [
  'tags' => [
    'icon' => require_once __DIR__ . '/tags/icon.php',
    'link' => require_once __DIR__ . '/tags/link.php',
  ]
]);
