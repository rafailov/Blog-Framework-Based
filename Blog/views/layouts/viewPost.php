<style type="text/css">
	body
	{
	    background-color:rgba(204, 204, 204, 0.48);
	    margin: 0;
	    min-width: 1300px;
	}
 </style>

<body>
	<div class="col-md-9">
		<?= $this->getLayoutData('viewPost')?>
		<?= $this->getLayoutData('posts')?>
	

    </div>
    <div  class="col-md-3" id="tagsToAddDiv">
        <?= $this->getLayoutData('tagsToAdd')?>
    </div>