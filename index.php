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
 * The global BASEDIR variable used to include and require files.
 */

define('BASEDIR', getcwd() . DIRECTORY_SEPARATOR);


/*
 * Define the location of some ControlPanel directories.
 */

define('MODULESDIR', BASEDIR . 'modules'   . DIRECTORY_SEPARATOR);
define('HTMLDIR',    BASEDIR . 'html'      . DIRECTORY_SEPARATOR);
define('GENDIR',     HTMLDIR . 'generator' . DIRECTORY_SEPARATOR);


/*
 * Load the Irssi Core module.
 */

require(MODULESDIR . 'core' . DIRECTORY_SEPARATOR . 'core.php');


/*
 * Create the Irssi Core constructor.
 */

$site =& new IrssiCore();
$site->load();
?>