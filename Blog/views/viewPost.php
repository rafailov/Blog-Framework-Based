<style type="text/css">
body {
    padding-top: 70px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
}

.thumbnail img {
    width: 100%;
}

.ratings {
    padding-right: 10px;
    padding-left: 10px;
    color: #d17581;
}

.thumbnail {
    padding: 0;
}

.thumbnail .caption-full {
    padding: 9px;
    color: #333;
}
div.caption-full span{
    font-style: oblique;
    font-size: 0.9em;
    color: brown;
}
footer {
    margin: 50px 0;
}

 </style>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Shop Name</p>
            <div class="list-group">
                <a href="#" class="list-group-item active">Category 1</a>
                <a href="#" class="list-group-item">Category 2</a>
                <a href="#" class="list-group-item">Category 3</a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="thumbnail">
                <div class="caption-full">
                    <h4 class="pull-right"><?=htmlentities($this->currentPost['views']);?> views</h4>
                    <h3><?=htmlentities($this->currentPost['title']);?></h3>
                    <span>
                        <?php
                            if ($this->currentPost['user_id'] > 0) {
                                echo "by ".htmlentities($this->byUsername)." | ";
                            }
                            echo htmlentities($this->currentPost['date']);
                        ?>
                    </span>
                    <p><?=htmlentities($this->currentPost['content']);?></p>
                </div>
                <div class="ratings">
                    <p class="pull-right">
               
                        <span class="btn btn-success">Like</span>
                        <span class="btn btn-danger">Dislike</span>

                    </p>
                    <h4>Tags:</h4>
                    <p>
                       <?php
                       		foreach ($this->currentPostTags as $key => $value) {
                       			//var_dump($value);
                       			echo " <span> ".htmlentities($value['tag'])." </span> ";
                       		}
                       ?>
                    </p><br />
                </div>
            </div>

            <div class="well">

                <div class="text-right">
                    <a class="btn btn-success">Leave a Review</a>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">10 days ago</span>
                        <p>This product was great in terms of quality. I would definitely buy another!</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">12 days ago</span>
                        <p>I've alredy ordered another one!</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">15 days ago</span>
                        <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
<!-- /.container -->


<?php 
echo "<h1>POST</h1>";
echo "<pre>".print_r($this->currentPost,true)."</pre>";
echo "<h1>Tags</h1>";
echo "<pre>".print_r($this->currentPostTags,true)."</pre>";
