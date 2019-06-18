<?php
##
## Chord Generator
##
## (c) 2011-2013 Theo Parmakis (http://tpn.lowtech.org)
##
## See chordgen.php?help for documentation!
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
##     GDLib (php5-gd)
##     Bitstream-Vera-Sans-Bold Font
##
## DIRTITLE
##
## mkHeader("Chord Generator");
##

error_reporting(E_ALL);

require_once (dirname($_SERVER["SCRIPT_FILENAME"])."/chordgen.inc.php");

$DEBUG = @$_GET['debug'] + 0;

$tries = 0;

if (isset($_GET['instrument'])) {
	$instrument = $_GET['instrument'];
	$gotInstrument = true;
} else {
	$instrument = "banjo";
	$gotInstrument = false;
}

foreach (array_keys ($Tunings) as $i) {
	if (isset($_GET[$i])) {
		$instrument = $i;
	}
}

require_once (dirname($_SERVER["SCRIPT_FILENAME"])."/chordgen_html.inc.php");
require_once (dirname($_SERVER["SCRIPT_FILENAME"])."/chordgen_help.inc.php");


## modes: i = main interface (default); c = chord diagram

$mode		= isset($_GET['m']) ? $_GET['m'] : "i";

if ($mode == "i") {
	fixRedirect();
}

$random		= isset($_GET['random']) ? true : false;
$jmode		= isset($_GET['jmode']) ? $_GET['jmode'] : "c";
$markFret	= array(5,7,10,12,17,19,22,24);
$printFret	= isset($_GET['nofretnumber']) ? false : true;
$maxFret	= isset($_GET['fretno']) ? $_GET['fretno'] : 12;
$showScale	= isset($_GET['showscale']) ? true : false;
$showOpen	= isset($_GET['showopen']) ? true : false;
$infoText	= isset($_GET['noinfotext']) ? false : true;
$printNote	= isset($_GET['noprintnote']) ? false : true;
$nopadtop	= isset($_GET['nopadtop']) ? true : false;
$colourNote	= @$_GET['nocolourchords'] == "on" ? true : false;
$rotateImage	= isset($_GET['rotate']) ? ($_GET['rotate'] + 0) : 0;
$allowPartial	= (@$_GET['partial'] == "on" ? true : false);
$fixEnharm	= (@$_GET['fixenharm'] == "on" ? true : false);
$cutout		= 0;
$clipFret	= (!isset($_GET['noclipfret']) && ! isset($_GET['fretno'])) ? true : false;
$maxOffset	= 11;
$key		= 0;
$capo		= (isset($_GET['capo']) ? $_GET['capo'] : 0);
$offset		= (isset($_GET['offset']) && $_GET['offset'] <= $maxOffset) ? $_GET['offset'] : 0;
$sOffset	= array();
$offset		= $offset > $capo ? $offset : $capo;
$oOffset	= $offset;
$diChords	= true; //@$_GET['dichords'] == "on" ? true : false;
$clipScale	= isset($_GET['clipscale']) ? true : false;
$findAlt	= true;
$handed		= isset($_GET['handed']) ? $_GET['handed'] : "right";
$keyoffset	= (isset($_GET['key']) ? $_GET['key'] : 0);
$scale		= isset($_GET['scale']) ? $_GET['scale'] : "single";
$cPosManual	= isset($_GET['cpos']) && $_GET['cpos'] != "" ? preg_split("/,/",$_GET['cpos']) : array();
$revOffset	= false;
$minHandspan	= 24;
$maxHandspan	= isset($_GET['maxhs']) ? $_GET['maxhs'] : 4;
$minChord	= array();
$tuning		= array();
$origTuning	= array();
$altmatch	= isset($_GET['alt']) ? $_GET['alt'] : 0;
$altno		= $altmatch > 12 ? $altmatch : 12;
$prefersf	= isset($_GET['prefersf']) ? $_GET['prefersf'] : "";
$displayScale	= true;
$dyk		= isset($_GET['dyk']) ? true : false;
$colorcode	= isset($_GET['nocolor']) ? false : true;
$revLh		= (@$_GET['revlh'] == "on" ? true : false);
$sheetCont	= isset($_GET['sheet']) ? urldecode($_GET['sheet']) : "";

if ($handed == "left" && $revLh) {
	$cPosManual = array_reverse ($cPosManual);
}


if ($scale == "single") {
	$diChords = false;
}

$fonts = array("/usr/share/fonts/truetype/ttf-dejavu/DejaVuSans-Bold.ttf",
	dirname($_SERVER["SCRIPT_FILENAME"])."/DejaVuSans-Bold.ttf");

$font = false;

foreach ($fonts as $f) {
	if (file_exists($f)) { $font = $f; break; }
}


$tuning = array();

if (sizeof($tuning) == 0) {
	if (isset($_GET['tuning'])) {
		$tuning = preg_split("/ *[,-] */", $_GET['tuning'], -1, PREG_SPLIT_NO_EMPTY);
		if ($handed == "left" && $revLh) {
			$tuning = array_reverse ($tuning);
		}

		for ($i=0;$i<sizeof($tuning);$i++) {
			$tuning[$i] = ucfirst($tuning[$i]);
		}
		$gotTuning = true;
	} else {
		$tuning = preg_split("/,/",$Tunings[$instrument][0]["tuning"]);
		$gotTuning = false;
	}
}


$chord = false;

if ($random) {
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

	while (!$chord) {
		$random = randomChord(($gotInstrument ? $instrument : false), ($gotTuning ? $tuning : false));

		$chord = $random[0];
		$instrument = $random[2];
		$tuning = $random[1];

		#if (absQual($chord) == "m") {
		#	$scale = "aeo";
		#} else {
		#	$scale = "ion";
		#}
		$sOffset = array_fill(0,sizeof($tuning),0);
		$posMatch = chordPos($tuning,$chord,$offset,$altno);
		if (sizeof($posMatch) == 0) {
			$chord = false;
		}
		$cPos = array_pop($posMatch);
	}
	if ($GLOBALS['DEBUG'] > 1) {
		print "Random mode selected " . $chord . " in " . join(",",$tuning);
	}
} elseif (isset($_GET['chord'])) {
	if ($diChords) {
		$chord = $_GET['chord'];
	} else {
		$chord = $_GET['chord'].@$_GET['quality'];
	}

	$origChord = absNote($chord);
	$origQual = absQual($chord);
	$chord = absNote($chord);

	if (preg_match("/^[A-G]b/",$chord)) {
		$chord = preg_replace("/^([A-G])b/", '$1', $chord);
		$enh = array_search($chord, $notes);
		$chord = $notes[$enh - 2]."#";
	}

	if ($showScale) { 
		$chord = $chord.$diChord[$scale][0];
	} else {
		$chord = $chord.$origQual;
	}
} else {
	$origChord = false;
	$origQual = false;
	$chord = false;
}


if ($scale == "chrom" && $fixEnharm) {
	$showEnh = true;
}

if ($scale == "chrom" && absQual($chord) != "") {
	for ($i=0;$i<sizeof($diChord["chrom"]);$i++) {
		$diChord["chrom"][$i] = absQual($chord);
	}
}

for ($i=0;$i<sizeof($tuning);$i++) {
	$sOffset[$i] = $offset;
}

if (preg_match("/^[a-zA-Z]/",$tuning[0]) && preg_match("/^[0-9]*$/",join("",array_slice($tuning,1,sizeof($tuning))))) {
	$tuning = rel2Notes ($tuning);
}

$fullTuning = $tuning;

if ($instrument == "banjo" && sizeof($tuning) == 5) {
	$tuning = array_slice($tuning,1,4);
} elseif ($instrument == "banjo" && sizeof($tuning) != 4 && preg_match("/^[a-g]/",$_GET['tuning'])) {
	$tuning = array_slice($tuning,1,sizeof($tuning) - 1);
}

$origTuning = $tuning;

$tuning = fixEnharmonic($tuning);

/*
if ($m == "o" && $chord == "") {
	$fretOffset = 0;
	
	if (!$chord = chordName(capoAdd($tuning,$capo))) {
		$chord = false;
	}
}
 */

if (isset($_GET['help']) || $mode == "h") {
	showHelp();
	exit;
} else {
	$cPos = array();


	$scroot = $chord;

	if (sizeof($cPosManual) > 0) {
		if (sizeof($cPosManual) == sizeof($tuning)) {

			if ($chord!="0") {
				if (absNote($chord)) {
					$enhScale = mkScale($chord, $scale, $prefersf, false);
					if ($scale != "single" && $keyoffset > 0) {
						$chord = $notes[array_search($chord, $notes) + $scales[$scale][$keyoffset-1]].$diChord[$scale][$keyoffset-1];
					}
				} else {
					$chord = chordName (pos2Notes ($tuning, $cPosManual));
					$enhScale = mkScale($chord,$scale, $prefersf, $showScale);
				}
			} else {
				$enhScale = array();
			}
			if ($GLOBALS['DEBUG'] > 1) {
				print "from the manual chord position " . join(",",$cPosManual).", we get the notes: ";
				print join (",", (pos2Notes($tuning, $cPosManual)));
				print " - which yields the chord: ". $chord . "<br>\n";
			}
			if ($GLOBALS['DEBUG'] > 2) {
				//print handSpan(array($cPosManual,pos2Notes($tuning,$cPosManual), chordName (pos2Notes ($tuning, $cPosManual)),$chord));
			}
			$cPos = $cPosManual;

		} else {
			drawFail("\n\nThe entered\nchord doesn't\nfit this tuning");
			exit;
		}

		$posMatch = array();
	} else {
		$enhScale = mkScale($chord, $scale, $prefersf, false);
		if (isset($_GET['key']) && $_GET['key'] > 0 && isset($_GET['scale'])) {
			$key = ($_GET['key'] - 1) % sizeof($scales[$scale]);
			if ($diChords || $scale == "chrom") {
				$chord = $notes[array_search(absNote($chord), $notes) + $scales[$scale][$key]] . ($diChord[$scale][$key]);
			} elseif ($_GET['key'] != 1) {
				$chord = $notes[array_search(absNote($chord), $notes) + $scales[$scale][$key]];
			}
		} elseif (!$chord) {
			$chord = $Tunings[$instrument][0]["defkey"].$diChords[$Tunings[$instrument][0]["defscale"]][0];
		}

		if (!$showScale) {
			if (!$posMatch = chordPos($tuning, $chord, $offset, $altno)) {
				drawFail("    $chord\ncould not be\ngenerated for\n    ".join(",",$tuning));
				exit;
			}

			$cPos = $posMatch[$altmatch];
			$posMatch = array_merge (array_slice ($posMatch, 0, $altmatch), array_slice($posMatch, $altmatch + 1));
		} else {
			$posMatch = array();
			$cPos = array();
		}

	}

	if ($mode == "c") {
		if (isset($_GET['blank'])) {
			drawFail(false);
			exit;
		}

		if (!sizeof($tuning) >= 3) {
			drawFail ("\n\nTuning must\nbe 3 or more\nstrings.");
			exit;
		}

		if (!in_array(absQual($chord), $cQualities)) {
			drawFail("No such quality\n    '".absQual($chord)."'");
			exit;
		}



		if ($showScale) {
			if ($sPos = scalePos($tuning, $enhScale)) {
				drawChord($sPos, $chord, $tuning, $origTuning, $scale, $enhScale, $capo, $handed,  "scale");
			}
			exit;

		} else {

			if (isset($_GET['describe'])) {
				describeChord($cPos, $chord, $tuning, $enhScale);
				exit;
			} elseif (isset($_GET['json'])) {
				jsonChord($instrument, $tuning, $fullTuning, $cPos, $chord, $scroot, $scale, $keyoffset, $capo, $handed, $enhScale, $posMatch, $jmode, $dyk);
				exit;
			} elseif (isset($_GET['numeric'])) {
				numericChord($cPos, $chord, $tuning);
				exit;
			} else {
				drawChord($cPos, $chord, $tuning, $origTuning, $scale, $enhScale, $capo, $handed,  "chord");
				exit;
			}
		}


	} else { ## The Main Interface
		## Redirect to the correct tuning if we came from a search result!
		if ($tuning = getSearch()) {
			$def = getDef($tuning[1]);
			header ("Location: ?".$tuning[0]."&tuning=".urlencode($tuning[1])."&chord=".$def[0].($def[1] ? "&scale=".$def[1] : ""));
		}

		htmlMainIntf();
		exit;
	}
}

exit;

?>
