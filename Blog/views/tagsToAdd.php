 <style type="text/css">
 li.tagToAdd:hover{
 	 list-style-image: url("../../views/leftArrow.png");
 	 cursor: pointer;
 	 text-decoration: underline;
 }
 li{
 	 list-style: none;

 }
 </style>
  <h2>CHOOSE TAGS</h2>
  <ul>
  	<?php
  		foreach ($this->tagsToAdd as $key => $value) {
  			echo "<li class='tagToAdd'>".$value['tag']."</li>";
  		}
  	?>
  </ul>