<!DOCTYPE html>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
		<script src="clipboard.min.js"></script>
		<script src="request.js"></script> 
		<style>
			table, th, td {
			    border: 1px solid black;
			    border-collapse: collapse;
			}
			th, td {
			    padding: 5px;
			    text-align: left;    
			}
			th.toon {
			  /* Something you can count on */
			  height: 225px;
			  white-space: nowrap;
			}
			th.toon > div {
			  transform: 
			    /* Magic Numbers */
			    translate(25px, 51px)
			    /* 45 is really 360 - 45 */
			    rotate(270deg);
			  	width: 30px;
			}
			.clipBoard{
				display:none;
			}
		</style>
		<title>Galaxy of Heroes Guild Data</title>
	</head>
	<body>
		<h1>SWGOH.gg Data Table</h1>
		<form id="getUser">
			<label for="username">SWGOH.gg account Name:</label>
			<input id="username" name="username" type="text" value="" />

			<input type="submit" value="Send" />
		</form>
		
		<div id="output">
		</div>
		<button class="clipBoard" data-clipboard-target="#output">
		    Copy To Clipboard
		</button>
		<?php
			
			//FindGuild("http://swgoh.gg/u/xiazer/");
		?>
	</body>
</html>