<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace haxe\http;

use \php\_Boot\HxAnon;
use \php\Boot;
use \haxe\Exception;
use \haxe\io\Error;
use \php\_Boot\HxClosure;
use \haxe\io\Bytes;

/**
 * This class can be used to handle Http requests consistently across
 * platforms. There are two intended usages:
 * - call `haxe.Http.requestUrl(url)` and receive the result as a `String`
 * (only available on `sys` targets)
 * - create a `new haxe.Http(url)`, register your callbacks for `onData`,
 * `onError` and `onStatus`, then call `request()`.
 */
class HttpBase {
	/**
	 * @var \Closure
	 */
	public $emptyOnData;
	/**
	 * @var object[]|\Array_hx
	 */
	public $headers;
	/**
	 * @var \Closure
	 * This method is called upon a successful request, with `data` containing
	 * the result String.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onBytes = function(data) { // handle result }`
	 */
	public $onBytes;
	/**
	 * @var \Closure
	 * This method is called upon a successful request, with `data` containing
	 * the result String.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onData = function(data) { // handle result }`
	 */
	public $onData;
	/**
	 * @var \Closure
	 * This method is called upon a request error, with `msg` containing the
	 * error description.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onError = function(msg) { // handle error }`
	 */
	public $onError;
	/**
	 * @var \Closure
	 * This method is called upon a Http status change, with `status` being the
	 * new status.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onStatus = function(status) { // handle status }`
	 */
	public $onStatus;
	/**
	 * @var object[]|\Array_hx
	 */
	public $params;
	/**
	 * @var Bytes
	 */
	public $postBytes;
	/**
	 * @var string
	 */
	public $postData;
	/**
	 * @var string
	 */
	public $responseAsString;
	/**
	 * @var Bytes
	 */
	public $responseBytes;
	/**
	 * @var string
	 * The url of `this` request. It is used only by the `request()` method and
	 * can be changed in order to send the same request to different target
	 * Urls.
	 */
	public $url;

	/**
	 * Creates a new Http instance with `url` as parameter.
	 * This does not do a request until `request()` is called.
	 * If `url` is null, the field url must be set to a value before making the
	 * call to `request()`, or the result is unspecified.
	 * (Php) Https (SSL) connections are allowed only if the OpenSSL extension
	 * is enabled.
	 * 
	 * @param string $url
	 * 
	 * @return void
	 */
	public function __construct ($url) {
		if ($this->onData === null) $this->onData = new HxClosure($this, '__hx__default__onData');
		if ($this->onBytes === null) $this->onBytes = new HxClosure($this, '__hx__default__onBytes');
		if ($this->onError === null) $this->onError = new HxClosure($this, '__hx__default__onError');
		if ($this->onStatus === null) $this->onStatus = new HxClosure($this, '__hx__default__onStatus');
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:72: characters 3-17
		$this->url = $url;
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:73: characters 3-15
		$this->headers = new \Array_hx();
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:74: characters 3-14
		$this->params = new \Array_hx();
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:75: characters 3-23
		$this->emptyOnData = $this->onData;
	}

	/**
	 * @return string
	 */
	public function get_responseData () {
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:242: lines 242-248
		if (($this->responseAsString === null) && ($this->responseBytes !== null)) {
			#/usr/share/haxe/std/haxe/http/HttpBase.hx:246: characters 23-77
			$_this = $this->responseBytes;
			$len = $this->responseBytes->length;
			$tmp = null;
			if (($len < 0) || ($len > $_this->length)) {
				throw Exception::thrown(Error::OutsideBounds());
			} else {
				$tmp = \substr($_this->b->s, 0, $len);
			}
			#/usr/share/haxe/std/haxe/http/HttpBase.hx:246: characters 4-77
			$this->responseAsString = $tmp;
		}
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:249: characters 3-26
		return $this->responseAsString;
	}

	/**
	 * Override this if extending `haxe.Http` with overriding `onData`
	 * 
	 * @return bool
	 */
	public function hasOnData () {
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:229: characters 3-54
		return !\Reflect::compareMethods($this->onData, $this->emptyOnData);
	}

	/**
	 * This method is called upon a successful request, with `data` containing
	 * the result String.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onBytes = function(data) { // handle result }`
	 * 
	 * @param Bytes $data
	 * 
	 * @return void
	 */
	public function onBytes ($data)
	{
		return call_user_func_array($this->onBytes, func_get_args());
	}
	public function __hx__default__onBytes ($data)
	{
	}

	/**
	 * This method is called upon a successful request, with `data` containing
	 * the result String.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onData = function(data) { // handle result }`
	 * 
	 * @param string $data
	 * 
	 * @return void
	 */
	public function onData ($data)
	{
		return call_user_func_array($this->onData, func_get_args());
	}
	public function __hx__default__onData ($data)
	{
	}

	/**
	 * This method is called upon a request error, with `msg` containing the
	 * error description.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onError = function(msg) { // handle error }`
	 * 
	 * @param string $msg
	 * 
	 * @return void
	 */
	public function onError ($msg)
	{
		return call_user_func_array($this->onError, func_get_args());
	}
	public function __hx__default__onError ($msg)
	{
	}

	/**
	 * This method is called upon a Http status change, with `status` being the
	 * new status.
	 * The intended usage is to bind it to a custom function:
	 * `httpInstance.onStatus = function(status) { // handle status }`
	 * 
	 * @param int $status
	 * 
	 * @return void
	 */
	public function onStatus ($status)
	{
		return call_user_func_array($this->onStatus, func_get_args());
	}
	public function __hx__default__onStatus ($status)
	{
	}

	/**
	 * Sets the header identified as `name` to value `value`.
	 * If `name` or `value` are null, the result is unspecified.
	 * This method provides a fluent interface.
	 * 
	 * @param string $name
	 * @param string $value
	 * 
	 * @return void
	 */
	public function setHeader ($name, $value) {
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:86: characters 13-17
		$_g = 0;
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:86: characters 17-31
		$_g1 = $this->headers->length;
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:86: lines 86-91
		while ($_g < $_g1) {
			#/usr/share/haxe/std/haxe/http/HttpBase.hx:86: characters 13-31
			$i = $_g++;
			#/usr/share/haxe/std/haxe/http/HttpBase.hx:87: lines 87-90
			if (($this->headers->arr[$i] ?? null)->name === $name) {
				#/usr/share/haxe/std/haxe/http/HttpBase.hx:88: characters 5-44
				$this->headers->offsetSet($i, new HxAnon([
					"name" => $name,
					"value" => $value,
				]));
				#/usr/share/haxe/std/haxe/http/HttpBase.hx:89: characters 5-11
				return;
			}
		}
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:92: characters 3-43
		$_this = $this->headers;
		$_this->arr[$_this->length++] = new HxAnon([
			"name" => $name,
			"value" => $value,
		]);
	}

	/**
	 * Sets the post data of `this` Http request to `data` string.
	 * There can only be one post data per request. Subsequent calls to
	 * this method or to `setPostBytes()` overwrite the previously set value.
	 * If `data` is null, the post data is considered to be absent.
	 * This method provides a fluent interface.
	 * 
	 * @param string $data
	 * 
	 * @return void
	 */
	public function setPostData ($data) {
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:143: characters 3-18
		$this->postData = $data;
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:144: characters 3-19
		$this->postBytes = null;
	}

	/**
	 * @param Bytes $data
	 * 
	 * @return void
	 */
	public function success ($data) {
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:233: characters 3-23
		$this->responseBytes = $data;
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:234: characters 3-26
		$this->responseAsString = null;
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:235: lines 235-237
		if ($this->hasOnData()) {
			#/usr/share/haxe/std/haxe/http/HttpBase.hx:236: characters 4-24
			$this->onData($this->get_responseData());
		}
		#/usr/share/haxe/std/haxe/http/HttpBase.hx:238: characters 3-25
		$this->onBytes($this->responseBytes);
	}
}

Boot::registerClass(HttpBase::class, 'haxe.http.HttpBase');
Boot::registerGetters('haxe\\http\\HttpBase', [
	'responseData' => true
]);
