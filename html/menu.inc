</div>

<div id="sub-content">
	<ul id="sub-menu">
<?php

/*
 * Make sure we do not print the closing div!
 */

$sc=1;

/*
 * Print the sub-menu.
 */

foreach ($items as $key => $value) {
	
	if ($_REQUEST['action'] == $key) {
		$html = '<li id="sub-menuactive"><a id="sub-menucurrent" ';
	} else {
		$html = '<li><a ';
	}
	
	print $html . "href='/" . $this->core->CurrentUserModule . "/" . $key . "' title='" . $value . "'>" . $value . "</a></li>\n";
}

?>
	</ul>