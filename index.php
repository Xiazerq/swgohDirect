<!DOCTYPE html>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
		<script src="assets/js/clipboard.min.js"></script>
		<script src="assets/js/request.js"></script> 
		<style>
			table, th, td {
			    border: 1px solid black;
			    border-collapse: collapse;
			}
			th, td {
			    padding: 5px;
			    text-align: center;    
			}
			th.toon {
			  height: 225px;
			  white-space: nowrap;
			}
			th.toon > div {
			  transform: 
			    translate(25px, 51px)
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
	</body>
</html>