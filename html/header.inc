<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Irssi  &raquo; The client of the future  </title>
	<meta http-equiv="Content-Type" content="UTF-8" />

	<link rel="shortcut icon" href="/favicon.ico" />

	<link rel="stylesheet" href="/css/style.css" type="text/css" media="screen, projection" />
	<!--[if lte IE 6]>
		<link rel="stylesheet" type="text/css" href="/css/ie_hacks.css" />
	<![endif]-->	
	<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />

</head>

<body <?php if ($this->core->CurrentUserModule == "news") { print "id='home'"; } ?>>

<div id="access">
	<ul id="skip">
		<li><a href="#main-content">Skip to main content</a></li>
		<li><a href="#sub-content">Skip to secondary content (sidebar)</a></li>
	</ul>
	
	<div id="search-form">
		<form action="/index.php" method="get" id="search">
			<div>

				<label for="s">Search Nidahas</label>
				<input type="text" value="" name="s" id="s" size="40" />
				<input type="image" name="submit" id="submit_btn" src="/images/search-btn.png" alt="Search" title="Search" />
			</div>
		</form>
	</div><!-- /search -->
</div><!-- /access -->
	
<div id="header">
	<h1><a href="http://dev.irssi.org" title="Irssi: Home"><img src="/images/logo.png" alt="Irssi - the IRC client" /></a></h1>

</div>
<!-- /header -->

<div id="wrap">
<div id="wrapper">

<div id="navigation">

		<ul class="level1">
<?php include(GENDIR . "mainmenu.inc"); ?>
		</ul>

</div><!-- /navigation -->

<div id="content">
