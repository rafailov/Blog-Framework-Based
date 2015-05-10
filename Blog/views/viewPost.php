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
 <script type="text/javascript">
  function refreshPostList() {
    var comment = $('textarea[name=commentContent]').val();
    var postId = $('input[name=postId]').val();
    
    $('textarea[name=commentContent]').val('');

    if (comment == '') return false;

    $.ajax({
       
       url:"http://localhost:3210/Blog-Framework/Blog/index.php/posts/comment",
       type:"POST",
       dataType: "html",
       data:{
          commentContent: comment,
          postId: postId,
       }
       
    }).done(function(data){
       $('#comment').html(data);
       alert('your tag is added');
    }).fail(function(){
       alert("failed");
    })
 }
 </script>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">

        </div>

        <div class="col-md-9">
            <div class="thumbnail">
                <div class="caption-full">
                    <input type="hidden" name="postId" <?=' value="'.htmlentities($this->currentPost["id"]).'"';?>/>
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
                    <a class="btn btn-success" onclick="refreshPostList()" id='addComment'>Leave a Review</a>
                </div>

            
                    <textarea style="width: 80%; height: 100px" name="commentContent"></textarea>

                <hr>
                <?php if (is_array($this->currentPostComments)): ?>                 
                    <?php foreach ($this->currentPostComments as $key => $value): ?>
                      <div class="row">
                            <div class="col-md-12">
                                <?php 
                                if ($value['authorUser_id'] > 0){ 
                                    echo 'by user :'.$value['username'];
                                }elseif (strlen($value['author_name']) > 0){
                                    echo 'by guest :'.$value['author_name'];
                                } else{
                                    echo "Anonymous";
                                } 
                                ?>
                                
                                <span class="pull-right"><?=$value['date']?></span>
                                <p><?=$value['content']?></p>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach ?>
                <?php endif ?>


                

            </div>

        </div>

    </div>

</div>
<!-- /.container -->

