<html>
<head>
	<title><?php echo htmlspecialchars($this->title) ?></title>
	<link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css" />
	<link rel="stylesheet" href="../../libs/bootstrap/bootstrap-theme.min.css" />
</head>
<body>
	<div style="width: 49%;display: inline-block;">
		<?= $this->getLayoutData('register')?>
	</div>
	<div style="width: 49%;display: inline-block;">
		<?= $this->getLayoutData('login')?>
	</div>
</body>
</html>