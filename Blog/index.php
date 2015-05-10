<?php
    error_reporting(E_ALL ^ E_NOTICE);
    include_once '../gf/App.php';
    $app = \GF\App::getInstance();

?>
<html>
<head>
	<title>BLOG</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <style type="text/css">
    	.content{
    		margin-top: 50px;
    	}
    </style>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="http://localhost:3210/Blog-Framework/Blog/index.php/posts">Home</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="http://localhost:3210/Blog-Framework/Blog/index.php/posts/add">add POST</a>
                </li>
                <li>
                    
                </li>
            </ul>
            <div class="pull-right">
                <ul class="nav navbar-nav">
                    <li><a href="http://localhost:3210/Blog-Framework/Blog/index.php/users/logout">logout</a></li>
                </ul>
                
             </div>
        </div>
    </div>

</nav>
<div class='content'>
<?php    
	$app->run();


?>
</div>
<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Denis Rafailov 2015</p>
            </div>
        </div>
    </footer>

</div>
</body>
</html>