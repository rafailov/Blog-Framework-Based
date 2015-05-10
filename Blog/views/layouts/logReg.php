<style type="text/css">

</style>
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

