<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\_Stringly;

use \php\_Boot\HxAnon;
use \php\Boot;
use \tink\core\TypedError;
use \tink\core\Outcome;
use \tink\core\OutcomeTools;

final class Stringly_Impl_ {
	/**
	 * @var \EReg
	 */
	static public $SUPPORTED_DATE_REGEX;

	/**
	 * @param string $this
	 * 
	 * @return bool
	 */
	public static function isFloat ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:57: characters 5-39
		return Stringly_Impl_::isNumber(\trim($this1), true);
	}

	/**
	 * @param string $this
	 * 
	 * @return bool
	 */
	public static function isInt ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:72: characters 5-40
		return Stringly_Impl_::isNumber(\trim($this1), false);
	}

	/**
	 * @param string $s
	 * @param bool $allowFloat
	 * 
	 * @return bool
	 */
	public static function isNumber ($s, $allowFloat) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:11: characters 5-36
		if (mb_strlen($s) === 0) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:11: characters 24-36
			return false;
		}
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:13: lines 13-14
		$pos = 0;
		$max = mb_strlen($s);
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:27: characters 5-20
		if (($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 45)) {
			++$pos;
		}
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:29: lines 29-32
		if (!$allowFloat) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:30: lines 30-31
			if (($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 48) && ($pos++ > -1)) {
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:31: characters 9-24
				if (($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 120)) {
					++$pos;
				}
			}
		}
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:34: characters 5-13
		while (($pos < $max) && ((\StringTools::fastCodeAt($s, $pos) ^ 48) < 10)) {
			++$pos;
		}
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:36: lines 36-44
		if ($allowFloat && ($pos < $max)) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:37: lines 37-38
			if (($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 46) && ($pos++ > -1)) {
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:38: characters 9-17
				while (($pos < $max) && ((\StringTools::fastCodeAt($s, $pos) ^ 48) < 10)) {
					++$pos;
				}
			}
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:40: lines 40-43
			if ((($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 101) && ($pos++ > -1)) || (($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 69) && ($pos++ > -1))) {
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:41: characters 9-43
				if (!(($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 43) && ($pos++ > -1))) {
					#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:41: characters 28-43
					if (($pos < $max) && (\StringTools::fastCodeAt($s, $pos) === 45)) {
						++$pos;
					}
				}
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:42: characters 9-17
				while (($pos < $max) && ((\StringTools::fastCodeAt($s, $pos) ^ 48) < 10)) {
					++$pos;
				}
			}
		}
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:46: characters 5-22
		return $pos === $max;
	}

	/**
	 * @param bool $b
	 * 
	 * @return string
	 */
	public static function ofBool ($b) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:174: characters 12-38
		if ($b) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:174: characters 20-24
			return "true";
		} else {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:174: characters 32-37
			return "false";
		}
	}

	/**
	 * @param \Date $d
	 * 
	 * @return string
	 */
	public static function ofDate ($d) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:183: characters 12-32
		return \Std::string($d->getTime());
	}

	/**
	 * @param float $f
	 * 
	 * @return string
	 */
	public static function ofFloat ($f) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:180: characters 5-25
		return \Std::string($f);
	}

	/**
	 * @param int $i
	 * 
	 * @return string
	 */
	public static function ofInt ($i) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:177: characters 5-25
		return \Std::string($i);
	}

	/**
	 * @param string $this
	 * @param \Closure $f
	 * 
	 * @return Outcome
	 */
	public static function parse ($this1, $f) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:171: characters 12-13
		$_g = $f;
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:171: characters 19-23
		$a1 = $this1;
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:171: characters 5-42
		return TypedError::catchExceptions(function () use (&$_g, &$a1) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:171: characters 12-18
			return $_g($a1);
		}, null, new HxAnon([
			"fileName" => "tink/Stringly.hx",
			"lineNumber" => 171,
			"className" => "tink._Stringly.Stringly_Impl_",
			"methodName" => "parse",
		]));
	}

	/**
	 * @param string $this
	 * 
	 * @return Outcome
	 */
	public static function parseDate ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:97: characters 19-31
		$_g = Stringly_Impl_::parseFloat($this1);
		$__hx__switch = ($_g->index);
		if ($__hx__switch === 0) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:98: characters 20-21
			$f = $_g->params[0];
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:99: characters 9-34
			return Outcome::Success(\Date::fromTime($f));
		} else if ($__hx__switch === 1) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:100: characters 20-21
			$_g1 = $_g->params[0];
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:101: characters 9-60
			if (!Stringly_Impl_::$SUPPORTED_DATE_REGEX->match($this1)) {
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:101: characters 47-60
				return Outcome::Failure(new TypedError(422, "" . ($this1??'null') . " is not a valid date", new HxAnon([
					"fileName" => "tink/Stringly.hx",
					"lineNumber" => 101,
					"className" => "tink._Stringly.Stringly_Impl_",
					"methodName" => "parseDate",
				])));
			}
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:126: characters 9-45
			$s = \StringTools::replace($this1, "Z", "+00:00");
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:127: characters 9-157
			$d = \DateTime::createFromFormat((Stringly_Impl_::$SUPPORTED_DATE_REGEX->matched(2) === null ? "Y-m-d\\TH:i:sP" : "Y-m-d\\TH:i:s.uP"), $s, new \DateTimeZone("UTC"));
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:128: characters 9-92
			if (!$d) {
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:128: characters 79-92
				return Outcome::Failure(new TypedError(422, "" . ($this1??'null') . " is not a valid date", new HxAnon([
					"fileName" => "tink/Stringly.hx",
					"lineNumber" => 128,
					"className" => "tink._Stringly.Stringly_Impl_",
					"methodName" => "parseDate",
				])));
			}
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:129: characters 9-56
			return Outcome::Success(\Date::fromTime($d->getTimestamp() * 1000));
		}
	}

	/**
	 * @param string $this
	 * 
	 * @return Outcome
	 */
	public static function parseFloat ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:61: characters 19-30
		$_g = \trim($this1);
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:62: characters 12-13
		$v = $_g;
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:62: lines 62-65
		if (Stringly_Impl_::isNumber($v, true)) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:63: characters 9-45
			return Outcome::Success(\Std::parseFloat($v));
		} else {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:64: characters 12-13
			$v = $_g;
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:65: characters 9-94
			return Outcome::Failure(new TypedError(422, "" . ($v??'null') . " (encoded as " . ($this1??'null') . ") is not a valid float", new HxAnon([
				"fileName" => "tink/Stringly.hx",
				"lineNumber" => 65,
				"className" => "tink._Stringly.Stringly_Impl_",
				"methodName" => "parseFloat",
			])));
		}
	}

	/**
	 * @param string $this
	 * 
	 * @return Outcome
	 */
	public static function parseInt ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:76: characters 19-30
		$_g = \trim($this1);
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:77: characters 12-13
		$v = $_g;
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:77: lines 77-80
		if (Stringly_Impl_::isNumber($v, false)) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:78: characters 9-41
			return Outcome::Success(\Std::parseInt($v));
		} else {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:79: characters 12-13
			$v = $_g;
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:80: characters 9-96
			return Outcome::Failure(new TypedError(422, "" . ($v??'null') . " (encoded as " . ($this1??'null') . ") is not a valid integer", new HxAnon([
				"fileName" => "tink/Stringly.hx",
				"lineNumber" => 80,
				"className" => "tink._Stringly.Stringly_Impl_",
				"methodName" => "parseInt",
			])));
		}
	}

	/**
	 * @param string $this
	 * 
	 * @return bool
	 */
	public static function toBool ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:51: lines 51-54
		if ($this1 !== null) {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:51: characters 30-55
			$__hx__switch = (\mb_strtolower(\trim($this1)));
			if ($__hx__switch === "0" || $__hx__switch === "false" || $__hx__switch === "no") {
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:52: characters 34-39
				return false;
			} else {
				#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:53: characters 18-22
				return true;
			}
		} else {
			#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:51: lines 51-54
			return false;
		}
	}

	/**
	 * @param string $this
	 * 
	 * @return \Date
	 */
	public static function toDate ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:168: characters 5-30
		return OutcomeTools::sure(Stringly_Impl_::parseDate($this1));
	}

	/**
	 * @param string $this
	 * 
	 * @return float
	 */
	public static function toFloat ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:69: characters 5-31
		return OutcomeTools::sure(Stringly_Impl_::parseFloat($this1));
	}

	/**
	 * @param string $this
	 * 
	 * @return int
	 */
	public static function toInt ($this1) {
		#/home/thehunter101/.haxe/tink_stringly/0,6,0/src/tink/Stringly.hx:84: characters 5-29
		return OutcomeTools::sure(Stringly_Impl_::parseInt($this1));
	}

	/**
	 * @internal
	 * @access private
	 */
	static public function __hx__init ()
	{
		static $called = false;
		if ($called) return;
		$called = true;


		self::$SUPPORTED_DATE_REGEX = new \EReg("^(\\d{4}-\\d{2}-\\d{2}T\\d{2}:\\d{2}:\\d{2})(\\.\\d{3})?(Z|[\\+-]\\d{2}:\\d{2})\$", "");
	}
}

Boot::registerClass(Stringly_Impl_::class, 'tink._Stringly.Stringly_Impl_');
Stringly_Impl_::__hx__init();
