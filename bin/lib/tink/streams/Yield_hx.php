<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\streams;

use \php\Boot;
use \tink\core\TypedError;
use \php\_Boot\HxEnum;

class Yield_hx extends HxEnum {
	/**
	 * @param mixed $data
	 * 
	 * @return Yield_hx
	 */
	static public function Data ($data) {
		return new Yield_hx('Data', 0, [$data]);
	}

	/**
	 * @return Yield_hx
	 */
	static public function End () {
		static $inst = null;
		if (!$inst) $inst = new Yield_hx('End', 2, []);
		return $inst;
	}

	/**
	 * @param TypedError $e
	 * 
	 * @return Yield_hx
	 */
	static public function Fail ($e) {
		return new Yield_hx('Fail', 1, [$e]);
	}

	/**
	 * Returns array of (constructorIndex => constructorName)
	 *
	 * @return string[]
	 */
	static public function __hx__list () {
		return [
			0 => 'Data',
			2 => 'End',
			1 => 'Fail',
		];
	}

	/**
	 * Returns array of (constructorName => parametersCount)
	 *
	 * @return int[]
	 */
	static public function __hx__paramsCount () {
		return [
			'Data' => 1,
			'End' => 0,
			'Fail' => 1,
		];
	}
}

Boot::registerClass(Yield_hx::class, 'tink.streams.Yield');
