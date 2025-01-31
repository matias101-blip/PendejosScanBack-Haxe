<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\_Url;

use \php\_Boot\HxAnon;
use \php\Boot;
use \tink\url\_Path\Path_Impl_;
use \php\_Boot\HxString;
use \tink\url\_Host\Host_Impl_;

final class Url_Impl_ {
	/**
	 * @var int
	 */
	const AUTH = 6;
	/**
	 * @var int
	 */
	const HASH = 12;
	/**
	 * @var int
	 */
	const HOSTNAMES = 7;
	/**
	 * @var int
	 */
	const PATH = 8;
	/**
	 * @var int
	 */
	const PAYLOAD = 3;
	/**
	 * @var int
	 */
	const QUERY = 10;
	/**
	 * @var int
	 */
	const SCHEME = 2;


	/**
	 * @param object $parts
	 * 
	 * @return object
	 */
	public static function _new ($parts) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:33: character 3
		return $parts;
	}

	/**
	 * @param string $s
	 * 
	 * @return object
	 */
	public static function fromString ($s) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:97: characters 51-66
		return Url_Impl_::parse($s);
	}

	/**
	 * @param object $this
	 * 
	 * @return string
	 */
	public static function get_host ($this1) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:23: characters 7-27
		return ($this1->hosts->arr[0] ?? null);
	}

	/**
	 * @param object $this
	 * 
	 * @return string[]|\Array_hx
	 */
	public static function get_hosts ($this1) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:27: characters 7-24
		return $this1->hosts;
	}

	/**
	 * @param object $this
	 * 
	 * @return string
	 */
	public static function get_pathWithQuery ($this1) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:31: characters 14-80
		if ($this1->query === null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:31: characters 37-46
			return $this1->path;
		} else {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:31: characters 52-80
			return ((($this1->path === null ? "null" : $this1->path))??'null') . "?" . ((($this1->query === null ? "null" : $this1->query))??'null');
		}
	}

	/**
	 * @param object $parts
	 * 
	 * @return object
	 */
	public static function make ($parts) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:160: lines 160-168
		$parts1 = new HxAnon([
			"payload" => "",
			"path" => $parts->path,
			"query" => $parts->query,
			"hosts" => $parts->hosts,
			"auth" => $parts->auth,
			"scheme" => $parts->scheme,
			"hash" => $parts->hash,
		]);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:169: characters 5-23
		Url_Impl_::makePayload($parts1);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:170: characters 12-26
		return $parts1;
	}

	/**
	 * @param object $parts
	 * 
	 * @return void
	 */
	public static function makePayload ($parts) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:64: characters 5-22
		$payload = "";
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:66: characters 12-17
		$_g = $parts->auth;
		$_g1 = $parts->hash;
		$_g1 = $parts->hosts;
		$_g2 = $parts->path;
		$_g2 = $parts->payload;
		$_g2 = $parts->query;
		$_g2 = $parts->scheme;
		if ($_g === null) {
			if ($_g1->length !== 0) {
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:68: characters 21-22
				$v = $_g1;
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:69: characters 9-38
				$payload = ($payload??'null') . "//" . ($v->join(",")??'null');
			}
		} else if ($_g1->length === 0) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:70: characters 20-24
			$auth = $_g;
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:71: characters 9-29
			$payload = ($payload??'null') . "//" . ((($auth === null ? "null" : ($auth === null ? "" : "" . ($auth??'null') . "@")))??'null');
		} else {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:72: characters 20-24
			$auth = $_g;
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:72: characters 33-34
			$v = $_g1;
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:73: characters 9-43
			$payload = ($payload??'null') . "//" . ((($auth === null ? "null" : ($auth === null ? "" : "" . ($auth??'null') . "@")))??'null') . ($v->join(",")??'null');
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:76: characters 5-26
		$payload = ($payload??'null') . (($parts->path === null ? "null" : $parts->path)??'null');
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:78: characters 12-23
		$_g = $parts->query;
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:79: lines 79-80
		if ($_g !== null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:80: characters 12-13
			$v = $_g;
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:80: characters 15-31
			$payload = ($payload??'null') . "?" . ((($v === null ? "null" : $v))??'null');
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:83: characters 12-22
		$_g = $parts->hash;
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:84: lines 84-85
		if ($_g !== null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:85: characters 12-13
			$v = $_g;
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:85: characters 15-31
			$payload = ($payload??'null') . "#" . ($v??'null');
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:88: characters 21-55
		$parts->payload = $payload;
	}

	/**
	 * @param string $_
	 * 
	 * @return void
	 */
	public static function noop ($_) {
	}

	/**
	 * @param string $s
	 * @param \Closure $onError
	 * 
	 * @return object
	 */
	public static function parse ($s, $onError = null) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:101: lines 101-102
		if ($s === null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:102: characters 7-23
			return Url_Impl_::parse("");
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:104: lines 104-105
		if ($onError === null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:105: characters 7-21
			$onError = Boot::getStaticClosure(Url_Impl_::class, 'noop');
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:107: characters 5-17
		$s = \trim($s);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:109: lines 109-110
		if (\StringTools::startsWith($s, "data:")) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:110: characters 14-76
			return new HxAnon([
				"scheme" => "data",
				"payload" => \mb_substr($s, 5, null),
				"hosts" => new \Array_hx(),
			]);
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:112: characters 5-114
		$FORMAT = new \EReg("^(([a-zA-Z][a-zA-Z0-9\\-+.]*):)?((//(([^@/]+)@)?([^/?#]*))?([^?#]*)(\\?([^#]*))?(#(.*))?)\$", "");
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:113: characters 5-48
		$HOST = new \EReg("^(\\[(.*)\\]|([^:]*))(:(.*))?\$", "");
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:116: characters 5-20
		$FORMAT->match($s);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:118: lines 118-142
		$hosts = null;
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:118: characters 24-49
		$_g = $FORMAT->matched(7);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:119: lines 119-141
		if ($_g === null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:118: lines 118-142
			$hosts = new \Array_hx();
		} else {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:120: characters 14-15
			$v = $_g;
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:121: lines 121-141
			$_g = new \Array_hx();
			$_g1 = 0;
			$_g2 = HxString::split($v, ",");
			while ($_g1 < $_g2->length) {
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:121: characters 18-22
				$host = ($_g2->arr[$_g1] ?? null);
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:121: lines 121-141
				++$_g1;
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:122: characters 15-31
				$HOST->match($host);
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:123: lines 123-129
				$host1 = null;
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:123: characters 34-49
				$_g3 = $HOST->matched(3);
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:123: characters 51-66
				$_g4 = $HOST->matched(2);
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:124: lines 124-128
				if ($_g4 === null) {
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:124: characters 25-29
					$ipv4 = $_g3;
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:123: lines 123-129
					$host1 = $ipv4;
				} else if ($_g3 === null) {
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:125: characters 31-35
					$ipv6 = $_g4;
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:123: lines 123-129
					$host1 = "[" . ($ipv6??'null') . "]";
				} else {
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:127: characters 21-50
					$onError("invalid host " . ($host??'null'));
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:123: lines 123-129
					$host1 = null;
				}
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:130: lines 130-139
				$port = null;
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:130: characters 33-48
				$_g5 = $HOST->matched(5);
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:131: lines 131-138
				if ($_g5 === null) {
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:130: lines 130-139
					$port = null;
				} else {
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:132: characters 24-25
					$v = $_g5;
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:133: characters 30-45
					$_g6 = \Std::parseInt($v);
					#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:134: lines 134-137
					if ($_g6 === null) {
						#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:135: characters 29-55
						$onError("invalid port " . ($v??'null'));
						#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:130: lines 130-139
						$port = null;
					} else {
						#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:137: characters 32-33
						$p = $_g6;
						#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:130: lines 130-139
						$port = $p;
					}
				}
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:140: characters 15-35
				$x = Host_Impl_::_new($host1, $port);
				$_g->arr[$_g->length++] = $x;
			}
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:118: lines 118-142
			$hosts = $_g;
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:143: characters 5-37
		$path = $FORMAT->matched(8);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:145: lines 145-146
		if (($hosts->length > 0) && (\mb_substr($path, 0, 1) !== "/")) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:146: characters 7-22
			$path = "/" . ($path??'null');
		}
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:149: characters 15-37
		$parts = $FORMAT->matched(2);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:150: characters 16-39
		$parts1 = $FORMAT->matched(3);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:152: characters 13-38
		$parts2 = $FORMAT->matched(6);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:153: characters 13-17
		$parts3 = Path_Impl_::ofString($path);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:154: characters 14-35
		$parts4 = $FORMAT->matched(10);
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:148: lines 148-156
		return new HxAnon([
			"scheme" => $parts,
			"payload" => $parts1,
			"hosts" => $hosts,
			"auth" => $parts2,
			"path" => $parts3,
			"query" => $parts4,
			"hash" => $FORMAT->matched(12),
		]);
	}

	/**
	 * @param object $this
	 * @param object $that
	 * 
	 * @return object
	 */
	public static function resolve ($this1, $that) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:38: lines 38-60
		if ($that->scheme !== null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:38: characters 32-36
			return $that;
		} else if (($that->hosts->arr[0] ?? null) !== null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:40: lines 40-45
			if ($that->scheme !== null) {
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:40: characters 34-38
				return $that;
			} else {
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:42: characters 11-41
				$copy = \Reflect::copy($that);
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:43: characters 27-52
				$copy->scheme = $this1->scheme;
				#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:44: characters 11-22
				return $copy;
			}
		} else {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:48: characters 17-42
			$parts = Path_Impl_::join($this1->path, $that->path);
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:47: lines 47-55
			$parts1 = new HxAnon([
				"path" => $parts,
				"payload" => "",
				"scheme" => $this1->scheme,
				"query" => $that->query,
				"auth" => $this1->auth,
				"hosts" => $this1->hosts,
				"hash" => $that->hash,
			]);
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:57: characters 9-27
			Url_Impl_::makePayload($parts1);
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:59: characters 16-30
			return $parts1;
		}
	}

	/**
	 * @param object $this
	 * 
	 * @return string
	 */
	public static function toString ($this1) {
		#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:93: lines 93-94
		if ($this1->scheme === null) {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:93: characters 18-30
			return $this1->payload;
		} else {
			#/home/thehunter101/.haxe/tink_url/0,5,0/src/tink/Url.hx:94: characters 17-46
			return "" . ($this1->scheme??'null') . ":" . ($this1->payload??'null');
		}
	}
}

Boot::registerClass(Url_Impl_::class, 'tink._Url.Url_Impl_');
Boot::registerGetters('tink\\_Url\\Url_Impl_', [
	'pathWithQuery' => true,
	'hosts' => true,
	'host' => true
]);
