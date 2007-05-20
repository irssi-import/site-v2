<?php

## General information.
#
# File name:   mainmenu.inc
# Last update: Wed Dec  7 10:29:23 2005
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
# Generated the XHTML for the mainmenu items.
##

$modNavigation    = array();
$sortedModuleList = array();

foreach ($this->core->GetAllModules() as $module) {

    $infoArray = $this->core->GetModuleInformation($module);

    ##
    # Do not include the module if it's a prohibited menubar-module.
    ##

    if (in_array($module, $this->core->ProhibitedMenuBar)) {
       continue;
    }

    ##
    # If the requested module does not include an info.ini file we must
    # insert the module into an empty spot.
    ##

    if (!@isset($infoArray['position'])) {

        $max = @max(array_keys($sortedModuleList));
        $pos = $max + 1;

        for ($i = 0; $i <= $max; ++$i) {
            if (!isset($sortedModuleList[$i])) {
                $pos = $i; break;
            }
        }

        $infoArray = array('position' => $pos);
    }

    if (isset($sortedModuleList[$infoArray['position']])) {

        $max = max(array_keys($sortedModuleList));

        for ($i = $max; $i >= $infoArray['position']; --$i) {

            if (isset($sortedModuleList[$i])) {
                $sortedModuleList[$i + 1] = $sortedModuleList[$i];
            } else {
                unset($sortedModuleList[$i + 1]);
            }
        }
    }

    $sortedModuleList[$infoArray['position']] = $module;
}

ksort($sortedModuleList);

##
# Show the ordered menubar.
##

while (list(, $module) = each($sortedModuleList)) {

    $class = ($module == $this->core->CurrentUserModule) ? 1 : 0;
    $item++;

    if ($class) {
	print "<li class='level1active'><a class='level1current' href='/". $module ."'>". $module ."</a></li>\n";
    } else {
	print "<li><a href='/". $module ."'>". $module ."</a></li>\n";

    }
}
?>
<li class='nav'><a href='/scripts' id='scripts'>scripts</a></li>
