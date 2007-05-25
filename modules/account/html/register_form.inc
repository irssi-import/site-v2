<h2>Register an account</h2>

<p>Please enter your username, password and e-mail address to register your Irssi account.</p>

<form id="form" method="post" action="/account/register&amp;submit=yes">
	<fieldset>
		<legend>Login</legend>
		
		<div><img src="/images/security.jpg" alt="" /></div>
		<div>
			<label <?php if ($field_error['username']) { echo "class='error'"; } ?>>Username:</label>
				<input type="text" name="username" value="<?php echo $_REQUEST['username']; ?>" />
			<label <?php if ($field_error['password']) { echo "class='error'"; } ?>>Password:</label>
				<input type="password" name="password" />
			<label <?php if ($field_error['email']) { echo "class='error'"; } ?>>E-Mail:</label>
				<input type="text" name="email" value="<?php echo $_REQUEST['email']; ?>" />
			<input type="submit" class="submit" value="Register" />
		</div>
	</fieldset>
</form>