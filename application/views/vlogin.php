<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// view admin
?>
<div id="container">
	<!-- <h1>Welcome to CodeIgniter!</h1> -->
	<h2>Login</h2>
	</div>
	<?php echo form_open('login/dblogin');?>
	<label for="username">Username</label><input type="text" name="username" value="">
	<label for="userpass">Password</label><input type="textarea" name="userpass" value="">
	<label for="capt">Captcha</label><input type="textarea" name="capt" value="">
	<input type="submit" name="login" value="login">
