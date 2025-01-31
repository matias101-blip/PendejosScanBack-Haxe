<?php
/**
 * Generated by Haxe 4.3.6
 */

use \php\Boot;

/**
 * The DateTools class contains some extra functionalities for handling `Date`
 * instances and timestamps.
 * In the context of Haxe dates, a timestamp is defined as the number of
 * milliseconds elapsed since 1st January 1970.
 */
class DateTools {
	/**
	 * Format the date `d` according to the format `f`. The format is
	 * compatible with the `strftime` standard format, except that there is no
	 * support in Flash and JS for day and months names (due to lack of proper
	 * internationalization API). On Haxe/Neko/Windows, some formats are not
	 * supported.
	 * ```haxe
	 * var t = DateTools.format(Date.now(), "%Y-%m-%d_%H:%M:%S");
	 * // 2016-07-08_14:44:05
	 * var t = DateTools.format(Date.now(), "%r");
	 * // 02:44:05 PM
	 * var t = DateTools.format(Date.now(), "%T");
	 * // 14:44:05
	 * var t = DateTools.format(Date.now(), "%F");
	 * // 2016-07-08
	 * ```
	 * 
	 * @param \Date $d
	 * @param string $f
	 * 
	 * @return string
	 */
	public static function format ($d, $f) {
		#/usr/share/haxe/std/DateTools.hx:148: characters 3-71
		return strftime($f, (int)($d->__t));
	}
}

Boot::registerClass(DateTools::class, 'DateTools');
