</div>

<div id="sub-content">
	<ul id="sub-menu">
<?php

/*
 * Make sure we do not print the closing div!
 */

$sc=1;

$items = array(
    'startup'   => 'Startup HOWTO',
    'faq'       => 'FAQ',
    'bugs'      => 'Writing good bug reports',
    'design'    => 'Design',
    'manual'    => 'Manual',
    'tips'      => 'Tips &#038; Tricks',
    'features'  => 'Irssi Features',
    'proxy'     => 'Irssi Proxy',
    'formats'   => 'Colour Formats',
    'variables' => 'Special Variables',
    'scripting' => 'Perl Scripting Reference',
    'signals'   => 'Signals'
);

foreach ($items as $key => $value) {
	    
	if ($_REQUEST['action'] == $key) {
		$html = '<li id="sub-menuactive"><a id="sub-menucurrent" ';
	} else {
		$html = '<li><a ';
	}
	
	print $html . 'href="/documentation/' . $key . '" title="' . $value . '">' . $value . '</a></li>';
}

?>
	</ul>