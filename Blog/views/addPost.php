<!-- <form method="POST" action="/Blog-Framework/Blog/public/index.php/posts/add">
	Title : <input type="text" name="title" /><br />
	Content : <input type="text" name="content"/><br />
	<input type="submit" name="submitAddPost" />
</form>
 -->
<form class="form-horizontal"  method="POST" action="/Blog-Framework/Blog/public/index.php/posts/add">
<fieldset>

<!-- Form Name -->
<legend>ADD POST</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">Title :</label>
  <div class="controls">
    <input id="textinput" name="textinput" type="text" placeholder="Post title..." class="input-xlarge">
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="textarea">Content : </label>
  <div class="controls">                     
    <textarea id="textarea" name="textarea"></textarea>
  </div>
</div>

<!-- Appended Input-->
<div class="control-group">
  <label class="control-label" for="appendedtext">Add NEW tag :</label>
  <div class="controls">
    <div class="input-append">
      <input id="appendedtext" name="appendedtext" class="input-xlarge" placeholder="placeholder" type="text">
      <span class="add-on">+</span>
    </div>
  </div>
</div>

<!-- Button (Double) -->
<div class="control-group">
  <div class="controls">
  <a href="/Blog-Framework/Blog/public/index.php/login" class="btn btn-danger">Cancel</a>
  <a href="/Blog-Framework/Blog/public/index.php/login" class="btn btn-success">ADD POST</a>
  </div>
</div>

</fieldset>
</form>
