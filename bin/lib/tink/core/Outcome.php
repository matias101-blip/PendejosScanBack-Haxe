<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\core;

use \php\Boot;
use \php\_Boot\HxEnum;

/**
 * Representation of the outcome of any kind of operation that can fail.
 * Values of this type automatically use the extension methods defined in `OutcomeTools`.
 */
class Outcome extends HxEnum {
	/**
	 * @param mixed $failure
	 * 
	 * @return Outcome
	 */
	static public function Failure ($failure) {
		return new Outcome('Failure', 1, [$failure]);
	}

	/**
	 * @param mixed $data
	 * 
	 * @return Outcome
	 */
	static public function Success ($data) {
		return new Outcome('Success', 0, [$data]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			1 => 'Failure',
			0 => 'Success',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Failure' => 1,
			'Success' => 1,
		];
	}
}

Boot::registerClass(Outcome::class, 'tink.core.Outcome');
