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
 * Irssi Core SQL module.
 *
 *    This module handles all the MySQL items using Pear::DB. If you don't have the
 *    required file use the folowing command (as root) to install the libarary:
 *
 *        # apt-get install php5-mysql php-db
 */

require_once 'DB.php';


Class CoreSQL {
	
	
	/*
	 * Variables to store instances of this class and other UDS classes.
	 */
	
	var $core, $Handler;
	
	
	/*
	 * Irssi Core SQL constructor.
	 */
	
	function CoreSQL (&$core, $config) {
		$this->core =& $core;
		$this->Connect($config);
	}
	
	
	/*
	 * Irssi Core SQL Connect() function.
	 *
	 *    This function will connect to the database.
	 *
	 *    By default the MySQL database is used, we can easily integrate
	 *    support for other types of databases like PostgreSQL or Oracle.
	 */
	
	function Connect (&$config) {
		
		
		/*
		 * Create the Irssi dsn data.
		 */
		
		$dsn = array (
		    'phptype'  => "mysql",
		    'protocol' => "tcp",
		    'username' => $config['username'],
	            'password' => $config['password'],
		    'database' => $config['database'],
	            'hostspec' => $config['hostname'] . ':' . $config['port'],
		);
		
		
		/*
		 * Connect to the database and load the queries.
		 */
		
		$this->Handler =& DB::connect($dsn);
		$this->LoadQueries();
		
		
		/*
		 * Save the configuration for later usage.
		 */
		
		$this->core->Config = $config;
	}
	
	
	/*
	 * Irssi Core SQL IsError() function.
	 *
	 *    This function will check if the SQL query was executed or not.
	 */
	
	function IsError (&$res) {
		
		if (DB::isError($res)) {
			return $res;
		}
		
		return 0;
	}
	
	
	/*
	 * Irssi Core SQL LoadQueries() function.
	 *
	 *    This function will load all the SQL queries.
	 *
	 *    We can easily create SQL statement files per module, but I don't see any reason for it at this
	 *    point.
	 */
	
	function LoadQueries () {
		
		$defFile = SQLDIR . 'queries.inc';
		
		if (!file_exists($defFile)) {
			return 0;
		}
		
		require ($defFile);
		return  1;
	}
}
?>