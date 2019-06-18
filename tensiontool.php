<?

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

if (isset($_GET['extra'])) {
	showExtra($_GET['extra']);
	exit();
}

if (isset ($_COOKIE['tension_presets'])) {
	$presets = unserialize ($_COOKIE['tension_presets']);

	if (isset ($_GET['delpreset'])) {
		unset ($presets[$_GET['delpreset']]);
		//print_r ($presets);
		//print "<br/>\n";
		$presets = array_values ($presets);
		//$presets = array();
		//print_r ($presets);
		setcookie ('tension_presets', serialize($presets));
		header ("Location: tensiontool.php");
	}
} else {
	$presets = array();
}

$selectedPreset = false;
$preloadPreset = false;

if (isset($_GET['preset'])) {
	if (isset($_GET["save"])) {
		$newPreset = urldecode($_GET['preset']);
		$newPreset = preg_replace ('/[=><],/', ',', $newPreset);
		array_push ($presets, $newPreset);
		setcookie ('tension_presets', serialize($presets));
		header ("Location: tensiontool.php?lp");
	} else {
		$preloadPreset = $_GET['preset'];
	}

} elseif (isset($_GET['lp'])) {
	$selectedPreset = sizeof($presets) - 1;
}

?><?="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
   "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>String Tensions</title>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="chordgen_help.css"></link>
<script type="text/javascript" src="jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="tensiontool.js"></script>
</head>

<body>
<div class="content">

<div class="rightsectout">
<div class="rightsectin" style="font-size:1.15em">
<div class="nojs">
<h2>Warning</h2>
<p>Your browser does <b>not</b> support <i>JavaScript</i> (or it's not enabled), meaning that the interactive functionality is not supported and you can't enter new string data using this interface.</p>
</div>
<form action="tensiontool.php">
<div class="jsonly">

<div style="text-align:center;">
	<img id="tensionimg" src="" alt="no data"/>
</div>

<div style="overflow:hidden;border-bottom:1px solid black;margin:4px 0px 4px 0px;">
	<div style="text-align:center;border-bottom:1px solid black;padding-bottom:4px;">
		<input type="button" onclick="getTension(false)" value="Calculate Tensions"/>
		<input type="button" onclick="savePreset()" value="Save Preset"/>
		<input type="button" onclick="eqTension()" value="Equalize"/>
		<input type="reset" value="Clear"/>
	</div>
	
	<div id="tuningcont" style="float:left;padding-right:2px;border-right:1px solid black;width:150px;">
		<b>Tuning</b>
		<a class="linkn" id="toggleted" onclick="toggleEdTuning()"><span>show</span> editor</a><br>
		<textarea id="strings" name="strings" style="font-size:12pt;font-weight:bold;" rows="6" cols="13"></textarea>
		<div id="tuninged" style="background-color:#ccc;"></div>
	</div>


	<div id="smatcont">
		<div style="float:left;text-align:left;">
			<b>Scale Length</b> <input id="length" name="length" value="" style="width:48px"/>
			<select id="units" name="units">
				<option value="">in</option>
				<option value="mm">mm</option>
			</select><br/>
			<b>Doubled Courses</b> <input type="checkbox" id="courses" name="courses"/>
		</div>
		<div style="overflow:auto;border-top:1px solid black;border-bottom:1px solid black;padding:2px 0px 2px 0px;float:right;">
			<div style="float:left;padding-right:4px;text-align:right;">
				<b>String Material</b><br/>
				steel <input type="radio" name="smat" value="s" checked="checked"/><br/>
				nylon <input type="radio" name="smat" value="n"/><br/>
			</div>
			<div style="float:right;padding-left:4px;text-align:right;border-left:1px solid black;">
				<b>Winding Material</b><br/>
				<span style="color:rgb(130,130,130)">nickel</span> <input type="radio" name="wmat" value="ni" checked="checked"/><br/>
				<span style="color:rgb(241, 165, 60)">phosphor-bronze</span> <input type="radio" name="wmat" value="pb"/><br/>
				<span style="color:rgb(241, 184, 45)">80/20 bronze</span> <input type="radio" name="wmat" value="8020"/><br/>
			</div>
		</div>
	</div>
</div>
<div style="text-align:center;">
	<a class="link" onclick="toggleStats($(this))">« <span>show</span> statistics... »</a>
</div>
<div id="stats" style="text-align:center;"></div>
</div>
</form>
</div>
</div>

<div class="section">

<h1>Instrument String Tension Calculator</h1>

<div id="bcglink"><a href="http://tpn.lowtech.org">http://tpn.lowtech.org</a> &mdash; <a href="/">Theo's Chord Generator</a></div>


<p>This tool is designed to calculate string tension (individual and total) exerted on an instrument (guitar, banjo, mandolin etc.) by a specific set of strings.  String gauges and materials can be altered, as can the scale length; all these factors have an effect on the overall tension.  I built it so I could measure the string sets for my various instruments and try and get a more or less even tension across the strings, taking into account my preferred tunings.</p>

<p>Click on a preset to load it into the editor.  To speed up the loading of the page, only a small number of presets will be loaded. To load the rest, click <b>Show All Presets</b> or <b>Show Extra Presets</b> for an individual instrument/group.</p>

<div style="text-align:center;font-size:1.20em;"><a class="linkn" href="#ypresets">Your Presets</a> | <a class="linkn" href="#presets">Reference Presets</a> | <a id="loadall" class="linkn" class="link loadmore" onclick="loadMore(false)"><span>Show</span> All Presets</a></div>
<hr/>

<div style="text-align:center;font-size:1.20em;"><a class="link" onclick="toggleInfo($(this))">« show <span>more</span> information... »</a></div>

<div id="moreinfo">

<p>The data for the plain steel, plain nylon, nickel wound steel and silver-plated copper wound nylon strings comes from the <a href="http://daddario.com/upload/tension_chart_13934.pdf">D'Addario String Tensions PDF</a>.  The tensions for other winding materials (for steel core strings) are calculated approximately based on their density relative to nickel, but should be pretty close.</p>

<p>Remember that the actual, real-life tension can only ever be a very close approximation, especially for the wound strings , which have so many variables - such as core size, shape etc. - which can vary between different manufacturers.  For an in-depth introduction to string materials, see <a href="http://www.acousticmasters.com/AcousticMasters_Strings1.htm">here</a>.)</p>
	
<h2>Entering Data</h2>

<p>You can either enter all new data, or modify existing data - to do this, click on an image from the <b>Reference Presets</b> below and the data will be loaded into the form ready for modification.  Depending on your preference, you can either enter the string data manually, or use the <b>Tuning Editor</b> form to fill it in using an expanded interface.  To access the tuning editor, click <b>show editor</b> above the tuning input box.</p>
	       
<p>The syntax for entering the tuning manually should be fairly self explanatory; the format of the tuning box is, for every string, <b>NOTE-OCTAVE-GAUGE-p (for plain) or w (for wound)</b>. The note and octave are specified using <a href="http://en.wikipedia.org/wiki/Piano_key_frequencies">Scientific Pitch Notation</a>. Strings are separated by a comma.</p>

<p>String material (steel or nylon) is specified on a per-instrument basis, since this is by far the most common configuration. However, if you wish to use a composite set of steel and nylon (for example a zither banjo), you may also enter another dash, followed by either s or n, e.g. <b>G-3-0.035-w-n</b>.</p>

<p>To add a new string in the <b>Tuning Editor</b>, click the <b>+</b> button next to any string, this will make a copy of the string which you can then modify to suit your specifications.  The <b>-</b> button will remove a string.  One advantage of using the editor interface is that if you alter the properties of the string material, the list of available gauges will be automatically altered to reflect this.  Remember that you may be able to find gauges outside this list, it's just that those are all that the <b>Tension Calculator</b> has data for at the moment.</p>

<h3>Doubled Strings / Courses</h3>

<p>Due to space constraints, the tension tool only supports either individual strings, or doubled <a href="http://en.wikipedia.org/wiki/Course_%28music%29">courses</a> of the same gauge, tuned to the same note and pitch (e.g. those found on the mandolin). To apply doubled courses across the whole instrument, tick the <b>Doubled Courses</b> checkbox.</p>

<p>You can have a mix of doubled courses and single strings on the same instrument - for example the lute, which has all strings doubled except for the highest pitched. To enter a stringing such as this, you can append either a <b>*1</b> (if your other strings are courses) or a <b>*2</b> (if your other strings are single) to any string.</p>

<p>For example, if <b>Doubled Courses</b> is not checked, all the strings will be singles by default, but entering <b>G-4-0.09-p*2</b> will make that string doubled. If Doubled Courses is checked, entering <b>G-4-0.09-p*1</b> will make that string single.</p>

<p>If you want to perform calculations for a more complicated configuration, such as octave strung courses of different gauges/pitches (such as on the Portuguese/fado guitar) courses with more than two strings etc., you will need to uncheck the courses option and enter the string data manually as if you were dealing with entirely separate strings.</p>

<h3>Shorter Strings</h3>

<p>For instruments where one or more strings are shorter than the nominal scale length, for example the 5-string banjo, you can use the syntax <b>G-4-0.10-p@NUMBER</b> to indicate that the length of that string is X frets shorter than the others. For example, <b>G-4-0.10-p@5</b> indicates that the string is 5 frets shorter. This is indicated visually in the chord image by drawing the string at a shorter length and putting the note name in lowercase.</p>

<h3>Tuning Statistics</h3>

<p>If you want to see graphs of the tension data, you can use to <b>show statistics</b> link in the tuning form.  This will show plots of the following: string-to-string tension, string gauge and absolute pitch of the notes.</p>

<h3>Equalized Tension Tunings</h3>

<p>As you'll soon see from using this tool to examine most common string sets (my own custom gauge sets included), the tensions can vary wildly from string to string.  Is debatable how much this actually <i>matters</i> to most players, since the gauges of standard string sets sold have obviously stood the test of time - however it's still worth noting.</p>

<p>If, for instance, you're playing on a set of <i>Light</i> acoustic guitar strings, you may be perfectly happy with the feel of most of the strings, but find that the first couple of plain strings don't project as much.  You could switch to a set of <i>Medium</i> strings and increase the tension across the board, but then you may loose the comfort and ease of playability from your mid-range strings; a <i>Medium</i> gauge <b>G</b> is one of the tensest strings you'll find on any acoustic instrument (it's usually around 0.026, clocking in at well over 30 lbs of pressure on a standard scale length.)</p>

<p>The answer could well be a custom gauge set of strings.  What strings you end up choosing are probably going to be influenced at least in part by availability; e.g. lots of manufacturers don't make wound strings in odd numbered gauges, or will only include them as part of special bespoke sets - and if you don't have a retailer who sells single strings, your only option may be to mix two or more pre-packaged sets.  Or you may just not want to go below or above a certain gauge for a certain string because of personal preference, of because it may require re-setting up you instrument.</p>

<p>However, the <b>String Tension Calculator</b> has a feature for helping you find the <i>perfect</i> gauges for even tension, which you may then use as a starting point.   It works as follows: if you're happy with the tension and feel of your top string, and you want to find which gauges will approximate that for the rest of your tuning, you can use the <b>Equalize</b> button.  This will run through all gauges for which there is data, and find out which will give the closest matches for the tension of top string.  These may still be a pound or two off, due to the physical limitations of what strings are manufactured, but they should be pretty close.</p>

<p>If you would prefer to equalize the tension to match a string other than the top string, you can append an <b>=</b> sign after the string's entry, for example <b>G-3-0.024-w=</b>.  If you want to fine-tune the equalization, you can use <b>&gt;</b> instead of <b>=</b> to indicate that you want the other strings' tensions to be a close match, but <i>not</i> to drop below the tension of your marked string.  It is even easier to equalize the tuning to a specific string when you're using the <b>Tuning Editor</b> interface, because you can just use the <b>=</b> and <b>&gt;</b> buttons next to each string entry to equalize with that string.</p>

<p>One thing to note is the way that the tension equalization routines handle the transition between plain and wound strings.  Whether a string string is wound can have quite an impact on the sound of feel of an instrument; one of the characteristic differences between a acoustic and electric guitar string sets - apart from the overall tension - is the different in composition of the G string.  When the trying to equalize the tension of a wound string, the <b>Tension Calculator</b> will keep it wound until it reaches the lower limit of available gauges before switching it to plain.  The same behaviour applies to transitioning from plain to wound, although if you end up using a plain string above around 20, you may wish to choose a wound string instead, since very heavy plain strings will only feel and sound decent on a few instruments.</p>

<p>When the <b>Equalize</b> functionality has been used to find gauges to match a string, this is indicated by the rest of the notes being coloured green on the image.  If you've specified higher tension using <b>&gt;</b>, they will be coloured blue.  If you like the resulting set, you can obviously save it as a preset for later use.</p>

<h3>Saving Presets</h3>

<p>You can use the <b>Save Preset</b> button to store a copy of your current preset so that you can easily return to it.  When you have one or more saved presets, a new section will appear called <b>Your Presets</b>.  Browser cookies must be enabled to store presets locally - if saved presets are not showing up then you may need to check your cookie settings.</p> 

<p>Saved presets can be removed by clicking the <i>DELETE</i> link above the preset image.  To modify a preset, you can select it to load it into the editor, save it and then remove the original.  When you've saved a preset, you can use the <i>SHARE</i> link to let other people access the same information.</p>

<h3>Related Tools</h3>

<p>If you find this tool useful, you may also be interested in my <a href="http://chordgen.rattree.co.uk">Chord Generator</a>, which dynamically generates chord diagrams for almost any instrument and tuning you can think of.  Also, players and students of keyboard and fretted instruments may like to try out <a href="kb2fb.php">Keyboard-to-Fretboard</a>, which lets you see where the notes of a piano may be found on various different fretted instruments and tunings.  Instrument builders might also be interested in my <a href="frettool.php">Fret Tool</a>, which lets you calculate the precise fret spacing for various scale lengths.</p>

<h3>This is Free Software</h3>

<p>You can download, study and modify this program under the terms of the <i>GNU AGPL3</i>.  The source code can be found <a href="http://tpn.lowtech.org/scripts/chordgen_php.tar.gz" alt="chordgen soure">here</a>.</p>

</div>

</div>

<?
if (sizeof ($presets) > 0) {
?>
<div class="section" id="ypresets" style="clear:left;">
<h2>Your Presets</h2>
</div>

<div class="centerfloat">
<?
if ($preloadPreset) {
		print "<div class=\"presetcont\" style=\"border-color:#0D0;\">MANUALLY SPECIFIED PRESET<br/>\n";
		print "<img class=\"instimg default\" src=\"tension.php?".preg_replace ("/#/", "%23", $preloadPreset)."\">\n";
		print "</div>";
}

	for ($i=0;$i<sizeof($presets);$i++) {
		print "<div class=\"presetcont\"><a href=\"?delpreset=".$i."\">DELETE</a> | <a href=\"#\" onclick=\"showLink('".urlencode($presets[$i])."')\">SHARE</a><br/>\n";
		print "<img class=\"instimg".($selectedPreset === $i ? " default" : "")."\" src=\"tension.php?".preg_replace ("/#/", "%23", $presets[$i])."\"/>\n";
		print "</div>";
	}
?>
</div>
<?
}
?>

<div class="section" id="presets" style="clear:left">

<h2>Reference Presets</h2>

<p>These are mostly based upon my own instruments, and the gauges I usually string them with.  Use the <b>Show Extra Presets</b> links to show extra data, such as alternate tunings, string sets which I don't use etc. Click on a preset to load it into the editor.</p>
	
</div>

<div class="centerfloat">
<div class="sectionfloat preset" id="sbanjo5">
<h3>5-string Banjo (26 &frac14;" scale)</h3>
<img class="instimg" src="tension.php?length=26.25&amp;strings=D-4-.010-p,C-4-.012-p,G-3-.016-p,C-3-.024-w,G-4-.010-p@5" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="sbanjo5l">
<h3>5-string Banjo (27 &frac12;" scale)</h3>
<img class="instimg" src="tension.php?length=27.5&amp;strings=D-4-.010-p,B-3-.012-p,G-3-.016-p,D-3-.024-w,G-4-.010-p@5" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="sbanjo5ny">
<h3>5-string Banjo (25" scale) (nylon strung)</h3>
<img class="instimg" src="tension.php?length=25&amp;strings=D-4-.024-p,B-3-.028-p,G-3-.034-p,D-3-.028-w,G-4-.024-p@5&amp;smat=n" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="sbanjotenor">
<h3>19-fret Tenor Banjo</h3>
<img class="instimg" src="tension.php?length=22.8&amp;strings=E-4-.011-p,A-3-.018-w,D-3-.028-w,G-2-.040-w" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="sbanjocello">
<h3>Cello Banjo (~25" scale)</h3>
<img class="instimg" src="tension.php?length=25&amp;strings=D-3-.024-w,B-2-.028-w,G-2-.035-w,D-2-.043-w,G-3-.040-p@5&amp;smat=n" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="sguitacoust">
<h3>Acoustic Guitar</h3>
<img class="instimg<?=($selectedPreset === false && $preloadPreset === false ? " default" : "")?>" src="tension.php?length=25.5&amp;strings=E-4-.012-p,B-3-.016-p,G-3-.022-w,D-3-.030-w,A-2-.042-w,E-2-.052-w&amp;wmat=pb" alt="tension image"/><br/>
</div>

<div class="sectionfloat preset" id="sguitclass">
<h3>Classical Guitar</h3>
<img class="instimg" src="tension.php?length=25.6&amp;strings=E-4-.028-p,B-3-.032-p,G-3-.040-p,D-3-.030-w,A-2-.035-w,E-2-.043-w&amp;smat=n" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="smandolin">
<h3>Mandolin</h3>
<img class="instimg" src="tension.php?length=13.25&amp;strings=E-5-.010-p,A-4-.015-p,D-4-.024-w,G-3-.036-w&amp;wmat=pb&amp;courses" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="smandobanjo">
<h3>Banjo Mandolin</h3>
<img class="instimg" src="tension.php?length=13&amp;strings=E-5-.009-p,A-4-.013-p,D-4-.024-w-n,G-3-.035-w-n&amp;wmat=ni&amp;courses" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="smandola">
<h3>Tenor Mandola (17" scale)</h3>
<img class="instimg" src="tension.php?length=17&amp;strings=A-4-.011-p,D-4-.020-w,G-3-.030-w,C-3-.042-w&amp;wmat=pb&amp;courses" alt="tension image"/>
</div>

<div class="sectionfloat preset" id="sguitelec">
<h3>Electric  Guitar</h3>
<img class="instimg" src="tension.php?length=24.75&amp;strings=E-4-.010-p,B-3-.013-p,G-3-.017-p,D-3-.026-w,A-2-.036-w,E-2-.046-w" alt="tension image"/>
</div>

<div id="extradata"></div>
</div>

</div>
</div>

</body>
</html>
<?
function showExtra($inst) {
	$extraPreset = array();
	$extraPreset["smandola"] = array(
		"length=17&amp;strings=A-4-.011-p,D-4-.020-w,A-3-.030-w,D-3-.042-w&amp;wmat=pb&amp;courses",
		"length=17&amp;strings=A-4-.014-p,D-4-.022-w,G-3-.036-w,C-3-.048-w&amp;wmat=pb&amp;courses",
		"length=17&amp;courses&amp;strings=E-4-.015-p,A-3-.024-w,D-3-.036-w,G-2-.056-w&amp;wmat=pb",
		"length=17&amp;strings=A-4-.011-p,D-4-.020-w,G-3-.030-w,D-3-.042-w&amp;wmat=pb&amp;courses"
	);

	$extraPreset["sguitacoust"] = array(
		"length=25.5&amp;strings=E-4-.012-p,A-3-.016-p,G-3-.022-w,D-3-.030-w,A-2-.042-w,D-2-.052-w&amp;wmat=pb",
		"length=25.5&amp;strings=D-4-.012-p,A-3-.016-p,G-3-.022-w,D-3-.030-w,A-2-.042-w,D-2-.052-w&amp;wmat=pb",
		"length=25.5&amp;strings=D-4-.012-p,C-4-.016-p,G-3-.022-w,C-3-.030-w,G-2-.042-w,C-2-.052-w&amp;wmat=pb",
		"length=25.5&amp;strings=E-4-.011-p,B-3-.015-p,G-3-.022-w,D-3-.030-w,A-2-.042-w,E-2-.052-w&amp;wmat=pb",
		"length=25.5&amp;strings=E-4-.012-p,B-3-.016-p,G-3-.024-w,D-3-.032-w,A-2-.044-w,E-2-.054-w&amp;wmat=pb",
		"length=25.5&amp;strings=E-4-.013-p,B-3-.017-p,G-3-.024-w,D-3-.034-w,A-2-.046-w,E-2-.056-w&amp;wmat=pb"
	);

	$extraPreset["sbanjocello"] = array(
		"length=25&amp;strings=E-3-.024-w,A-2-.028-w,D-2-.035-w,G-1-.043-w&amp;smat=n"
	);

	$extraPreset["sbanjotenor"] = array(
		"length=22.8&amp;strings=A-4-.009-p,D-4-.013-p,G-3-.022-w,C-3-.032-w"
	);

	$extraPreset["sbanjo5ny"] = array(
		"length=25&amp;strings=D-4-.024-p,B-3-.028-p,G-3-.032-p,D-3-.024-w,G-4-.024-p@5&amp;smat=n"
	);

	$extraPreset["sbanjo5"] = array(
		"length=26.25&amp;strings=D-4-.010-p,B-3-.012-p,G-3-.016-p,D-3-.024-w,G-4-.010-p@5",
		"length=26.25&amp;strings=D-4-.010-p,C-4-.012-p,G-3-.016-p,D-3-.024-w,G-4-.010-p@5"
	);

	$extraPreset["sbanjo5l"] = array(
		"length=27.5&amp;strings=E-4-.010-p,B-3-.012-p,G-3-.016-p,D-3-.024-w,G-4-.010-p@5"
	);

	$extraPreset["smandolin"] = array(
		"length=13.25&amp;strings=E-5-.011-p,A-4-.015-p,D-4-.026-w,G-3-.040-w&amp;wmat=pb&amp;courses",
		"length=13.25&amp;strings=E-5-.010-p,A-4-.014-p,D-4-.024-w,G-3-.034-w&amp;wmat=pb&amp;courses"
	);

	if ($inst == "all") {
		foreach (array_keys ($extraPreset) as $p) {
			print "<div class=\"".$p."\">\n";
			for ($i=0;$i<sizeof($extraPreset[$p]);$i++) {
				print "<img src=\"tension.php?" . $extraPreset[$p][$i] . "\" alt=\"tension image\">\n";
			}
			print "</div>\n";
		}
	} else {
		print "<div class=\"".$inst."\">\n";
		for ($i=0;$i<sizeof($extraPreset[$inst]);$i++) {
			print "<img src=\"tension.php?" . $extraPreset[$inst][$i] . "\" alt=\"tension image\">\n";
		}
		print "</div>\n";
	}

}
?>
