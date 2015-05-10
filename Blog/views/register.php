<div id="registerForm">
	<h1>User Registration</h1>
	<hr>
	<form method="post" action="/Blog-Framework/Blog/index.php/users/register">
		<div class="form-group">
			<label for="usernameReg" class="col-lg-4 control-label">Username:</label>
			<input type="text" name="username" id="usernameReg" class="control-label" placeholder="Username" required="required"
			<?php
			 if ($this->previousUsernameReg) {
				echo "value='".htmlentities($this->previousUsernameReg)."'";
			}?>
			/>
		</div>
		<div class="form-group">
			<label for="passwordReg" class="col-lg-4 control-label">Password:</label>
			<input type="password" name="password" id="passwordReg" class="control-label" placeholder="Password" required="required" />
		</div>
		<div class="form-group">
			<label for="confirmPasswordReg" class="col-lg-4 control-label">Confirm Password:</label>
			<input type="password" name="confirmPassword" id="confirmPasswordReg" class="control-label" placeholder="Confirm password" required="required"/>
		</div>

		<div class="form-group">
			<label for="emailReg" class="col-lg-4 control-label">Email:</label>
			<input type="email" name="email" id="emailReg" class="control-label" placeholder="Email" required="required"
			<?php if ($this->previousEmail) {
				echo "value='".htmlentities($this->previousEmail)."'";
			}?>
			/>
		</div>
		<div class="form-group">
			<span class="col-md-4"></span>
			<button type="submit" class="btn btn-lg btn-primary">Register</button>
		</div>
	</form>
	<?php

?>
</div>
