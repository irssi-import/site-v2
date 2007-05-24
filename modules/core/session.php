<?php

/*
 *  License disclaimer.
 *
 *	For bugreports and other improvements contact The Irssi Project <staff@irssi.org>
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 2 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this script; if not, write to the Free Software
 *	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


/*
 * Irssi Core Session module.
 *
 *    This module handles all the session items.
 */

Class CoreSession {
	
	
	/*
	 * Variables to store instances of this module and other core classes.
	 */
	
	var $core;
	
	
	/*
	 * Irssi Core Session constructor.
	 */
	
	function CoreSession (&$core) {
		$this->core =& $core;
		$this->start();
	}
	
	
	/*
	 * Irssi Core Session set() function.
	 *
	 *    This function will set a session variable into the 3-dimensional
	 *    array containing the module and the coresponding value of the setting.
	 */
	
	function set ($module, $name, $value) {
		
		if (!isset($_SESSION[$module]) || !is_array($_SESSION[$module])) {
			$_SESSION[$module] = array();
		}
		
		$_SESSION[$module][$name] = $value;
	}
	
	
	/*
         * Irssi Core Session get() function.
	 *
	 *    This function will return the value of the requested setting or return NULL
	 *    if it doesn't exist.
	 */
	
	function get ($module, $name = NULL) {
		
		if (!isset($name) && isset($_SESSION[$module])) {
			return $_SESSION[$module];
		} elseif (!isset($_SESSION[$module][$name])) {
			return NULL;
		} else {
			return $_SESSION[$module][$name];
		}
	}
	
	
	/*
	 * Irssi Core Session uset() function.
	 *
	 *    This function will unset a session variable or return NULL if it doesn't exist.
	 */
	
	function uset ($module, $name = NULL) {
		
		if (!isset($name) && isset($_SESSION[$module])) {
			unset($_SESSION[$module]);
			return;
		} elseif (!isset($_SESSION[$module][$name])) {
			return NULL;
		} else {
			unset($_SESSION[$module][$name]);
		}
	}
	
	
	/*
	 * Irssi Core Session start() function.
	 *
	 *    Start a PHP session which is needed for security reasons.
	 */
	
	function start () {
		session_start();
	}
}
?>