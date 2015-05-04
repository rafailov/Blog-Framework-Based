<style type="text/css">
    body
    {
        background-color:rgba(204, 204, 204, 0.48);
        margin: 0;
    }
    .addPostForm{
      min-width: 250px;
    }
    div.controls, div.input-append
    {
      display:inline;
      vertical-align: top;
    }
    div.control-group
    {
      margin:5px;
      margin-top:10px;
    }
    label{
      text-align: right;
      vertical-align: top;

      width: 100px;
    }
    #loginButton
    {
      margin-right: 100px;
      margin-left: 45px;
    }
    input, textarea{
      padding: 5px;
      border-radius: 2px;
      min-width: 286px;
      color:black;
    }
    input{
      height: 29px;
    }
    #appendedtag{
      min-width: 258px;
      border-top-right-radius: 0; 
      border-bottom-right-radius: 0; 
    }
    .add-on{
      padding: 6.5px 10px;
      margin-left: -4px;
      background: rgb(97, 117, 221);
      border-top-right-radius: 2px; 
      border-bottom-right-radius: 2px; 
      cursor: pointer;
    }
    .add-on:hover, .add-on:active{
      background: rgb(81, 94, 160);
    }
    .btn{
      margin-top: 16px;
      margin-left: 94px;
      padding: 10px 20px;

    }
    legend{
      margin:0 auto;
      color:white;
    }
  </style>
<form class="addPostForm" id="addPostForm"  method="POST" action="/Blog-Framework/Blog/index.php/posts/add">
<fieldset>

<!-- Form Name -->
<legend>ADD POST</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="textinput">Title :</label>
  <div class="controls">
    <input id="textinput" name="title" type="text" placeholder="Post title..." class="input-xlarge">
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="textarea">Content : </label>
  <div class="controls">                     
    <textarea id="textarea" name="content"></textarea>
  </div>
</div>

<!-- Appended Input-->
<div class="control-group">
  <label class="control-label" for="appendedtag">Add NEW tag :</label>
  <div class="controls">
    <div class="input-append">
      <input id="appendedtag" name="appendedtag" class="input-xlarge" placeholder="You can add new tag" type="text">
      <span class="add-on">+</span>
    </div>
  </div>
</div>

<!-- Button (Double) -->
<div class="control-group">
  <div class="controls">
  <a href="/Blog-Framework/Blog/index.php/posts" class="btn btn-danger">Cancel</a>
  <span class="btn btn-success">ADD POST</span>
  </div>
</div>

</fieldset>
</form>

