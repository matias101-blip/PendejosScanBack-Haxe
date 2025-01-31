<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\streams\_Stream;

use \tink\streams\StreamBase;
use \tink\core\_Future\SyncFuture;
use \php\Boot;
use \tink\streams\Step;
use \tink\core\TypedError;
use \tink\core\_Lazy\LazyConst;
use \tink\streams\Conclusion;
use \tink\core\_Future\FutureObject;

class ErrorStream extends StreamBase {
	/**
	 * @var TypedError
	 */
	public $error;

	/**
	 * @param TypedError $error
	 * 
	 * @return void
	 */
	public function __construct ($error) {
		#/home/thehunter101/.haxe/tink_streams/0,4,0/src/tink/streams/Stream.hx:196: characters 5-23
		parent::__construct();
		$this->error = $error;
	}

	/**
	 * @param \Closure $handler
	 * 
	 * @return FutureObject
	 */
	public function forEach ($handler) {
		#/home/thehunter101/.haxe/tink_streams/0,4,0/src/tink/streams/Stream.hx:202: characters 12-49
		return new SyncFuture(new LazyConst(Conclusion::Failed($this->error)));
	}

	/**
	 * @return FutureObject
	 */
	public function next () {
		#/home/thehunter101/.haxe/tink_streams/0,4,0/src/tink/streams/Stream.hx:199: characters 12-41
		return new SyncFuture(new LazyConst(Step::Fail($this->error)));
	}
}

Boot::registerClass(ErrorStream::class, 'tink.streams._Stream.ErrorStream');
