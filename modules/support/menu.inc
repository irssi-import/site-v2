</div>

<div id="sub-content">
	<ul id="sub-menu">
<?php

/*
 * Make sure we do not print the closing div!
 */

$sc=1;

$items = array(
    'mailinglists'   => 'Mailing Lists',
    'irc'            => 'IRC',
);

foreach ($items as $key => $value) {
	    
	if ($_REQUEST['action'] == $key) {
		$html = '<li id="sub-menuactive"><a id="sub-menucurrent" ';
	} else {
		$html = '<li><a ';
	}
	
	print $html . 'href="/support/' . $key . '" title="' . $value . '">' . $value . '</a></li>';
}

?>
	</ul>