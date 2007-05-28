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
 * Irssi Account SQL queries.
 */

define("LOGIN_EXISTS",  "SELECT id FROM gn_passwd WHERE username = ?");
define("USER_PASSWORD", "SELECT password FROM gn_passwd WHERE username = ?");
define("UPDATE_LOGIN",  "UPDATE gn_passwd SET account_lastlogin = NOW(), account_lastip = ? WHERE username = ?");
define("EMAIL_EXISTS",  "SELECT id FROM gn_passwd WHERE email = ?");
define("INSERT_USER",   "INSERT INTO gn_passwd (username, password, email, account_created, account_modified, administrator) VALUES (?, ?, ?, NOW(), NOW(), 0)");
define("UM_EXISTS",     "SELECT email FROM gn_passwd WHERE email = ? OR username = ?");
define("UPDATE_PASS",   "UPDATE gn_passwd SET password = ? WHERE email = ?");
define("EMAIL_TO_USER", "SELECT username FROM gn_passwd WHERE email = ?");


/*
 * Irssi Manage Script SQL queries.
 */

define("FIND_LICENSE", "SELECT id FROM licenses WHERE license = ?");
define("ADD_LICENSE",  "INSERT INTO licenses (license) VALUES (?)");
define("GET_SCRIPT",   "SELECT id FROM scripts_archive WHERE name_file = ?");
define("ADD_SCRIPT",   "INSERT INTO scripts_archive (name_script, name_file, description, fk_license, date_added, download_counter, fk_passwd) VALUES (?, ?, ?, ?, NOW(), '0', ?)");
define("ADD_HISTORY",  "INSERT INTO scripts_history (fk_script, version, submit_date) VALUES (?, ?, NOW())");
define("CHECK_EXISTS", "SELECT id FROM scripts_archive WHERE name_file = ? OR name_script = ?");
?>