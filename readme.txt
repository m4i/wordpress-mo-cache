=== MO Cache ===
Contributors: m4i
Tags: cache, caching, performance, benchmark, i18n, internationalization, l10n, localization, language, languages, translation, translate
Requires at least: 3.2.0
Tested up to: 3.2.1
Stable tag: 1.0

Improving the site performance by caching translation files using the WordPress standard cache mechanism.


== Description ==

For localized WordPress, which was newly installed, the loading time of translation files accounts for 70% of the
entire processing time. You can make this process 3 times faster by just installing this plugin.

The MO Cache provides simple and fast caching of the translation MO files using the
[WP Object Cache](http://codex.wordpress.org/Class_Reference/WP_Object_Cache) mechanism. This plugin is necessary to be
used [persistent caching plugin](http://codex.wordpress.org/Class_Reference/WP_Object_Cache#Persistent_Cache_Plugins),
otherwise you can not benefit from this plugin.
I recommend to use the [APC Object Cache Backend](http://wordpress.org/extend/plugins/apc/).

= Features =

* No configuration
* Supports multiple languages
* Supports plugin's translation files caching
* Supports WordPress Network/Multisite installation
* A simple plugin in less than 100 lines


== Installation ==

= Quick Installation =

1. Verify that `/wp-content/object-cache.php` is installed.
1. Install the plugin; the "Plugins -> Add New" menu in the WordPress.
1. Activate the plugin.

= Recommended Installation =

It is recommended to install the MO Cache as a [must-use plugin](http://codex.wordpress.org/Must_Use_Plugins) because
the translation files will not be cached if other plugins load translation files before the MO Cache is loaded.

1. Verify that `/wp-content/object-cache.php` is installed.
1. Create `/wp-content/mu-plugins` directory, if it not exist.
1. Upload `mo-cache.php` to the `/wp-content/mu-plugins` directory.
1. Done! No need to activate.


== Frequently Asked Questions ==

= Does this plugin support multiple WordPress installs? =

It depends on the persistent caching plugin.
The [APC Object Cache Backend](http://wordpress.org/extend/plugins/apc/) supports it.


== Changelog ==

= 1.0 =
* Initial release
