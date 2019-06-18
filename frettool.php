<?php

$scales = array();

$scales["ion"] = array( 0, 2, 4, 5, 7, 9, 11 );  ## Ionian - Major Scale
$scales["dor"] = array( 0, 2, 3, 5, 7, 9, 10 );  ## Dorian - Minor b3 b7
$scales["phr"] = array( 0, 1, 3, 5, 7, 8, 10 );  ## Phrygian - Minor b2 b3 b7 b6
$scales["lyd"] = array( 0, 2, 4, 6, 7, 9, 11 );  ## Lydian - Major #4
$scales["mix"] = array( 0, 2, 4, 5, 7, 9, 10 );  ## Mixolydian - b7
$scales["aeo"] = array( 0, 2, 3, 5, 7, 8, 10 );  ## Aeolian - Natural Minor Scale b3 b6 b7
$scales["moh"] = array( 0, 2, 3, 5, 7, 8, 11 );  ## Mohammedan - Harmonic Minor Scale b3 b6
$scales["loc"] = array( 0, 1, 3, 5, 6, 8, 10 );  ## Locrian - Diminished b2 b3 b5 b6 b7
$scales["pent"] = array( 0, 2, 4, 7, 9 );  ## Ionian - Major Scale
$scales["mpent"] = array( 0, 3, 5, 7, 10 );  ## Ionian - Major Scale
$scales["rpent"] = array( 0, 2, 5, 7, 9 );  ## Ritusen - Major Scale

$instruments = array();

$instruments['banjo']['scale'] = 26.25;
$instruments['banjo']['frets'] = 22;
$instruments['banjo']['pot'] = 10.5;
$instruments['banjo']['5th'] = 5;
$instruments['banjo']['strings'] = 5;

$instruments['guitar']['scale'] = 24.5;
$instruments['guitar']['frets'] = 14;
$instruments['guitar']['pot'] = 9;
$instruments['guitar']['5th'] = 0;
$instruments['guitar']['strings'] = 6;

$instruments['dulcimer']['scale'] = 26;
$instruments['dulcimer']['frets'] = 30;
$instruments['dulcimer']['pot'] = 5;
$instruments['dulcimer']['5th'] = 0;
$instruments['dulcimer']['strings'] = 3;

$instrument = isset($_GET['instrument']) ? $_GET['instrument'] : "banjo";

if (!isset($_SERVER['QUERY_STRING'])) {
	$_SERVER['QUERY_STRING'] = "";
}

$scale = isset($_GET['scale']) && $_GET['scale'] != "" ? $_GET['scale'] : $instruments[$instrument]['scale'];
$frets = isset($_GET['frets']) ? $_GET['frets'] : $instruments[$instrument]['frets'];
$pot = isset($_GET['pot']) ? $_GET['pot'] : $instruments[$instrument]['pot'];
$fifth = isset($_GET['5th']) ? $_GET['5th'] : $instruments[$instrument]['5th'];
$strings = isset($_GET['strings']) ? $_GET['strings'] : $instruments[$instrument]['strings'];

#if ($instrument != "banjo") {
#	$fifth = 0;
#}

$mult = 24; ## inches to pixels
$sspace = 0.35; ## string spacing
$headstock = 3; ## number of inches for headstock

foreach (array(
	#"/usr/share/fonts/bitstream-vera/VeraBd.ttf",
	"/usr/share/fonts/truetype/ttf-dejavu/DejaVuSans-Bold.ttf",
	dirname($_SERVER["SCRIPT_FILENAME"])."/DejaVuSans-Bold.ttf"
) as $f) {
	if (file_exists($f)) {
		$font = $f;
		break;
	}
}

unset($f);

$im_width = $mult * $pot + (2 * 16);
$im_height = $mult * $scale + 16 + ((($pot / 3) + 2)*$mult) + ($headstock * $mult);

###
$lf = $scale;
$fs = array();

for ($i=0;$i<=$frets;$i++) {
	array_push($fs,sprintf("%.4f",$scale - $lf));
	$lf /= pow(2,1/12);
}

unset($lf);
###

if (isset($_GET['draw'])) {
	$canvas = imagecreatetruecolor($im_width, $im_height); 
	$c = array();

	$c['black'] = imagecolorallocate($canvas, 0,0,0); 
	$c['white'] = imagecolorallocate($canvas, 255,255,255); 
	$c['wood'] = imagecolorallocate($canvas, 128,70,27); 
	$c['bg'] = imagecolorallocate($canvas, 255,255,100); 

	$nl1 = (($im_width / 2) - ((($sspace * ($strings - (($instrument == "banjo") ? 1 : 0))) * $mult)/2)) + (($sspace * $mult)/2);
	$nr1 = (($im_width / 2) + ((($sspace * ($strings - (($instrument == "banjo") ? 1 : 0))) * $mult)/2)) + (($sspace * $mult)/2);;
	$nl2 = ($nr1 - ((($sspace * $strings) * $mult)));
	$nr2 = $nr1;

	$toff = 16 + ($headstock * $mult);
	$potmid = $toff + ($scale * $mult) - ((($pot / 9))*$mult);

	imagefilledrectangle ($canvas, 0, 0, $im_width, $im_height, $c['bg']);
	imagettftext($canvas, 12, 0, 8, 16, $c['black'], $font, "Scale:\n  " . $scale."\nPot:\n  ".$pot);

	imagesetthickness($canvas, 2);

	imagefilledrectangle ($canvas, $nl1, ($headstock * $mult) + 16, $nr1, $scale * $mult, $c['wood']);
	if ($instrument == "banjo") {
		imagefilledrectangle ($canvas, $nl2, ($headstock * $mult) + 16 + ($mult * $fs[$fifth]) + ((($fs[$fifth-2] - $fs[$fifth-1])/2)*$mult), $nr2, $scale * $mult, $c['wood']);
	}
	imagefilledrectangle ($canvas, $nl1 - 6, 16, $nr1 + 5, 16 + ($headstock * $mult) - 1, $c['wood']);

	if ($instrument == "banjo") {
		imagefilledellipse ($canvas, ($im_width / 2), $potmid, ($pot * $mult), ($pot * $mult), $c['white']);
		imageellipse ($canvas, ($im_width / 2), $potmid, ($pot * $mult), ($pot * $mult), $c['black']);
	} elseif ($instrument == "dulcimer") {
		imagefilledrectangle ($canvas, ($im_width / 2) - (($pot / 2)*$mult), $toff, ($im_width / 2) + (($pot / 2)*$mult), $toff + (($scale * $mult) + (($pot/2)*$mult)), $c['wood']);
	} else {
		imagefilledrectangle ($canvas, ($im_width / 2) - (($pot / 2)*$mult), $toff + ($fs[$frets] * $mult), ($im_width / 2) + (($pot / 2)*$mult), $toff + (($scale * $mult) + (($pot/2)*$mult)), $c['wood']);
	}
	imagefilledrectangle ($canvas, $nl2, $toff + ($mult * $scale) + 1, $nr2, $toff + ($mult * $scale) + 8, $c['black']);

	$lp = 0;
	for ($i=0;$i<sizeof($fs);$i++) {
		if ($fs[$i] >= $scale || $i > $frets) {
			break;
		}
		$lp = 16 + (($headstock + $fs[$i]) * $mult);

		if ($i < $fifth || $instrument != "banjo") {
			if ($instrument != "dulcimer" || in_array($i%11, $scales["mix"])) {
				imageline($canvas, $nl1, $lp, $nr1, $lp, $c['black']);
			}
		} else {
			imageline($canvas, $nl2, $lp, $nr1, $lp, $c['black']);
		}

		if ($i > 0 && ($instrument != "dulcimer" || in_array($i%11, $scales["mix"]))) {
			imagettftext($canvas, 10, 0, $nr2 + 4, $lp + 4, $c['black'], $font, $fs[$i]);
		}
	}
	unset($lp);

	header ("Content-type: image/png");
	imagepng($canvas); 

} else {
?>
<html>
<head>
<title>Fret Spacing Calculator</title>
</head>

<body style="margin-left:64px;margin-right:64px;">

<div style="float:left;margin-right:8px;">
<img src="<?=$_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING']."&draw"?>"/>
</div>
<h1>Fret Spacing</h1>

<p>Please select your instrument class, and enter the scale length. Please not that the type of instrument has no baring on the fret spacing. However, certain instrument have quite idiosyncratic designs; for example the banjo's short 5th string, or the dulcimer's full length neck and diatonic fretting. Guitar should cover anything you're not sure about (including, confusingly enough, the <i>4-string</i> banjo family.)</p>

<p>The drawing to the left is by no means intended to resemble the instrument, but it should be correct with regards to <i>important</i> features, like where the bridge is!</p>

<form method="get">
<b>Instrument</b> <select id="instrument" name="instrument">
	<option value="guitar" <?=$instrument=="guitar"?"selected=selected":""?>>Guitar</option>
	<option value="banjo" <?=$instrument=="banjo"?"selected=selected":""?>>5-String Banjo</option>
	<option value="dulcimer" <?=$instrument=="dulcimer"?"selected=selected":""?>>Appalachian Dulcimer</option>
</select><br>

<b>Scale</b> <input id="scale" value="" name="scale"> (default for this instrument <?=$instruments[$instrument]['scale']?>)<br>

<input type="submit" value="Calculate Scale"/>

<hr>
<?

	for ($i=1;$i<sizeof($fs);$i++) {
		print "<b>$i</b>: ".$fs[$i];
		if ($instrument == "dulcimer" && !in_array($i%11, $scales["mix"])) {
			print " <i>(<b>N/A</b>)</i>";
		}
		print "<br>\n";
	}
}
?>
</form>
</body>
</html>
<?

?>
