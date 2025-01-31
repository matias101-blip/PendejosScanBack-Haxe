<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace haxe;

use \php\Boot;

class MainLoop {
	/**
	 * @var MainEvent
	 */
	static public $pending;

	/**
	 * Add a pending event to be run into the main loop.
	 * 
	 * @param \Closure $f
	 * @param int $priority
	 * 
	 * @return MainEvent
	 */
	public static function add ($f, $priority = 0) {
		#/usr/share/haxe/std/haxe/MainLoop.hx:92: lines 92-102
		if ($priority === null) {
			$priority = 0;
		}
		#/usr/share/haxe/std/haxe/MainLoop.hx:93: lines 93-94
		if ($f === null) {
			#/usr/share/haxe/std/haxe/MainLoop.hx:94: characters 4-9
			throw Exception::thrown("Event function is null");
		}
		#/usr/share/haxe/std/haxe/MainLoop.hx:95: characters 3-38
		$e = new MainEvent($f, $priority);
		#/usr/share/haxe/std/haxe/MainLoop.hx:96: characters 3-22
		$head = MainLoop::$pending;
		#/usr/share/haxe/std/haxe/MainLoop.hx:97: lines 97-98
		if ($head !== null) {
			#/usr/share/haxe/std/haxe/MainLoop.hx:98: characters 4-17
			$head->prev = $e;
		}
		#/usr/share/haxe/std/haxe/MainLoop.hx:99: characters 3-16
		$e->next = $head;
		#/usr/share/haxe/std/haxe/MainLoop.hx:100: characters 3-14
		MainLoop::$pending = $e;
		#/usr/share/haxe/std/haxe/MainLoop.hx:101: characters 3-11
		return $e;
	}

	/**
	 * @return bool
	 */
	public static function hasEvents () {
		#/usr/share/haxe/std/haxe/MainLoop.hx:72: characters 3-19
		$p = MainLoop::$pending;
		#/usr/share/haxe/std/haxe/MainLoop.hx:73: lines 73-77
		while ($p !== null) {
			#/usr/share/haxe/std/haxe/MainLoop.hx:74: lines 74-75
			if ($p->isBlocking) {
				#/usr/share/haxe/std/haxe/MainLoop.hx:75: characters 5-16
				return true;
			}
			#/usr/share/haxe/std/haxe/MainLoop.hx:76: characters 4-14
			$p = $p->next;
		}
		#/usr/share/haxe/std/haxe/MainLoop.hx:78: characters 3-15
		return false;
	}

	/**
	 * @return void
	 */
	public static function sortEvents () {
		#/usr/share/haxe/std/haxe/MainLoop.hx:108: characters 3-22
		$list = MainLoop::$pending;
		#/usr/share/haxe/std/haxe/MainLoop.hx:110: lines 110-111
		if ($list === null) {
			#/usr/share/haxe/std/haxe/MainLoop.hx:111: characters 4-10
			return;
		}
		#/usr/share/haxe/std/haxe/MainLoop.hx:113: characters 3-49
		$insize = 1;
		$nmerges = null;
		$psize = 0;
		$qsize = 0;
		#/usr/share/haxe/std/haxe/MainLoop.hx:114: characters 3-31
		$p = null;
		$q = null;
		$e = null;
		$tail = null;
		#/usr/share/haxe/std/haxe/MainLoop.hx:116: lines 116-161
		while (true) {
			#/usr/share/haxe/std/haxe/MainLoop.hx:117: characters 4-12
			$p = $list;
			#/usr/share/haxe/std/haxe/MainLoop.hx:118: characters 4-15
			$list = null;
			#/usr/share/haxe/std/haxe/MainLoop.hx:119: characters 4-15
			$tail = null;
			#/usr/share/haxe/std/haxe/MainLoop.hx:120: characters 4-15
			$nmerges = 0;
			#/usr/share/haxe/std/haxe/MainLoop.hx:121: lines 121-156
			while ($p !== null) {
				#/usr/share/haxe/std/haxe/MainLoop.hx:122: characters 5-14
				++$nmerges;
				#/usr/share/haxe/std/haxe/MainLoop.hx:123: characters 5-10
				$q = $p;
				#/usr/share/haxe/std/haxe/MainLoop.hx:124: characters 5-14
				$psize = 0;
				#/usr/share/haxe/std/haxe/MainLoop.hx:125: characters 15-19
				$_g = 0;
				#/usr/share/haxe/std/haxe/MainLoop.hx:125: characters 19-25
				$_g1 = $insize;
				#/usr/share/haxe/std/haxe/MainLoop.hx:125: lines 125-130
				while ($_g < $_g1) {
					#/usr/share/haxe/std/haxe/MainLoop.hx:125: characters 15-25
					$i = $_g++;
					#/usr/share/haxe/std/haxe/MainLoop.hx:126: characters 6-13
					++$psize;
					#/usr/share/haxe/std/haxe/MainLoop.hx:127: characters 6-16
					$q = $q->next;
					#/usr/share/haxe/std/haxe/MainLoop.hx:128: lines 128-129
					if ($q === null) {
						#/usr/share/haxe/std/haxe/MainLoop.hx:129: characters 7-12
						break;
					}
				}
				#/usr/share/haxe/std/haxe/MainLoop.hx:131: characters 5-19
				$qsize = $insize;
				#/usr/share/haxe/std/haxe/MainLoop.hx:132: lines 132-154
				while (($psize > 0) || (($qsize > 0) && ($q !== null))) {
					#/usr/share/haxe/std/haxe/MainLoop.hx:133: lines 133-147
					if ($psize === 0) {
						#/usr/share/haxe/std/haxe/MainLoop.hx:134: characters 7-12
						$e = $q;
						#/usr/share/haxe/std/haxe/MainLoop.hx:135: characters 7-17
						$q = $q->next;
						#/usr/share/haxe/std/haxe/MainLoop.hx:136: characters 7-14
						--$qsize;
					} else if (($qsize === 0) || ($q === null) || (($p->priority > $q->priority) || (($p->priority === $q->priority) && ($p->nextRun <= $q->nextRun)))) {
						#/usr/share/haxe/std/haxe/MainLoop.hx:140: characters 7-12
						$e = $p;
						#/usr/share/haxe/std/haxe/MainLoop.hx:141: characters 7-17
						$p = $p->next;
						#/usr/share/haxe/std/haxe/MainLoop.hx:142: characters 7-14
						--$psize;
					} else {
						#/usr/share/haxe/std/haxe/MainLoop.hx:144: characters 7-12
						$e = $q;
						#/usr/share/haxe/std/haxe/MainLoop.hx:145: characters 7-17
						$q = $q->next;
						#/usr/share/haxe/std/haxe/MainLoop.hx:146: characters 7-14
						--$qsize;
					}
					#/usr/share/haxe/std/haxe/MainLoop.hx:148: lines 148-151
					if ($tail !== null) {
						#/usr/share/haxe/std/haxe/MainLoop.hx:149: characters 7-20
						$tail->next = $e;
					} else {
						#/usr/share/haxe/std/haxe/MainLoop.hx:151: characters 7-15
						$list = $e;
					}
					#/usr/share/haxe/std/haxe/MainLoop.hx:152: characters 6-19
					$e->prev = $tail;
					#/usr/share/haxe/std/haxe/MainLoop.hx:153: characters 6-14
					$tail = $e;
				}
				#/usr/share/haxe/std/haxe/MainLoop.hx:155: characters 5-10
				$p = $q;
			}
			#/usr/share/haxe/std/haxe/MainLoop.hx:157: characters 4-20
			$tail->next = null;
			#/usr/share/haxe/std/haxe/MainLoop.hx:158: lines 158-159
			if ($nmerges <= 1) {
				#/usr/share/haxe/std/haxe/MainLoop.hx:159: characters 5-10
				break;
			}
			#/usr/share/haxe/std/haxe/MainLoop.hx:160: characters 4-15
			$insize *= 2;
		}
		#/usr/share/haxe/std/haxe/MainLoop.hx:162: characters 3-19
		$list->prev = null;
		#/usr/share/haxe/std/haxe/MainLoop.hx:163: characters 3-17
		MainLoop::$pending = $list;
	}

	/**
	 * Run the pending events. Return the time for next event.
	 * 
	 * @return float
	 */
	public static function tick () {
		#/usr/share/haxe/std/haxe/MainLoop.hx:170: characters 3-15
		MainLoop::sortEvents();
		#/usr/share/haxe/std/haxe/MainLoop.hx:171: characters 3-19
		$e = MainLoop::$pending;
		#/usr/share/haxe/std/haxe/MainLoop.hx:172: characters 3-32
		$now = \microtime(true);
		#/usr/share/haxe/std/haxe/MainLoop.hx:173: characters 3-18
		$wait = 1e9;
		#/usr/share/haxe/std/haxe/MainLoop.hx:174: lines 174-183
		while ($e !== null) {
			#/usr/share/haxe/std/haxe/MainLoop.hx:175: characters 4-22
			$next = $e->next;
			#/usr/share/haxe/std/haxe/MainLoop.hx:176: characters 4-29
			$wt = $e->nextRun - $now;
			#/usr/share/haxe/std/haxe/MainLoop.hx:177: lines 177-181
			if ($wt <= 0) {
				#/usr/share/haxe/std/haxe/MainLoop.hx:178: characters 5-13
				$wait = 0;
				#/usr/share/haxe/std/haxe/MainLoop.hx:179: characters 5-13
				if ($e->f !== null) {
					($e->f)();
				}
			} else if ($wait > $wt) {
				#/usr/share/haxe/std/haxe/MainLoop.hx:181: characters 5-14
				$wait = $wt;
			}
			#/usr/share/haxe/std/haxe/MainLoop.hx:182: characters 4-12
			$e = $next;
		}
		#/usr/share/haxe/std/haxe/MainLoop.hx:184: characters 3-14
		return $wait;
	}
}

Boot::registerClass(MainLoop::class, 'haxe.MainLoop');
