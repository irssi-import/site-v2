					<?php if (!$sc) { print '</div>'; } ?>
<?php

/*
 * Include the download and commercial box
 * on all pages except the news page.
 */

if ($this->core->CurrentUserModule != "news") {
	require(HTMLDIR . "sub-content.inc");
}
?>
				</div>
				
				<div id="footer">
					<h3 class="hide">Copyright notice and other geek stuff</h3>
					<ul>
						<li>Copyright &copy; 1999-<?php echo date("Y"); ?> &raquo; The Irssi Project.</li>
					</ul>
				</div>
			</div>
		</div>
		<script src="http://www.google-analytics.com/urchin.js" type="text/javascript" />
		<script type="text/javascript">
			_uacct = "UA-1191860-1";
			urchinTracker();
		</script>
	</body>
</html>