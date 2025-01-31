<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\core;

use \tink\core\_Progress\ProgressObject;
use \tink\core\_Signal\Signal_Impl_;
use \php\Boot;
use \tink\core\_Progress\ProgressValue_Impl_;
use \haxe\ds\Option as DsOption;

final class ProgressTrigger extends ProgressObject {
	/**
	 * @var SignalTrigger
	 */
	public $_changed;
	/**
	 * @var ProgressStatus
	 */
	public $_status;

	/**
	 * @param ProgressStatus $status
	 * 
	 * @return void
	 */
	public function __construct ($status = null) {
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:126: characters 18-22
		$this->_changed = null;
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:128: lines 128-132
		$_gthis = $this;
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:129: lines 129-130
		if ($status === null) {
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:130: characters 17-56
			$status = ProgressStatus::InProgress(ProgressValue_Impl_::$ZERO);
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:130: characters 7-56
			$this->_status = $status;
		}
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:131: characters 15-27
		$tmp = null;
		if ($status === null) {
			$tmp = false;
		} else if ($status->index === 1) {
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:131: characters 37-38
			$_g = $status->params[0];
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:131: characters 15-27
			$tmp = true;
		} else {
			$tmp = false;
		}
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:131: characters 5-104
		parent::__construct(($tmp ? Signal_Impl_::dead() : $this->_changed = Signal_Impl_::trigger()), function () use (&$_gthis) {
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:131: characters 96-103
			return $_gthis->_status;
		});
	}

	/**
	 * @return ProgressObject
	 */
	public function asProgress () {
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:135: characters 5-16
		return $this;
	}

	/**
	 * @param mixed $v
	 * 
	 * @return void
	 */
	public function finish ($v) {
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:142: characters 10-17
		$_g = $this->_status;
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:142: characters 10-23
		$tmp = null;
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:142: characters 10-17
		if ($_g->index === 1) {
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:142: characters 33-34
			$_g1 = $_g->params[0];
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:142: characters 10-23
			$tmp = true;
		} else {
			$tmp = false;
		}
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:142: lines 142-143
		if (!$tmp) {
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:143: characters 7-46
			$this->_changed->handlers->invoke($this->_status = ProgressStatus::Finished($v));
		}
	}

	/**
	 * @param float $v
	 * @param DsOption $total
	 * 
	 * @return void
	 */
	public function progress ($v, $total) {
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:138: characters 10-17
		$_g = $this->_status;
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:138: characters 10-23
		$tmp = null;
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:138: characters 10-17
		if ($_g->index === 1) {
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:138: characters 33-34
			$_g1 = $_g->params[0];
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:138: characters 10-23
			$tmp = true;
		} else {
			$tmp = false;
		}
		#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:138: lines 138-139
		if (!$tmp) {
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:139: characters 7-74
			$_this = $this->_changed;
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:139: characters 45-72
			$this1 = new MPair($v, $total);
			#/home/thehunter101/.haxe/tink_core/2,1,1/src/tink/core/Progress.hx:139: characters 7-74
			$_this->handlers->invoke($this->_status = ProgressStatus::InProgress($this1));
		}
	}
}

Boot::registerClass(ProgressTrigger::class, 'tink.core.ProgressTrigger');
