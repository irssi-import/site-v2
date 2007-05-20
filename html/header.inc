<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
	<head>
		<title>Irssi &raquo; The client of the future</title>
		<meta http-equiv="Content-Type" content="UTF-8" />
		
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="stylesheet" href="/combine/initial.css,irssi.css" type="text/css" media="screen, projection"/>
		<!--[if lte IE 6]>
			<link rel="stylesheet" type="text/css" href="/combine/ie_hacks.css" />
		<![endif]-->
		<link rel="stylesheet" href="/combine/print.css" type="text/css" media="print"/>
	</head>
	
	<body<?php if ($this->core->CurrentUserModule == "news") { print " id='home'"; } ?>>
	
		<div id="access">
			<ul id="skip">
				<li><a href="#main-content">Skip to main content</a></li>
				<li><a href="#sub-content">Skip to secondary content (sidebar)</a></li>
			</ul>

			<div id="search-form">
				<form action="#" method="get" id="search">
					<div>
						<label for="s">Search</label>
						<input type="text" value="" name="s" id="s" size="40" />
						<input type="image" name="submit" id="submit_btn" src="/images/search-btn.png" alt="Irssi &raquo; Search" title="Irssi &raquo; Search" />
					</div>
				</form>
			</div>
		</div>
		
		<div id="header">
			<h1><a href="/" title="Irssi &raquo; The client of the future"><img src="/images/logo.png" alt="Irssi &raquo; The client of the future" /></a></h1>
		</div>
		
		<div id="wrap">
			<div id="wrapper">
				
				<div id="navigation">
					<ul class="level1">
						<?php include(GENDIR . "mainmenu.inc"); ?>
					</ul>
				</div>
				
				<div id="content">
					<?php if ($this->core->CurrentUserModule == "news") { ?>
					<div id="description">
						<p id="heya">Irssi is a feature-rich, popular terminal based IRC client for UNIX systems which also supports SILC and ICB protocols via plugins. <span>|</span> <a href="/about">More about Irssi</a></p>
						<div id="download">
							<p class="intro">Download Irssi</p>
							<p class="version"><em><a href="/files/irssi-<?php echo $this->core->Config['latest']; ?>.tar.gz" class="release">Version <?php echo $this->core->Config['latest']; ?></a></em></p>
						</div>
					</div>
					<?php } ?>
					<div id="main-content">