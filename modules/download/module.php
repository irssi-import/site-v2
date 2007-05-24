<?php

/*
 *  License disclaimer.
 *
 *    For bugreports and other improvements contact The Irssi Project <staff@irssi.org>
 *
 *    This program is free software; you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation; either version 2 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this script; if not, write to the Free Software
 *    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


/*
 * Irssi Download module.
 *
 *    This module will display the download page of Irssi.
 */

Class IrssiDownload {
	
	
	/*
	 * Variables to store instances of this module and other core classes.
	 */
	
	var $core;
	
	
	/*
	 * Irssi Download constructor.
	 */
	
	function IrssiDownload (&$core) {
		$this->core =& $core;
	}
	
	
	/*
	 * Irssi Download load() function.
	 *
	 *    This function will load the Irssi about pages.
	 */
	
	function load () {
		require_once(HTMLDIR . 'header.inc');
		require_once(MODULESDIR . $this->core->CurrentUserModule . DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "download.page");
		require_once(HTMLDIR . 'footer.inc');
	}
}
?>