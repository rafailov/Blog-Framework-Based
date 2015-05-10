<style type="text/css">
 li.tagToAdd:hover{
     cursor: pointer;
     text-decoration: underline;
 }
 li.selected, li.tagToAdd:hover, li.brevisionTag{
     list-style-image: url("http://localhost:3210/Blog-Framework/Blog/views/leftArrow.png");

 }
 li{
     list-style: none;
 }
 </style>
  <h3>CHOOSE TAGS</h3>

  <input type="hidden" name="filteredTags" 
    <?php if ($_POST['tags']) {
      echo 'value="'.$_POST['tags'].'"';
    }?> 
  />

  <ul>
  	<?php
            echo "<pre>".print_r($_POST,true)."</pre>";
  	
  		foreach ($this->tagsToAdd as $key => $value) {
  			echo "<li class='tagToAdd' >".$value['tag']."</li>";
  		}
  	?>
  </ul>