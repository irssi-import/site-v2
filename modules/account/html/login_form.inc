<h2>Sign IN</h2>

<p>Please enter your username and password to access your Irssi account.</p>

<form id="form" method="post" action="/account/login&amp;submit=yes">
	<fieldset>
		<legend>Login</legend>
		
		<div><img src="/images/security.jpg" alt="" /></div>
		<div>
			<label <?php if ($field_error['username']) { echo "class='error'"; } ?>>Username:</label>
				<input type="text" name="username" value="" />
			<label <?php if ($field_error['password']) { echo "class='error'"; } ?>>Password:</label>
				<input type="password" name="password" />
			<input type="submit" class="submit" value="Sign IN" />
		</div>
	</fieldset>
</form>