<html>
<head>
	<title><?php echo htmlspecialchars($this->title) ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">



	<style type="text/css">
		body
		{
		    background-color:rgba(204, 204, 204, 0.48);
		    margin: 0;
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
			min-width: 195px;
		}
		input{
			height: 25px;
		}
		#appendedtext{
			min-width: 180px;
			border-top-right-radius: 0; 
			border-bottom-right-radius: 0; 
		}
		.add-on{
			padding: 4.5px;
			margin-left: -4px;
			height: 26px;
			background: rgb(97, 117, 221);
			border-top-right-radius: 2px; 
			border-bottom-right-radius: 2px; 
		}
		.btn{
			margin-top: 16px;
			margin-left: 67px;

		}
	</style>
	
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
	<div>
		<div style="width: 50%; margin : 2%">
			<?= $this->getLayoutData('addPostForm')?>
		</div>
		<?= $this->getLayoutData('viewPost')?>
	</div>
</body>
</html>