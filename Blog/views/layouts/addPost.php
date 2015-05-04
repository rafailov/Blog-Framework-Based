<style type="text/css">
	body
	{
	    background-color:rgba(204, 204, 204, 0.48);
	    margin: 0;
	    min-width: 1300px;
	}
	#PostFormDiv{
		width: 35%;
		margin: 2%;
		border: 2px solid;
		background: rgba(35, 68, 101, 1);
		padding: 10px;
		border-radius: 5px;
		color: white;
		display: inline-block;
		vertical-align: top;
	}
	#addedTagsDiv{
		width: 30%;
	 	margin: 2% 0%;
	   	display: inline-block;
		vertical-align: top;
	}
	#tagsToAddDiv{
		width: 30%;
		margin: 0;
		display: inline-block;
		vertical-align: top;
		border-left: 3px solid white;
		padding: 2%;
		height: 100%;
		background: rgb(35, 68, 101);
		color: white;
	}
</style>
	<script type="text/javascript">

	function submitPostForm (addedTagsArray) {
		var addedTagsJson = JSON.parse(JSON.stringify(addedTagsArray));
		var input = document.createElement("input");
		input.setAttribute("type", "hidden");
		input.setAttribute("name", "tags");
		input.setAttribute("value", addedTagsJson);
		var theFrom = document.getElementById("addPostForm");
		theFrom.appendChild(input);
		theFrom.submit();
	}

	function addToAddedTags (tagName, addedTagsArray) {
		if ($.inArray(tagName, addedTagsArray) == -1) {
				addedTagsArray.push(tagName);
				var li = document.createElement('li');
				li.setAttribute("class", "addedTagsLi");
				li.innerHTML = tagName;
				document.getElementById('addedUlTags').appendChild(li);
			};
	}

	$( document ).ready(function() {
		var addedTagsArray = [];

		$(".tagToAdd").click(function(){
			addToAddedTags($(this).text(), addedTagsArray);
		});

		$("span.add-on").click(function(){
			addToAddedTags($('#appendedtag').val(), addedTagsArray);
		});

		$("span.btn").click(function() {
			submitPostForm(addedTagsArray);
		})

		$("#addedUlTags").on('click', '.addedTagsLi',function(){
			var tag = $(this).text();
			addedTagsArray.pop(tag);
			$(this).remove();
			console.log(addedTagsArray);
		});
	});
	</script>
<body>
	<div>
		<div id="PostFormDiv">
			<?= $this->getLayoutData('addPostForm')?>
		</div>
		<div id="addedTagsDiv">
			<?= $this->getLayoutData('addedTags')?>
		</div>
		<div id="tagsToAddDiv">
			<?= $this->getLayoutData('tagsToAdd')?>
		</div>
	</div>
