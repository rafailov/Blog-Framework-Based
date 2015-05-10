<div id='loginForm'>
	<h1>Login</h1>
	<hr>
	<form method="POST" action="/Blog-Framework/Blog/index.php/users/login">
		<div class="form-group">
			<label for="usernameLog" class="col-lg-2 control-label">Username</label>
			<input type="text" id="usernameLog" name="username" class="control-label" placeholder="Username" required="required"
			<?php
			 if ($this->previousUsernameLog) {
				echo "value='".htmlentities($this->previousUsernameLog)."'";
			}?>
			/>
		</div>
		<div class="form-group">
			<label for="passwordLog" class="col-lg-2 control-label">Password</label>
			<input type="password" id="passwordLog" name="password" class="control-label" placeholder="Password" required="required"/>
		</div>
		<div class="form-group">
			<span class="col-md-2"></span>
			<button type="submit" class="btn btn-lg btn-primary">Login</button>
		</div>
	</form>
	
</div>