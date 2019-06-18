<?php

$font = array();

foreach (array(
	"/usr/share/fonts/truetype/ttf-dejavu/DejaVuSans-Bold.ttf",
	dirname($_SERVER["SCRIPT_FILENAME"])."/DejaVuSans-Bold.ttf"
) as $f) {
	if (file_exists($f)) {
		$font['bold'] = $f;
		break;
	}
}

foreach (array(
	"/usr/share/fonts/truetype/ttf-dejavu/DejaVuSans.ttf",
	dirname($_SERVER["SCRIPT_FILENAME"])."/DejaVuSans.ttf"
) as $f) {
	if (file_exists($f)) {
		$font['regular'] = $f;
		break;
	}
}

$c = array();
$c['black'] = array(0,0,0);
$c['white'] = array(255, 255, 255);
$c['bg'] = array(255, 255, 240);
$c['rule'] = array(140,140,140);

function textWrap ($text, $width=72, $indent="") {
	$s = preg_split ("/ /", $text);
	$t = array();
	$linelen = 0;
	for ($i=0;$i<sizeof($s);$i++) {
		if (strlen ($s[$i]) > $width) {
			$g = str_split ($s[0], $width-1);
			if (isset ($_GET['debug']))
				print_r ($g);
			for ($j=0;$j<sizeof($g);$j++) {
				
				$t[] = $g[$j].($j < sizeof($g) -1 ? "-\n".$indent : "");
			}
			#$t[] = preg_replace ("/(.{".$width."})(.*)/", "\n$2", $a);
			#print $t[sizeof ($t) - 1];
			$linelen = strlen ($g[$j-1]) + 1;
			continue;
		} elseif ($linelen + strlen ($s[$i]) > $width) {
			$t[] = "\n".$indent;
			$linelen = 0;
		}
			$t[] = $s[$i]." ";
			$linelen += strlen($s[$i]) + 1;
	#		$linelen += strlen ($s[$i]) + 1;
	#		if ($linelen > $width) {
	#			if ($i > 0 && $i <sizeof($s)) {
	#				$t[sizeof($t) - 1] = "\n".$t[sizeof($t) - 1];
	#			}
	#		}
	#	}
				//$a = $t[sizeof($t) - 1];

	}
	$t[sizeof($t)-1] = rtrim ($t[sizeof($t)-1]);
	return (join ("",$t));
}

function returnGradient ($from, $to, $width) {
	$gradient = array_fill (0, ceil($width), 0);

	for ($i=0;$i<$width;$i++) {
		$gradient[$i] = array(0,0,0);
		for ($c=0;$c<=2;$c++) {
			$div = (abs($from[$c] - $to[$c]) / $width);
			$gradient[$i][$c] = abs($from[$c] - floor($i*$div));
		}
	}

	return ($gradient);
}

function gdC ($c) {
	global $im;
	if (gettype ($c) == 'string') {
		$c = getHexC($c);
	}
	return imagecolorallocate($im, $c[0], $c[1], $c[2]);
} //gdC

function getHexC ($c) {
	$c = preg_replace ("/^#/", "", $c);
	$c = str_split($c, 2);

	for($i=0;$i<sizeof($c);$i++) {
		$c[$i] = hexdec($c[$i]);
	}

	return ($c);
}

function h2gd ($c) {
	global $im;

	for($i=0;$i<sizeof($c);$i++) {
		$c[$i] = hexdec($c[$i]);
	}

	return gdC($c);
}

?>
