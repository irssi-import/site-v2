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
 * Irssi Account module.
 *
 *    This module will display the Irssi account pages.
 */

Class IrssiAccount {
	
	
	/*
	 * Variables to store instances of this module and other core classes.
         */
	
	var $core, $menu_manage, $menu_normal, $menu_user;
	
	
	/*
         * Irssi Account constructor.
	 */
	
	function IrssiAccount (&$core) {
		$this->core =& $core;
	}
	
	
	/*
	 * Irssi Account load() function.
	 *
	 *    This function will load the Irssi documentation pages.
	 */
	
	function load () {
		
		
		/*
		 * The normal user menu.
		 */
		
		$this->menu_normal = array(
			'login'    => 'Sign IN',
			'register' => 'Register an account',
			'recover'  => 'Recover your password',
		);
		
		
		/*
		 * The registered user menu.
		 */
		
		$this->menu_user = array(
			'status'      => 'Account Overview',
			'manage'      => 'Manage your scripts &amp; themes',
			'preferences' => 'Preferences',
			'logout'      => 'Sign OUT',
		);
		
		
		/*
		 *  Check if the user is authenciated.
		 */
		
		if (!$this->core->Session->get("session", "username")) {
			
			
			/*
			 * Display the correct requested pages.
			 */
			
			if (empty($_REQUEST['action'])) {
				$_REQUEST['action'] = 'login';
			}
			
			if (file_exists(MODULESDIR . $this->core->CurrentUserModule . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "normal" . DIRECTORY_SEPARATOR . $_REQUEST['action'] . ".page")) {
				require_once(HTMLDIR . 'header.inc');
				require_once(MODULESDIR . $this->core->CurrentUserModule . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "normal" . DIRECTORY_SEPARATOR . $_REQUEST['action'] . ".page");
			} else {
				header("HTTP/1.0 404 Not Found");
				
				require_once(HTMLDIR . 'header.inc');
				require_once(HTMLDIR . '404.inc');
			}
			
			
			/*
			 * The items in the sub-menu.
			 */
			
			if (!isset($items)) {
				$items = $this->menu_normal;
			}
		} else {
			
			
			/*
			 * Display the correct requested pages.
			 */
			
			if (empty($_REQUEST['action'])) {
				$_REQUEST['action'] = 'status';
			}
			
			if (file_exists(MODULESDIR . $this->core->CurrentUserModule . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "user" . DIRECTORY_SEPARATOR . $_REQUEST['action'] . ".page")) {
				
				if (!is_dir(MODULESDIR . $this->core->CurrentUserModule . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "user" . DIRECTORY_SEPARATOR . $_REQUEST['action'])) {
					require_once(HTMLDIR . 'header.inc');
				}
				
				require_once(MODULESDIR . $this->core->CurrentUserModule . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "user" . DIRECTORY_SEPARATOR . $_REQUEST['action'] . ".page");
			} else {
				header("HTTP/1.0 404 Not Found");
				
				require_once(HTMLDIR . 'header.inc');
				require_once(HTMLDIR . '404.inc');
			}
			
			
			/*
			 * The items in the sub-menu.
			 */
			
			if (!isset($items)) {
				$items = $this->menu_user;
			}
		}
		
		
		/*
		 * Display the Irssi footer page.
		 */
		
		require_once(HTMLDIR . 'menu.inc');
		require_once(HTMLDIR . 'footer.inc');
	}
}
?>