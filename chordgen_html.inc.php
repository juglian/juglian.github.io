<?

function htmlHead ($title,$help=false) {

?>
<?="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?=$title?></title>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
<meta name="description" content="This tool displays chord position diagrams for fretboard-based stringed instruments, such as the banjo, mandolin, guitar etc. The chords are dynamically generated, so any tuning is supported."/>
<meta name="keywords" content="banjo chords, guitar chords, chord, chords, banjo, guitar, generator, mandolin, minor, major, 7th, open source, free software"/> 
<link rel="stylesheet" type="text/css" media="screen" href="chordgen.css"/>
<? if (!$help) {
?>
<link rel="stylesheet" type="text/css" media="screen" href="jquery-ui-1.10.3.custom.min.css"/>
<link rel="stylesheet" type="text/css" media="print" href="chordgen_print.css"/>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="chordgen.js"></script>
<?
} else {
?>
<link rel="stylesheet" type="text/css" href="chordgen_help.css"/>
<?
}
?>
<link rel="shortcut icon" href="favicon.ico"/>
</head>

<body>
<?
}

function htmlMainIntf() {
	global $notes;
	global $scale;
	global $instrument;
	global $Tunings;
	global $didYouKnow;
	global $tuning;
	global $chord;
	global $capo;
	global $offset;
	global $prefersf;
	global $handed;
	global $altmatch;
	global $fixEnharm;
	global $fullTuning;
	global $cPosManual;
	global $displayScale;
	global $help;
	global $sheetCont;

	htmlHead("Theo's Chord Generator");
?>

<div id="colleft">

<form id="chordset" name="chordset" action="?">
<div id="controls">
<b>Instrument</b>: <span id="instname"><?=ucfirst($instrument)?></span><input name="instrument" id="instrument" value="<?=$instrument?>"/><br/>
<a href="#" onclick="$('div#instlist').slideToggle('slow')"><b>« more instruments... »</b></a><br/>
<div id="instlist">
<ul>	
<?
foreach (array_keys($Tunings) as $i) {
?>
<li><a onclick="chInstrument('<?=$i?>', true, true)" href="#"><?=ucfirst($i)?></a></li>
<?
}
?>
</ul>
</div>


<b>Tuning</b>&nbsp;
<input name="tuning" id="tuning" value="<?=join(",",$fullTuning)?>"/>
<br/>

<div id="chordselcontainer">
<div>
<b>Chord</b><br/>
<select name="chord" id="chord" >
<?
	for ($i=0;$i<12;$i++) {
	#<option style="<?=preg_match("/#$/",$notes[$i]) ? "background-color:#000000;color:#FFFFFF" : "background-color:#FFFFFF;color:#000000">"><?=$notes[$i]></option>
?>

	<option value="<?=$notes[$i]?>" <?=absNote($chord)==$notes[$i]?" selected=\"selected\"":""?>><?=$notes[$i].(preg_match("/#$/",$notes[$i]) ? " ".enhNote($notes[$i]) : "")?></option>
<?
	}
?>
</select>

<span id="qualitybox">
<select name="quality" id="quality">
	<option <?=absQual($chord)==""?" selected=\"selected\"":""?> value="">Major</option>
	<option <?=absQual($chord)=="m"?" selected=\"selected\"":""?> value="m">minor</option>
	<option <?=absQual($chord)=="7"?" selected=\"selected\"":""?> value="7">Dom 7</option>
	<option <?=absQual($chord)=="maj7"?" selected=\"selected\"":""?> value="maj7">Maj 7</option>
	<option <?=absQual($chord)=="m7"?" selected=\"selected\"":""?> value="m7">min 7</option>
	<option <?=absQual($chord)=="aug"?" selected=\"selected\"":""?> value="aug">aug</option>
	<option <?=absQual($chord)=="dim"?" selected=\"selected\"":""?> value="dim">dim</option>
	<option <?=absQual($chord)=="sus2"?" selected=\"selected\"":""?> value="sus2">sus2</option>
	<option <?=absQual($chord)=="sus4"?" selected=\"selected\"":""?> value="sus4">sus4</option>
	<option <?=absQual($chord)=="5"?" selected=\"selected\"":""?> value="5">5 (no 3rd)</option>
	<option <?=absQual($chord)=="6"?" selected=\"selected\"":""?> value="6">6</option>
	<option <?=absQual($chord)=="m6"?" selected=\"selected\"":""?> value="m6">m6</option>
	<option <?=absQual($chord)=="9"?" selected=\"selected\"":""?> value="9">9</option>
	<option <?=absQual($chord)=="m9"?" selected=\"selected\"":""?> value="m9">m9</option>
	<option <?=absQual($chord)=="4"?" selected=\"selected\"":""?> value="4">4</option>
	<option <?=absQual($chord)=="m4"?" selected=\"selected\"":""?> value="m4">m4</option>
	<option <?=absQual($chord)=="dim7"?" selected=\"selected\"":""?> value="dim7">dim7</option>
</select>
</span>
<span id="qualityna">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?help#cnq" class="newwin">N/A</a>
</span>
</div>
<b>Scale / Multiple Chords</b>
<br/>
<select name="scale" id="scale">
	<option id="single" value="single"<?=$scale=="single"?" selected=\"selected\"":""?>>Single Chord</option>
	<option id="chrom" value="chrom"<?=$scale=="chrom"?" selected=\"selected\"":""?>>Chromatic (All)</option>
	<option id="altq" value="altq"<?=$scale=="altq"?" selected=\"selected\"":""?>>All Qualities</option>
	<option id="ion" value="ion"<?=$scale=="ion"?" selected=\"selected\"":""?>>Major (Ionian) </option>
	<option id="dor" value="dor"<?=$scale=="dor"?" selected=\"selected\"":""?>>Dorian</option>
	<option id="phr" value="phr"<?=$scale=="phr"?" selected=\"selected\"":""?>>Phrygian</option>
	<option id="lyd" value="lyd"<?=$scale=="lyd"?" selected=\"selected\"":""?>>Lydian</option>
	<option id="mix" value="mix"<?=$scale=="mix"?" selected=\"selected\"":""?>>Mixolydian</option>
	<option id="aeo" value="aeo"<?=$scale=="aeo"?" selected=\"selected\"":""?>>Minor (Aeolian)</option>
	<option id="loc" value="loc"<?=$scale=="loc"?" selected=\"selected\"":""?>>Locrian</option>
	<option id="moh" value="moh"<?=$scale=="moh"?" selected=\"selected\"":""?>>Harmonic Minor</option>
</select>
</div>
<div id="cposcontainer">
	<b>Enter Manual Position</b>
	<input id="cpos" name="cpos" value="<?=join(",",$cPosManual)?>"/><br/>
	(for example, the current chord position is <span id="cposcur" style="font-weight:bold"></span>)
</div>
<div class="buttondiv">
	<input type="submit" id="tune" value="Go!"/>
	<input type="button" onclick="parseReturn();showChord()" id="tuneopen" value="Open"/>
</div>
<div class="buttondiv">
	<input type="button" onclick="showPrint()" id="printch" value="Print"/>
	<input type="button" onclick="showHelp()" id="help" value="Help"/>
</div>
<div class="buttondiv">
	<input type="button" onclick="manualChord(false)" id="manual" value="Manual"/>
	<input type="button" onclick="randomChord()" id="random" value="Random"/>
</div>
<div class="buttondiv">
	<input type="button" onclick="toggleSheet()" id="customsheet" value="Build Custom Sheet"/>
</div>
<div>
<b>Capo Fret</b>&nbsp;
<select name="capo" id="capo">
<?
	for ($i=0;$i<=6;$i++) {
?>
<option value="<?=$i?>"<?=($capo == $i) ? " selected=\"selected\"" : ""?>><?=$i?></option>
<?
	}
?>
</select>	
<br/>
<b>Alt. Chords</b>&nbsp;
<select name="alt" id="alt">
<?
	for ($i=0;$i<=12;$i++) {
?>
	<option value="<?=$i?>"<?=($altmatch == $i) ? " selected=\"selected\"" : ""?>><?=$i?></option>
<?
	}
?>
</select>	
<br/>
<b>Show Scale</b> <input name="displayscale" id="displayscale" type="checkbox" <?=$displayScale ? 'checked="checked"' : ""?>/>
<br/>
<b>Handed:</b> Left <input name="handed" class="handed"  type="radio" value="left"<?=($handed == "left") ? " checked=\"checked\"" : ""?> onchange="chHanded()"/> / Right <input name="handed" class="handed"  type="radio" value="right"<?=($handed == "right") ? " checked=\"checked\"" : ""?>  onchange="chHanded()"/><br/>
<div id="advcontainer">
	<a href="#" onclick="toggleAdvOpt()"><b>« Advanced Options... »</b></a>
</div>

<div id="advopt">
	<b>Fret Offset</b>&nbsp;
	<select name="offset" id="offset">
	<?
		for ($i=0;$i<=7;$i++) {
	?>
		<option value="<?=$i?>"<?=($offset == $i) ? " selected=\"selected\"" : ""?>><?=$i?></option>
	<?
		}
	?>
	</select>	
	<br/>
	<b>Prefer # or b Keys</b>
	<select name="prefersf" id="prefersf">
		<option value=""<?=($prefersf == "") ? " selected=\"selected\"" : ""?>></option>
		<option value="s"<?=($prefersf == "s") ? " selected=\"selected\"" : ""?>>#</option>
		<option value="f"<?=($prefersf == "f") ? " selected=\"selected\"" : ""?>>b</option>
	</select>
	<br/>
	<b>Random</b>
	<select name="randomize" id="randomize">
		<option value="c" selected="selected">chord only</option>
		<option value="t">tuning &amp; chord</option>
		<option value="it">all</option>
	</select>
	<br/>
	<b>Fix Enharmonic</b> <input name="fixenharm" id="fixenharm" type="checkbox" checked="checked"/>
	<br/>
	<b>Reverse Left-Handed</b> <input name="revlh" id="revlh" type="checkbox" unchecked="unchecked" onchange="chHanded()"/>
	
	<input name="debug" id="debug" type="hidden" value="<?=$GLOBALS['DEBUG']?>"/>
</div>
</div>

<h2><a href="#" onclick="$('div#tuninglist').slideToggle('slow')">« Some Tunings... »</a></h2>
<div id="tuninglist">

<ul class="tunelist">
	<li></li>
</ul>

</div>
<div id="dyk">
	<b>Did You Know...</b>&nbsp;&nbsp;&nbsp;<?=$didYouKnow[rand(0,sizeof($didYouKnow)-1)]."\n"?>
</div>
</div>
</form>
</div>

<div id="colright">

<div id="colchords">

<div id="greendiv">
<div id="minihelp">
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(128,0,0);">Root</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(128,92,92);">2nd</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(0,128,0);">3rd</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(255,128,0);">4th</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(0,0,128);">5th</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(0,128,128);">6th</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(128,0,128);">7th</div>
</div>

<div id="introtext">
	<h1>Theo's Chord Generator</h1>
	<p style="margin-top:0px;">Welcome to <i>Theo's Chord Generator</i>. The current <b>tuning</b> is in the box at the <i>top left</i> and <b>chords</b> can be selected from the dropdown boxes. The Chord Generator is fully dynamic, meaning that it will accept <i>any chord and any tuning</i>.  For more info see the <a href="?help">Documentation</a>. Also see <a href="?help#tools">more tools</a>...  If you wish to bookmark or share the current chords, use this <a id="statlink" href="">Static Link</a>. <span id="nocust">(this excludes changes made to the <b>Custom Chord Sheet</b>!)</span></p>

	<div id="lhinfo"><p><b>NOTE!</b> In <b>Reverse Left-Handed</b> mode, the tuning (and any manual chord positions) should be entered in the same way the chord appears in the diagramns, i.e. strings from top to bottom.  If you have switched from right handed mode, you will need to manually reverse the tuning entered in the box, otherwise the chord generator will not work as expected!</p></div>

	<div id="nojs" class="warnmsg">
	<h2>Warning</h2>
	<p>Your browser does <b>not</b> support <i>JavaScript</i> (or it's not enabled), meaning that the interactive functionality is not supported and you can't select chords using this interface. However, all is not lost. See the <a href="?help#advanced">Documentation</a> for instructions on how to drive the chord generator manually.</p>
	</div>
	<div id="warn" class="warnmsg">

	</div>

</div>
</div>

<div id="printinfo">
	
</div>

<div id="progresscontainer">
	<div id="progressBar"><div></div></div>
</div>
<div id="chordscontainer">
<div>
<?  for ($i=1;$i<=36;$i++) {
?><img class="chordimg" id="chordImg<?=$i?>" src="" alt="" style="display:none"/><?
} ?>
</div>

<div>
<img id="scaleimg" src="" alt="scale image" style="display:none"/>
</div>
</div>
<div class="printhide" id="helpsingle">
<p>You are currently in <b>Single Chord</b> mode, meaning that only the actual chord you have selected will be shown.  If you wish to display multiple chords, please use the <i>Scale / Multiple Chords</i> menu to select a set of chords to display.  Diatonic chords within various scales are available, as well as the entire Chromatic scale (including major, minor and major 7th chords based on all notes.)  And/or you may wish to see multiple variations / inversions of a single chord; this functionality is available from the <i>Alt. Chords</i> menu.  Although be aware that asking multiple variations of every chord in the scale may take some time to generate and/or load.</p>
</div>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<div id="footer" class="printhide">
	<div id="footerleft">
		<div id="bottombtns">
				<input type="hidden" name="cmd" value="_s-xclick" />
				<input type="hidden" name="hosted_button_id" value="WKK3D4Z2PCM9G" />
				<input id="donatebtn" type="submit" value="Donate" alt="PayPal – The safer, easier way to pay online." />
				<input id="bugreport" type="button" onclick="reportBug()" value="Report Bug" />
		</div>
	</div>
	<div id="footerright">
		<div id="authorship">
			<b>&copy; 2014</b> - <a href="http://tpn.lowtech.org">Theo Parmakis</a>.  Additional design Sol Loreto-Miller.<br/>This tool is <i><a href="?help#copyright">free software</a> (open source)</i> (<b>GNU AGPLv3</b>.)
		</div>
	</div>
</div>
</form>

</div>
<div id="colsheet">
	<div class="printhide" id="sheetinfo">
	<p><i>Click chords in the left hand sheet and they will appear in this area, so that you can build your own custom chord sheet.  You can drag them around to rearrange them, or double click them to remove. Then just print the page to see your custom sheet!</i></p>
	<input type="button" value="Add Linebreak" onclick="addLinebreak()"/>
	<input type="button" value="Clear" onclick="clearSheet()"/>
	<input type="button" value="Add All" onclick="allToSheet()"/>
	<input type="button" value="Share" onclick="shareSheet()"/>
	</div>
	<div id="sheetchords"><?=$sheetCont?></div>
</div>
</div>

</body>

</html>
<?
}

function printTuning($tuning, $i) {

	global $notes;
	global $scales;
	global $instrument;

	$tNotes = preg_split("/,/", $tuning["tuning"]);

	$key = array_search($tuning['defkey'],$notes);
	$scale = array_search($tuning['defscale'],array_keys($scales));

	//print "\t<li><a onclick=\"fillTune('".$notes[1].",".$notes[2].",".$notes[3].",".$notes[4]."')\""
	
	print "\t<li><a onclick=\"fillTune('".join(",",$tNotes)."',".($key + 0).",".($scale ? $scale : 0).")\"" . "href=\"#\">"
		. " ".$tuning["name"]." "
		. ($tuning["altname"] ? '"'.$tuning["altname"].'"' : "")
		. " "."(" . join("", $tNotes) . ")"
		. "</a></li>\n";

}

?>
