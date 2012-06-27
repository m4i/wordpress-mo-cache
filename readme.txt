=== MO Cache ===
Contributors: m4i
Tags: cache, caching, performance, benchmark, benchmarking, i18n, internationalization, l10n, localization, language, languages, translation, translate
Requires at least: 3.2
Tested up to: 3.4
Stable tag: 2.0

Improving the site performance by caching translation files using the WordPress standard cache mechanism.


== Description ==

The MO Cache provides simple and fast caching of the translation MO files using the [WP Object Cache](http://codex.wordpress.org/Class_Reference/WP_Object_Cache) mechanism.
This plugin is necessary to be used [persistent caching plugin](http://codex.wordpress.org/Class_Reference/WP_Object_Cache#Persistent_Cache_Plugins), otherwise you can not benefit from this plugin.

For localized WordPress, which was newly installed, the loading time of translation files accounts for 70% of the entire processing time.
You can make this process 3 times faster by just installing this plugin.

[Description in Japanese （日本語での紹介記事）](http://m4i.hatenablog.com/entry/2011/12/10/000407)

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

It is recommended to install the MO Cache as a [must-use plugin](http://codex.wordpress.org/Must_Use_Plugins) because the translation files will not be cached if other plugins load translation files before the MO Cache is loaded.

1. Verify that `/wp-content/object-cache.php` is installed.
1. Create `/wp-content/mu-plugins` directory, if it not exist.
1. Upload `mo-cache.php` to the `/wp-content/mu-plugins` directory.
1. Done! No need to activate.


== Frequently Asked Questions ==

= Does this plugin support multiple WordPress installs? =

It depends on the persistent caching plugin.
[APC Object Cache Backend](http://wordpress.org/extend/plugins/apc/), [W3 Total Cache](http://wordpress.org/extend/plugins/w3-total-cache/) and [WP File Cache](http://wordpress.org/extend/plugins/wp-file-cache/) support it.


== Screenshots ==

1. Benchmarking WordPress 3.3 ja using Xdebug profiler.


== Changelog ==

= 2.0 =
* Support WordPress 3.4

= 1.2 =
* No change in the code
* Fix typos in readme

= 1.1 =
* No change in the code
* Tested up to WordPress 3.3

= 1.0 =
* Initial release
