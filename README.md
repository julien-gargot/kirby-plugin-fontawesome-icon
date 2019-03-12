# Kirby plugins

## Fontawesome Icons plugin

In the context of Kirbytext, the plugin simply allows you to add Font Awesome icons from a kirbytag:

`(icon: fa fa-camera-retro)`

or simply:

`(icon: camera-retro)`

If you want to use “Stacked Icons”:

`(icon: fa fa-camera-retro stack: fa fa-circle-thin)`

or simply:

`(icon: camera-retro stack: circle-thin)`

If you want linked icons, you can use the default `(link:…)` kirbytag with extra(s) attribute(s).
All standard kirbytags links attribute are working.

`(link: https://example.com icon: camera-retro)`

and even:

`(link: https://example.com icon: camera-retro stack: circle-thin)`

You can write *with or without* `fa` class and `fa-` prefix.

Use https://fontawesome.com/v4.7.0/ to choose icons you want.

## Installation

Download or clone the repository in `/site/plugins`.

Make sure you have Font Awesome v4.7.0. loaded. It’s not include in the plugin.
