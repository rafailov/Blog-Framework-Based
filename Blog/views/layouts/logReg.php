<style type="text/css">
	body
	{
	    background-color:rgba(204, 204, 204, 0.48);
	    margin: 0;
	    min-width: 1300px;
	}
</style>

<body>

	<div style="display: inline-block;width: 49%;">
		<?= $this->getLayoutData('register')?>
	</div>
	<div style="display: inline-block;width: 49%;">
		<?= $this->getLayoutData('login')?>
	</div>
	<?php
	if ($this->errorMessage) {
		echo "<script type=\"text/javascript\">"; 
		echo "alert('".$this->errorMessage."');"; 
		echo "</script>";
	}?>