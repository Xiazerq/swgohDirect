<?php
libxml_use_internal_errors(true);
include('simple_html_dom.php');
/*
<div class="collection-char collection-char-light-side">
		<div class="player-char-portrait char-portrait-full char-portrait-full-gear-t11">
			<a href="/u/xiazer/collection/r2-d2/" class="char-portrait-full-link" rel="nofollow">
				<img class="char-portrait-full-img" src="//swgoh.gg/static/img/assets/tex.charui_astromech_r2d2.png" alt="R2-D2">
				<div class="char-portrait-full-gear"></div>
				<div class="star star1"></div>
				<div class="star star2"></div>
				<div class="star star3"></div>
				<div class="star star4"></div>
				<div class="star star5"></div>
				<div class="star star6"></div>
				<div class="star star7"></div>
				<div class="char-portrait-full-level">85</div>
				<div class="char-portrait-full-gear-level">XI</div>
			</a>
		</div>
		<div class="collection-char-gp" data-toggle="tooltip" data-container="body" title="Power 19,015 / 22,081">
			<div class="collection-char-gp-progress">
				<div class="collection-char-gp-progress-bar" style="width: 86.11%;"></div>
			</div>
			<div class="collection-char-gp-label">
				<span class="collection-char-gp-label-value">
				86
				</span>
				<span class="collection-char-gp-label-percent">%</span>
			</div>
		</div>
		<div class="collection-char-name"><a class="collection-char-name-link" href="/u/xiazer/collection/r2-d2/" rel="nofollow">R2-D2</a></div>
	</div>
</div>
*/

	
	function DOMtestByTag($dom){
		//$body = $dom->getElementsByTagName('div');
		$divs = $dom->getElementsByTagName('div');

		foreach($divs as $div){
			echo "Made It in";
			$test = $toon->getElementsByTagName("a");	//->firstChild->nodeValue;
			//collection-char-name
			//echo $char->getElementsByTagName('collection-char-name').
			//var_dump($char);
			//echo $div->getAttribute("class")."<br>";
			/**/
			if(strpos($div->getAttribute("class"), "collection-char-name") !== false){	//"collection-char"){
				echo "NodeValue:".$div->firstChild->nodeValue."<br>";
				//echo "Made it inside";
			}
		}


	}

	function DOMtestByQuery($dom){

		$xpath = new DOMXpath($dom);
		$articles = $xpath->query('//div[@class="collection-char"]');


		var_dump($articles);

		echo "<br>Made it outside\n";
		foreach($articles as $toon){
			echo "Made It in";
			$test = $toon->getElementsByTagName("a");	//->firstChild->nodeValue;
			//collection-char-name
			//echo $char->getElementsByTagName('collection-char-name').
			//var_dump($char);
			//echo $div->getAttribute("class")."<br>";
			/**/
			if(strpos($div->getAttribute("class"), "collection-char-name") !== false){	//"collection-char"){
				//echo "NodeValue:".$div->firstChild->nodeValue."<br>";
				
				echo "string";
				//echo "Made it inside";
			}
		/**/ 
		//break;
		}

		//<ul class="list-group media-list media-list-stream m-t-0">
		//<li class="media list-group-item p-a collection-char-list">
	}

	

?>

<head>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"> </script>
</head>
<body>
  <h1>SWGOH.gg Redirecter</h1>

  <div id="output">
   <?php

   		if(isset($_GET["username"])){

	   		$name = $_GET["username"];
	   		if($name != null) {
	   			echo $name;
	   		}else{
	   			echo "You dun fucked up man";
	   		}
	   	} else{
	   		echo "What? No username?!";
	   	}
   ?>
   </div>


<?php
	//$url = 'https://swgoh.gg/u/Xiazer/';
	$url = 'https://swgoh.gg/u/'.$name.'/collection/';

	echo $url."<br>";
	ParseSWGOHgg($url);

/* OLD CRAPPIER METHOD*/
//var_dump(parse_url($url));
//$html = file_get_contents($url);

//var_dump($html);
//echo $html //->find('collection-char-list', 0);
//$dom = new DOMDocument;
//$dom->loadHTMLFile($url);
//$dom->saveHTML();

/**/
?>


</body>