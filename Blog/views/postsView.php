<style type="text/css">
body {
    padding-top: 70px; /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
}

.thumbnail img {
    width: 100%;
}
.container{
    width: 1250px;
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
#tagsToAddDiv{
    margin: 0;
    display: inline-block;
    vertical-align: top;
    border-left: 3px solid white;
    padding: 2%;
    height: 100%;
    background: white;
    color: rgb(35, 68, 101);
}
 </style>
 <script type="text/javascript">
 $(document).ready(function () {
    $('.tagToAdd').click(function(){
        $(this).toggleClass('selected'); 
        refreshPostList()
    })
 })
//var arr = $('input[name=filteredTags]').val().split(",")
//$.inArray('SQL',arr) -> 3
//arr.splice(3,1)
 function refreshPostList() {
    var oldTags = $('input[name=filteredTags]').val();
    var selectedTag = $('li.selected')[0].innerHTML;
    var oldTagsArray = oldTags.split(",");

    if (oldTags) {
        var indexOf = oldTagsArray.indexOf(selectedTag);
        if (indexOf >= 0) {
            oldTagsArray.splice(indexOf, 1);
            var selectedTags = [oldTagsArray.toString()];
            
        }else{
            var selectedTags = [oldTags, selectedTag];
        }
    }else{
        var selectedTags = [selectedTag];
    }
    var selectedDate = $('input[name=dateFilter]').innerHTML;
    $.ajax({
       
       url:"http://localhost:3210/Blog-Framework/Blog/index.php/posts",
       type:"POST",
       dataType: "html",
       data:{
          tags: selectedTags.toString(),
          date: selectedDate,
       }
       
    }).done(function(data){
       $('body').html(data);
    setLiClass();
    }).fail(function(){
       alert("failed");
    })

    function setLiClass() {
        var oldTags = $('input[name=filteredTags]').val();
        var arr = oldTags.split(",");
        $('li.brevisionTag').toggleClass('brevisionTag');
        for (var i = 0; i < arr.length; i++) {
        $('li.tagToAdd').each(function () {
            console.log();
            if ($(this).text() == arr[i]) {

            $(this).toggleClass('brevisionTag');
            }
        })
            
        }
    }


 }

 </script>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-md-3">
            <p class="lead">Filter</p>
                <div>
                  <div class="input-append">
                    <input type="date" name="dateFilter" />
                  </div>
                </div>
        </div>

        <div class="col-md-6">
            <?php 
            if (is_array($this->posts)) {
                foreach ($this->posts as $key => $value) {
                    ?>
                   <?php echo '<a href="http://localhost:3210/Blog-Framework/Blog/index.php/posts/view/'.htmlentities($value['id']).'/" >';?>
                    <div class="thumbnail">
                        <div class="caption-full">
                            <h4 class="pull-right"><?=htmlentities($value['views']);?><?=htmlentities($value['views']);?> views</h4>
                            <h3><?=htmlentities($value['title']);?></h3>
                            <span>
                                <?php
                                    if ($value['user_id'] > 0) {
                                        echo "by ".htmlentities($this->byUsername)." | ";
                                    }
                                    echo htmlentities($value['date']);
                                ?>
                            </span>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">
                       
                               <?=htmlentities($value['likes']);?> <span>likes</span>
                               <?=htmlentities($value['dislikes']);?> <span>dislikes</span>

                            </p>
                            <br />
                        </div>
                    </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>