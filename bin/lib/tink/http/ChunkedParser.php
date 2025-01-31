<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace tink\http;

use \php\_Boot\HxAnon;
use \tink\chunk\_Seekable\Seekable_Impl_;
use \tink\io\StreamParserObject;
use \php\Boot;
use \haxe\io\_BytesData\Container as _BytesDataContainer;
use \tink\core\TypedError;
use \tink\core\Outcome;
use \tink\io\ParseStep;
use \haxe\io\Bytes;
use \tink\_Chunk\Chunk_Impl_;
use \tink\chunk\ChunkCursor;

class ChunkedParser implements StreamParserObject {
	/**
	 * @var int[]|\Array_hx
	 */
	static public $LINEBREAK;

	/**
	 * @var int
	 */
	public $chunkSize;
	/**
	 * @var int
	 */
	public $lastChunkSize;
	/**
	 * @var int
	 */
	public $remaining;

	/**
	 * @param int $a
	 * @param int $b
	 * 
	 * @return int
	 */
	public static function min ($a, $b) {
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:103: characters 10-23
		if ($a > $b) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:103: characters 18-19
			return $b;
		} else {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:103: characters 22-23
			return $a;
		}
	}

	/**
	 * @return void
	 */
	public function __construct () {
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:59: characters 26-28
		$this->lastChunkSize = -1;
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:64: characters 3-10
		$this->reset();
	}

	/**
	 * @param ChunkCursor $rest
	 * 
	 * @return Outcome
	 */
	public function eof ($rest) {
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:99: characters 10-118
		if (($this->chunkSize === -1) && ($this->lastChunkSize === 0)) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:99: characters 50-70
			return Outcome::Success(Chunk_Impl_::$EMPTY);
		} else {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:99: characters 73-118
			return Outcome::Failure(new TypedError(null, "Unexpected end of input", new HxAnon([
				"fileName" => "tink/http/Chunked.hx",
				"lineNumber" => 99,
				"className" => "tink.http.ChunkedParser",
				"methodName" => "eof",
			])));
		}
	}

	/**
	 * @param ChunkCursor $cursor
	 * 
	 * @return ParseStep
	 */
	public function progress ($cursor) {
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:74: lines 74-95
		if ($this->chunkSize < 0) {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:75: characters 12-34
			$_g = $cursor->seek(ChunkedParser::$LINEBREAK);
			$__hx__switch = ($_g->index);
			if ($__hx__switch === 0) {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:76: characters 16-17
				$v = $_g->params[0];
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:76: characters 20-64
				$this->remaining = $this->chunkSize = \Std::parseInt("0x" . ((($v === null ? "null" : $v->toString()))??'null'));
			} else if ($__hx__switch === 1) {
			}
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:79: characters 5-15
			return ParseStep::Progressed();
		} else {
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:81: characters 20-49
			$a = $cursor->length;
			$b = $this->remaining;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:81: characters 5-50
			$length = ($a > $b ? $b : $a);
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:82: characters 5-39
			$data = $cursor->sweep($length);
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:83: characters 5-24
			$this->remaining -= $length;
			#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:84: lines 84-94
			if ($this->remaining === 0) {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:85: lines 85-91
				if (($cursor->currentByte === 13) && $cursor->next() && ($cursor->currentByte === 10)) {
					#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:86: characters 7-20
					$cursor->next();
					#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:87: characters 7-14
					$this->reset();
					#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:88: characters 7-17
					return ParseStep::Done($data);
				} else {
					#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:90: characters 7-65
					return ParseStep::Failed(new TypedError(null, "Invalid encoding, expected line break", new HxAnon([
						"fileName" => "tink/http/Chunked.hx",
						"lineNumber" => 90,
						"className" => "tink.http.ChunkedParser",
						"methodName" => "progress",
					])));
				}
			} else {
				#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:93: characters 6-16
				return ParseStep::Done($data);
			}
		}
	}

	/**
	 * @return void
	 */
	public function reset () {
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:68: characters 3-28
		$this->lastChunkSize = $this->chunkSize;
		#/home/thehunter101/.haxe/tink_http/0,10,0/src/tink/http/Chunked.hx:69: characters 3-17
		$this->chunkSize = -1;
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


		$tmp = \strlen("\x0D\x0A");
		self::$LINEBREAK = Seekable_Impl_::ofBytes(new Bytes($tmp, new _BytesDataContainer("\x0D\x0A")));
	}
}

Boot::registerClass(ChunkedParser::class, 'tink.http.ChunkedParser');
ChunkedParser::__hx__init();
