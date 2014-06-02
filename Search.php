<?php 
	session_start();
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
					$(".wordDisplayDiv").remove();
					for (var i=0; i<data.length; i++){
						var word=data[i];
						var spanNumber=$('<span class="wordDisplayNumberSpan">'+ (i+1)+"."+'</span>');
						var spanTrans=$('<span class="wordDisplayTrans">'+word.name+' '+word.trans+'</span>');
						var div=$('<div class="wordDisplayDiv"></div>');
						div.append(spanNumber);
						div.append(spanTrans);
						$(".wordSearchContainer").append(div);
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

			<div class="wordSearchContainer">
			
			</div>

		</div>

	</body>
</html>