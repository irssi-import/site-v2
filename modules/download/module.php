<?php

## General information.
#
# File name:   module.php
# Last update: Thu Dec  8 16:03:13 2005
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
# Irssi Download module.
#
#    This module will display the Irssi download links.
##

Class IrssiDownload {

    ##
    # Variables to store instances of this module and other core classes.
    ##

    var $core;

    ##
    # Irssi Download constructor.
    ##

    function IrssiDownload (&$core) {
        $this->core =& $core;
    }

    function load () {

        require_once(BASEDIR . 'html/header.inc');

        if (file_exists(((isset($_REQUEST['action'])) ? BASEDIR . "modules/" . $this->core->CurrentUserModule . "/pages/${_REQUEST['action']}.page" : BASEDIR . "modules/" . $this->core->CurrentUserModule . "/pages/download.page"))) {
            require_once((isset($_REQUEST['action'])) ? BASEDIR . "modules/" . $this->core->CurrentUserModule . "/pages/${_REQUEST['action']}.page" : BASEDIR . "modules/" . $this->core->CurrentUserModule .  '/pages/download.page');
        } else {
            require_once(BASEDIR . "html/404.inc");
        }

        require_once(BASEDIR . 'html/footer.inc');
    }
}
?>
