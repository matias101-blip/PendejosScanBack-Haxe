<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\http\clients;

use \php\_Boot\HxAnon;
use \tink\core\_Future\SyncFuture;
use \tink\io\RealSourceTools;
use \php\Boot;
use \tink\io\std\InputSource;
use \tink\http\IncomingResponse;
use \tink\io\_Source\Source_Impl_;
use \tink\core\TypedError;
use \sys\io\Process;
use \tink\streams\StreamObject;
use \tink\io\_Worker\Worker_Impl_;
use \tink\core\Outcome;
use \tink\http\ResponseHeaderBase;
use \tink\core\_Lazy\LazyConst;
use \php\_Boot\HxClosure;
use \tink\_Url\Url_Impl_;
use \tink\http\ClientObject;
use \tink\core\_Promise\Promise_Impl_;
use \tink\io\_Sink\SinkYielding_Impl_;
use \haxe\io\Bytes;
use \tink\http\OutgoingRequest;
use \tink\core\_Future\FutureObject;

class CurlClient implements ClientObject {
	/**
	 * @var \Closure
	 */
	public $curl;
	/**
	 * @var string[]|\Array_hx
	 */
	public $extraArgs;

	/**
	 * @param \Closure $curl
	 * @param string[]|\Array_hx $extraArgs
	 * 
	 * @return void
	 */
	public function __construct ($curl = null, $extraArgs = null) {
		if ($this->curl === null) $this->curl = new HxClosure($this, '__hx__default__curl');
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:17: characters 5-38
		if ($curl !== null) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:17: characters 22-38
			$this->curl = $curl;
		}
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:18: characters 5-31
		$this->extraArgs = $extraArgs;
	}

	/**
	 * @param string[]|\Array_hx $args
	 * @param StreamObject $body
	 * 
	 * @return StreamObject
	 */
	public function curl ($args, $body)
	{
		return call_user_func_array($this->curl, func_get_args());
	}
	public function __hx__default__curl ($args, $body)
	{
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:57: characters 7-33
		$args->arr[$args->length++] = "--data-binary";
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:58: characters 7-22
		$args->arr[$args->length++] = "@-";
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:73: characters 7-56
		$process = new Process("curl", $args);
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:74: characters 7-58
		$sink = SinkYielding_Impl_::ofOutput("stdin", $process->stdin);
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:75: characters 7-45
		Source_Impl_::pipeTo($body, $sink, new HxAnon(["end" => true]))->eager();
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:76: characters 21-39
		$_g = $process->exitCode();
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:76: lines 76-78
		if ($_g === null) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:78: characters 14-15
			$v = $_g;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:78: characters 30-65
			$tmp = $process->stderr->readAll()->toString();
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:78: characters 9-66
			return Source_Impl_::ofError(new TypedError($v, $tmp, new HxAnon([
				"fileName" => "tink/http/clients/CurlClient.hx",
				"lineNumber" => 78,
				"className" => "tink.http.clients.CurlClient",
				"methodName" => "curl",
			])));
		} else if ($_g === 0) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:77: characters 17-57
			$input = $process->stdout;
			$options = null;
			if ($options === null) {
				$options = new HxAnon();
			}
			$tmp = Worker_Impl_::ensure($options->worker);
			$_g1 = $options->chunkSize;
			$tmp1 = null;
			if ($_g1 === null) {
				$tmp1 = 65536;
			} else {
				$v = $_g1;
				$tmp1 = $v;
			}
			return new InputSource("stdout", $input, $tmp, Bytes::alloc($tmp1), 0);
		} else {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:78: characters 14-15
			$v = $_g;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:78: characters 30-65
			$tmp = $process->stderr->readAll()->toString();
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:78: characters 9-66
			return Source_Impl_::ofError(new TypedError($v, $tmp, new HxAnon([
				"fileName" => "tink/http/clients/CurlClient.hx",
				"lineNumber" => 78,
				"className" => "tink.http.clients.CurlClient",
				"methodName" => "curl",
			])));
		}
	}

	/**
	 * @param OutgoingRequest $req
	 * 
	 * @return FutureObject
	 */
	public function request ($req) {
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:22: characters 19-54
		$_g = Helpers::checkScheme($req->header->url);
		$__hx__switch = ($_g->index);
		if ($__hx__switch === 0) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:23: characters 17-18
			$e = $_g->params[0];
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:24: characters 9-26
			return new SyncFuture(new LazyConst(Outcome::Failure($e)));
		} else if ($__hx__switch === 1) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:26: lines 26-29
			$args = null;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:26: characters 29-38
			$_g = $this->extraArgs;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:27: lines 27-28
			if ($_g === null) {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:26: lines 26-29
				$args = new \Array_hx();
			} else {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:28: characters 16-17
				$v = $_g;
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:26: lines 26-29
				$args = (clone $v);
			}
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:31: characters 9-26
			$args->arr[$args->length++] = "-isS";
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:33: characters 9-24
			$args->arr[$args->length++] = "-X";
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:34: characters 9-37
			$args->arr[$args->length++] = $req->header->method;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:36: characters 16-35
			$__hx__switch = ($req->header->protocol);
			if ($__hx__switch === "HTTP/1.0") {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:37: characters 25-47
				$args->arr[$args->length++] = "--http1.0";
			} else if ($__hx__switch === "HTTP/1.1") {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:38: characters 25-47
				$args->arr[$args->length++] = "--http1.1";
			} else if ($__hx__switch === "HTTP/2") {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:39: characters 23-43
				$args->arr[$args->length++] = "--http2";
			} else {
			}
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:43: characters 23-33
			$_g_current = 0;
			$_g_array = $req->header->fields;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:43: lines 43-46
			while ($_g_current < $_g_array->length) {
				$header = ($_g_array->arr[$_g_current++] ?? null);
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:44: characters 11-26
				$args->arr[$args->length++] = "-H";
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:45: characters 11-55
				$args->arr[$args->length++] = "" . ($header->name??'null') . ": " . ($header->value??'null');
			}
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:48: characters 9-34
			$x = Url_Impl_::toString($req->header->url);
			$args->arr[$args->length++] = $x;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:49: lines 49-51
			return Promise_Impl_::next(RealSourceTools::parse($this->curl($args, $req->body), ResponseHeaderBase::parser()), function ($p) {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/clients/CurlClient.hx:51: characters 22-52
				return new SyncFuture(new LazyConst(Outcome::Success(new IncomingResponse($p->a, $p->b))));
			});
		}
	}
}

Boot::registerClass(CurlClient::class, 'tink.http.clients.CurlClient');
