<?php

## General information.
#
# File name:   sql.php
# Last update: Wed Dec  7 13:23:31 2005
#
##

## Bugreports and License disclaimer.
#
# For bugreports and other improvements contact The Irssi Project <staff@irssi.org>
#
#    This program is free software; you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation; either version 2 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this script; if not, write to the Free Software
#    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
##

##
# Irssi Core SQL module.
#
#    This module handles all the MySQL items using Pear::DB. If you don't have the
#    required file use the folowing command (as root) to install the libarary:
#
#        # pear install db
#
##

require_once 'DB.php';

Class CoreSQL {

    ##
    # Variables to store instances of this class and other UDS classes.
    ##

    var $core, $Handler;

    ##
    # Irssi Core SQL constructor.
    ##

    function CoreSQL ($config) {
        $this->core =& $core;
        #$this->Connect($config);
    }


    ##
    # Irssi Core SQL Connect() function.
    #
    #    This function will connect to the database.
    #
    #    By default the MySQL database is used, we can easily integrate
    #    support for other types of databases like PostgreSQL or Oracle.
    ##

    function Connect (&$config) {

        $dsn = array (
            'phptype'  => "mysql",
            'protocol' => "tcp",
            'username' => $config['username'],
            'password' => $config['password'],
            'database' => $config['database'],
            'hostspec' => $config['hostname'] . ':' . $config['port'],
        );

        ##
        # Note: I'm using the PEAR_ERROR_DIE statement which affects Pear::DB error handling.
        #       When new queries are added please check the query for every possible result and
        #       try to emulate every possible error. Some functions return '1' or an object upon
        #       errors. Do not blindly use if !$SQL->statement();
        ##

        $this->Handler =& DB::connect($dsn);
        PEAR::setErrorHandling(PEAR_ERROR_DIE);

        $this->LoadQueries();
    }


    ##
    # Irssi Core SQL IsError() function.
    #
    #    This function will check if the SQL query was executed or not.
    ##

    function IsError (&$res) {

        if (DB::isError($res)) {
            return $res;
        }

        return 0;
    }


    ##
    # Irssi Core SQL LoadQueries() function.
    #
    #    This function will load all the SQL queries.
    #
    #    We can easily create SQL statement files per module, but I don't see any reason for it at this
    #    point.
    ##

    function LoadQueries () {

        $defFile = BASEDIR . 'sql/queries.php';

        if (!file_exists($defFile)) {
            return 0;
        }

        require ($defFile);
        return  1;
    }
}
?>
