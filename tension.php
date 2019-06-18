<?php

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

require ("tension.inc.php");

$instrument["length"] = isset($_GET["length"]) ? $_GET["length"] : 0;
$instrument["smat"] = isset ($_GET["smat"]) ? $_GET["smat"] : "s";
$instrument["wmat"] = isset ($_GET["wmat"]) ? $_GET["wmat"] : "n";
$instrument["courses"] = isset ($_GET["courses"]) ? true : false;

if (preg_match("/mm$/", $instrument['length'])) {
	//$instrument['length'] *= 1;
	$metric = true;
} else {
	$metric = false;
}

//if (preg_match ("/mm$/", $instrument["length"])) {
//	$instrument["length"] = sprintf ("%0.3f", $instrument["length"] * 0.039370);
//}

//$showAlt = isset($_GET["alt"]) ? true : false;
$moreInfo = isset($_GET["info"]) ? true : false;

$equalize = isset($_GET["eq"]) ? true : false;

$gaugeInc = isset($_GET["gaugeinc"]) ? $_GET["gaugeinc"] : 0.001;

$eqdir = "=";

$instrument["strings"] = array();

if (isset ($_GET['gauges'])) {
	header ("Content-type: application/json");
	$si = preg_split ("/,/", $_GET['gauges']);
	$cg = isset ($_GET['cg']) ? $_GET['cg'] : 0;
	print json_encode (array("cg" => $cg, "mass" => $mass[$si[0]][$si[1]]));
	exit;
}

if (isset ($_GET['strings'])) {
	foreach (preg_split("/,/", $_GET['strings']) as $sraw) {
		$string = array();

		if (preg_match("/\*\d/", $sraw)) {
			$string["course"] = preg_replace ("/.*\*(\d)/", "$1", $sraw) == 2 ? true : false; 
		} else {
			$string["course"] = $instrument["courses"];
		}

		if (preg_match("/=/", $sraw)) {
			$string['eqroot'] = true;
			$eqdir = "=";
		} elseif (preg_match("/</", $sraw)) {
			$string['eqroot'] = true;
			$eqdir = "<";
		} elseif (preg_match("/>/", $sraw)) {
			$string['eqroot'] = true;
			$eqdir = ">";
		} else {
			$string['eqroot'] = false;
		}

		if (preg_match("/@\d{1,2}/", $sraw)) {
			$string["length"] = ($instrument["length"] / (pow(pow(2,1/12),preg_replace ("/.*@(\d{1,2}).*/", "$1", $sraw))));
			if ($metric)
				$string["length"] = ($string["length"]) ."mm";
	
		} else {
			$string["length"] = $instrument["length"];
		}

		$string['extra'] = preg_replace ("/^.*-[pw]/", '', $sraw);

	       	$sraw = preg_replace ("/(.*)\*(\d)/", "$1", $sraw);
	       	$sraw = preg_replace ("/(.*)@\d{1,2}/", "$1", $sraw);
		$sraw = preg_replace ("/[=<>]/", "", $sraw);
		$sraw = preg_split("/-/", $sraw);

		$string["note"] = ucfirst($sraw[0]);
		$string["octave"] = $sraw[1];
		$string["gauge"] = $sraw[2];
		$string["pw"] = $sraw[3];

		if (isset ($sraw[4])) {
			$string["smat"] = $sraw[4];
		} else {
			$string["smat"] = $instrument["smat"];
		}

		array_push($instrument["strings"], $string);
		//if (isset($_GET['courses'])) {
		//	array_push($instrument["strings"], preg_split("/-/", $sraw));
		//}
	}
	//$instrument["strings"] = array_reverse($instrument["strings"]);
	#print_r ($instrument["strings"]);
}

$eqroot = false;
for ($i=0;$i<sizeof($instrument['strings']);$i++) {
	if ($instrument['strings'][$i]['eqroot']) {
		if ($eqroot === false)
			$eqroot = $i;
		else
			$instrument['strings'][$i]['eqroot'] = false;
	}
}

if (isset ($_GET['debug']))
	print "eqroot = ".$eqroot."<br/>\n";

$optTension = tension($instrument['strings'][$eqroot]["note"], $instrument['strings'][$eqroot]["octave"], $instrument['strings'][$eqroot]["gauge"], $instrument['strings'][$eqroot]["pw"], $instrument['strings'][$eqroot]["length"], $instrument['strings'][$eqroot]["smat"], $instrument["wmat"]);

if (isset($_GET['debug'])) {
	print "opt:".$optTension;
}

$fonts = array("/usr/share/fonts/truetype/ttf-dejavu/DejaVuSans-Bold.ttf",
	dirname($_SERVER["SCRIPT_FILENAME"])."/DejaVuSans-Bold.ttf");

$font = false;

foreach ($fonts as $f) {
	if (file_exists($f)) { $font = $f; break; }
}

//$alttext = array();
$info = array("data" => array(), "alt" => "", "newStrings" => array());

ob_start();

$im_width = 422;
$im_height = (sizeof($instrument["strings"])*25)+2;

$canvas = imagecreatetruecolor($im_width, $im_height); 

$c['black'] = imagecolorallocate($canvas, 0,0,0); 
$c['white'] = imagecolorallocate($canvas, 255,255,255); 
$c['green'] = imagecolorallocate($canvas, 0,160,0); 
$c['blue'] = imagecolorallocate($canvas, 0,0,190); 

$c['s'] = imagecolorallocate($canvas, 200,200,200); 
$c['n'] = imagecolorallocate($canvas, 255,255,255); 

$c['ni'] = imagecolorallocate($canvas, 180,180,180); 
$c['dni'] = imagecolorallocate($canvas, 130,130,130); 
$c['pb'] = imagecolorallocate($canvas, 241, 165, 60); 
$c['dpb'] = imagecolorallocate($canvas, 218, 105, 0); 
$c['8020'] = imagecolorallocate($canvas, 241, 184, 45); 
$c['d8020'] = imagecolorallocate($canvas, 218, 145, 0); 
$c['sc'] = imagecolorallocate($canvas, 220,220,200); 
$c['dsc'] = imagecolorallocate($canvas, 180,180,170); 

$c['nut'] = imagecolorallocate($canvas, 255,255,230); 
$c['gold'] = imagecolorallocate($canvas, 255,110,0); 

imagefilledrectangle($canvas,0,0,$im_width,$im_height,$c['black']);
imagefilledrectangle($canvas,0,0,24,$im_height,$c['nut']);

$totaltension = 0;

$incomplete = false;

for ($i=0;$i<sizeof($instrument["strings"]);$i++) {
	$string = $instrument["strings"][$i];
	$h = (($i+1)*25);

	if ($equalize && !$string["eqroot"] && $optTension > 0) {
			$newGauge = fGauge($g[$string['smat']][$string['pw']]['max']);
			$newGaugeLast = $newGauge;
			$newPW = $string['pw'];

			if (
				(tension($string["note"], $string["octave"], $newGauge, $newPW, $string["length"], $string["smat"], $instrument["wmat"]) < $optTension) && $newPW == 'p') {
					$newPW = 'w';
					$newGauge = fGauge($g[$string['smat']][$newPW]['max']);
					$newGaugeLast = $newGauge;
			}

			while (true) {

				$newGauge = fGauge($newGauge - ($string['pw'] == 'p' ? 0.001 : $gaugeInc));

				$curTension = tension($string["note"], $string["octave"], $newGauge, $newPW, $string["length"], $string["smat"], $instrument["wmat"]);

				if ($newGauge <= $g[$string['smat']][$newPW]['min']) {
					if ($newPW == 'w' && $string['smat'] == 's') {
						$newPW = 'p';
						$curTension = tension($string["note"], $string["octave"], $newGauge, $newPW, $string["length"], $string["smat"], $instrument["wmat"]);
					} else {
						$string['gauge'] = fGauge($newGauge);
						$string['pw'] = $newPW;
						if (isset ($_GET['debug']))
							print "breaking at $newGauge for ".$string['note'];
						break;
					}
				}

				if ($curTension > 0) {
					if ($curTension == $optTension) {
						$string["gauge"] = $newGauge;
						$string["pw"] = $newPW;
						break;
					} elseif ($curTension < $optTension) {
						if (abs($optTension - $curTension) < abs ($optTension - $newGaugeLast) && $eqdir != ">") {
							$string["gauge"] = $newGauge;
							$string["pw"] = $newPW;
							if (isset ($_GET['debug']))
								print "prefer" . $newGauge . " to " . $newGaugeLast . " (orig. " . $string["gauge"] . ")<br/>";
							break;
						} else {
							if (isset ($_GET['debug']))
								print "prefer" . $newGaugeLast . " to " . $newGauge . " (orig. " . $string["gauge"] . ")<br/>";
							$string["gauge"] = $newGaugeLast;
							$string["pw"] = $newPW;
							break;
						}
					} else {
						$newGaugeLast = $newGauge;
					}
				}

			}

		
	}

	if ($string["pw"] == "w") {
		if ($string["smat"] == "s") {
			if ($instrument["wmat"] == "pb") {
				$c1 = $c["pb"];
				$c2 = $c["dpb"];
			} elseif ($instrument["wmat"] == "8020") {
				$c1 = $c["8020"];
				$c2 = $c["d8020"];
			} else {
				$c1 = $c["ni"];
				$c2 = $c["dni"];
			}
		} else {
			$c1 = $c["sc"];
			$c2 = $c["dsc"];
		}
	} else { 
		$c1 = $c[$string["smat"]];
		$c2 = $c[$string["smat"]];
	}


	for ($k=0;$k<=($string["course"] ? 1 : 2);$k++) {
		if ($string["course"] == 2 && $k==0) {
			$y = $h - 16;
		} elseif ($string["course"] == 2 && $k==1) {
			$y = $h - 8;
		} else {
			$y = $h - 12;
		}
		$slen = $im_width-282-25;
		$sstart = $slen - ($slen / ($instrument["length"] / $string["length"]));
		imagefilledrectangle($canvas,25+$sstart,$y,$im_width-282,$y + floor($string["gauge"] * 75),$c1);
		if ($string["pw"] == "w") {
			for ($j=25+$sstart;$j<$im_width-282;$j+=2) {
				imageline ($canvas,$j,$y,$j,$y + floor($string["gauge"] * 75),$c2);
			}
		}
	}

	$tension = tension($string["note"], $string["octave"], $string["gauge"], $string["pw"], $string["length"], $string["smat"], $instrument["wmat"]);

	if ($tension > 0) {
		if ($string["course"])
			$totaltension += ($tension * 2);
		else 
			$totaltension += $tension;
	} else {
		$tension = "???";
		$incomplete = true;
	}

	if ($string["length"] == $instrument["length"]) {
		if (preg_match ("/\d\d\.\d{1,2}/", $instrument["length"])) {
			$f = preg_split ("/\./", $instrument["length"]);
			$printLength = $f[0];

			if (isset ($vulgFrac[$f[1]])) {
				$printLength .= " ".$vulgFrac[$f[1]];
			} else {
				$printLength .= ".".$f[1];
			}
		} else {
			$printLength = $instrument["length"];
		}
	} else {
		if ($metric) {
			$printLength = round ($printLength);
		} else {
			$printLength = sprintf ("%.2f", $string["length"]);
		}
	}

	if ($metric) {
		$printLength = ($printLength * 1) . "mm";
	} else {
		$printLength .= "\"";
	}

	if ($string["length"] == $instrument["length"]) {
		$printNote = $string["note"];
	} else {
		$printNote = strtolower ($string["note"]);
	}

	$printNote = preg_replace("/([A-G]+)b/", "$1♭", $printNote);
	$printNote = preg_replace("/#/", "♯", $printNote);

	if ($equalize && $i != $eqroot) {
		if ($eqdir == ">")
			$nc = $c['blue'];
		else
			$nc = $c['green'];
	} else {
		$nc = $c['black'];
	}

	imagettftext($canvas, (strlen($printNote) == 2 ? 12 : 12), 90, 20, $h - (strlen($printNote) == 2 ? 0 : 5), $nc, $font, $printNote);
	imagettftext($canvas, 12, 0, $im_width-276, $h -6, $c['gold'], $font, 
		($string["gauge"]." ".$string["pw"].($string['smat'] == 'n' ? " ".strtoupper($string['smat']) : "") ." @ ".$printLength . " = ".$tension." lb".($string["course"] ? "*2" : ""))
	);

	if ($moreInfo) {
		array_push($info['data'], array(
			"gauge" => $string['gauge'],
			"tension" => $tension != "???" ? $tension : -1,
			"note" => $string['note'],
			"freq" => ((isset ($freq[$string['note']]) ? $freq[$string['note']] : $freq[$enharm[$string['note']]]) * (pow(2,$string['octave'])))
		));
		$info['alt'] .= $printNote." ".($string["pw"] == "p" ? "-----" : "=====")." ".($string["octave"]." ".$string["gauge"].($string['smat'] == 'n' ? " ".strtoupper($string['smat']) : "") ." @ ".$printLength . "\" = ".$tension." lb".($string["course"] ? "*2" : ""))."\n";
	}

	array_push ($info['newStrings'], $string['note'] . "-" . $string['octave'] . "-" . $string['gauge'] . "-" . $string['pw'] . $string['extra']);

}

//if ($instrument["courses"])
//	$totaltension *= 2;

imagettftext($canvas, 13, 0, 28, 32, $c['gold'], $font, ($incomplete ? "???" : $totaltension. " lb"));

imagepng($canvas); 

//if ($showAlt) {
//	ob_clean();
//		header ("Content-type: text/plain");
//	print join ("\r\n", $alttext);
//
//} else
if ($moreInfo) {
	ob_clean();
		header ("Content-type: application/json");
	print json_encode ($info);

} else {
	if (!isset($_GET['debug'])) {
		header ("Content-type: image/png");
	}

	ob_flush();
}

function tension($note, $octave, $gauge, $string, $length, $smat, $wmat) {
	global $mass;
	global $freq;
	global $enharm;

//	$instrument["length"] = sprintf ("%0.3f", $instrument["length"] * 0.039370);
//}
	if (preg_match("/mm$/", $length)) {
		$length *=  0.039370;
	}

	$octave = preg_replace ("/[^0-9]*/", "", $octave);

	//$tension = 4 * pow(($freq[$note] * $octave), 2) * $length * ($smass * ($length / 10)) / 980621;
	//$tension *= 2.20462;
	//print $smat;
	if (isset($mass[$smat][$string][$gauge])) {
		if ($string == "w") {
			if ($smat == "s") {
				if ($wmat == "pb") {
					$smass = ($mass[$smat][$string][$gauge]) / 0.95;
				} elseif ($wmat == "8020") {
					$smass = ($mass[$smat][$string][$gauge]) / 0.97;
				} else {
					$smass = ($mass[$smat][$string][$gauge]);
				}
			} else {
				$smass = ($mass[$smat][$string][$gauge]);
			}
		} else {
			$smass = ($mass[$smat][$string][$gauge]);
		}

		if (isset($freq[$note])) {
			$sfreq = $freq[$note];
		} elseif (isset($freq[$enharm[$note]])) {
			$sfreq = $freq[$enharm[$note]];
		} else {
			return false;
		}

		$tension = sprintf("%0.3f", (($smass * pow((2 * $length * ($sfreq * (pow(2,$octave)))),2)) / 386.4));
	} else {
		return false;
	}
	
	return $tension;
}

function fGauge($n) {
	return (preg_replace ("/^0/", "", sprintf ("%.3f", $n)));

}

?>
