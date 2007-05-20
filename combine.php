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
 *
 *    Some code is extracted from the CSS generator by Niels Leenheer.
 */


/*
 * Define the location of the css and the temporary directory.
 */

$tmp = "/tmp";
$css = getcwd() . DIRECTORY_SEPARATOR . "css";


/*
 * Create a list of files.
 */

$files = explode(',', $_REQUEST['files']);


/*
 * Used to determine the modification date.
 */

$lastmodified = 0;


/*
 * Check if the requested files exist.
 */

while (list(,$file) = each($files)) {
	
	$path = $css . DIRECTORY_SEPARATOR . $file;
	
	if (substr($path, -4) != '.css') {
		header ("HTTP/1.0 403 Forbidden");
		exit;	
	}
	
	if (!file_exists($path)) {
		header ("HTTP/1.0 404 Not Found");
		exit;
	}
	
	$lastmodified = max($lastmodified, filemtime($path));
}


/*
 * Calculte the Etag hash.
 */

$hash = $lastmodified . '-' . md5($_REQUEST['files']);


/*
 * Send the Etag hash and check if we need to send the data.
 */

header("Etag: \"" . $lastmodified . '-' . md5($_REQUEST['files']) . "\"");

if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && stripslashes($_SERVER['HTTP_IF_NONE_MATCH']) == '"' . $hash . '"') {
	
	
	/*
	 * Return visit and no modifications, so do not send anything
	 */
	
	header ("HTTP/1.0 304 Not Modified");
	header ('Content-Length: 0');
	
} else {
	
	
	/*
	 * Check if the webserver support compression.
	 */
	
	$gzip     = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip');
	$deflate  = strstr($_SERVER['HTTP_ACCEPT_ENCODING'], 'deflate');
	$encoding = $gzip ? 'gzip' : ($deflate ? 'deflate' : 'none');
	
	
	/*
	 * Check for buggy version of Internet Explorer.
	 */
	
	if (!strstr($_SERVER['HTTP_USER_AGENT'], 'Opera') && preg_match('/^Mozilla\/4\.0 \(compatible; MSIE ([0-9]\.[0-9])/i', $_SERVER['HTTP_USER_AGENT'], $matches)) {
		
		
		/*
		 * Check the browser version.
		 */
		
		$version = floatval($matches[1]);
		
		if ($version < 6) {
			$encoding = 'none';
		}
		
		if (($version == 6) && !strstr($_SERVER['HTTP_USER_AGENT'], 'EV1')) {
			$encoding = 'none';
		}
	}
	
	
	/*
	 * Try the cache and check if the combined files are already generated.
	 */
	
	$cachefile = $tmp . DIRECTORY_SEPARATOR . 'cache-' . $hash . '.' . ($encoding != 'none' ? '.' . $encoding : '');
	
	if (file_exists($cachefile)) {
		
		if ($fp = fopen($cachefile, 'rb')) {
			
			if ($encoding != 'none') {
				header ("Content-Encoding: " . $encoding);
			}
			
			header ("Content-Type: text/css");
			header ("Content-Length: " . filesize($cachefile));
			
			fpassthru($fp);
			fclose($fp);
			
			exit;
		}
	}
	
	
	/*
	 * Get the content of the file.
	 */
	
	$contents = '';
	reset($files);
	
	while (list(,$file) = each($files)) {
		
		
		/*
		 * Compress the CSS files.
		 */
		
		$path = $css   . DIRECTORY_SEPARATOR . $file;
		$raw  = "\n\n" . file_get_contents($path);
		
		$raw  = preg_replace("/\s+/",           " ",   $raw);
		$raw  = preg_replace("/\} /",           "}\n", $raw);
		$raw  = preg_replace("/ \{ /",          " {",  $raw);
		$raw  = preg_replace("/; \}/",          "}",   $raw);
		$raw  = preg_replace("/\/\*(.*?)\*\//", "",    $raw);
		
		$contents .= $raw;
	}
	
	
	/*
	 * Send the content type and check the encoding.
	 */
	
	header ("Content-Type: text/css");
	
	if (isset($encoding) && ($encoding != 'none')) {
		
		
		/*
		 * Return the compressed content.
		 */
		
		$contents = gzencode($contents, 9, $gzip ? FORCE_GZIP : FORCE_DEFLATE);
		
		header ("Content-Encoding: " . $encoding);
		header ('Content-Length: '   . strlen($contents));
		
		echo $contents;
	} else {
		
		
		/*
		 * Return the normal content.
		 */
		
		header ('Content-Length: ' . strlen($contents));
		echo $contents;
	}
	
	if ($fp = fopen($cachefile, 'wb')) {
		fwrite($fp, $contents);
		fclose($fp);
	}
}
?>