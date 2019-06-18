<?php
##
## Keyboard-to-Fretboard
##
## (c) 2013 Theo Parmakis (http://tpn.lowtech.org)
##
## This program is free software: you can redistribute it and/or modify
## it under the terms of the GNU Affero General Public License as
## published by the Free Software Foundation, either version 3 of the
## License, or (at your option) any later version.
## 
## This program is distributed in the hope that it will be useful,
## but WITHOUT ANY WARRANTY; without even the implied warranty of
## MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
## GNU Affero General Public License for more details.
## 
## Requirements:
##
##	jquery 1.8.3+
##	( http://code.jquery.com/jquery-1.8.3.min.js )
##
## 	Theo's Chord Generator ( http://tpn.lowtech.org/chordgen.php )
##	( http://tpn.lowtech.org/scripts/chordgen_php.tar.gz )
##
##	You must place chordgen.php and jquery-1.8.3.min.js in the same
##	directory as kb2fb.php - or place them elsewhere and modify the
##	paths accordingly.
##

if (file_exists("chordgen.php")) {
	$chordgenURL = "./";
} elseif (is_dir("chordgen")) {
	$chordgenURL = "chordgen/";
} else {
	$chordgenURL = "http://chordgen.rattree.co.uk/";
}

$notename = false;
#$section = array(40,76);
$kw = 36;

$inst = (isset($_GET['inst']) ? $_GET['inst'] : "guitar");

$instrument = array();

$instrument['guitar']['name'] = "Guitar (as sounded)";
$instrument['guitar']['tuning'] = "E,A,D,G,B,E";
$instrument['guitar']['notes'] = array(array(20),array(25),array(30),array(35),array(39),array(44));

$instrument['guitar_8']['name'] = "Guitar (as <i>notated</i>)";
$instrument['guitar_8']['tuning'] = "E,A,D,G,B,E";
$instrument['guitar_8']['notes'] = array(array(32),array(37),array(42),array(47),array(51),array(56));

$instrument['mandolin']['name'] = "Violin, Mandolin etc.";
$instrument['mandolin']['tuning'] = "G,D,A,E";
$instrument['mandolin']['notes'] = array(array(35),array(42),array(49),array(56));

$instrument['viola']['name'] = "Viola, Mandola, Tenor Banjo etc.";
$instrument['viola']['tuning'] = "C,G,D,A";
$instrument['viola']['notes'] = array(array(28),array(35),array(42),array(49));

$instrument['banjo4_irish']['name'] = "Irish Tenor Banjo, Octave Mandolin";
$instrument['banjo4_irish']['tuning'] = "G,D,A,E";
$instrument['banjo4_irish']['notes'] = array(array(23),array(30),array(37),array(44));

$instrument['banjo5_std']['name'] = "5-String Banjo (Open G)";
$instrument['banjo5_std']['tuning'] = "D,G,B,D";
$instrument['banjo5_std']['notes'] = array(array(30),array(35),array(39),array(42));

$instrument['banjo5_2c']['name'] = "5-String Banjo (Double C)";
$instrument['banjo5_2c']['tuning'] = "C,G,C,D";
$instrument['banjo5_2c']['notes'] = array(array(28),array(35),array(30),array(42));

$instrument['cello']['name'] = "Cello, Mandocello etc.";
$instrument['cello']['tuning'] = "C,G,D,A";
$instrument['cello']['notes'] = array(array(16),array(23),array(30),array(37));

$instrument['bass']['name'] = "Bass";
$instrument['bass']['tuning'] = "E,A,D,G";
$instrument['bass']['notes'] = array(array(8),array(13),array(18),array(23));

#$instrument['ukulele']['tuning'] = "G,C,E,A";
#$instrument['ukulele']['notes'] = array(array(47),array(30),array(41),array(59));

if (isset($instrument[$inst])) {
	for ($i=0;$i<sizeof($instrument[$inst]['notes']);$i++) {
		for ($j=1;$j<=24;$j++) {
			array_push($instrument[$inst]['notes'][$i], $instrument[$inst]['notes'][$i][0]+$j);
		}
	}
$section = array($instrument[$inst]['notes'][0][0],$instrument[$inst]['notes'][sizeof($instrument[$inst]['notes'])-1][14]);
	$section = array($instrument[$inst]['notes'][0][0],$instrument[$inst]['notes'][sizeof($instrument[$inst]['notes'])-1][24]);
	$blankchord = $chordgenURL."/?m=c&nocolor&instrument=guitar&showopen&rotate=90&nopadtop&fretno=24&chord=0&tuning=".$instrument[$inst]['tuning']."&cpos=".preg_replace("/[^,]/","-1",$instrument[$inst]['tuning']);
} else {
	$section = array(1,88);
	$blankchord = "";
}


$range = array("A","A#","B","C","C#","D","D#","E","F","F#","G","G#",
		"A","A#","B","C","C#","D","D#","E","F","F#","G","G#",
		"A","A#","B","C","C#","D","D#","E","F","F#","G","G#",
		"A","A#","B","C","C#","D","D#","E","F","F#","G","G#",
		"A","A#","B","C","C#","D","D#","E","F","F#","G","G#",
		"A","A#","B","C","C#","D","D#","E","F","F#","G","G#",
		"A","A#","B","C","C#","D","D#","E","F","F#","G","G#",
		"A","A#","B","C");


$keys = array("W","B","W","W","B","W","B","W","W","B","W","B");

?>
<html>
<head>
<title>Keyboard-to-Fretboard</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta name="description" content="A dynamic tool to display the notes from a piano keyboard on various instrument fretboards.">
<meta name="keywords" content="piano, guitar, banjo, free software, fretboard, keyboard">
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript">

var lock = false;

var cpos = new Array();

<?
//print_r ($instrument[$inst]['notes']);
if (isset($instrument[$inst])) {
	for ($i=1;$i<=88;$i++) {
		$cpos = "";
		for ($j=0;$j<sizeof($instrument[$inst]['notes']);$j++) {
			for ($k=0;$k<sizeof($instrument[$inst]['notes'][$j]);$k++) {
				if ($instrument[$inst]['notes'][$j][$k] == $i) {
					$cpos .= $k.",";
					continue 2;
				}
			}
			$cpos .= "-1,";
		}

		$cpos = preg_replace("/(.*),$/", "$1", $cpos);

		print "cpos[".($i-1)."] = \"".$cpos."\";\n";
	}
}
?>

function colorFret(key, col) {

	key = key.replace (/key_/, "");

	key = parseInt(key);
	
<?
if (isset($instrument[$inst])) {
?>
	if (col) {
		document.getElementById("fretimg").src = "<?=$chordgenURL?>?m=c&nocolor&instrument=guitar&showopen&rotate=90&nopadtop&fretno=24&chord=0&tuning=<?=$instrument[$inst]['tuning']?>&cpos=" + cpos[key];
	} else {
		document.getElementById("fretimg").src = "<?=$blankchord?>";
	}
<?
}
?>

}


$(document).ready(function () {
	$("div.keywhite").hover(
		(function(){ $(this).css('background-color','#FF2828'); if (!lock) { colorFret(this.attributes["name"].value, true); } }),
		(function(){ $(this).css('background-color',''); if (!lock) { colorFret(this.attributes["name"].value, false); } })
	);
	$("div.keywhite").click(
		function(){ colorFret(this.attributes["name"].value, true); lock = true; }
	);
	$("div.keywhite").dblclick(
		function(){ colorFret(this.attributes["name"].value, true); lock = false; }
	);
	$("div.keyblack").hover(
		(function(){ $(this).css('background-color','#FF2828'); if (!lock) { colorFret(this.attributes["name"].value, true); } }),
		(function(){ $(this).css('background-color',''); if (!lock) { colorFret(this.attributes["name"].value, false); } })
	);
	$("div.keyblack").click(
		function(){ colorFret(this.attributes["name"].value, true); lock = true; }
	);
	$("div.keyblack").dblclick(
		function(){ colorFret(this.attributes["name"].value, true); lock = false; }
	);

	$("div.keyboardinner").css ('width', ($("div.keywhite").width() * $("div.keywhite").length));
});
</script>
<link rel="stylesheet" type="text/css" href="chordgen_help.css"></link>
<style class="text/css">
h1 {font-size:1.2em;}

div.notename {
	position:absolute; bottom:0; text-align:center; width:100%; font-size:2em;
}

div.notenumber {
	display:block; position:absolute; top:154; width:36px; text-align:center; font-size:1.25em;
}

div.keywhite {
	position:absolute; top:0px; width:36px; height:150px; background-color:#FFFFFF; border:1px solid #000000; z-index:0;
}

div.keyblack {
	position:absolute; top:0px; width:24px; height:105px; background-color:#000000; border:1px solid #000000; z-index:1;
}

div#key_39, span.midC {
	background-color: #FFFF00;
}

div#key_48, span.A440 {
	background-color: #0000AA; color:#FFFFFF;
}

div.keyboarddiv {
	padding:0px; position:absolute; top:0px; left:4px; height:196px; right:4px; overflow-x:auto; overflow-y:hidden; max-width:99%;
}

div.keyboardinner { margin-right:auto; margin-left:auto;  height:196px; }
div.keyboardinner2 { position:relative; height: 196px;}


div.lower {
	margin-top:200px; left:8px; max-width:800px; margin-left:auto; margin-right:auto;
}

div.subtitle {
	float:right;font-weight:bold;font-style:italic;margin-top:0.20em;
}

div.instrumentsdiv {
	float:left;padding-right:16px;margin-right:16px;margin-bottom:16px; border-right:2px solid #000000;
}

ul.instruments li {
	font-size:1.01em;
	font-weight:bold;
}

a {
	color:#660099;
}
a:hover {
	color:#EE7777;
}
</style>
</head>

<body>
<div class="keyboarddiv">
	<div class="keyboardinner">
	<div class="keyboardinner2">
<?

$ks = 0;
for ($i=$section[0]-1;$i<=$section[1]-1;$i++) {

	if ($inst && in_array($i+1,$instrument[$inst]['notes'])) {
		$sf = "s".(array_search($i+1,$instrument[$inst]['notes']))."f0";
	} else {
		$sf = "";
	}
	if ($keys[$i % 12] == "W") {
?>
<div class="keywhite" id="key_<?=$i?>" name="key_<?=$i?>" style="left:<?=$kw*$ks?>;"><?=$notename ? "<div class=\"notename\">".$range[$i]."</div>" : ""?>&nbsp;</div>
<div class="notenumber" style="left:<?=$kw*$ks?>;"><?=$i+1?></div>
<?
		$ks++;
	} elseif ($keys[$i % 12] == "B") {
?>
<div class="keyblack" id="key_<?=$i?>" name="key_<?=$i?>" style="left:<?=($kw*$ks+1)-12-2?>px;">&nbsp;</div>
<?
	}

}

?>
</div>
</div>
</div>

<div class="lower">
		<div class="section" style="text-align:center;overflow-x:auto;">
<h2><?=$instrument[$inst]['name']?></h2>
<? if ($inst) { ?>
	<img id="fretimg" src="<?=$blankchord?>">
<? } ?>
</div>
	<div class="intro">
<div class="instrumentsdiv">

		<ul class="instruments">
<?
foreach (array_keys($instrument) as $i) {
	print "<li><a href=\"?inst=".$i."\">".$instrument[$i]['name']."</li>\n";
}
?>
		</ul>
</div>

		<div class="section">
		<div class="subtitle">
		a tool by <a href="http://tpn.lowtech.org">Theo Parmakis</a>
		</div>
		<h1>Keyboard-to-Fretboard</h1>

		<p>Welcome to <i>Keyboard-to-Fretboard</i>.  This tool is designed to present an interactive visual representation of the relationship between the notes on a piano keyboard and where the same notes on the fretboard of a stringed instrument, such as a guitar, mandolin etc.  This is one of a set of music and instrument related tools, along with <a href="http://chordgen.rattree.co.uk">Theo's Chord Generator</a>.</p>
		
		<p>To use the tool, select your instrument from the following list.  The piano keyboard at the top will then change to reflect the playable range<b>*</b> of your chosen instrument, and the fretboard diagram will change to reflect the tuning and stringing of the instrument.  You can then hover the keys on the keyboard, and you will be shown the position(s) at which you can play those same notes on your chosen instrument.  If you wish to lock the fret diagram to a specific note, just click the keyboard rather than hovering (double clicking unlocks it again.)</p>

		<p>Regarding the virtual piano keyboard, a few visual aids are provided: <b><span class="midC">Middle C is displayed in yellow</span></b> and the <b><span class="A440">the A above Middle C is shown in blue</span></b> (this is the international reference pitch, usually pitched at 400 Hz.)</p>
		<p>There are a few caveats:  accurately representing unique instrument features such as the 5-string banjo's truncated 5th string is rather hard to do, and/but it's taken for granted that if you play the instrument, you'll know how to interpret the information.  Also, instruments such as the guitar are often notated in sheet music an octave above their actual <i>sounding pitch</i>.  For this reason, there are two entries for these instruments, so that you can choose the one which best fits your purpose.  This is done partly in order to make them fit better onto the treble clef (without excessive ledger lines), and also because music is often played on these instruments an octave below it is played on other instruments.</p>

		<p><b>(*)</b> The practically playable upper range may vary from instrument to instrument.  24 frets are shown, but in reality you may only get 21 or 22 frets on your neck unless you're playing an electric guitar. The minimum number of frets is probably 17, for short scale tenor banjo.</p>

		<p>This tool is free software (released under the GNU AGPLv3) - the source code is bundled with the <b>Chord Generator</b> source, and can be downloaded <a href="http://tpn.lowtech.org/scripts/chordgen_php.tar.gz">here</a>.</p>
	</div>

	</div>
</div>
</body>
</html>
