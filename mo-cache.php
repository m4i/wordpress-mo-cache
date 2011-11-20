<?php
/**
 * @package MOCache
 */

/*
Plugin Name: MO Cache
Plugin URI: http://wordpress.org/extend/plugins/mo-cache/
Description: Improving the site performance by caching translation files using the WordPress standard cache mechanism.
Author: Masaki Ishihara
Version: 1.0
Author URI: https://github.com/m4i/wordpress-mo-cache
License: MIT
*/

/**
 * Load and store MO object
 */
class MOCache {
	const GROUP = 'mo';

	private $hit  = array();
	private $miss = array();

	/**
	 * Setup WordPress hook
	 */
	public static function setup() {
		add_filter(
			'override_load_textdomain', array( new self, 'load' ), 10, 3 );
	}

	/**
	 * Load MO object from cache
	 */
	public function load( $override, $domain, $mofile ) {
		if ( isset( $this->hit[$domain] ) ) return true;

		if ( ! preg_match( '/\w+(?=\.mo$)/', $mofile, $matches ) ) return;
		$key = "$domain:$matches[0]";

		if ( function_exists( 'wp_cache_add_global_groups' ) ) {
			wp_cache_add_global_groups( self::GROUP );
		}

		if ( $cache = wp_cache_get( $key, self::GROUP ) ) {
			if ( is_array( $cache ) ) {
				global $l10n;
				$mo = new MO;
				$mo->entries = $cache['entries'];
				$mo->set_headers( $cache['headers'] );
				$l10n[$domain] = $mo;
			}

			$this->hit[$domain] = true;
			return true;

		} else {
			add_action( 'shutdown', array( $this, 'store' ) );

			$this->miss[$domain] = $key;
			return false;
		}
	}

	/**
	 * Store MO object in cache
	 */
	public function store() {
		global $l10n;

		if ( function_exists( 'wp_cache_add_global_groups' ) ) {
			wp_cache_add_global_groups( self::GROUP );
		}

		foreach ( $this->miss as $domain => $key ) {
			if ( isset( $l10n[$domain] ) ) {
				$mo = $l10n[$domain];
				$cache = array(
					'entries' => $mo->entries,
					'headers' => $mo->headers,
				);
			} else {
				$cache = 'negative cache';
			}
			wp_cache_set( $key, $cache, self::GROUP );
		}
	}
}

MOCache::setup();
