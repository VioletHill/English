<?php
	header("Content-Type:text/html; charset=utf8");
?>
<html>
	<head>
		<style>
			.mainDiv{
				width:50%;
				margin-left: auto;
				margin-right: auto;
			}
		</style>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<script src="jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<script>
			function wordClick()
			{	
			 	var word=$("#inputWord").val();
			 	var phonetic=$("#inputPhonetic").val();
			 	var trans=$("#inputTrans").val();
			 	var cet4=document.getElementById("cet4").checked;
			 	var cet6=document.getElementById("cet6").checked;
			 	var kaoyan=document.getElementById("kaoyan").checked;
			 	var ielts=document.getElementById("ielts").checked;
			 	var toefl=document.getElementById("toefl").checked;
			 	$.post("WordAdminInsert.php",{word:word,phonetic:phonetic,trans:trans,cet4:cet4,cet6:cet6,kaoyan:kaoyan,ielts:ielts,toefl:toefl},function(data){
			 			alert("finish");
			 	});
			}
		</script>
	</head>
	<body>
		<div style="width:80%; margin-left:auto; margin-right:auto; text-align: center; margin-top:50px;">
			<h3>"We are what we repeatedly do. Excellence, then, is not an act, but a habit."     - Aristotle</h3>
		</div>
		
		<div class="mainDiv" style="margin-top:30px;">
			
			<div class="form-horizontal" >
				<div class="control-group">
					<label class="control-label">Word</label>
					<div class="controls">
						<input  type="text" id="inputWord" placeholder="Word">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label">Phonetic</label>
					<div class="controls">
						<input type="text" id="inputPhonetic" placeholder="Phonetic">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label">Trans</label>
					<div class="controls">
						<textarea id="inputTrans" rows="3"></textarea>
					</div>
				</div>
			

				<div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<input id="cet4" type="checkbox" checked="checked"> CET4
						</label>
						<label class="checkbox">
							<input id="cet6" type="checkbox" checked="checked"> CET6
						</label>
						<label class="checkbox">
							<input id="kaoyan" type="checkbox" checked="checked"> 考研
						</label>
						<label class="checkbox">
							<input id="ielts" type="checkbox" checked="checked"> IELTS
						</label>
						<label class="checkbox">
							<input id="toefl" type="checkbox" checked="checked"> TOEFL
						</label>
						
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<button class="btn" onclick="wordClick()">添加</button>
					</div>
				</div>
				
			</div>
		</div>
	</body>
</html>