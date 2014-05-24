<?php session_start()
?>

<html>
	<head>
		
		<link rel="stylesheet" type="text/css" href="Search/kComplete.css">
		<link rel="stylesheet" type="text/css" href="Search/Search.css">

		<script src="Search/jquery-1.7.2.min.js"></script>
		<script src="Search/jquery.Kcomplete-1.1.js"></script>
		<script>
			$(function(){
				$(".K_text").Kcomplete({
					location       : 'Search/WordSearchServer.php',
					dataType       : 'json'
				});
			});

			function searchClick(){
				var inputText=$(".inputSearch").attr("value");
				$.get("Search/WordSearchServer.php",{"input":inputText},function(data){
					$(".wordDisplayUl").find("li").remove();
					for (var i=0; i<data.length; i++){
						var word=data[i];
						var li=$('<li class="wordDisplayLi">' + (i+1)+' '+word.name+' '+word.trans+'</li>');
						li.appendTo( $(".wordDisplayUl") );
					}
				},"json");
			}

		</script>
	</head>
	<body>

		<?php
			include_once ("Navigation.php");
		?>

		<!-- mainDiv is the main Container -->
		<div class="mainDiv">
			<div class="SearchField">
				<input type="text" name="wd" class="K_text inputSearch" autocomplete="off" />
				<input type="button"  class="searchButton" onclick="searchClick()"/>
			</div>


			<div>
				<ul class="wordDisplayUl">
				</ul>
			</div>

		</div>

	</body>
</html>