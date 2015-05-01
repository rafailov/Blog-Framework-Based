<div id='loginForm'>
	<h1>Login</h1>
	<hr>
	<form >
		<div class="form-group">
			<label for="username" class="col-lg-2 control-label">Username</label>
			<input type="text" id="username" class="control-label" placeholder="Username" required="required"/>
		</div>
		<div class="form-group">
			<label for="password" class="col-lg-2 control-label">Password</label>
			<input type="password" id="password" class="control-label" placeholder="Password" required="required"/>
		</div>
		<div class="form-group">
			<span class="col-md-3"></span>
			<button class="col-md-3" type="submit">Login</button>
		</div>
	</form>
</div>
<?php
var_dump($this->posts);