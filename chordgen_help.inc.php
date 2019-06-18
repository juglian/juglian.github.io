<?php

function showHelp() {

	htmlHead("Theo's Chord Generator - Documentation",true);

?>



<div class="section">
<div class="ileft">
<img src="?m=c&tuning=D,F%23,A,D&amp;chord=G&amp;fretno=4">
<img src="?m=c&tuning=D,G,B,D&amp;chord=F&amp;fretno=4">
<img src="?m=c&tuning=D,G,B,D&amp;chord=Bm&amp;fretno=4">
</div>

<h1>Theo's Chord Generator &ndash; Documentation</h1>

<div id="bcglink"><a href="http://tpn.lowtech.org">http://tpn.lowtech.org</a> &mdash; <a href="?">Theo's Chord Generator</a></div>

<p>This tool displays chord position diagrams for fretboard-based stringed instruments, such as the banjo, mandolin, guitar etc. While pre-made chord diagrams are very easy to find for common instruments and tunings, this tool allows you to find chords for <i>any</i> tuning, since it calculates and generates the chord positions dynamically.&nbsp;&nbsp;I originally wrote the chord generator for the banjo, because I couldn't find chord diagrams for a lot of the instrument's more esoteric tunings.  However, most fretted instruments are supported.</p>
	
<p>If you have found this document as the result of a search, you may wish to see the <a href="http://tpn.lowtech.org/">Chord Generator</a> itself first.  Also, you can find some of my actual music on my <a href="http://tpn.lowtech.org/music/">website</a> and on <a href="https://www.youtube.com/channel/UC49jYN45DJvyOlyem_Sa4jQ">YouTube</a>.</p>

</div>

<div class="section">

<h2>Help to support the Chord Generator</h2>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" value="WKK3D4Z2PCM9G" />
<p> If you use the Chord Generator regularly and would like to fund further improvements, please consider making a donation.  Any contributions would be gratefully received!</p>
<p style="text-align:center">
<input id="donatebtn" type="submit" value="Donate" alt="PayPal – The safer, easier way to pay online." />
</p>
</form>


</div>

<div class="section" id="tools" style="overflow:auto;">

<h2>More Tools</h2>

<p>If you are interested in the Chord Generator, you may wish to see some of my other music-related tools.  These include:</p>

<div class="toollink">
	<a href="kb2fb.php">Keyboard-to-Fretboard<br/>
	<img src="http://tpn.lowtech.org/images/kb2fb.jpg" style="width:200px"></a><br/>
	(powered by the <i>Chord Generator</i>)
</div>

<div class="toollink">
	<a href="tensiontool.php">String Tension Calculator<br/>
	<img src="http://tpn.lowtech.org/images/tension.jpg" style="width:200px"></a><br/>
</div>

<div class="toollink">
	<a href="frettool.php">Fret Spacing Tool<br/>
	<img src="http://tpn.lowtech.org/images/frettool.jpg" style="height:160px"></a><br/>
</div>

</div>

<div class="section">
<div class="iright">
<img src="?m=c&tuning=C,G,C,D&amp;chord=C&amp;fretno=5">
<img src="?m=c&tuning=C,G,C,D&amp;chord=C&amp;alt=2&amp;fretno=5">
</div>

<h2>Using The Chord Generator</h2>

<br>
<h3>Instrument &amp;Tuning</h3>

<p>The Chord Generator includes presets for several instruments and their respective tunings.  This is not to say it is limited to those, however, as any tuning can be entered in the <b>Tuning</b> box.  When you've entered the tuning and selected the parameters for the chord, simply click <b>Go!</b> to load your chord(s.)</p>

<p>For the most part, it doesn't matter which instrument you have selected, because the important part is the tuning.&nbsp;&nbsp;There is a special case when it comes to 5-string banjo tunings; due to the special nature of the banjo's 5th string, it's not usually used in chords &ndash; or rather, it's not fretted as part of a chord. So, if it's tuned to part of your current chord, it'll ring out as part of it. If not, it will act as a drone and establish the tonality of the piece as a whole &ndash; since it's usually tuned to the root, 5th or 3rd of the current <i>key</i>.</p>

<div class="ileft">
<img src="?m=c&tuning=E,A,D,G,B,E&amp;chord=Dm&amp;fretno=4">
</div>

<p>Therefore, it doesn't matter whether you enter <b>a,E,A,C#,E</b>, <b>c#,E,A,C#,E</b> or simply <b>E,A,C#,E</b>, your chord will be the same since the chord generator simply drops the 5th string.  If you're lucky enough to be in possession of a banjo with an extra bass string, you can still use the chord generator - provided you enter <b>all the strings</b> and put the drone string in <b>lower case</b> so the chord generator knows that it's dealing with 5 chording strings and not either 4 strings and a drone or 6 playable strings. The same applies to banjos with more than 6 strings. For example: <b>g,G,D,G,B,D</b></p>

<div class="iright">
<img src="?m=c&tuning=D,G,B,D&amp;capo=2&amp;chord=G&amp;capo=2">
</div>

<p>An alternate method of notating tunings is to use the intervals between the strings rather than the absolute notes. You only need the note of the left hand (bass on a guitar, thumb string on a banjo) string, plus the intervals, in order to enter the tuning.  So, the banjo's <b>Open-G</b> tuning would be <b>g,7,5,4,3</b>, and to turn it into an <b>A</b> tuning you'd simply enter <b>a,7,5,4,3</b> and to turn it into the old minstrel <b>E</b> tuning, you'd enter <b>e,7,5,4,3</b>. The guitar's standard tuning would be <b>E,5,5,5,4,5</b>. The tuning box also accepts this notation.</p>

<p>If you have a left handed instrument, simply enter the tuning as normal and select <b>Left</b> from the <b>Handed</b> selection area.&nbsp;&nbsp;If you are using a capo, you can use the <b>Capo</b> menu to select upon which fret you have got it, and the chord generator will then generate only chords playable below the capo.</p>

<div id="cnq">
<br>
<h3>Chord and Quality</h3>

<p>The <b>Chord</b> menu allows you to choose a note from the chromatic scale as the root for your chord (and scale, unless your're in <i>Single Chord</i> or <i>All Qualities</i> mode.)&nbsp;&nbsp;Of course, the non-natural notes have two names (e.g. <i>F# / Gb</i>.) There is a fairly solid rule as to what the note <i>should</i> be called in the context of diatonic scales, however (see below.)</p>

<p>In <i>Single Chord</i> mode, only the chord which you have selected will be shown, and you will also be able to select the <b>Chord Quality</b> (e.g. <i>Major</i>, <i>Minor</i>, <i>Augmented</i>, etc.)  The other modes are either Diatonic scales (<i>Major</i>, <i>Minor</i> etc.) or special (<i>Chromatic (All Chords)</i>, <i>All Qualities</i>); and, in these modes, you can't select the chord quality.<p>

<p>In <i>All Qualities</i> mode, all the types of chord which the chord generator supports will be shown, rooted on the note you select.  In <i>Chromatic (All Chords)</i> mode, <i>all</i> of the <i>Major</i>, <i>minor</i> and <i>Dominant 7th</i> chords are displayed (arguably the most common chords played in popular, folk music and classical genres.)  If you want to see other kinds of chord, though, you will still need to go to single chord mode.</p>

<p>When using Diatonic scales, the scale selected will dictate the chords available - for example, you could not select <i>Gm</i> as your root chord if you were using a major scale such as the <i>Ionian</i> or <i>Mixolydian</i>, since they do no include a <i>Bb</i> as part of the scale. And vice versa, you could not select the <i>G Major</i> chord if you were using a scale with a flattened 3rd.  Thus, the <b>Chord Quality</b> box will be disabled when not in single chord mode.</p>
</div>


<div class="iright">
	<img src="?m=c&banjo&amp;tuning=a,E,A,C%23,E&amp;chord=A&amp;scale=dor&amp;showscale&amp;fixenharm">
</div>
<div class="ileft">
	<img src="?m=c&banjo&amp;tuning=E,A,D,G,B,E&amp;chord=D&amp;scale=ion&amp;showscale&amp;fixenharm"><br/>
</div>
<br>
<h3>Scales</h3>

<p>The <b>Scale</b> option allows you to pick from which scale your chords will be chosen. This will also decide the quality of the root chord (major, minor or diminished.)  If you're unsure that this is the behaviour you want, it might make more sense to use the <i>Chromatic (All Chords)</i> or <i>Single Chord</i> options to manually select the chord you want. If, on the other hand, you wish to harmonise with a particular key, one of the diatonic scales (or modes) may be more useful to quickly find appropriate chords.</p>

<p>If you pick a tuning from the <b>Some Tunings</b> list, the key and scale will default the one for which that tuning is usually used.  Guitar standard tuning is an obvious example of a tuning designed for (at least theoretically) playing in any key, however this is not usually the case with, for instance, many of the more esoteric banjo tunings.  These have usually been settled upon to play in a certain key, whilst evoking a mood or atmosphere though the use of open string drones.  It's a moot point as to whether these tunings were ever really designed for playing full chords in, but, since that's the purpose of this tool, they are included.  For an exhaustive list, see <a href="http://zeppmusic.com/banjo/aktuning.htm">here</a>.</p>

<br>
<h3>Scale Diagrams</h3>

<p>If <b>Show Scale</b> is checked then the chord diagrams will be followed by a scale diagram. This shows the positions of all the notes in the current scale as found in your selected tuning across the entire fretboard (down to the 12th fret, after which the pattern repeats!)</p>

<p>The colour of the circles represent the note's position in the scale, as in standard chord diagrams. Except, of course, that this is the note's position relative to the scale root, as opposed to the root of the selected chord.  The yellow notes indicate that this note matches the first note on the next string. This does not necessarily mean the open string.  If the open note of a string is in red, it means this is NOT part of the scale, and you should avoid it; for example the major 3rd, <b>C#</b>, in the minor <b>Dorian</b> scale pictured to the right.</p>

<br>
<h3>Drawing Manual Chord Positions</h3>

<p>If you already know the fingerings for a chord (whether or not you know <i>what</i> the chord is), you can use the <b>Manual</b> button to switch into <i>Manual Chord Position</i> mode.  Here, you can enter a set of fret positions in order such as <i>2,0,1,2</i>, and click <i>Go</i> to draw that chord in the current tuning.  If the Chord Generator can establish what the chord actually is, then it will show its name too.</p>

<br>
<h3>Finding Open Chords</h3>

<p>Many banjo tunings are <i>Open Tunings</i>; the strings will play some specific chord without needing to be fretted.  Pressing the <b>Open</b> button will attempt to find the open chord for your selected tuning if it exists.</p>

<br>
<h3>Building Custom Chord Sheets</h3>

<p>If you want to make a sheet containing specific chords for one or more instruments and tunings, you can use the <b>Custom Chord Sheet</b> button.  This will open a pane at the right hand side of the screen, into which you can place any chords from the main pane by clicking on them.  You can drag chords around in the right hand pane to re-arrange them, or double click them (or drag them outside the pane) to remove them.</p>

<p>When you click on print, it is the contents of this pane which will be printed, rather than the contents of the central pane, as normally happens.  If you try and navigate away from the page whilst you are editing a custom chord sheet, you will receive a warning, since all changes will be lost upon leaving the page.</p>

<p>If you wish to share your custom chord sheet, you can use the <b>Share</b> button.  This will give you a (rather long) link which you can copy and paste to let other people load the same custom chords.</p>

<br>
<h3>Printing Chords</h3>

<p>Clicking the <b>Print</b> button will prompt you to print a page of chords. Please make sure you have chosen your <b>Scale</b> and <b>Diatonic Chords</b> correctly if you are printing a whole sheet of chords; that's a better use of paper, but you don't want to end up with the wrong set of chords.</p>

<p><b>You can also use your browser's standard <i>Print...</i> function &ndash; it WILL print only the chords, not the whole interface.</b></p>

<br>
<h3>Linking To and Bookmarking Chords</h3>

<p>Due to the way the chord generator is programmed, nearly all of the functionality takes place <i>behind the scenes</i>, and the new chords are generated and then loaded without having to submit a form or refresh the page.  Because of this, however, if the page <i>is</i> reloaded then it will revert to the default settings, and any chords and tunings specified will be lost.</p>

<p>If you wish to link to a specific set or chords, and/or add it to your browser bookmarks so that it's easy to get back to it in the future, you can use the <b>Static Link</b>, which appears on the main interface below the intro text.  This is a a special link which is dynamically updated to reflect the current parameters specified in the interface.</p>


<br>
<h3>Advanced Options</h3>

<p><b>Fret Offset</b> allows you to set a fret below which all notes of the chord should fall.&ndash;&ndash;This is effectively quite similar the capo option, except it will not draw the capo and the notes which it would "fret".  It could be useful for generating closed position chords and inversions up the neck.

<p>The rationale behind the <b>Prefer # or b Keys</b> option is documented in the <i>Enharmonic Notes</i> section.&ndash;&ndash;Should you want to play in normally inaccessible keys such as <i>D# Major</i> (complete with its <i>F##</i> and <i>C##</i>), this is the option to use.&ndash;&ndash;</p>

<p>The <b>Random</b> option allows you to select what is randomized when you click the <b>Random</b> button.  The default is to load a random chord in the current tuning, however you may also wish to select a random tuning on the current instrument, or evene select a random instrument each time the button is clicked.</p>

<p>A relation of the previous option, <b>Fix Enharmonic</b> (which is turned on by default) allows you to disable any substitution of enharmonic notes, even when this yields ugly scales such as <i>G, A, A#, C, D, D#, E, F</i>.</p>

<p>The <b>Reverse Left-Handed</b> option allows you to toggle whether a manual chord position is entered in the same way in which the diagrams are displayed (i.e. the reverse of right-handed) or not.  This may or may not be intuitive, since in virtually any standard banjo literature, the <i>tunings themselves</i> are listed in right handed fashion.  So, for example, a <b>C</b> chord in <b>Open G</b> tuning on the banjo would either be entered (standard) <i>2,0,1,2</i> or (reversed) <i>2,1,0,2</i>.</p>

</div>

<div class="section" id="theory">
<div class="iright">
	<img src="?m=c&banjo&amp;tuning=C,G,C,G,C,D&amp;chord=C&amp;scale=ion&amp;showscale&amp;fixenharm">
</div>

<h2>Music Theory and Chords</h2>

<div id="minicol">
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(128,0,0);">Root</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(128,92,92);">2nd</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(0,128,0);">3rd</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(255,128,0);">4th</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(0,0,128);">5th</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(0,128,128);">6th</div>
	<div style="padding-left:4px;color:#FFFFFF;font-weight:bold;background-color:rgb(128,0,128);">7th</div>
</div>
<br>
<h3>How The Chords Are Constructed</h3>

<p>Usually, a chord consists of a triad (3 notes.) A <b>Major chord</b> triad is the root (the note itself), the 3rd and the 5th. e.g. <b>C = C,E,G</b>. When more than 3 strings are used, you double up one of the notes. e.g. <b>Open-G (gDGBD)</b>, which yields a <b>G</b> chord when unfretted.</p>

<p>A <b>Minor chord</b> is a triad with a <b>Minor 3rd</b> (the note flatted.) e.g. <b>Dm = D,F,A</b>.</p>

<p>A 7th chord consists of a triad plus the seventh note of the scale on which the chord is based.  The most common 7th chord is the <b>Dominant 7th</b>, which consists of a Major triad and a flattened 7th, e.g. <b>G7 = G, B, D, F</b>.  There are also the <b>Major</b> and <b>Minor</b> 7th chords: <b>Dmaj7 = D, F#, A, C#</b>, <b>Em7 = E, G, B, D</b>.</p>

<p>A <b>Diminished Chord</b> has also has minor 3rd but the 5th is also flatted, e.g. <b>Cdim = C, Eb, Gb</b>.</p>

<p>An <b>Augmented Chord</b> is the triad with the 5th raised, e.g. <b>Baug = B, D#, G</b>.</p>

<p>A <b>Suspended chord</b> is a chord with the 3rd raised to a 4th (sus4) or lowered to a 2nd (sus2.) e.g. <b>Dsus2 / Asus4 = D,E,A</b> &amp; <b>Gsus4 / Csus2 = G,C,D</b>, <b>Dsus4 / Gsus2 = G,A,D</b> etc.</p>

<p>A <b>5</b> chord is the triad but without the 3rd (a dyad.) e.g. <b>D5 = D,A</b>. These are also known as power chords.</p>

<br>
<h3>Enharmonic Notes</h3>

<p>Unless you are playing in only the natural scales (C Major / A Minor / D Dorian etc.), your scale and chords will include accidentals (# or b notes.)  Depending upon the context, the same note must be given different names. For example, <i>G Aeolian</i> (or <i>Melodic Minor</i>) includes the notes <i>G, A, Bb, C, D, Eb and F</i>.  Technically, they could be written as <i>G, A, A#, C, D, D# and F</i>.  But you'd notice that this looks a bit odd; you have two notes called <i>A</i> and two called <i>D</i>, whilst <i>B</i> and <i>E</i> are absent.&nbsp;&nbsp;On the other hand, the same appear as sharps in the key of <i>B Major</i> (<i>B, C#, <b>D#</b>, E, F#, G# and <b>A#</b></i>.)  If they were were flats, the scale would be a rather unreadable <i>B, Db, Eb, E, Gb, Ab, Bb</i>.</p>

<p>Then, there is the case of scales rooted on a sharp of flat.  These scales could actually legitimately be rendered in either sharp or flat form, e.g.: <i>C# Major</i> (<i>C#, D#, E#, F#, G#, A#, B#</i>), versus <i>Db Major</i> (<i>Db, Eb, F, Gb, Ab, Bb and C</i>.)  In this case, the latter is the most commonly used form because, when written out in sheet music, it contains fewer accidentals.&nbsp;&nbsp;This is thus the version of the key which the chord generator will default to unless the <b>Prefer # or b Keys</b> option (found in <b>advanced options...</b>) is set.</p>

<p>In <i>Chromatic (All Chords)</i> mode, every chord name will be calculated as if that chord were the root of its own scale, and so you will see various incarnations of the various accidentals depending on which chord they appear in.  For instance the <i>E Major</i> chord will include a <i>G#</i>, while the <i>Db Major</i> chord will include an <i>Ab</i>.  This can result in a few anomolies, such as the fact that even if you select <i>A#</i> as your root, you will see <i>C</i> rather than <i>B#</i>.</p>

<p>The <i>correct</i> note names do not need to be calculated by using any specific scale as reference. We simply need to ensure the each (diatonic) scale contains <i>every letter</i> and that each letter appears <i>once and once only</i>. With this rule some accidentals become flats and become sharps. If you're confused just try picking a load of scales (both major and minor), and you should see the logic in the names assigned to the keynote as well as the other 6 notes.&nbsp;&nbsp;Should you wish to see each note in its completely unaltered form, you can untick the <b>Fix Enharmonic</b> option in <b>advanced options</b>.  This is not the recommended way to display the chords, though, and will probably completely bewilder anyone who has studied music theory.</p>

</div>
<div class="section">

<h2>Troubleshooting &amp; Advanced Use</h2>

<p>The chord generator should work in any standards compliant browser and even <i>Internet Explorer</i>. The interface functionality is only available with <i>JavaScript</i> enabled &ndash; if you don't know what that means then it probably <i>is enabled</i>. If you can't/won't enable <i>JavaScript</i> you can still generate the chords by specifying them in the URL (see below.)</p>

<br>
<h3>URL Parameters</h3>

<p>All parameters are passed to the page after the address.  The first one must be preceded by a <u>?</u>, after which they should be separated with <u>&amp;</u>.</p>

<p><u><b>m=[c,i]</b></u> - to make the chord generator load a single chord diagram rather than the whole page, you can append <u>m=c</u> to the URL.</p>

<p><u><b>instrument=[banjo,guitar,mandolin,mandola,ukulele]</b></u><br/>
<u><b>tuning=[...]</b></u><br/>
<u><b>chord=[...]</b></u><br/>
<u><b>quality=[,m,7,dim,aug,maj7,m7,sus2,sus4,add6,5]</b></u><br/>
<u><b>capo=[...]</b></u>.</p>

<p><u><b>alt=[n]</b></u>. Select the alternate chord to display, so that you can load a single image for an alt. chord.</p>

<p><u><b>random</b></u>. Picks a random chord and instrument. <a href="?m=i&random">pick a chord, any chord</a>.</p>


<p>There are several <i>undocumented</i> switches too. Some of these are really just for my own debugging, but some may be useful to truly fine-tune the way that your chord is generated or displayed. They are not for the casual user, however, and I figure if you want to know what they are it's pretty simple to find them in the source code. If you don't know how to do that then they've probably not got much that you'll want or need.</p>

</div>

<div class="section" id="links">

<h2>Links</h2>

<ul>
	<li><a href="http://tpn.lowtech.org/">Theo Parmakis</a></li>
	<li><a href="http://zeppmusic.com/banjo/aktuning.htm">Anita Kermode's 5-String Banjo Tunings</a></li>
	<li><a href="http://www.rocketsciencebanjo.com">Rocket Science Banjo</a></li>
</ul>

</div>


<div class="section" id="copyright">
<h2>Authorship and Copyright</h2>

<p><i>PHP</i> code etc. &copy; 2015 <b>Theo Parmakis</b> (<a href="http://tpn.lowtech.org">http://tpn.lowtech.org</a>.)  Additional interface design by Sol Loreto-Miller.</p>

<p>This script is relased as Free Software / Open Source Software under the <a href="http://www.gnu.org/licenses/agpl-3.0.html"><b>GNU Affero General Public License 3</b></a>.</p>

<p>You may download the source code of this program, study it, modify it and redistribute modified copies. You may even adapt this program &ndash; for example to make a mandolin chord generator &ndash; and put that new version on your website.</p>

<p>You <b>must</b>, however, preserve this authorship and copyright notice as well as the fact that your have modified it. Additionally, you must make the source code available from your server, just as I have done.</p>

<p>The source code can be downloaded from <a href="http://tpn.lowtech.org/scripts/chordgen_php.tar.gz">http://tpn.lowtech.org/scripts/chordgen_php.tar.gz</a>.</p>

</div>

</body>
</html>
<?

}

## Did You Know...
$didYouKnow = array();

{
$didYouKnow[0] = <<<EOF
You can uncheck <b>Diatonic Chords</b> in order to get chords outside of the current scale. If you're wondering why you can only see major chords (or minor chords), try unchecking <b>Diatonic Chords</b> now.
EOF;

$didYouKnow[1] = <<<EOF
You don't have to select one of the preset tunings. Simply enter a <b>Tuning</b> in the box; the notes should be comma-separated.
EOF;

$didYouKnow[2] = <<<EOF
This chord generator isn't just for the <b>$instrument</b>! If you play another fretted instrument simply enter the tuning in the box above.
EOF;

$didYouKnow[3] = <<<EOF
If you play it left hand, you can use the <b>Handed</b> radio button to choose which way round you want you chord diagrams.
EOF;

$didYouKnow[4] = <<<EOF
You can use a <b>Capo</b> in your chord diagrams. Try selecting the 2nd fret as your capo postion and see how your chords are transposed.
EOF;

$didYouKnow[5] = <<<EOF
<b>Fret Offset</b> allows you to have some control over down-the-neck inversions.
EOF;

$didYouKnow[6] = <<<EOF
You can get the full 12 chords of the scale by using the <b>Scale</b> drop down and selecting <i>Chromatic</i>.
EOF;

$didYouKnow[7] = <<<EOF
You can print chord sheets out simply by hitting the <b>Print</b> button or your browser's print option. You don't have to worry about all the surrounding interface, it will not be part of the printed sheet.
EOF;

$didYouKnow[8] = <<<EOF
Notes displayed on the chord diagrams in <span style="background-color:#000000;color:#FFFF00;font-weight:bold">yellow</span> can be left out for interesting inversions.
EOF;

$didYouKnow[9] = <<<EOF
If your instrument is tuned to an open chord (the banjo's <i>Open G</i>, for example, and many <i>slide guitar</i> tunings), clicking on the <b>Open</b> button will try and base your scale around that chord.
EOF;


$didYouKnow[10] = <<<EOF
There's full documentation for the chord generator available at a click of the <b>Help</b> button.
EOF;

$didYouKnow[11] = <<<EOF
If you want partial chords with a tonic or walking bassline, check the <b>Partial Chords</b> box.
EOF;

$didYouKnow[12] = <<<EOF
This chord generator is <i>Free / Open Source</i>. If you want to see how it's built then you can actually download the source code. See the <b>Help</b> section for more info.
EOF;

$didYouKnow[13] = <<<EOF
There's more than one way to tune a cat... Uhm, $instrument.
EOF;

$didYouKnow[14] = <<<EOF
The box at the top right is the key to the colours used in the chord diagrams. They are a quick way to see which note is the root, 3rd, 5th or an added tone.
EOF;
}

?>
