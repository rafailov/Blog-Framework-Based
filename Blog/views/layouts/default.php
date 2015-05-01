<html>
<head>
	<title><?php echo htmlspecialchars($this->title) ?></title>
	<link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="../../libs/bootstrap/bootstrap-theme.min.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</head>
<body>
	<div>
		<?= $this->getLayoutData('addPostForm')?>
		<?= $this->getLayoutData('viewPost')?>
	</div>
</body>
</html>