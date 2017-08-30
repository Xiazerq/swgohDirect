<?php
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
	libxml_use_internal_errors(true);
	include('simple_html_dom.php');
	//funciton SwoghGG($url)
	function FindGuild($url){
		//p-t-md
		//panel-body
		//p
		//a
		$html = str_get_html(file_get_contents($url));
		$guildPage = $html->find('.p-t-md .panel-body p a', 0)->getAttribute("href");
		//plaintext;

		//echo $name;
		return GetGuildRoster("http://swgoh.gg".$guildPage);;
	}

	function GetGuildRoster($url) {
		$html = str_get_html(file_get_contents($url));

		$rawMembers = $html->find('table a');
		$members = array();

		//echo $url." ".sizeof($rawMembers).".<br>";

		foreach($rawMembers as $rawMember){
			//echo $rawMember->plaintext;
			//echo "Link: ".$rawMember->getAttribute("href");
			//$members[$rawMember->plaintext]=>array("link"=>$rawMember->getAttribute("href"));
			$href = $rawMember->getAttribute("href");
			//var_dump($href);
			//$href = mb_convert_encoding($href, 'HTML-ENTITIES', "UTF-8");
			$testClean = preg_replace('/\/u\/(.*)\//', '$1', $href);

			$test = urlencode(urldecode($testClean));
	
			//echo "(".urlencode(urldecode($testClean)).")(".urldecode($testClean).")<br>";
			
			$members[$rawMember->plaintext] = ParseSWGOHgg('http://swgoh.gg/u/'.$test.'/collection');
			//break;
		}
		//return;
		return $members;
		//echo ".";
	}

	function ParseSWGOHgg($url){
		//$url = "http://swgoh.gg/u/x%27lor%20sidiousolo/";
		//$url = urlencode($url);//mb_convert_encoding($url, 'HTML-ENTITIES');
		//$url = str_replace(['&#39;'], ['\''], $burl);
		//$url = htmlspecialchars_decode($url);
		//echo $url."<br>";
		//$re = '/\'/';
		//$str = 'http://swgoh.gg/u/x\'lor%20sidiousolo/';
		//$subst = '\\\\\'';
		//var_dump($url);
		//$url = preg_replace($re, $subst, $str);

		//echo "The result of the substitution is ".$result;
		echo $url."<br>";
		//return;
		$html = str_get_html(file_get_contents($url));
		//return;
		/**/
		$rawToons = $html->find('.collection-char');
		$toons = array();
		//var_dump($toons);
		//echo "<br>";

		//$x = 0;
		foreach ($rawToons as $rawToon) {

			$tab = ",";
			$toon = ParseToon($rawToon);
			//echo $toon["name"] . $tab . "L" . $toon["level"] . $tab . "G" . $toon["gear"];
			//echo "<br>";
			$toons[$toon[0]] = array("level"=>$toon[1], "star"=>$toon[2], "gear"=>$toon[3]);
		}

		return $toons;
	}
	function ParseToon($raw){

		//IMPORTANT CLASSES
		//Missing toon:		 	collection-char-missing
		//Level:	 			char-portrait-full-level
		//Gear Level:			char-portrait-full-gear-level
		//Galactic Power %:		collection-char-gp-label-value
		//Name/Link:			collection-char-name-link
		//Locked Toon:			collection-char-missing

		$toon = array();

		$name = $raw->find('.collection-char-name-link', 0)->plaintext;
		
		$level = 0;
		$gear = 0;
		$star = 0;
		$galac = 0;

		if(strpos($raw->getAttribute('class'), 'collection-char-missing') == false){
			$level = $raw->find('.char-portrait-full-level', 0)->plaintext;
			$gear = GetGearLevel($raw->find('.char-portrait-full-gear-level', 0)->plaintext);

			$countInactiveStars = sizeof($raw->find('.star-inactive'));
			$star = 7 - $countInactiveStars;
		}


		//return array($name => array("name"=>$name, "level"=>$level, "gear"=>$gear));
		return array($name, $level, $star, $gear, $galac);
	}

	function GetGearLevel($gear){
		$romans = array(
		    'X' => 10,
		    'IX' => 9,
		    'V' => 5,
		    'IV' => 4,
		    'I' => 1,
		);

		$result = 0;

		foreach ($romans as $key => $value) {
		    while (strpos($gear, $key) === 0) {
		        $result += $value;
		        $gear = substr($gear, strlen($key));
		    }
		}
		return $result;
	}

	function MakeCell($tag, $inner, $attributes = false){
		return "<".$tag . ($attributes !== false ? " " . $attributes : "") . ">".$inner."</".$tag.">";
	}

	function MakeTable($users){
		$rS =  "<tr>";
		$rE = "</tr>";

		echo "<table style=\"width:100%\">";
		$toonNames = array();
		foreach($users as $user => $toons) {

			if(sizeof($toonNames) < 1){
				$toonNames = array_keys($toons);
				sort($toonNames);

				echo $rS;
				echo MakeCell("th", "Name", "rowspan=\"2\"");
				foreach($toonNames as $toonName){
					echo MakeCell("th", "<div>".$toonName."</div>", "class=\"toon\" colspan=\"3\"");
				}
				echo $rE;

				echo $rS;
				for($x = 0; $x < sizeof($toonNames); $x++){
					echo MakeCell("th", "Star");
					echo MakeCell("th", "Gear");
					echo MakeCell("th", "Lvl");
				}
				echo $rE;
			}

			echo $rS;
			echo MakeCell("td", $user);
			foreach ($toons as $name => $toon) {
				echo MakeCell("td", $toon["star"]);
				echo MakeCell("td", $toon["gear"]);
				echo MakeCell("td", $toon["level"]);
			}


			echo $rE;
		}

		echo "</table>";
	}

	$name = isset($_POST['username']) ? $_POST['username'] : null;
	$guild = isset($_POST['guild']) ? $_POST['guild'] : null;

	if($name){
		//FindGuild("http://swgoh.gg/u/xiazer/");
		$url = 'http://swgoh.gg/u/'.$name.'/';	//collection/';
		$guildMembers = FindGuild($url);
		MakeTable($guildMembers);
		//var_dump($guildMembers);
		//MakeTable(array($name=>ParseSWGOHgg($url)));
	}

?>

<?php
/*
<table style="width:100%">
  <tr>
    <th rowspan="2">Name</th>
    <th colspan="2">Count Dooku</th>
    <th colspan="2">Kylo</th>
    <th colspan="2">CLS</th>
    <th colspan="2">Yo Mama</th>
  </tr>
  <tr>
    <th>Star</th>
    <th>Gear</th>
    <th>Star</th>
    <th>Gear</th>
    <th>Star</th>
    <th>Gear</th>
    <th>Star</th>
    <th>Gear</th>
  </tr>
  <tr>
    <td>user</td>
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
  </tr>
</table>

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
/*


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