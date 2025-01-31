<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace httpstatus\_HttpStatusCode;

use \tink\http\HeaderField;
use \php\Boot;
use \tink\http\IncomingResponse;
use \tink\io\_Source\Source_Impl_;
use \tink\http\ResponseHeaderBase;
use \httpstatus\_HttpStatusMessage\HttpStatusMessage_Impl_;
use \tink\http\_Response\OutgoingResponseData;

final class HttpStatusCode_Impl_ {

	/**
	 * @param int $code
	 * 
	 * @return int
	 */
	public static function fromErrorCode ($code) {
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:87: characters 3-20
		return $code;
	}

	/**
	 * @param IncomingResponse $res
	 * 
	 * @return int
	 */
	public static function fromIncomingResponse ($res) {
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:105: characters 3-31
		return $res->header->statusCode;
	}

	/**
	 * @param int $this
	 * 
	 * @return int
	 */
	public static function toInt ($this1) {
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:74: characters 3-14
		return $this1;
	}

	/**
	 * @param int $this
	 * 
	 * @return string
	 */
	public static function toMessage ($this1) {
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:70: characters 10-37
		return HttpStatusMessage_Impl_::fromCode($this1);
	}

	/**
	 * @param int $this
	 * 
	 * @return OutgoingResponseData
	 */
	public static function toOutgoingResponse ($this1) {
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:100: characters 51-62
		$this2 = HttpStatusMessage_Impl_::fromCode($this1);
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:100: characters 4-120
		$this3 = new ResponseHeaderBase($this1, $this2, \Array_hx::wrap([new HeaderField("content-length", "0")]), "HTTP/1.1");
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:99: lines 99-102
		return new OutgoingResponseData($this3, Source_Impl_::$EMPTY);
	}

	/**
	 * @param int $this
	 * 
	 * @return OutgoingResponseData
	 */
	public static function toWebResponse ($this1) {
		#/home/thehunter101/.haxe/http-status/1,3,1/src/httpstatus/HttpStatusCode.hx:93: characters 3-30
		return HttpStatusCode_Impl_::toOutgoingResponse($this1);
	}
}

Boot::registerClass(HttpStatusCode_Impl_::class, 'httpstatus._HttpStatusCode.HttpStatusCode_Impl_');
