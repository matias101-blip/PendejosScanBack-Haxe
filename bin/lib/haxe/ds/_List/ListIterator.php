<?php
/**
 * Generated by Haxe 4.3.6
 */

namespace haxe\ds\_List;

use \php\Boot;

class ListIterator {
	/**
	 * @var ListNode
	 */
	public $head;

	/**
	 * @param ListNode $head
	 * 
	 * @return void
	 */
	public function __construct ($head) {
		#/usr/share/haxe/std/haxe/ds/List.hx:281: characters 3-19
		$this->head = $head;
	}

	/**
	 * @return bool
	 */
	public function hasNext () {
		#/usr/share/haxe/std/haxe/ds/List.hx:285: characters 3-22
		return $this->head !== null;
	}

	/**
	 * @return mixed
	 */
	public function next () {
		#/usr/share/haxe/std/haxe/ds/List.hx:289: characters 3-23
		$val = $this->head->item;
		#/usr/share/haxe/std/haxe/ds/List.hx:290: characters 3-19
		$this->head = $this->head->next;
		#/usr/share/haxe/std/haxe/ds/List.hx:291: characters 3-13
		return $val;
	}
}

Boot::registerClass(ListIterator::class, 'haxe.ds._List.ListIterator');
