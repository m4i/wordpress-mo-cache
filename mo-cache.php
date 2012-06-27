<?php
/**
 * @package MOCache
 */

/*
Plugin Name: MO Cache
Plugin URI: http://wordpress.org/extend/plugins/mo-cache/
Description: Improving the site performance by caching translation files using the WordPress standard cache mechanism.
Author: Masaki Takeuchi
Version: 2.0
Author URI: https://github.com/m4i/wordpress-mo-cache
License: MIT
*/

class MOCache {
	const VERSION = '2.0';
	const GROUP   = 'mo';

	public static function setup() {
		add_filter(
			'override_load_textdomain', array( new self, 'load' ), 10, 3 );
	}

	public function load( $override, $domain, $mofile ) {
		global $l10n;

		do_action( 'load_textdomain', $domain, $mofile );
		$mofile = apply_filters( 'load_textdomain_mofile', $mofile, $domain );
		if ( !is_readable( $mofile ) ) return false;

		if ( function_exists( 'wp_cache_add_global_groups' ) ) {
			wp_cache_add_global_groups( self::GROUP );
		}
		$key = preg_replace('/[^-\w]/', '_',
			self::VERSION . "-${GLOBALS['wp_version']}-$mofile");

		$mo = new MO();
		if ( $cache = wp_cache_get( $key, self::GROUP ) ) {
			$mo->entries = $cache['entries'];
			$mo->set_headers( $cache['headers'] );
		} else {
			if ( !$mo->import_from_file( $mofile ) ) return false;
			$cache = array(
				'entries' => $mo->entries,
				'headers' => $mo->headers,
			);
			wp_cache_set( $key, $cache, self::GROUP );
		}

		if ( isset( $l10n[$domain] ) )
			$mo->merge_with( $l10n[$domain] );
		$l10n[$domain] = &$mo;
		return true;
	}
}

MOCache::setup();
