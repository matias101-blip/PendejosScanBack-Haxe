<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\_Url;

use \php\_Boot\HxAnon;
use \php\Boot;

final class SingleHostUrl_Impl_ {
	/**
	 * @param object $v
	 * 
	 * @return object
	 */
	public static function _new ($v) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:190: character 3
		return $v;
	}

	/**
	 * @param string $s
	 * 
	 * @return object
	 */
	public static function ofString ($s) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:207: characters 5-20
		return SingleHostUrl_Impl_::ofUrl(Url_Impl_::fromString($s));
	}

	/**
	 * @param object $u
	 * 
	 * @return object
	 */
	public static function ofUrl ($u) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:193: lines 193-204
		$v = null;
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:193: characters 37-60
		$_g = $u->hosts;
		$__hx__switch = ($_g->length);
		if ($__hx__switch === 0) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:193: lines 193-204
			$v = $u;
		} else if ($__hx__switch === 1) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:193: characters 37-60
			$_g1 = ($_g->arr[0] ?? null);
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:193: lines 193-204
			$v = $u;
		} else {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:195: characters 12-13
			$v1 = $_g;
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:193: lines 193-204
			$v = Url_Impl_::make(new HxAnon([
				"path" => $u->path,
				"query" => $u->query,
				"hosts" => \Array_hx::wrap([($u->hosts->arr[0] ?? null)]),
				"auth" => $u->auth,
				"scheme" => $u->scheme,
				"hash" => $u->hash,
			]));
		}
		return $v;
	}
}

Boot::registerClass(SingleHostUrl_Impl_::class, 'tink._Url.SingleHostUrl_Impl_');
