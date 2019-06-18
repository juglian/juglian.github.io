<?php
/*
 * drawgraph.php
 *
 * Theo Parmakis ( http://tpn.lowtech.org )
 *
 */

require ("drawing.inc.php");

$labels = split(",",stripslashes($_GET['labels']));

$data = array();
foreach (preg_split("/,/",stripslashes($_GET['data'])) as $rec) {
	$recname = preg_replace("/=.*/", "", $rec);
	$recdata = preg_split("/:/", preg_replace("/.*=/", "", $rec));
	$data[$recname] = $recdata;
}

$title = isset($_GET['title']) ? stripslashes($_GET['title']) : "";

$numAtPoint = isset($_GET['numatpoint']) ? true : false;

$cstart = isset ($_GET['c']) ? $_GET['c'] : 0;

$wpad = 16;
$chunkWidth = 36;
$labelHeight = 24;
$hpad = 24;
$lpad = 6;
$rpad = 6;
$onlyJoined = false;

if(function_exists('imageantialias')) {
	imageantialias($im,true);
	$tob = 1;
} else {
	$tob = 1;
}

$fontSize = array(
	"title" => 11.5,
	"label" => 8,
	"message" => 12
);

if (isset ($_GET['max'])) {
	if ($_GET['max'] == "auto") {
		$max = 0;
		foreach (array_keys ($data) as $k) {
			for ($i=0;$i<sizeof($data[$k]);$i++) {
				if ($data[$k][$i] > $max)
					$max = $data[$k][$i];

			}
		}
		if ($max < 1) 
			$max = ceil($max * 100) / 100;
		else
			$max = ceil($max / 10) * 10;

	} else {
		$max = $_GET['max'];
	}
} else {
	$max = 700;
}

if (isset ($_GET['min'])) {
	if ($_GET['min'] == "auto") {
		$min = $max;
		foreach (array_keys ($data) as $k) {
			for ($i=0;$i<sizeof($data[$k]);$i++) {
				if ($data[$k][$i] < $min)
					$min = $data[$k][$i];

			}
		}
		$min = floor ($min / 10) * 10;
		#if ($min < 1) 
		#	$min = ceil($max * 100) / 100;
		#else
		#	$max = ceil($max / 10) * 10;

	} else {
		$min = $_GET['min'];
	}
} else {
	$min = 0;
}

if (isset ($_GET['scale'])) {
	if (preg_match ("/^@/", $_GET['scale'])) {
		$scale = preg_replace ("/^@/", "", $_GET['scale'])  / ($max - $min);
	} else {
		$scale = $_GET['scale'];
	}
} else {
	$scale = 1;
}


$barHeight = floor(($max-$min) * $scale);
$legendRight = true;
$legendWidth = (8 * (strlen($max))) + 3;
$lineMax = round((sizeof ($data)+1) * 4.3) + 6; // lol

if ($title !== "") {
	$titleHeight = (((substr_count(textWrap ($title, $lineMax),"\n")) + 1) * 16) + 10;
	//if (isset ($_GET['debug']))
	//	print "h".$titleHeight;
} else {
	$titleHeight = 8;
}

$namesAtTop = false;
if ($namesAtTop) {
	$topNamesHeight = 56;
} else {
	$topNamesHeight = 0;
}

$imWidth = (((sizeof($labels)-1) * ($chunkWidth))) + (2 * $wpad) + 32;
$imHeight = $titleHeight + $topNamesHeight + $barHeight + $labelHeight;

$im = imagecreatetruecolor($imWidth, $imHeight + 1);

$c['lines'] = array(
	"#5D8AA8",
	"#E32636",
	"#FF7E00",
	"#8DB600",
	"#5B7E23",
	"#66424D",
	"#FC0FC0"
);

imagefilledrectangle($im,0,0,$imWidth,$imHeight,gdC($c['bg']));

$legends = array();
for ($j=$min;$j<=$max;$j+=($max-$min)/10) {
	if (isset($_GET['debug']))
		print $j."<br/>";
	$legends[] = $j;
}
$legends = array_reverse($legends);
for ($i=0;$i<sizeof($legends);$i++) {
	if ($max < 1)
		$ldisp = sprintf ("%.03f", $legends[$i]);
	else
		$ldisp = $legends[$i];

	$y = $imHeight - $labelHeight - (($legends[$i]-$min) * $scale);
	imagettftext($im, $fontSize['label'], 0, ($legendRight ? $imWidth - $rpad - $legendWidth + 4 : $lpad), $y + 4, gdC($c['rule']), $font['bold'], $ldisp);
	imageline($im,($legendRight ? $lpad : $lpad + $legendWidth),$y,($legendRight ? $imWidth - $rpad - $legendWidth : $imWidth - $rpad),$y,gdC($c['rule']));
}

#for ($i=0;$i<sizeof($legends);$i++) {
#	$y = $imHeight - (24 + ($tob)) - floor(($legends[$i] * $scale));
#	//print $y."<br/>\n";
#	imagettftext($im, 8, 0, $imWidth - 40, $y, gdC($c['black']), $font, $legends[$i]);
#	imageline($im, 0, $y,$imWidth,$y,gdC($c['rule']));
#}

//imagettftext($im, 16, 0, 8, 16, gdC($c['black']), $font, $title);
imagettftext($im, $fontSize['title'], 0, $lpad, 16, gdC($c['black']), $font['bold'], textWrap ($title, $lineMax));

//imageline($im,$wpad,$imHeight - 24,$imWidth - $wpad,$imHeight - 24, gdC($c['black']));

imagesetthickness($im,$tob);

$d = 0;

foreach (array_keys($data) as $i) {
	$noy = array();
	
	$j = 0;
	$lineCol = gdC($c['lines'][($d % (sizeof($c['lines']))) + $cstart]);
	for ($j=1;$j<sizeof($data[$i]);$j++) {
		$pos[0] = $wpad + (($j - 1) * $chunkWidth);
		$pos[1] = $imHeight - $labelHeight - floor((($data[$i][$j-1]-$min)*$scale));
		$pos[2] = $wpad + ($j * $chunkWidth);
		$pos[3] = $imHeight - $labelHeight - floor((($data[$i][$j]-$min)*$scale));

		if ($data[$i][$j-1] != -1 && $data[$i][$j] != -1) {
			imageline($im,$pos[0],$pos[1],$pos[2],$pos[3],$lineCol);

			if ($onlyJoined) {
				imagefilledellipse ($im, $pos[0],$pos[1], 6, 6, $lineCol);
				imagefilledellipse ($im, $pos[2],$pos[3], 6, 6, $lineCol);
			}
		}
		if ((!$onlyJoined) && $data[$i][$j-1] != -1) {
			imagefilledellipse ($im, $pos[0],$pos[1], 6, 6, $lineCol);
			if ($numAtPoint)
				imagettftext($im, 6.5, 0, $pos[0] - 4, $pos[1] - 4, $lineCol, $font['regular'], $data[$i][$j-1]);
		}
		if ((!$onlyJoined) && $data[$i][$j] != -1) {
			imagefilledellipse ($im, $pos[2],$pos[3], 6, 6, $lineCol);
			if ($numAtPoint)
				imagettftext($im, 6.5, 0, $pos[2] - 4, $pos[3] - 4, $lineCol, $font['regular'], $data[$i][$j]);
		}


	}


	$d++;

}

for ($i=0;$i<sizeof($labels);$i++) {
	imagettftext($im, 10, 300, $lpad + ($i*$chunkWidth)+7, $imHeight - $labelHeight + 10,  gdC($c['black']), $font['bold'], $labels[$i]);
}

$i=0;

if ($namesAtTop && $title != "") {
	imageline($im,$lpad,$titleHeight - 4,$imWidth - $rpad,$titleHeight - 4,gdC($c['black']));
}

foreach (array_keys($data) as $linename) {
	$lineCol = gdC($c['lines'][$i % (sizeof($c['lines']))]);
	if ($namesAtTop) {
		imagettftext($im, 8, 0, $lpad, $titleHeight + 10 + ($i*12),  $lineCol, $font['bold'], $linename);
	} else {
		imagettftext($im, 8, 0, $lpad, $titleHeight + $topNamesHeight + 10 + ($i*12),  $lineCol, $font['bold'], $linename);
	}
	$i++;
}

if (!isset($_GET['debug']))
	header("Content-type: image/png");

imagepng($im);

?>
