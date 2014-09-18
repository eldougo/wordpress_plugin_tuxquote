=== Tuxquote ===
Contributors: eldougo
Donate link: 
Tags: quote, tux
Requires at least: 3.0.1
Tested up to: 4.0
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show a random image of Tux the Linux penguin with a random quote.

== Description ==

Tuxquote shows a random image of Tux the Linux penguin with a random quote either as a widget or shortcode.

You can add or remove images from wp-content/plugins/tuxquote/images/ directory. All jpg, png and gif images will be randomly used from that directory.

Add or remove quotes from the wp-content/plugins/tuxquote/quotes.txt file. Quotes are line delimited and HTML formatting can be used, enabling you to use <br /> for line breaks etc.

Development for this plugin can be found on GitHub: https://github.com/eldougo/wordpress_plugin_tuxquote

The supplied images were sourced from CrystalXP.net (http://www.crystalxp.net/) and are all distributed under the Creative Commons BY-NC-SA license (http://creativecommons.org/licenses/by-nc-sa/3.0/)

Please see images-license.txt for image licensing information and image attributions.

= Shortcode usage =

Default usage:

[TUXQUOTE]

Parameters:

[TUXQUOTE title="title_text" width="container_width" align="container_alignment"]

* title:     Add title text above the image. Eg: title="Listen to the Penguin"  
* width:     Div container width in percentage or pixels. Eg: width="80%" or width="200px"  
* align:     How to align among the surrounding elements on the page. Can be "left", "right", "none". Eg: align="left"  

= Shortcode examples =

Set the width to 200 pixels:

[TUXQUOTE width="200px"]

Set the width to 80% of the container element and add a title:

[TUXQUOTE width="80%" title="Thought of the day"]

Set the alignment to the left allowing surrounding text to flow down the right of the Tuxquote container:

[TUXQUOTE align="left"]

== Installation ==

1. Upload the Tuxquote plugin to your blog, activate it, then either enter the shortcode '[TUXQUOTE]' in your page or post and/or drag the Tuxquote Widget to a widgitized area on your Widgets page.

== Frequently Asked Questions ==

= The images are distributed under the Creative Commons BY-NC-SA license, what does this mean? =

This means that you can't use the supplied images for any commercial purposes.

= How do I get around this? =

No problem, either remove all the images from the plugin images directory and replace them with your own, or get written permission from the image authors who are listed in the images-license.txt file. The Tuxquote plugin code is distributed under the GPL v2 license.

== Screenshots ==

1. Tuxquote in action - static sample only.
2. Tuxquote in action - static sample only.

== Changelog ==

= 1.3 =

* Added an alignment option to the shortcode and widget.
* The image will now expand to fill 100% of the Tuxquote div container.
* Refactored tuxquote.php to Wordpress standards.

= 1.2 =

* Replaced some deprecated HTML styling tags.
* Widgetized the plugin.
* Added width and title options.

= 1.1 =
Corrected some small typos in the readme file.

= 1.0 =
Initial.

== Upgrade Notice ==

= 1.3 =

* Added an alignment option to the shortcode and widget.
* The image will now expand to fill 100% of the Tuxquote div container.

= 1.2 =
* Replaced some deprecated HTML styling tags.
* Widgetized the plugin.
* Added width and title options.

= 1.1 =
Corrected some small typos in the readme file.

= 1.0 =
Initial release.

