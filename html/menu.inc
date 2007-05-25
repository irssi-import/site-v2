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
	
	if (is_array($value)) {
		$ovalue = $value;
		$value  = $value[0];
	} else {
		unset($ovalue);
	}
	
	if ($_REQUEST['action'] == $key) {
		$html = '<li id="sub-menuactive"><a id="sub-menucurrent" ';
	} else {
		$html = '<li><a ';
	}
	
	
	print $html . "href='/" . $this->core->CurrentUserModule . "/" . $key . "' title='" . $value . "'>" . $value . "</a></li>\n";
	
	if (is_array($ovalue)) {
		
		foreach ($ovalue[1] as $key2 => $value2) {
			
			if ($_REQUEST['third'] == $key2) {
				$html = 'sub-menusubcur';
			} else {
				$html = 'sub-menusub';
			}
			
			print "<li><a class='" . $html . "' href='/" . $this->core->CurrentUserModule . "/" . $key . "/" . $key2 . "' title='" . $value2 . "'>" . $value2 . "</a></li>\n";
		}
	}
}

?>
	</ul>