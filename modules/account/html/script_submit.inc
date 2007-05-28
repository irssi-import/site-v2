<h2>Upload your new script</h2>

<form id="form" method="post" action="/account/manage/ssubmit&amp;submit=yes" enctype="multipart/form-data">
	<fieldset>
		<legend>New script</legend>
		
		<div>
			<label <?php if ($field_error['descr']) { echo "class='error'"; } ?>>Irssi script name:</label>
				<input type="text" name="descr" value="<?php echo $_REQUEST['desc']; ?>" />
			<label <?php if ($field_error['file']) { echo "class='error'"; } ?>>Irssi script to upload:</label>
				<input type="file" name="file" size="20" />
			<input type="submit" class="submit" value="Upload" />
		</div>
	</fieldset>
</form>