<h2>Recover your password</h2>

<p>Please enter your username or e-mail address to recover your Irssi account password. Our system will generate a new password and mail it to your e-mail address.</p>

<form id="form" method="post" action="/account/recover&amp;submit=yes">
	<fieldset>
		<legend>Recover</legend>
		
		<div><img src="/images/security.jpg" alt="" /></div>
		<div>
			<label <?php if ($field_error['username']) { echo "class='error'"; } ?>>Username or E-Mail:</label>
				<input type="text" name="username" value="<?php echo $_REQUEST['username']; ?>" />
			<input type="submit" class="submit" value="Recover" />
		</div>
	</fieldset>
</form>