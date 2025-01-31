<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace php\_Boot;

use \php\Boot;
use \haxe\Exception;

/**
 * Closures implementation
 */
class HxClosure {
	/**
	 * @var mixed
	 * A callable value, which can be invoked by PHP
	 */
	public $callable;
	/**
	 * @var string
	 * Method name for methods
	 */
	public $func;
	/**
	 * @var mixed
	 * `this` for instance methods; php class name for static methods
	 */
	public $target;

	/**
	 * @param mixed $target
	 * @param string $func
	 * 
	 * @return void
	 */
	public function __construct ($target, $func) {
		#/usr/share/haxe/std/php/Boot.hx:983: characters 3-23
		$this->target = $target;
		#/usr/share/haxe/std/php/Boot.hx:984: characters 3-19
		$this->func = $func;
		#/usr/share/haxe/std/php/Boot.hx:986: lines 986-988
		if (\is_null($target)) {
			#/usr/share/haxe/std/php/Boot.hx:987: characters 4-9
			throw Exception::thrown("Unable to create closure on `null`");
		}
		#/usr/share/haxe/std/php/Boot.hx:989: characters 3-104
		$this->callable = (($target instanceof HxAnon) ? $target->{$func} : [$target, $func]);
	}

	/**
	 * @see http://php.net/manual/en/language.oop5.magic.php#object.invoke
	 * 
	 * @return mixed
	 */
	public function __invoke () {
		#/usr/share/haxe/std/php/Boot.hx:997: characters 3-71
		return \call_user_func_array($this->callable, \func_get_args());
	}

	/**
	 * Invoke this closure with `newThis` instead of `this`
	 * 
	 * @param mixed $newThis
	 * @param array $args
	 * 
	 * @return mixed
	 */
	public function callWith ($newThis, $args) {
		#/usr/share/haxe/std/php/Boot.hx:1024: characters 3-65
		return \call_user_func_array($this->getCallback($newThis), $args);
	}

	/**
	 * Check if this is the same closure
	 * 
	 * @param HxClosure $closure
	 * 
	 * @return bool
	 */
	public function equals ($closure) {
		#/usr/share/haxe/std/php/Boot.hx:1017: characters 10-60
		if (Boot::equal($this->target, $closure->target)) {
			#/usr/share/haxe/std/php/Boot.hx:1017: characters 39-59
			return $this->func === $closure->func;
		} else {
			#/usr/share/haxe/std/php/Boot.hx:1017: characters 10-60
			return false;
		}
	}

	/**
	 * Generates callable value for PHP
	 * 
	 * @param mixed $eThis
	 * 
	 * @return mixed[]
	 */
	public function getCallback ($eThis = null) {
		#/usr/share/haxe/std/php/Boot.hx:1004: lines 1004-1006
		if ($eThis === null) {
			#/usr/share/haxe/std/php/Boot.hx:1005: characters 4-18
			$eThis = $this->target;
		}
		#/usr/share/haxe/std/php/Boot.hx:1007: lines 1007-1009
		if (($eThis instanceof HxAnon)) {
			#/usr/share/haxe/std/php/Boot.hx:1008: characters 4-36
			return $eThis->{$this->func};
		}
		#/usr/share/haxe/std/php/Boot.hx:1010: characters 3-39
		return [$eThis, $this->func];
	}
}

Boot::registerClass(HxClosure::class, 'php._Boot.HxClosure');
