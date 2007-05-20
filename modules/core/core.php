<?php

## General information.
#
# File name:   core.php
# Last update: Wed Dec  7 10:45:16 2005
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
# Start the page generation timer.
##

define ('PAGEGEN', microtime());

##
# Require other core class files.
##

require 'session.php';
require 'sql.php';

##
# Irssi Core module.
#
#    This module handles all centralized module actions, mostly module loading
#    and unloading. It also handles interaction between other core modules and
#    additional modules.
##

Class IrssiCore {

    ##
    # Variables to store instances of other core classes.
    ##

    var $Session, $SQL, $core, $Config;

    ##
    # Prohibited user modules which can't be loaded from the web.
    ##

    var $ProhibitedModules = array('core', '.svn');

    ##
    # Do not include these modules into the dynamic menubar.
    ##

    var $ProhibitedMenuBar = array('files');

    ##
    # Variables to store the user module and instance of the module currently
    # being used.
    ##

    var $CurrentUserModule, $CurrentUserModuleInstance;

    ##
    # Should the reuqested page display the standard header/footer or a custom one?
    ##

    var $DefaultHeader = 1;

    ##
    # Irssi Core constructor.
    ##

    function IrssiCore () {
        $this->Session =& new CoreSession($this);
        $this->SQL     =& new CoreSQL($this, @parse_ini_file(BASEDIR . 'config.ini'));
        $this->core    =& $this;
    }

    ##
    # Irssi Core load() function.
    #
    #    This function handles the interaction between modules and initializes
    #    modules when required.
    ##

    function load () {

        ##
        # Every Irssi module requires UTF-8 support.
        ##

        header('Content-type: text/html; charset=UTF-8');

        ##
        # Verify if the requested module is installed or not.
        ##

        if (empty($_REQUEST['module'])) {
            $this->CurrentUserModule = 'news';
        } elseif (!$this->ModuleExists($_REQUEST['module']) || $this->IsProhibited($_REQUEST['module'])) {


            header("HTTP/1.0 404 Not Found");

            require_once(BASEDIR . "html/header.inc");
            require_once(BASEDIR . "html/404.inc");
            require_once(BASEDIR . "html/footer.inc");

            exit;

        } else {
            $this->CurrentUserModule = $_REQUEST['module'];
        }

        $this->CurrentUserModuleInstance =& $this->LoadUserModule($this->CurrentUserModule);
        $this->CurrentUserModuleInstance->load();
    }

    ##
    # Irssi Core InitializeModule() function.
    #
    #    This function initalizes and returns the instance of the module.
    ##

    function & InitializeModule ($moduleStr) {

        require('modules/' . $moduleStr . '/module.php');

        $strName  =  "Irssi$moduleStr";
        $instance =& new $strName($this);

        return $instance;
    }

    ##
    # Irssi Core ModuleExists() function.
    #
    #    This function returns TRUE or FALSE, depending on the existance of the
    #    module.
    ##

    function ModuleExists ($moduleStr) {

        $directory = opendir(BASEDIR . 'modules');

        while (false !== ($file = readdir($directory))) {

            if (($file == $moduleStr) && !$this->IsProhibited($moduleStr)) {
                return 1;
            }
        }

        return 0;
    }

    ##
    # Irssi Core LoadUserModule() function.
    #
    #    This function will check if the module is valid and returns an instance of
    #    the module.
    ##

    function LoadUserModule ($moduleStr) {
        return $this->InitializeModule($moduleStr);
    }

    ##
    # Irssi Core IsProhibited() function.
    #
    #    This function will return TRUE or FALSE, depending on the existance of
    #    the module on the list of prohibited modules.
    ##

    function IsProhibited ($moduleStr) {
        return in_array($moduleStr, $this->ProhibitedModules);
    }

    ##
    # Irssi Core GetCurrentUserModule() function.
    #
    #    This will return the instance of the module currently being used.
    ##

    function GetCurrentUserModule () {
        return $this->CurrentUserModule;
    }

    ##
    # Irssi Core GetModuleAction() function.
    #
    #    This will return the action of the currently used module. If no action is
    #    specified, a default action will be returned.
    ##

    function GetModuleAction () {

        if (isset ($_REQUEST['action'])) {
            return $_REQUEST['action'];
        } else {
            return 'default';
        }
    }

    ##
    # Irssi Core GetAllModules() function.
    #
    #    This functions will return an array of all the available modules as strings.
    #    It would be nice to change this so it returns objects instead.
    ##

    function GetAllModules () {

        $dp      = opendir(BASEDIR . 'modules/');
        $reArray = array();

        while ($file = readdir($dp)) {

            if (($file != '.') && ($file != '..') && !$this->IsProhibited($file) && is_dir(BASEDIR . 'modules/' . $file)) {
                $reArray[] = $file;
            }
        }

        closedir($dp);
        return $reArray;
    }

    ##
    # Irssi Core GetModuleInformation() function.
    #
    #    This function will return an array containing the core information
    #    of the requested module.
    ##

    function GetModuleInformation ($moduleStr) {

        if (file_exists(BASEDIR . 'modules/' . $moduleStr . '/info.ini')) {
            return @parse_ini_file(BASEDIR . 'modules/' . $moduleStr . '/info.ini');
        }
    }

    ##
    # Irssi Core SendMail() function.
    #
    #    This function will send an email.
    ##

    function SendMail ($to, $subject, $message) {
        mail($to, $subject, $message, "From: The Irssi Project<no-reply@irssi.org>\nReturn-path: no-reply@irssi.org");
    }

    ##
    # Irssi Core IsAdmin() functions.
    #
    #   This function will return true or false.
    ##

    function IsAdmin ($username) {
        return $this->core->SQL->Handler->getOne(ISADMIN, array($username));
    }

    ##
    # Irssi Core update_counter() function.
    #
    #   This function will update the download counter.
    ##

    function update_counter ($file) {

        if (!$this->SQL->Handler->getOne(ISDOWNLOADED, array($file))) {
            $this->SQL->Handler->execute($this->core->SQL->Handler->prepare(FIRSTDOWNLOAD), array($file));
        } else {
            $this->SQL->Handler->execute($this->core->SQL->Handler->prepare(UPDATECOUNTER), array($file));
        }
    }
}
?>
