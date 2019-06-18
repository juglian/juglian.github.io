<?php

$notes = array(	"A", "A#", "B", "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#",
		"A", "A#", "B", "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#",
		"A", "A#", "B", "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#",
		"A", "A#", "B", "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#",
		"A", "A#", "B", "C", "C#", "D", "D#", "E", "F", "F#", "G", "G#");

$cQualities = array(
		"",	## Major
		"m",	## Minor
		"7",	## Dominant 7th
		"maj7",	## Major 7th
		"m7",	## Minor 7th
		"sus2",	## Suspended 2nd
		"sus4",	## Suspended 4th
		"dim",	## Diminished
		"aug",	## Augmented
		"6",	## 6th
		"m6",	## minor 6th
		"9",	## 9th
		"m9",	## minor 9th
		"5",	## no 3rd
		"4",	## added fourth
		"m4",	## Minor, added fourth
		"dim7",	## Diminished 7th
	);

$scaleNames = array();

$scaleNames["ion"] = "Ionian";
$scaleNames["dor"] = "Dorian";
$scaleNames["phr"] = "Phrygian";
$scaleNames["lyd"] = "Lydian";
$scaleNames["mix"] = "Mixolydian";
$scaleNames["aeo"] = "Aeolian";
$scaleNames["moh"] = "Harmonic Minor";
$scaleNames["loc"] = "Locrian";
$scaleNames["pent"] = "Pentatonic";
$scaleNames["mpent"] = "Minor Pentatonic";
$scaleNames["rpent"] = "Ritusen";
$scaleNames["chrom"] = "Chromatic";
$scaleNames["single"] = "Single Chord";
$scaleNames["altq"] = "All Qualities";

$scales = array();

$scales["ion"] = array( 0, 2, 4, 5, 7, 9, 11 );  ## Ionian - Major Scale
$scales["dor"] = array( 0, 2, 3, 5, 7, 9, 10 );  ## Dorian - Minor b3 b7
$scales["phr"] = array( 0, 1, 3, 5, 7, 8, 10 );  ## Phrygian - Minor b2 b3 b7 b6
$scales["lyd"] = array( 0, 2, 4, 6, 7, 9, 11 );  ## Lydian - Major #4
$scales["mix"] = array( 0, 2, 4, 5, 7, 9, 10 );  ## Mixolydian - b7
$scales["aeo"] = array( 0, 2, 3, 5, 7, 8, 10 );  ## Aeolian - Natural Minor Scale b3 b6 b7
$scales["moh"] = array( 0, 2, 3, 5, 7, 8, 11 );  ## Harmonic Minor Scale b3 b6
$scales["loc"] = array( 0, 1, 3, 5, 6, 8, 10 );  ## Locrian - Diminished b2 b3 b5 b6 b7
$scales["pent"] = array( 0, 2, 4, 7, 9 );  ## Pentatonic Major Scale
$scales["mpent"] = array( 0, 3, 5, 7, 10 );  ## Pentatonic Minor Scale
$scales["rpent"] = array( 0, 2, 5, 7, 9 );  ## Ritusen - Major Scale
$scales["chrom"] = array( 0, 0, 0, 1, 1, 1, 2, 2, 2, 3, 3, 3, 4, 4, 4, 5, 5, 5, 6, 6, 6, 7, 7, 7, 8, 8, 8, 9, 9, 9, 10, 10, 10, 11, 11, 11 );  ## Chromatic
$scales["single"] = array( 0 );  ## No scale, just single chord
$scales["altq"] = array_fill (0,sizeof($cQualities),0);  ## Alternate qualities of the same chord
$scales["dim"] = array( 0, 2, 3, 5, 6, 8, 10 );  ## Diminished
$scales["dim7"] = array( 0, 2, 3, 5, 6, 8, 10 );  ## Diminished

$diChord["ion"] = array( "", "m", "m", "", "", "m", "dim" );
$diChord["dor"] = array( "m", "m", "", "", "m", "dim", "" );
$diChord["phr"] = array( "m", "", "", "m", "dim", "", "m" );
$diChord["lyd"] = array( "", "", "", "dim", "", "m", "m", );
$diChord["mix"] = array( "", "m", "dim", "", "m", "m", "" );
$diChord["aeo"] = array( "m", "dim", "", "m", "m", "", "" );
$diChord["moh"] = array( "m", "dim", "", "m", "", "", "" );
$diChord["loc"] = array( "dim", "", "m", "m", "", "", "m" );
$diChord["pent"] = array( "", "", "", "", "" );
$diChord["mpent"] = array( "", "", "", "", "" );
$diChord["rpent"] = array( "", "", "", "", "" );
$diChord["chrom"] = array( "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7", "", "m", "7" );
$diChord["single"] = array( "" );
$diChord["altq"] = $cQualities;

$strings = array();

$Tunings = array();

$strings['banjo'] = 4; ## that's strings you can make chords on, BTW!
$Tunings['banjo'] = array();

$Tunings['banjo'][0] = array("name" => "Open G", "altname" => "High Bass", "tuning" => "g,D,G,B,D", "defkey" => "G", "defscale" => "chrom");
$Tunings['banjo'][1] = array("name" => "Open A", "altname" => "", "tuning" => "a,E,A,C#,E", "defkey" => "A", "defscale" => "ion");
$Tunings['banjo'][2] = array("name" => "Double D", "altname" => "", "tuning" => "a,D,A,D,E", "defkey" => "D", "defscale" => "ion");
$Tunings['banjo'][3] = array("name" => "A Modal", "altname" => "Sawmill", "tuning" => "a,E,A,D,E", "defkey" => "A", "defscale" => "dor");
$Tunings['banjo'][4] = array("name" => "Double C", "altname" => "", "tuning" => "g,C,G,C,D", "defkey" => "C", "defscale" => "ion");
$Tunings['banjo'][5] = array("name" => "G Modal", "altname" => "Sawmill", "tuning" => "g,D,G,C,D", "defkey" => "G", "defscale" => "dor");
$Tunings['banjo'][6] = array("name" => "D Standard", "altname" => "", "tuning" => "a,D,A,C#,E", "defkey" => "D", "defscale" => "ion");
$Tunings['banjo'][7] = array("name" => "C Standard", "altname" => "", "tuning" => "g,C,G,B,D", "defkey" => "C", "defscale" => "ion");
$Tunings['banjo'][8] = array("name" => "Open D", "altname" => "Graveyard", "tuning" => "f#,D,F#,A,D", "defkey" => "D", "defscale" => "ion");
$Tunings['banjo'][9] = array("name" => "Open C", "altname" => "", "tuning" => "g,C,G,C,E", "defkey" => "C", "defscale" => "ion");
$Tunings['banjo'][10] = array("name" => "Tenor", "altname" => "Fifths", "tuning" => "G,D,A,E", "defkey" => "G", "defscale" => "chrom");
$Tunings['banjo'][11] = array("name" => "G Minor", "altname" => "", "tuning" => "g,D,G,Bb,D", "defkey" => "G", "defscale" => "aeo");
$Tunings['banjo'][12] = array("name" => "A Minor", "altname" => "", "tuning" => "a,E,A,C,E", "defkey" => "A", "defscale" => "aeo");
$Tunings['banjo'][13] = array("name" => "Old G", "altname" => "", "tuning" => "g,D,G,D,E", "defkey" => "G", "defscale" => "ion");
$Tunings['banjo'][14] = array("name" => "Triple D", "altname" => "Darling Cora", "tuning" => "f#,D,A,D,D", "defkey" => "D", "defscale" => "ion");
$Tunings['banjo'][15] = array("name" => "Plectrum", "altname" => "Chicago", "tuning" => "g,D,G,B,E", "defkey" => "G", "defscale" => "chrom");
$Tunings['banjo'][16] = array("name" => "D Modal", "altname" => "Dock Boggs", "tuning" => "f#,D,G,A,D", "defkey" => "D", "defscale" => "dor");
$Tunings['banjo'][17] = array("name" => "G Bass", "altname" => "", "tuning" => "g,G,G,B,D", "defkey" => "G", "defscale" => "ion");
$Tunings['banjo'][18] = array("name" => "", "altname" => "Little Birdie", "tuning" => "e,C,G,A,D", "defkey" => "C", "defscale" => "ion");
$Tunings['banjo'][19] = array("name" => "", "altname" => "Cumberland Gap", "tuning" => "f#,B,E,A,D", "defkey" => "D", "defscale" => "ion");
$Tunings['banjo'][20] = array("name" => "", "altname" => "Lost Gander", "tuning" => "f#,D,E,A,D", "defkey" => "G", "defscale" => "ion");
$Tunings['banjo'][21] = array("name" => "", "altname" => "Willie Moore", "tuning" => "g,D,G,A,D", "defkey" => "D", "defscale" => "dor");
$Tunings['banjo'][22] = array("name" => "Sandy River Belle", "altname" => "", "tuning" => "f,C,F,C,D", "defkey" => "F", "defscale" => "ion");
$Tunings['banjo'][22] = array("name" => "Briggs", "altname" => "", "tuning" => "d,G,D,F#,A", "defkey" => "G", "defscale" => "ion");
$Tunings['banjo'][23] = array("name" => "Briggs", "altname" => "High Bass", "tuning" => "d,A,D,F#,A", "defkey" => "D", "defscale" => "ion");
$Tunings['banjo'][24] = array("name" => "Minstrel", "altname" => "", "tuning" => "e,A,E,G#,B", "defkey" => "A", "defscale" => "ion");
$Tunings['banjo'][25] = array("name" => "Minstrel", "altname" => "High Bass", "tuning" => "e,B,E,G#,B", "defkey" => "E", "defscale" => "ion");
$Tunings['banjo'][26] = array("name" => "Double A", "altname" => "", "tuning" => "c#,A,E,A,B", "defkey" => "A", "defscale" => "ion");
$Tunings['banjo'][27] = array("name" => "Roustabout", "altname" => "", "tuning" => "g,C,G,Bb,D", "defkey" => "G", "defscale" => "dor");

$strings['guitar'] = 6;
$Tunings['guitar'] = array();
$Tunings['guitar'][0] = array("name" => "Standard Tuning", "altname" => "", "tuning" => "E,A,D,G,B,E", "defkey" => "A", "defscale" => "chrom");
$Tunings['guitar'][1] = array("name" => "Drop D", "altname" => "", "tuning" => "D,A,D,G,B,E", "defkey" => "D", "defscale" => "chrom");
$Tunings['guitar'][2] = array("name" => "DAD-GAD", "altname" => "D Modal", "tuning" => "D,A,D,G,A,D", "defkey" => "D", "defscale" => "chrom");
$Tunings['guitar'][3] = array("name" => "Drop C", "altname" => "", "tuning" => "C,G,C,F,A,D", "defkey" => "F", "defscale" => "ion");
$Tunings['guitar'][4] = array("name" => "Open D", "altname" => "Vestapol", "tuning" => "D,A,D,F#,A,D", "defkey" => "D", "defscale" => "ion");
$Tunings['guitar'][5] = array("name" => "Open E", "altname" => "", "tuning" => "E,B,E,G#,B,E", "defkey" => "E", "defscale" => "ion");
$Tunings['guitar'][6] = array("name" => "Open G", "altname" => "Chicago", "tuning" => "D,G,D,G,B,D", "defkey" => "G", "defscale" => "ion");
$Tunings['guitar'][7] = array("name" => "Csus2", "altname" => "", "tuning" => "C,G,C,G,C,D", "defkey" => "C", "defscale" => "ion");
$Tunings['guitar'][8] = array("name" => "Gsus4/4", "altname" => "Orkney", "tuning" => "C,G,D,G,C,D", "defkey" => "G", "defscale" => "dor");
$Tunings['guitar'][9] = array("name" => "Gsus4", "altname" => "G Modal", "tuning" => "D,G,D,G,C,D", "defkey" => "G", "defscale" => "dor");
$Tunings['guitar'][10] = array("name" => "C9sus4", "altname" => "", "tuning" => "C,G,C,F,C,D", "defkey" => "C", "defscale" => "ion");
$Tunings['guitar'][11] = array("name" => "G/4", "altname" => "Low Bass G", "tuning" => "C,G,D,G,B,D", "defkey" => "G", "defscale" => "ion");
$Tunings['guitar'][12] = array("name" => "New Carthy", "altname" => "", "tuning" => "C,G,C,D,G,A", "defkey" => "G", "defscale" => "chrom");
$Tunings['guitar'][13] = array("name" => "Old Carthy", "altname" => "A Pipe", "tuning" => "D,A,D,E,A,E", "defkey" => "A", "defscale" => "chrom");
$Tunings['guitar'][14] = array("name" => "DAD-GAC", "altname" => "Klingon", "tuning" => "D,A,D,G,A,C", "defkey" => "D", "defscale" => "mix");
$Tunings['guitar'][15] = array("name" => "Open C", "altname" => "", "tuning" => "C,G,C,G,C,E", "defkey" => "C", "defscale" => "ion");
$Tunings['guitar'][16] = array("name" => "Open C5", "altname" => "", "tuning" => "C,G,C,G,C,C", "defkey" => "C", "defscale" => "ion");
$Tunings['guitar'][17] = array("name" => "Fifths", "altname" => "New Standard", "tuning" => "C,G,D,A,E,G", "defkey" => "A", "defscale" => "chrom");
$Tunings['guitar'][18] = array("name" => "Double Drop D", "altname" => "", "tuning" => "D,A,D,G,B,D", "defkey" => "G", "defscale" => "ion");

$strings['guitar'] = 4;
$Tunings['ukulele'] = array();
$Tunings['ukulele'][0] = array("name" => "Concert", "altname" => "", "tuning" => "G,C,E,A", "defkey" => "C", "defscale" => "ion");
$Tunings['ukulele'][1] = array("name" => "Soprano", "altname" => "", "tuning" => "A,D,F#,B", "defkey" => "D", "defscale" => "ion");
$Tunings['ukulele'][2] = array("name" => "Open C", "altname" => "", "tuning" => "G,C,E,G", "defkey" => "C", "defscale" => "ion");

$strings['mandolin'] = 4;
$Tunings['mandolin'] = array();
$Tunings['mandolin'][0] = array("name" => "All Fifths", "altname" => "Italian", "tuning" => "G,D,A,E", "defkey" => "D", "defscale" => "chrom");
$Tunings['mandolin'][1] = array("name" => "High Bass", "altname" => "", "tuning" => "A,D,A,E", "defkey" => "D", "defscale" => "ion");
$Tunings['mandolin'][2] = array("name" => "Sawmill", "altname" => "Cross A", "tuning" => "A,E,A,E", "defkey" => "A", "defscale" => "ion");
$Tunings['mandolin'][3] = array("name" => "Irish", "altname" => "Gee-Dad", "tuning" => "G,D,A,D", "defkey" => "A", "defscale" => "ion");
$Tunings['mandolin'][4] = array("name" => "Open A", "altname" => "", "tuning" => "A,E,A,C#", "defkey" => "A", "defscale" => "ion");
$Tunings['mandolin'][5] = array("name" => "D Drone", "altname" => "", "tuning" => "D,D,A,D", "defkey" => "D", "defscale" => "ion");

$strings['mandola'] = 4;
$Tunings['mandola'] = array();
$Tunings['mandola'][0] = array("name" => "All Fifths", "altname" => "", "tuning" => "C,G,D,A", "defkey" => "G", "defscale" => "chrom");
$Tunings['mandola'][1] = array("name" => "High Bass", "altname" => "", "tuning" => "D,G,D,A", "defkey" => "G", "defscale" => "chrom");

function chord ($root,$strings) {
	global $notes;

	if (!$root) {
		return false;
	}

	$key = array_search(absNote($root), $notes);

	if (absQual($root) == "m")		{ $chord = array($notes[$key], $notes[$key+3], $notes[$key+7]); } ## Minor
	elseif (absQual($root) == "aug")	{ $chord = array($notes[$key], $notes[$key+4], $notes[$key+8]); } ## Augmented
	elseif (absQual($root) == "dim")	{ $chord = array($notes[$key], $notes[$key+3], $notes[$key+6]); } ## Diminished
	elseif (absQual($root) == "sus2")	{ $chord = array($notes[$key], $notes[$key+2], $notes[$key+7]); } ## Suspended 2nd
	elseif (absQual($root) == "sus4")	{ $chord = array($notes[$key], $notes[$key+5], $notes[$key+7]); } ## Suspended 4th
	elseif (absQual($root) == "9")		{ $chord = array($notes[$key], $notes[$key+4], $notes[$key+7], $notes[$key+14]); } ## Added 9th
	elseif (absQual($root) == "m9")		{ $chord = array($notes[$key], $notes[$key+3], $notes[$key+7], $notes[$key+14]); } ## Added 9th
	elseif (absQual($root) == "5")		{ $chord = array($notes[$key], $notes[$key+7]); } ## No 3rd Chord
	elseif (absQual($root) == "6")		{ $chord = array($notes[$key], $notes[$key+4], $notes[$key+7], $notes[$key+9]); } ## Major 6th
	elseif (absQual($root) == "m6")		{ $chord = array($notes[$key], $notes[$key+3], $notes[$key+7], $notes[$key+9]); } ## Minor 6th
	elseif (absQual($root) == "maj7")	{ $chord = array($notes[$key], $notes[$key+4], $notes[$key+7], $notes[$key+11]); } ## Major 7th
	elseif (absQual($root) == "m7")		{ $chord = array($notes[$key], $notes[$key+3], $notes[$key+7], $notes[$key+10]); } ## Minor 7th
	elseif (absQual($root) == "7") 		{ $chord = array($notes[$key], $notes[$key+4], $notes[$key+7], $notes[$key+10]); } ## Dominant 7th
	elseif (absQual($root) == "4") 		{ $chord = array($notes[$key], $notes[$key+4], $notes[$key+5], $notes[$key+7]); } ## added 4
	elseif (absQual($root) == "m4") 	{ $chord = array($notes[$key], $notes[$key+3], $notes[$key+5], $notes[$key+7]); } ## minor added 4
	elseif (absQual($root) == "dim7")	{ $chord = array($notes[$key], $notes[$key+3], $notes[$key+6], $notes[$key+9]); } ## Diminished 7th
	elseif (absQual($root) == "u") 		{ $chord = array($notes[$key]); } ## Unison "Chord"
	else 					{ $chord = array($notes[$key], $notes[$key+4], $notes[$key+7]); } ## Major 
	if (sizeof($chord) == 4 && $strings < 4) {
		$chord = array($chord[0],$chord[1],$chord[3]);
	}
	return ($chord);

	
}

function chordPos ($tuning, $chord, $offset=0, $altno) {
	global $notes;
	global $maxFret;
	global $findAlt;
	global $maxOffset;
	global $allowPartial;
	global $capo;
	global $sOffset;
	global $revOffset;
	global $minHandspan;
	global $maxHandspan;
	global $minChord;
	global $altno;

	if (!is_array($offset)) {
		$offset = array_fill(0,sizeof($tuning),$offset);
	}

	debug ("trying to find chord " . $chord . " with offset ". join(",",$offset)."<br>\n",3);

	//if (handSpan(chordPosOld($tuning, $chord, $offset=0),$chord) <= 2) {
	//	return (chordPosOld($tuning, $chord, $offset=0));
	//}


	if (!$tones = chord ($chord,sizeof($tuning))) {
		return false;
	}

	$matches = array();

	$fb = array();

	for ($s=0;$s<sizeof($tuning);$s++) {
		$fb[$s] = array();
		$open = array_search($tuning[$s], $notes);
		for ($fret=0;$fret<=12;$fret++) {
			if ($fret < $offset[$s]) {
				continue;
			}
			foreach ($tones as $t) {
				if ($notes[$fret+$open] == $t) {
					array_push($fb[$s], $fret);
				}
			}
		}
	}

	$matchpos = array();
	$postry = 0;
	foreach (array_comb($fb) as $pos) {
		if (in_array(join(",",$pos),$matchpos)) {
			continue;
		}
		array_push ($matchpos, join(",",$pos));

		$postry++;

		if ($postry > 5000) {
			break;
		}
		$chordNotes = array();


		for ($s=0;$s<sizeof($pos);$s++) {

			$fret = $pos[$s];

			$open = array_search($tuning[$s], $notes);

			foreach ($tones as $t) {
				if ($notes[$fret+$open] == $t) {
					array_push ($chordNotes, $t);
				}
			}
		}

		foreach ($tones as $t) {
			if (!in_array($t, $chordNotes)) {
				continue 2;
			}
		}

		array_push($matches, array($pos,handSpan($pos,$chordNotes,absNote($chord))));
		#print join(",", $pos)."<br>\n";


	}

	#$matches = array_unique($matches);

	usort($matches, function($a, $b) {
		return($a[1] - $b[1]);
	});

	if ($GLOBALS['DEBUG'] > 3) {
		foreach ($matches as $m) {
			print join(",",$m[0]).$m[1]."<br>\n";
			#print join(",",$m)."<br>\n";
		}
	}

	for ($i=0;$i<sizeof($matches);$i++) {
		$matches[$i] = $matches[$i][0];
	}

	//debug ($matches[$altno][0],3);
	//debug ($matches[$altno][1]." [ ".$altno."]",3);

	return (array_slice($matches,0,$altno + 1));


}

function handSpan ($chordPos2, $chordNotes, $root) {

	global $capo;
	global $offset;
	global $oOffset;
	global $cutout;
	global $notes;
	global $instrument;

	$chordPos = array();

	$chordDif = 0;
	$cMax = 0;

	foreach (array_unique($chordPos2) as $string) {
		if ($string > 0) {
			array_push($chordPos, $string);
		}
	}

	if ($GLOBALS['DEBUG'] > 2) {
		print "checking handspan for: ";
		print join(",",$chordPos2);
		print " (which is actually ".join(",",$chordPos).") : \n";
	}

	for ($i=0;$i<sizeof($chordPos);$i++) {
		if (($i < sizeof($chordPos) - 1)) {
				
			if ($chordPos[$i] != $chordPos[$i+1]) {
				if ($GLOBALS['DEBUG'] > 4) {
					print $chordPos[$i] . " to ". $chordPos[$i+1]."<br>\n";
				}
				if ($chordPos[$i+1] != 0) {
					$chordDif += abs($chordPos[$i+1] - $chordPos[$i]);
				}
				#if ($chordPos[$i] == $capo) {
				#	$chordDif -= $capo;
				#}
			}
		} elseif (sizeof($chordPos) == 1) {
			$chordDif == 1;
		}
		if ($chordPos[$i] > $cMax) {
			$cMax = $chordPos[$i];
		}
	}

	if ($cMax >= $oOffset + 8) {
		$chordDif += 4;
	} elseif ($cMax > $oOffset + 6) {
		$chordDif += 2;
	} elseif ($cMax >= $oOffset + 5 && $chordDif < 2) {
		$chordDif += 1;
	} elseif ($cMax > 4 && sizeof($chordPos) != sizeof(array_unique($chordPos2))) {
		$chordDif += 3;
	}

	if ($cMax >= 5) {
		$chordDif += 2;
	}

	if ($chordNotes[0] == $root || $chordNotes[0] == $notes[array_search($root,$notes)+7] || ($instrument == "ukulele" && ($chordNotes[0] == $notes[array_search($root,$notes)+4] || $chordNotes[0] == $notes[array_search($root,$notes)+3]))) {
		$chordDif -= 2;
	}

	if ($GLOBALS['DEBUG'] > 2) {
		#print_r ($chordPos2);
		print "<<".$chordDif.">><br>\n";
	}

	#$chordDif -= sizeof ($chordPos2) - sizeof ($chordPos); #?????

	return ($chordDif);
}

function scalePos ($tuning, $scale) {
	global $notes;

	$scalePos = array();

	for ($string=0;$string<sizeof($tuning);$string++) {
		$scalePos[$string] = array();
		$open = array_search($tuning[$string], $notes);

		for ($fret=0;$fret<=24;$fret++) {
			foreach (array_keys($scale) as $t) {
				if ($notes[$fret+$open] == $t) {
					array_push($scalePos[$string],$fret);
				}
			}

		}

	}

	return ($scalePos);
}

function pos2Notes ($tuning, $cPos) {
	global $notes;
	global $capo;

	for ($i=0;$i<sizeof($tuning);$i++) {
		$tuning[$i] = $notes[array_search($tuning[$i], $notes) + $cPos[$i]];
	}

	return $tuning;
}

function rel2Notes ($tuning) {
	global $notes;

	for ($i=1;$i<sizeof($tuning);$i++) {
		$tuning[$i] = $notes[array_search(strtoupper($tuning[$i - 1]), $notes) + $tuning[$i]];
	}

	return $tuning;
}

function capoAdd ($tuning, $capo) {
	global $notes;
	for ($i=0;$i<sizeof($tuning);$i++) {
		$tuning[$i] = $notes[array_search($tuning[$i], $notes)+$capo];
	}

	return $tuning;
}

function chordName ($comp) {
	global $notes;
	
	$comp = array_values(array_unique($comp));

	if (sizeof($comp) < 2 || sizeof($comp) > 4) {
		return false;
	}

	for ($i=0;$i<sizeof($comp);$i++) {
		$note = $comp[$i];
		if ($GLOBALS['DEBUG'] > 3) {
			print "Working out intervals from " . $note . "<br>\n";

		}

		if (sizeof($comp) == 2 && interval($comp, $note, 7)) {
			return ($note . 5); ## 5
		} elseif (sizeof($comp) == 4 && interval($comp, $note, 4) && interval($comp, $note, 7) && interval($comp, $note, 11)) {
			return ($note . "maj7"); ## 7
		} elseif (sizeof($comp) == 4 && interval($comp, $note, 3) && interval($comp, $note, 7) && interval($comp, $note, 10)) {
			return ($note . "m7"); ## 7
		} elseif (sizeof($comp) == 4 && interval($comp, $note, 4) && interval($comp, $note, 7) && interval($comp, $note, 10)) {
			return ($note . "7"); ## 7
		} elseif (sizeof($comp) == 4 && interval($comp, $note, 4) && interval($comp, $note, 7) && interval($comp, $note, 9)) {
			return ($note . "6"); ## 6
		} elseif (sizeof($comp) == 4 && interval($comp, $note, 4) && interval($comp, $note, 5) && interval($comp, $note, 7)) {
			return ($note . "4"); ## 4
		} elseif (sizeof($comp) == 4 && interval($comp, $note, 3) && interval($comp, $note, 5) && interval($comp, $note, 7)) {
			return ($note . "m4"); ## m4
		} elseif (sizeof($comp) == 3 && interval($comp, $note, 3) && interval($comp, $note, 7)) {
			return ($note . "m"); ## Minor
		} elseif (sizeof($comp) == 3 && interval($comp, $note, 3) && interval($comp, $note, 6)) {
			return ($note. "dim"); ## Diminished
		} elseif (sizeof($comp) == 3 && interval($comp, $note, 4) && interval($comp, $note, 8)) {
			return ($note. "aug"); ## Augmented
		} elseif (sizeof($comp) == 3 && interval($comp, $note, 2) && interval($comp, $note, 7)) {
			return ($note . "sus2"); ## Suspended 2nd
		} elseif (sizeof($comp) == 3 && interval($comp, $note, 5) && interval($comp, $note, 7)) {
			return ($note . "sus4"); ## Suspended 4th
		} elseif (sizeof($comp) == 3 && interval($comp, $note, 4) && interval($comp, $note, 7)) {
			return ($note); ## Major
		}
	}

	return (false);
}

function interval($tuning, $note, $interval) {
	global $notes;

	$tuning = array_merge($tuning,$tuning);
	for ($i=0;$i<sizeof($tuning);$i++) {
		if ($GLOBALS['DEBUG'] > 3) {
			print $note . " to " . $tuning[$i] . ":" . array_search($tuning[$i], array_slice($notes, array_search($note, $notes)))."<br>\n";
		}
		if (array_search($tuning[$i], array_slice($notes, array_search($note, $notes))) == $interval) {
			return (true);
		}
	}

	return (false);
}

function fixEnharmonic($tuning) {
	global $notes;

	for ($i=0;$i<sizeof($tuning);$i++) {
		if (preg_match("/^[A-G]b/",$tuning[$i])) {
			$tuning[$i] = preg_replace("/^([A-G])b/", '$1', $tuning[$i]);
			$enh = array_search($tuning[$i], $notes);
			$tuning[$i] = $notes[$enh - 2]."#";
		}

		$tuning[$i] = strtoupper($tuning[$i]);
	}

	return ($tuning);
}


function enhNote($note) {
	global $notes;

	if (preg_match("/^[A-G]#/",$note)) {
		$note = preg_replace("/^([A-G])#/", '$1', $note);
		$enh = array_search($note, $notes);
		$note = $notes[$enh + 2]."b";
	} elseif (preg_match("/^[A-G]b/",$note)) {
		$note = preg_replace("/^([A-G])b/", '$1', $note);
		$enh = array_search($note, $notes);
		$note = $notes[$enh - 2]."#";
	}

	return ($note);
}

function absNote($note) {
	global $cQualities;
	$qual = join("|", $cQualities);
	return (preg_replace("/($qual)$/","",$note));
}

function absQual($note) {
	global $cQualities;
	$qual = join("|", $cQualities);
	return (preg_replace("/.*?($qual)$/","$1",$note));
}

function drawFail ($msg) {
	global $font;

	if (isset($_GET['describe']) || isset($_GET['numeric'])) {
		print "$msg";
		return;
	}

	if (!$GLOBALS['DEBUG'] > 0) {
		header ("Content-type: image/png");
	}

	$pad = 24;
	if ($msg === false) {
		$im_width = 1;
		$im_height = 1;
	} else {
		$im_width = (3 * 32) + (2 * $pad);
		$im_height = 8+(32*5)+4;
	}

	$canvas = imagecreatetruecolor($im_width, $im_height); 

	#imageantialias($canvas,true);

	$c['black'] = imagecolorallocate($canvas, 0,0,0); 
	$c['white'] = imagecolorallocate($canvas, 255,255,255); 
	$c['red'] = imagecolorallocate($canvas, 255,0,0); 

	imagefilledrectangle($canvas,0,0,$im_width,$im_height,$c['white']);

	imagettftext($canvas, 12, 0, 8, 20, $c['red'], $font, $msg);

	imagepng($canvas); 
}

function drawChord ($chord, $note, $tuning, $origTuning, $scale, $enhScale, $capo, $handed, $mode = "chord") {
	global $showOpen;
	global $printNote;
	global $notes;
	global $maxFret;
	global $markFret;
	global $printFret;
	global $clipFret;
	global $font;
	global $showEnh;
	global $origChord;
	global $origQual;
	global $fixEnharm;
	global $scaleNames;
	global $clipScale;
	global $nopadtop;
	global $rotateImage;
	global $colorcode;

	if ($handed == "left") {
		$chord = array_reverse($chord);
		$tuning = array_reverse($tuning);
		$tuningPrint = array_reverse($origTuning);
	} else {
		$tuningPrint = $origTuning;
	}

	if ($GLOBALS['DEBUG'] >= 1) {
		print join(", ",$tuningPrint)." = ".$note."<br>";
		print "<br>";
	} else {
		header ("Content-type: image/png");
	}

	if ($nopadtop) {
		$padTop = 0;
	} elseif ($mode == "scale") {
		$padTop = 64;
	} else {
		$padTop = 48;
	}

	$lastFret = 0;

	if ($mode == "chord" && $clipFret) {
		for ($i=0;$i<sizeof($chord);$i++) {
			if ($chord[$i] > $lastFret) {
				$lastFret = $chord[$i];
			}
		}
		if ($lastFret < 5) {
			$lastFret = 5;
		}
	} else {
		$lastFret = $maxFret;
	}

	$sqs = 30;
	$markersize = 21;

	$pad = 14;
	$im_width = ((sizeof($tuning)-1) * $sqs) + (2 * $pad);
	$im_height = $padTop+8+($sqs*$lastFret)+4;

	$canvas = imagecreatetruecolor($im_width, $im_height); 

	$c = array();

	$c['black'] = imagecolorallocate($canvas, 0,0,0); 
	$c['white'] = imagecolorallocate($canvas, 255,255,255); 
	$c['red'] = imagecolorallocate($canvas, 255,0,0); 

	$c['fg'] = $c['white'];

	$c['root'] = imagecolorallocate($canvas,128,0,0); 
	$c['2'] = imagecolorallocate($canvas, 128, 92, 92);
	$c['3'] = imagecolorallocate($canvas, 0,128,0);
	$c['4'] = imagecolorallocate($canvas, 255, 128, 0);
	$c['5'] = imagecolorallocate($canvas, 0,0,128);
	$c['add'] = imagecolorallocate($canvas, 0,128,128);
	$c['7'] = imagecolorallocate($canvas, 128,0,128);
	$c['oinv'] = imagecolorallocate($canvas, 255,255,0); 

	imagefilledrectangle($canvas,0,0,$im_width,$im_height,$c['white']);

	imagefilledrectangle($canvas,$pad - 8,$padTop,($im_width - $pad) + 8,$padTop+8,$c['black']);
	imagefilledrectangle($canvas,$pad,($padTop+8+$sqs*12),$pad+($sqs * (sizeof($tuning)-1)),($padTop+8+$sqs*12+4),$c['black']);

	if ($capo > 0) {
		imagefilledrectangle($canvas,$pad - 4,$padTop+($capo * $sqs)-4,($im_width - $pad) + 4,$padTop+($capo * $sqs) + 4,$c['black']);
	}


	if ($mode=="scale" && $note) {
		$noteShow = notate($enhScale[absNote($note)], $scale, $enhScale);
	} elseif ($note) {
		$noteShow = notate($enhScale[absNote($note)].absQual($note), $scale, $enhScale);
	} else {
		$noteShow = "";
	}


	imagettftext($canvas, (($showEnh && (strlen(absQual($note)) > 2) ? 11 : 16)), 0, ($im_width / 2) - $sqs, 20, $c['black'], $font, $noteShow);

	if ($mode == "scale") {
		imagettftext($canvas, 11, 0, 16, 36, $c['black'], $font, $scaleNames[$scale]);
	}

	for ($i=0;$i<sizeof($tuning);$i++) {
		$osCol = $c['black'];

		if ($mode == "scale" && $chord[$i][0] != 0) {
			$osCol = $c['red'];
		}

		if (!$nopadtop) {
			imagettftext($canvas, 12, 0, $pad + ($i * $sqs) - 6, ($mode == "scale" ? 56 : 40), $osCol, $font, notate((isset($tuningPrint[$i]) ? $tuningPrint[$i] : $tuning[$i]), $scale));
		}
	}
	
	for ($i=0;$i<sizeof($tuning);$i++) {
		imageline($canvas,$pad+($sqs*$i),$padTop,$pad+($sqs*$i),$im_height,$c['black']);
	}

	for ($i=0;$i<=$lastFret;$i++) {
		imageline($canvas, $pad, ($padTop + 8 + ($sqs*$i)), $pad+($sqs * (sizeof($tuning)-1)), ($padTop + 8 + ($sqs*$i)), $c['black']);

		if ($printFret && in_array($i,$markFret)) {
			imagettftext($canvas, 10, 270, $im_width - $pad + 4, ($padTop + 8 + ($sqs*$i)) - 16, $c['black'], $font, $i);
		}
	}

	if ($mode == "scale") {
		for ($s=0;$s<sizeof($tuning);$s++) {
			for ($a=0;$a<sizeof($chord[$s]);$a++) {
				$pos = $notes[array_search($tuning[$s], $notes)+$chord[$s][$a]];
				$cdi = array_search($pos, array_slice($notes,array_search(absNote($note),$notes)));

				$fColor = $c['fg'];
				if ($colorcode) {

					if ($cdi == 7 || (absQual($note) == "dim" && $cdi == 6) || (absQual($note) == "aug" && $cdi == 8)) {
						$bColor = $c['5'];
					} elseif ($cdi == 1 || $cdi == 2) {
						$bColor = $c['2'];
					} elseif ($cdi == 3 || $cdi == 4) {
						$bColor = $c['3'];
					} elseif ($cdi == 5 || $cdi == 6) {
						$bColor = $c['4'];
					} elseif ($cdi == 0) {
						$bColor = $c['root'];
					} elseif ($cdi == 10 || $cdi == 11) {
						$bColor = $c['7'];
					} elseif ($cdi > 7) {
						$bColor = $c['add'];
					} else {
						$bColor = $c['root'];
					}
				} else {
					$bColor = $c['white'];
				}

				if ($s + 1 < sizeof($tuning)) {
					$nextPos = $notes[array_search($tuning[$s+1], $notes)+$chord[$s+1][0]];
					if ($pos == $nextPos) {
						$fColor = $c['oinv'];
						if ($clipScale) {
							continue 2;
						}
					}
				}

				$cdi = array_search($pos, array_slice($notes,array_search(absNote($note),$notes)));

				#print $pos." = $cdi (".absNote($note)." + ".absQual($note).")\n";

				$cSize = sizeof(array_values(array_unique(array_keys($chord))));

				imagefilledellipse ($canvas, ($s*$sqs+$pad), ($padTop + 8 + ($chord[$s][$a]*$sqs) - 20 + 8), $markersize, $markersize, $bColor);

				if ($printNote && $font) {
					if (isset($enhScale[$pos])) {
						$noteName = $enhScale[$pos];
					} else {
						$noteName = $pos;
					}
					if (preg_match("/(#|b){2}$/",$noteName)) {
						$fontsize = 6;
						$shiftleft = 9;
					} elseif (preg_match("/(#|b)$/",$noteName)) {
						$fontsize = 8;
						$shiftleft = 8;
					} else {
						$fontsize = 8;
						$shiftleft = 4;
					}
					imagettftext($canvas, $fontsize, 0, ($s*$sqs+$pad) - $shiftleft, ($padTop + 8 + ($chord[$s][$a]*$sqs) - 20 + 12), $fColor, $font, $noteName);
					//imagettftext($canvas, 8, 0, ($s*$sqs+$pad) - (preg_match("/(#|b)$/",@$enhScale[$pos]) || preg_match("/(#|b)$/",$pos) ? 8 : 4), ($padTop + 8 + ($chord[$s]*$sqs) - 20 + 12), $fColor, $font, (isset($enhScale[$pos]) ? $enhScale[$pos] : $pos));
				}
			}
		}
	} else {
		for ($s=0;$s<sizeof($chord);$s++) {
			if ($chord[$s] < 0) {
				#for ($j=$s;$j>=0;$j--) {
				imagefilledellipse ($canvas, ($s*$sqs+$pad),
					($padTop + 0 + (0*$sqs) - 20 + 8), $markersize, $markersize, $c['black']);
				imagettftext($canvas, 12, 0, ($s*$sqs+$pad)-5,
					($padTop - 6),
					$c['white'], $font, "X");
				#}
			} else {
				$pos = $notes[array_search($tuning[$s], $notes)+$chord[$s]];

				$cdi = array_search($pos, array_slice($notes,array_search(absNote($note),$notes)));

				#print $pos." = $cdi (".absNote($note)." + ".absQual($note).")\n";

				$cSize = sizeof(array_values(array_unique($chord)));

				if ($colorcode) {
					$fColor = $c['fg'];
					if ($cdi == 7 || (absQual($note) == "dim" && $cdi == 6) || (absQual($note) == "aug" && $cdi == 8)) {
						$bColor = $c['5'];
					} elseif ($cdi >= 2 && $cdi <= 5) {
						$bColor = $c['3'];
					} elseif ($cdi == 0) {
						$bColor = $c['root'];
					} elseif ($cdi == 10 || $cdi == 11) {
						$bColor = $c['7'];
					} elseif ($cdi > 7) {
						$bColor = $c['add'];
					} else {
						$bColor = $c['root'];
					}
				} else {
					$fColor = $c['white'];
					$bColor = $c['black'];
				}

				if (chord($note,sizeof($tuning)) && in_array($tuning[$s],chord($note,sizeof($tuning)))) {
					$fColor = $c['oinv'];
				}

				if ($chord[$s] > $lastFret) {
					imagefilledrectangle($canvas,$pad+($sqs*$s),$padTop,$pad+($sqs*$s)+4,$im_height,$c['red']);
				} elseif ($capo > 0 && $chord[$s] == $capo) {
					imagefilledellipse ($canvas, ($s*$sqs+$pad), ($padTop + 8 + ($chord[$s]*$sqs) - 20 + 8), 20, 20, $bColor);
					//imagefilledellipse ($canvas, ($s*$sqs+$pad), ($padTop + 22 + (($chord[$s])*$sqs) - 24), 20, 20, $bColor);

					if ($printNote && $font) {
						if (isset($enhScale[$pos])) {
							$noteName = $enhScale[$pos];
						} else {
							$noteName = $pos;
						}
						if (preg_match("/(#|b){2}$/",$noteName)) {
							$fontsize = 6;
							$shiftleft = 9;
						} elseif (preg_match("/(#|b)$/",$noteName)) {
							$fontsize = 8;
							$shiftleft = 8;
						} else {
							$fontsize = 8;
							$shiftleft = 4;
						}
						imagettftext($canvas, $fontsize, 0, ($s*$sqs+$pad) - $shiftleft, ($padTop + 8 + ($chord[$s]*$sqs) - 20 + 12), $fColor, $font, $noteName);
					}
				} elseif ($chord[$s] > 0) {
					imagefilledellipse ($canvas, ($s*$sqs+$pad), ($padTop + 8 + ($chord[$s]*$sqs) - 20 + 8), 20, 20, $bColor);

					if ($printNote && $font) {
						if (isset($enhScale[$pos])) {
							$noteName = $enhScale[$pos];
						} else {
							$noteName = $pos;
						}
						if (preg_match("/(#|b){2}$/",$noteName)) {
							$fontsize = 6;
							$shiftleft = 9;
						} elseif (preg_match("/(#|b)$/",$noteName)) {
							$fontsize = 8;
							$shiftleft = 8;
						} else {
							$fontsize = 8;
							$shiftleft = 4;
						}
						imagettftext($canvas, $fontsize, 0, ($s*$sqs+$pad) - $shiftleft, ($padTop + 8 + ($chord[$s]*$sqs) - 20 + 12), $fColor, $font, $noteName);
					}
				} elseif ($showOpen) {
					imagefilledellipse ($canvas, ($s*$sqs+$pad),
						($padTop + 22 + (($chord[$s])*$sqs) - 20 + 8), 20, 20, $c['white']);
					imageellipse ($canvas, ($s*$sqs+$pad),
						($padTop + 22 + (($chord[$s])*$sqs) - 20 + 8), 20, 20, $c['black']);
					if ($nopadtop && $printNote && $font) {
						imagettftext($canvas, 8, 0, ($s*$sqs+$pad) - (preg_match("/(#|b)$/",$pos) ? 8 : 4),
							($padTop + 8 + ($chord[$s]*$sqs) + 6),
							$c['black'], $font, $tuning[$s]);
					}
				}
			}
		}

	}


	if ($rotateImage) {
		imagepng (imagerotate($canvas, $rotateImage, $c['white']));
	} else {
		imagepng($canvas); 
	}
}

function notate ($note, $scale, $enhScale=false) {

	global $scales;
	global $notes;

	if ($enhScale && $scale != "chrom" && isset($enhScale[absNote($note)])) {
		$note = $enhScale[absNote($note)].absQual($note);
	}

	$note = preg_replace("/dim/", "dim", $note);
	$note = preg_replace("/aug/", "aug", $note);
	$note = preg_replace("/([A-G]+)b/", "$1♭", $note);
	$note = preg_replace("/##/", "♯♯", $note);
	$note = preg_replace("/#/", "♯", $note);


	return ($note);
}

function mkScale ($chord, $scale, $prefersf, $allNotes=false) {
	global $notes;
	global $scales;
	global $fixEnharm;
	global $keyoffset;
	global $diChord;
	global $diChords;

	if (($scale == "chrom" || $scale == "single" || $scale == "altq")) {
		if ($keyoffset > 0 && $scale != "single" && $diChords) {
			$o = $notes[array_search($chord, $notes) + $scales[$scale][$keyoffset-1]].$diChord[$scale][$keyoffset-1];
			$di = $diChord[$scale][$keyoffset - 1];
		} else {
			$o = $chord;
			$di = absQual($chord);
		}
		if ($di ==  "m") {
			$qs = "aeo";
		} elseif ($di ==  "m7") {
			$qs = "aeo";
		} elseif ($di ==  "m4") {
			$qs = "aeo";
		} elseif ($di ==  "m9") {
			$qs = "aeo";
		} elseif ($di ==  "m6") {
			$qs = "dor";
		} elseif ($di ==  "7") {
			$qs = "mix";
		} elseif ($di == "dim") {
			$qs = "dim";
		} elseif ($di == "dim7") {
			$qs = "dim7";
		} else {
			$qs = "ion";
		}
	} else {
		$o = $chord;
		$qs = $scale;
	}

	if ($fixEnharm) {

		if ($GLOBALS['DEBUG'] > 1) {
			print "fixing enharmonic notes for " . $o . ", using the " . $qs . " scale.<br>\n";
		}
		$flatSc = mkEnh($o, $qs, "b");
		$sharpSc = mkEnh($o, $qs, "#"); 
		$flats = sizeof (preg_grep ("/b/", $flatSc));
		$sharps = sizeof (preg_grep ("/#/", $sharpSc));


		if ($prefersf) {
			if ($prefersf == "s") {
				debug ("using # version<br>",2);
				$scr = mkEnh($o, $qs, "#");
			} elseif ($prefersf == "f") {
				debug ("using b version<br>",2);
				$scr = mkEnh($o, $qs, "b");
			}
		} else {
			if ($GLOBALS['DEBUG'] > 1) {
				print "<b>#</b>: $sharps / <b>b</b>: $flats<br>\n";
			}
			if ($sharps > $flats) {
				$scr = mkEnh($o, $qs, "b");
			} elseif ($sharps < $flats) {
				$scr = mkEnh($o, $qs, "#");
			} else {
				$scr = mkEnh($o, $qs, "b");
			}
		}
		       
		if ($scale == "chrom")	{
			$sc = array();
			for ($i=0;$i<sizeof($scales["chrom"]);$i++) {
				$k = $notes[array_search(absNote($o), $notes) + $scales["chrom"][$i]];
				if (array_key_exists($k,$scr)) {
					$sc[$k] = $scr[$k];
				} else {
					$sc[$k] = $k;
				}
			}
		} else {
			$sc = $scr;
		}
		return ($sc);
	} else {
		$sc = array();
		for ($i=0;$i<sizeof($scales[$qs]);$i++) {
			$k = $notes[array_search(absNote($o), $notes) + $scales[$qs][$i]];
			$sc[$k] = $k;
		}

		return ($sc);
	}

}

function mkEnh ($chord, $scale, $prefer="") {
	global $notes;
	global $scales;
	global $fixEnharm;
	global $diChord;
	global $key;
	global $keyoffset;

	$note = absNote($chord);

	$sc = array();
	for ($i=0;$i<sizeof($scales[$scale]);$i++) {
		$k = $notes[array_search($note, $notes) + $scales[$scale][$i]];
		$sc[$k] = $k;
	}

	$scold = $sc;

	if (preg_match ("/(#)/", $note)) {
		$enhkey = $notes[array_search($note, $notes)+1] . "b";
	} else {
		$enhkey = $note;
	}

	if ($prefer != "b") {
		foreach (array_keys($sc) as $k) {
			$absK = array_search(preg_replace("/(#|b)/", "", $sc[$k]), $notes)+12;
			if (isset ($l)) {
				$absL = array_search(preg_replace("/(#|b)/", "", $sc[$l]), $notes)+12;
			} else {
				$absL = "";
			}
			if ($GLOBALS['DEBUG'] > 2) {
				if (isset ($l)) {
					print   $k . " follows " . $sc[$l] . "<br>\n";
				}
			}
			if ($absK != $absL) {
				$newnote = $notes[$absK-1]."#";
				if (isset ($l) && !preg_match(
					"/^". preg_replace("/(#|b)/","",$sc[$l]) ."/", 
					preg_replace("/(#|b)/","",$newnote))
					) {
					for ($i=1;$i<=2;$i++) {
					if ((preg_replace("/(#)/", "", $notes[$absK+$i]) != $notes[$absK]) && (!preg_grep("/".$notes[$absK+$i]."/", $sc)) && $prefer != "#") {
						#print $notes[$absK+$i]."==<br>\n";
						
						if ($GLOBALS['DEBUG'] > 1) {
							print $k." <i>won't</i> become ".$newnote.", because there is no ".$notes[$absK+$i].", so it should become ".$notes[$absK+$i]."b instead!<br>\n";
						}
						$sc = $scold;
						break 2;
					}
					}
					if ($prefer == "#" || !preg_match("/##/", $newnote)) {
						if ($GLOBALS['DEBUG'] > 1) {
							print "$k becomes ".$newnote." (because there is no " . $notes[$absK-1] . ")<br>\n";
						}
						$sc[$k] = $newnote;
						#$sc[$sc[$k]] = &$sc[$k];
					} elseif ($prefer != "#") {
						#$sc[$k] = $notes[$enh + 1]."b";
						if ($GLOBALS['DEBUG'] > 1) {
							print "$k would become ".$newnote." because there is no " . preg_replace("/#/","",$notes[$absK-1]) . ",\n";
							print "but that would be dumb.  So, instead, the key will become " . $enhkey . "<br>\n";
						}
						$prefer = "b";
						$sc = $scold;
						$sc[$note] = $enhkey;
						break;
						if ($recurse) {
							return($sc);
						} else {
							break;
						}
					}
				}
			} else {
				if ($GLOBALS['DEBUG'] > 1) {
					print "these are the same note<br>\n";
				}
				$sc = $scold;
				break;
			}
					
			$l = $k;
		}
	}

	unset($l);

	if ($prefer != "#") {
		foreach (array_keys($sc) as $k) {
			$absK = array_search(preg_replace("/(#|b)/", "", $sc[$k]), $notes)+12;
			if (isset ($l)) {
				$absL = array_search(preg_replace("/(#|b)/", "", $sc[$l]), $notes)+12;
			} else {
				$absL = "";
			}

			if ((isset($l) && ($absK == $absL)) || ((!isset($l)) && preg_match("/(#)/", $k) )) {
				if ($enh = array_search($sc[$k], $notes)) {
					$sc[$k] = preg_replace("/#/", "", $notes[$enh + 1])."b";
					if ($GLOBALS['DEBUG'] > 2) {
						print "$k becomes " . $sc[$k] . "<br>\n";
					}
				}
			}
			$l = $k;
		}

	}

	if ($GLOBALS['DEBUG'] > 1) {
		print $note . " " . $scale . ($scale == "chrom" ? " <b>[" . $note . " " . $scale . "]</b>" : "") . ($prefer ? " (<i>preferring " . $prefer . "</i>)" : "") .": ";
		print_r ($sc);
		print "<br>\n";
	}

	if ($prefer == "b") {
		if (preg_grep("/#/", $sc) &&  preg_grep("/b/", $sc)) {
			debug ("There are #s and bs in this scale, ", 2);

			if (absQual($chord) == "dim" || absQual($chord) == "7") {
				debug ("but this is the result of having an flatened note in the chord.", 2);
			} else {
				debug ("so we'll opt for the sharp version", 2);
				return (mkEnh($note, $scale, "#"));
			}
		}
	}


	return ($sc);
}

function randomChord($instrument = false, $tuning = false) {
	global $notes;
	global $Tunings;
	global $cQualities;

	if (!$instrument) {
		$instrument = array_rand($Tunings, 1);
	}

	if (!$tuning) {
		$tuning = preg_split("/,/",$Tunings[$instrument][array_rand($Tunings[$instrument],1)]["tuning"]);
	}


	$chord = $notes[array_rand($notes, 1)];

	$qual = false;
	## MUST REMEMBER === MEANS NOT ONLY EVALUATES TO FALSE BUT IS ACTUALLY
	## FALSE. I.E. NOT ZERO OR A BLANK STRING.
	while ($qual === false) {
		$qual = $cQualities[array_rand($cQualities, 1)];
		#print "qual: '".$qual."'<br>";
	}

	$chord .= $qual;

	return (array($chord, $tuning, $instrument));
}

function openChord($tuning) {
	global $notes;
	global $cQualities;

	$chord = chordName($tuning);

	$c = array_search(absNote($chord), $notes);
	$q = array_search(absQual($chord), $cQualities);
	
	if (absQual($chord) == "m") {
		$s = "1";
	} else {
		$s = "0";
	}

	if ($c) {
		return (($c)." ".($q ? $q : 0)." ".($s ? $s : 0));
	} else {
		return (false);
	}
}

function jsonChord($instrument, $tuning, $fullTuning, $pos, $chord, $scroot, $scale, $keyoffset, $capo, $handed, $enhScale, $posMatch=array(), $jmode="c", $dyk) {
	global $notes;
	global $altno;
	global $prefersf;
	global $fixEnharm;
	global $diChords;
	global $Tunings;
	global $random;
	global $didYouKnow;
	header("Content-type: application/json");

	$jsonData = array ();
	$jsonData["instrument"] = $instrument;
	$jsonData["out_chord"] = $chord;
	$jsonData["out_abschord"] = absNote($chord);
	$jsonData["out_absqual"] = absQual($chord);
	$jsonData["cpos"] = $pos;

	if ($fullTuning != $tuning) {
		$jsonData["tuning"] = preg_split("/,/",lcfirst(join(",",$fullTuning)));
	} else {
		$jsonData["tuning"] = $fullTuning;
	}


	$jsonData["out_openchord"] = chordName($tuning);
	$jsonData["out_openabschord"] = absNote(chordName($tuning));
	$jsonData["out_openabsqual"] = absQual(chordName($tuning));

	if ($jmode == "i") {
		$jsonData["deftunings"] = array();
		foreach ($Tunings[$instrument] as $t) {
			array_push($jsonData["deftunings"], $t);
		}
	}
	$jsonData["altpos"] = $posMatch;
	$jsonData["random"] = $random;

	if ($dyk) {
		$jsonData["dyk"] = $didYouKnow[rand(0,sizeof($didYouKnow)-1)];
	} else {
		$jsonData["dyk"] = false;
	}

	if ($keyoffset == 0) {
		$keyoffset = 1;
	}
	if ($random) {
		$scale = "single";
	}

	$jsonData["keyoffset"] = $keyoffset;
	$jsonData["capo"] = $capo;

	$jsonData["query"] = "m=c&instrument=" . $instrument . "&tuning=" . urlencode(join(",",$jsonData["tuning"])) . "&chord=" . urlencode(absNote($scroot)) . ($scale == "single" ? "&quality=" . absQual($chord) : "") . "&scale=" . $scale . ($scale != "single" ? "&key=" . $keyoffset : "") . "&fixenharm=" . ($fixEnharm ? "on" : "off") . "&capo=" . $capo . "&handed=" . $handed . "&prefersf=" . $prefersf;

	if ($jsonData["out_chord"]) {
		$jsonData["out_scale"] = preg_match("/m$/", $jsonData["out_chord"]) ? "aeo" : "ion";
	} else {
		$jsonData["out_scale"] = false;
	}

	$jsonData["notes"] = array();
	for ($i=0;$i<sizeof($tuning);$i++) {
		$fnote = $notes[array_search($tuning[$i], $notes) + $pos[$i]];
		if (isset($enhScale[$fnote])) {
			$fnote = $enhScale[$fnote];
		}
		array_push($jsonData["notes"],$fnote);
	}

	$jsonData["altnotes"] = array();

	foreach ($posMatch as $m) {
		$anotes = array();
		for ($i=0;$i<sizeof($tuning);$i++) {
			$fnote = $notes[array_search($tuning[$i], $notes) + $m[$i]];
			if (isset($enhScale[$fnote])) {
				$fnote = $enhScale[$fnote];
			}
			array_push($anotes,$fnote);
		}

		array_push($jsonData["altnotes"], $anotes);
	}

	print json_encode($jsonData);


}

function describeChord($chord, $note="", $tuning="", $enhScale = false) {
	global $notes;

	htmlHead();

?>
<h1><b><?=$note?></b> chord in <?=join(",", $tuning)?> tuning</h1>

<?
	for ($i=0;$i<sizeof($tuning);$i++) {
		$fnote = $notes[array_search($tuning[$i], $notes) + $chord[$i]];
		if ($enhScale !== false) {
			$fnote = $enhScale[$fnote];
		}
?>
<p>string <?=sizeof($tuning) - $i?> - <?=$chord[$i] ? "fret ".$chord[$i] : "open"?> (<?=$fnote?>)</p>
<?
	}

	htmlEnd();
}

function numericChord($chord, $note="", $tuning="") {
	global $notes;

	header("Content-type: text/plain");

	for ($i=0;$i<sizeof($tuning);$i++) {
		print $chord[$i] . ($i+1!=sizeof($tuning) ? " " : "");
	}
}

function getSearch() {

	global $Tunings;

	$matchStr = array();
	$matchStr['banjo'] = array(
		"@^http://[^/]*.*[?&]q=.*([A-Ga-g]?[#]?)([A-Ga-g][#]?)([A-Ga-g][#]?)([A-Ga-g][#]?)([A-Ga-g][#]?).*@",
		'strtoupper("$2,$3,$4,$5")'
	);
	$matchStr['guitar'] = array(
	       	"@^http://[^/]*.*[?&]q=.*([A-Ga-g][#]?)([A-Ga-g][#]?)([A-Ga-g][#]?)([A-Ga-g][#]?)([A-Ga-g][#]?)([A-Ga-g][#]?).*@",
		'strtoupper("$1,$2,$3,$4,$5,$6")'
	);
	$tuning = "";

	#if (isset($_SERVER['HTTP_REFERER'])) { 
	#	$refDec = urldecode ($_SERVER['HTTP_REFERER']);

	#	if (isset($_SERVER['QUERY_STRING']) && !preg_match ("@^http://[^?]*chordgen.php@", $refDec) && !preg_match("@deftuning=@", $_SERVER['QUERY_STRING'])) {

	#		foreach (array("guitar","banjo") as $j) {
	#			if (!$tuning = preg_replace($matchStr[$j][0]."e", $matchStr[$j][1], $refDec)) {
	#				continue;
	#			}

	#			foreach ($Tunings[$j] as $tt) {
	#				if (preg_match("@$tuning@", $tt["tuning"])) {
	#					return (array($j, $tuning));
	#				}
	#			}
	#		}
	#	}
	#}

	return false;

}

function getDef($tuning) {

	global $Tunings;

	foreach (array_keys($Tunings) as $j) {
		foreach ($Tunings[$j] as $tt) {
			if (preg_match("/$tuning/", $tt["tuning"])) {
				return array($tt["defkey"], $tt["defscale"]);
			}
		}
	}

	return "A";

}

function fixRedirect() {

	$redirect = "";

	if (isset($_GET['deftuning'])) {
		$redirect .= "tuning=" . $_GET['deftuning'] . "&";
	}
	if (isset($_GET['defchord'])) {
		$redirect .= "chord=" . $_GET['defchord'] . "&";
	}
	if (isset($_GET['defqual'])) {
		$redirect .= "quality=" . $_GET['defqual'] . "&";
	}
	if (isset($_GET['defscale'])) {
		$redirect .= "scale=" . $_GET['defscale'] . "&";
	}

	$redirect = preg_replace ("/&$/","",$redirect);

	if ($redirect) {
		header ("Location: chordgen.php?".$redirect);
		exit();
	}

}

function debug($msg, $lvl) {
	if ($GLOBALS['DEBUG'] >= $lvl) {
		if (is_array($msg)) {
			print_r ($msg);
			print "<br>\n";
		} elseif (is_object($msg) && is_callable($msg)) {
			$msg();
		} else {
			print $msg;
		}
	}
	/*
	if (is_array($msg)) {
		error_
		error_log ($msg);
	 */


}

function array_comb($arrays) {
	$result = array();
	$arrays = array_values($arrays);
	$sizeIn = sizeof($arrays);
	$size = $sizeIn > 0 ? 1 : 0;
	foreach ($arrays as $array)
		$size = $size * sizeof($array);
	for ($i = 0; $i < $size; $i ++) {
		$result[$i] = array();
		for ($j = 0; $j < $sizeIn; $j ++)
			array_push($result[$i], current($arrays[$j]));
		for ($j = ($sizeIn -1); $j >= 0; $j --)
		{
			if (next($arrays[$j]))
				break;
			elseif (isset ($arrays[$j]))
				reset($arrays[$j]);
		}
	}
	return $result;
}

?>
