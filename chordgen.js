var singleMode = false;
var lastScale = "";
var lastChord = "";
var lastQuality = "";
var customMode = false;
var prog = 0;
var progressInc = 0;
var lastTuning;
var chordgenUrl = document.location.pathname;

$(document).ready (function () {
	$("div#nojs").hide();
	$("form#chordset").trigger('reset');

	$("div#cposcontainer").hide();
	$("div#singleintro").show();
	$("div#advopt").hide();
	$("div#instlist").hide();
	$("div#tuninglist").hide();
	$("form#chordset").submit ( function (e) {
		e.preventDefault();
		showChord(false);
	});

	//$("div#authorship, div#bottombtns").draggable();

	//if ($(window).height() >= $("div#colleft").height()) {
	//	$("div#colleft").css ({'position':'fixed','overflow-y':'auto','height':'100%'});
	//}
	$("div#sheetchords").sortable({
		over: function () {
			removeIntent = false;
		},
		out: function () {
			removeIntent = true;
		},
		beforeStop: function (event, ui) {
			if(removeIntent == true){
				ui.item.remove();   
			}
		}
	});

	//$("div#sheetchords").height ($(window).height() - $("div#colsheet > div").height() - 16); 
	$("div#colsheet").hide();
	$("div#colhelp").hide();

	//$("select#chord").change (function() {
	//	if ($("select#chord option:selected").val().match (/#/)) {
	//		$(this).css ('font-size','10pt');
	//	} else {
	//		$(this).css ('font-size','');
	//	}
	//});

	$("select#scale").change (function() {
		toggleQuality();
	});

	$("a.newwin").each (function () {
		var href = $(this).attr('href');
		$(this).attr('href','#')
1
		$(this).click (function () {
			window.open(href);
		});

	});

	lastScale = $("select#scale option:selected").val();
	manualChord (true);

	if ($("input#cpos").val() != "") {
		manualChord();
	}
	chInstrument ($("input#instrument").val(),false,false);
	showChord (false);

	if ($("div#sheetchords").html() != "") {
		toggleSheet();
	}

	$(window).bind('beforeunload', function(e) { 
		if ($("div#sheetchords").html() != "") {
			return ("You have made changes to the custom chord sheet. Are you sure you wish to discard these changes?");
			//return("");
		}

	});

});

function editText (label) {
	var p = label.parent("div.ltext").text ("trololololol"); 

}

function addLabel () {
	var label = $("div#sheetchords").append ("<div class=\"sheetlabel\"><div class=\"ltext\"></div><input type=\"button\" onClick=\"editText($(this))\" value=\"edit text\"/></div>");
}

function addLinebreak () {
	var linebr = $("div#sheetchords").append ("<div class=\"linebr\"></div>");
}

function clearSheet () {
	$("div#sheetchords").empty();
}

function allToSheet () {
	$("div#chordscontainer img.chordimg, div#chordscontainer img.chordimgalt").each (function () { if ($(this).is(":visible")) { addToSheet($(this)); } });
}

function addToSheet (chord) {
	if (customMode) { 
		var clone = chord.clone(false).appendTo($("div#sheetchords"));
		//clone.css ('width',Math.floor(clone.width() / 2));
		//clone.css ('width',clone.css('width') / 
		clone.removeClass ('chordimg');
		clone.removeClass ('chordimgalt');
		clone.attr('id','');
		clone.attr('alt','');
		clone.dblclick (function () { $(this).remove(); });
	}
}

function toggleQuality() {
	if ($("select#scale option:selected").val() != "single") {
		$("span#qualitybox").hide();
		$("span#qualityna").show();
	} else {
		$("span#qualitybox").show();
		$("span#qualityna").hide();
	}
}


function toggleSheet () {
	
	$("div#colsheet").toggle(0, function () {
		if ($(this).is(":visible")) {
			$("div#colchords").css ('right',$(this).width() + 10);
			$("div#colchords").addClass("printhide");
			$("span#nocust").show();
			$(this).removeClass("printhide");
			customMode = true;
		} else {
			$("div#colchords").css ('right','0');
		       	$("div#colchords").removeClass("printhide");
			$("span#nocust").hide();
		       	$(this).addClass("printhide");
			customMode = false;
		}
	});

}

function sheetPosition() {
	if ($("div#colsheet").is(":visible")) {
		if ($("div#colsheet").css('top') != '50%') {
			$("div#colsheet").css('height','50%');
			$("div#colchords").css('height','50%');
			$("div#colsheet").css('position','static');
			$("div#colschords").css('position','static');
			$("div#colsheet").css('width','0px');
		}
	}
}

function shareSheet () 	{
	window.prompt("Copy and paste this link to share your chord sheet","http://chordgen.rattree.co.uk/?sheet=" + encodeURIComponent ($("div#sheetchords").html()));
}

function toggleAdvOpt () {
	$("div#advopt").slideToggle('slow',function () {});
}

function randomChord() {
	showChord (true);
}


function manualChord(reset) {
	if ($('div#chordselcontainer').is(':visible') && !reset) {
		$('input#manual').attr({'value':'Auto'});
		$('div#chordselcontainer').hide();
		lastScale = $('select#scale option:selected').val();
		$('select#scale').val('single')
		$('div#cposcontainer').show();
		toggleSingle(true);
		$('select#alt').attr({'disabled' : true});
		$('select#capo').attr({'disabled' : true});
		$('select#offset').attr({'disabled' : true});
		$('input#tuneopen').attr({'disabled' : true});
		$('input#random').attr({'disabled' : true});
		$("div#cposcontainer").css ('height',$("div#chordselcontainer").height());
	} else {
		$('input#manual').attr({'value':'Manual'});
		$('select#scale').val(lastScale);
		$('div#chordselcontainer').show();
		$('div#cposcontainer').hide();
		toggleSingle();
		$('select#alt').attr({'disabled' : false});
		$('select#capo').attr({'disabled' : false});
		$('select#offset').attr({'disabled' : false});
		$('input#tuneopen').attr({'disabled' : false});
		$('input#random').attr({'disabled' : false});
	}
	chHanded();
}

function showChord(random) {
	if (random) {
		$("select#scale").val("single");
	}
	var chordQuery;
	var scaleQuery;
	var scale = $('select#scale option:selected').attr ('value');
	var quality = $('input#quality').val();
	var chordNo = 0;
	var maxAlt = $("select#alt option:selected").attr ('value');

	if (lastTuning && $("input#tuning").val() != lastTuning) {
		if (customMode && $("div#sheetchords img").length > 0) {
			alert ("Please be aware that you have got chords on your custom sheet for an instrument / tuning other than the one you are about to switch to.  Your currently added chords will NOT be changed to reflect your new tuning.");


		}
	}

	var tNotes = $("input#tuning").val();
	tNotes = tNotes.split (',');
	n = 0;
	var numeric = false;
	for (i=0;i<tNotes.length;i++) {
		if (tNotes[i] == "") {
			alert ("malformed tuning.");
			return (false);
		} else if (i == 0 && tNotes[i].match (/^[0-9]+$/)) {
			alert ("if you are using relative positions, the bass (or leftmost) string most be an absolute note.");
			return (false);
		} else if (!tNotes[i].match (/^([a-gA-G]{1}|[0-9]{0,2})(#|b)?$/)) {
			alert (tNotes[i] + " is not a valid musical note or relative position!");
			return (false);
		} else if (i > 0 && tNotes[i].match (/^[A-G]/) && numeric == true) {
			alert ("If you are using numeric tuning notation, only the bass (or leftmost) string can be an absolute note...");
			return (false);
		} else if (i > 0 && tNotes[i].match (/^[0-9]+$/)) {
			numeric = true;
		}
		if (tNotes[0].match (/[A-Ga-g]/) && tNotes[i].match (/^[A-G0-9]/)) {
			n++;
		}
	}

	if (n<3) {
		alert ("You cannot generate a chord with less than three strings!");
		return (false);
	}


	if ($('div#cposcontainer').is(':visible')) {
		var tPos = $("input#cpos").val();
		tPos = tPos.split (',');
		for (i=0;i<tPos.length;i++) {
			if (!tPos[i].match (/^[0-9x]{1,2}$/)) {
				alert ("You cannot enter anything other than numbers in the Chord Position box...");
				return (false);
			}
		}

		if (tPos.length != n && tPos.length != tNotes) {
			alert ("The manual chord position must be the same number of strings as (chordable strings of) the tuning...");
			return (false);
		}
	}

	toggleQuality();

	lastTuning = $("input#tuning").val();

	toggleSingle();

	if (scale == "single" || scale == "altq") {
		$("input#displayscale").attr({"disabled" : true});
	} else {
		$("input#displayscale").attr({"disabled" : false});
	}

	if (scale == "chrom") {
		chordNo = 36;
	} else if (scale == "single") {
		chordNo = 1;
	} else if (scale == "altq") {
		chordNo = 13;
	} else {
		chordNo = 7;
	}

	progressInc = Math.ceil(100 / (chordNo + 1));
	prog = 0;
	progress(0, $('#progressBar'));
	$("div#chordscontainer").hide();
	$("div#progresscontainer").show();

	$("img.chordimg").off('click');
	$("img#scaleimg").off('click');
	$("div#chordscontainer img.chordimgalt").remove();
	$("div#warn").hide();

			
	var statLink = "";
	
	if (!random) {
		statLink = chordgenUrl
		+ "?instrument=" + $("input#instrument").val()
		+ "&tuning=" + $("input#tuning").val()
		+ "&scale=" + $("select#scale option:selected").val()
		+ "&alt=" + $("select#alt option:selected").val()
		+ "&capo=" + $("select#capo option:selected").val()
		+ "&handed=" + $("input[name=handed]").filter(":checked").val()
		+ "&offset=" + $("select#offset option:selected").val()
		+ "&fixenharm=" + ($("input#fixenharm").is(":checked") ? "on" : "off")
		+ "&prefersf=" + $("select#prefersf option:selected").val();

		if ($('div#cposcontainer').is(':visible')) {
			statLink += "&cpos=" + $("input#cpos").val();
		} else {
			statLink += "&chord=" + escape($("select#chord option:selected").val())
			+ "&quality=" + $("select#quality option:selected").val();
		}

		if ($("input#displayscale").is(":checked") && scale != "single" && scale != "altq") {
			statLink += "&showscale";
		}

		$("a#statlink").attr ("href", statLink);
	}

	for (var i=1;i<=chordNo;i++) {

		if (random) {
			chordQuery = "m=c&random&fixenharm=" + ($("input#fixenharm").is(":checked") ? "on" : "off");
			if ($("select#randomize option:selected").val() == "t") {
				chordQuery = chordQuery + "&instrument=" + $("input#instrument").val()
			} else if ($("select#randomize option:selected").val() == "c") {
				chordQuery = chordQuery + "&instrument=" + $("input#instrument").val()
				+ "&tuning=" + escape($("input#tuning").val());
			}
		} else {
			chordQuery = "m=c&instrument=" + $("input#instrument").val()
				+ "&tuning=" + escape($("input#tuning").val())
				+ "&scale=" + $("select#scale option:selected").val()
				+ "&handed=" + $("input[name=handed]").filter(":checked").val()
				+ "&fixenharm=" + ($("input#fixenharm").is(":checked") ? "on" : "off")
				+ "&offset=" + $("select#offset option:selected").val()
				+ "&capo=" + $("select#capo option:selected").val()
				+ "&key=" + i
				+ "&prefersf=" + $("select#prefersf option:selected").val()
				+ "&revlh=" + ($("input#revlh").is(":checked") ? "on" : "off")
				+ "&debug=" + $("input#debug").val()
				//+ "&partial=" + ($("input#partial").is(':checked') ? "on" : "off")

				if ($('div#cposcontainer').is(':visible')) {
					chordQuery += "&cpos=" + $("input#cpos").val();
					maxAlt = 0;
					$("select#alt").val(0);
				} else {
					chordQuery += "&chord=" + escape($("select#chord option:selected").val())
						+ "&quality=" + $("select#quality option:selected").val()
				}
		}

		if (i == 1) {
			chordQuery += "&dyk";
		}

		jQuery.ajax({
			url: chordgenUrl,
			type: "get",
			data: chordQuery + "&json",
			dataType: "json",
			async: true,
			success: function (data) {
				chordImg = $("img#chordImg" + data.keyoffset);

				if (data.keyoffset == 1) {
					$("span#cposcur").html (data.cpos.join(","));
					if ($('div#cposcontainer').is(':visible') || data.random) {
						$("select#chord").val(data.out_abschord);
						$("select#quality").val(data.out_absqual);
						$("input#tuning").val(data.tuning.join(","));
					}
					if (data.instrument != $("input#instrument").val()) {
						chInstrument (data.instrument, false,false);
					}
				}

				if (data.cpos.length == 3 && data.out_absqual.match (/(7|6|9)/) ) {
					$("div#warn").text(data.out_abschord + data.out_absqual + " is a 4 note chord, and will not fit in your chosen tuning.  You can play the version shown, which is missing the 5th.  However, it will not technically be the same chord, and may sound somewhat strange.");
					$("div#warn").show();
				}

				if (data.dyk) {
					$("div#dyk").html (data.dyk);
				}

				var desc = (data.out_chord ? data.out_chord : "unknown") + " chord in " + data.tuning + (data.capo > 0 ? " (capo " + data.capo + ")" : "") + ": \n";
				for (i=0;i<data.notes.length;i++) {
					desc += "string " + (data.cpos.length - i) + " - " +  (data.cpos[i] ? "fret " + data.cpos[i] : "open") + " (" + data.notes[i] + "),\n";
				}

				$(chordImg).attr({"src" : chordgenUrl + "?" + data.query + "&cpos=" + data.cpos});
				$(chordImg).attr({"alt" : desc});
				$(chordImg).attr({"title" : desc});
				$(chordImg).click(function () { addToSheet($(this)); });
				$(chordImg).show();
				
				for (alt=maxAlt-1;alt>=0;alt--) {
					$("img#chordImg" + data.keyoffset).after ("<img class=\"chordimgalt\" id=\"chordImg" + data.keyoffset + "_" + alt + "\"/>");
					var altImg = $("img#chordImg" + data.keyoffset + "_" + alt);

					var altDesc = (data.out_chord ? data.out_chord : "unknown") + " chord in " + data.tuning + (data.capo > 0 ? " (capo " + data.capo + ")" : "" ) + ":\n";
					for (i=0;i<data.altnotes[alt].length;i++) {
						altDesc += "string " + (data.altpos[alt].length - i) + " - " +  (data.altpos[alt][i] ? "fret " + data.altpos[alt][i] : "open") + " (" + data.altnotes[alt][i] + "),\n";
					}

					altImg.attr({"src" : chordgenUrl + "?" + data.query + "&cpos=" + data.altpos[alt].join(",")});
					//altImg.attr({"alt" : data.altdesc[alt]});
					altImg.attr({"title" : altDesc});
					altImg.click(function () { addToSheet($(this)); });
				}
				
				prog += progressInc;
				progress(prog, $('#progressBar'));
				chkProgress();
				//$( "#progressbar" ).progressbar({ value: prog });
			},
				error: function () {
					prog += progressInc;
					progress(prog, $('#progressBar'));
					chkProgress(prog);

				}

		});

	}

	for (i=chordNo+1;i<=36;i++) {
		$("img#chordImg" + i).attr({"src" : ""});
		$("#chordImg" + i).attr({'alt': ""});
		$("#chordImg" + i).attr({'title': ""});
		$("img#chordImg" + i).hide();
	}

	if ($("input#displayscale").is(":checked") && scale != "single" && scale != "altq" && !random) {
		scaleQuery = "m=c&instrument=" + $("input#instrument").val()
			+ "&tuning=" + escape($("input#tuning").val())
			+ "&chord=" + escape($("select#chord option:selected").val())
			+ "&quality=" + $("select#quality option:selected").val()
			+ "&scale=" + $("select#scale option:selected").val()
			+ "&handed=" + $("input[name=handed]").filter(":checked").val()
			+ "&fixenharm=" + ($("input#fixenharm").is(":checked") ? "on" : "off")
			+ "&prefersf=" + $("select#prefersf option:selected").val();
		$("img#scaleimg").attr({ "src" : chordgenUrl + "?" + scaleQuery + "&showscale" });
		$("img#scaleimg").show();
		$("img#scaleimg").click(function () { addToSheet($(this)); });

	} else {
		$("img#scaleimg").attr({ "src" : "" });
		$("img#scaleimg").hide();
	}
	//$("img.chordimgalt").each (function () { if (($(this).attr('id').replace (/.*_(\d)/, '$1') > maxAlt) { $(this).remove(); } });
	prog += progressInc;
	progress(prog, $('#progressBar'));
	chkProgress(prog);

}

function chHanded() {
	if ($("input#revlh").is(":checked") && $("input[name=handed]").filter(":checked").val() == "left") {
		$("div#lhinfo").show();
		//if ($("div#cposcontainer").is(":visible")) {
		//$("input#cpos").css ("direction","RTL");
		///$("input#tuning").val($("input#tuning").val().split("").reverse().join(""));
	} else {
		//$("input#cpos").css ("direction","");
		$("div#lhinfo").hide();
	}

}

function chkProgress () {
	if (prog >= 100) {
		$("div#progresscontainer").hide();
		$("div#chordscontainer").show();
	}
}

function toggleSingle (force) {
	var scale = $('select#scale option:selected').val();

	if (scale == "single" || force) {
		singleMode = true;
		$("div#helpsingle").show();
	} else {
		singleMode = false;
		$("div#helpsingle").hide();
	}
}

function fillTune(tuning, chord, scale) {
	$("input#tuning").val(tuning);

	$("select#chord").val(chord);
	$("select#scale").val(scale);

	showChord(false);
}

function showHelp() {
	window.open(chordgenUrl + "?help");
}

function showPrint() {
	window.print();
}

function parseReturn() {
	var tuning = $('input#tuning').val();
	jQuery.ajax({
		url: chordgenUrl,
		type: "get",
		data: "m=c&tuning=" + escape(tuning) + "&json",
		dataType: "json",
		async: false,
		success: function (data) {
			if (data.out_openchord) {
				//alert (data.out_chord);
				//alert (data.out_scale);
				$("select#chord").val(data.out_openabschord);
				$("select#quality").val(data.out_openabsqual);
				showChord();
				//if ($("#scale").val() != "chrom") {
				//	$("#scale").attr({'value':data.out_openscale});
				//}
				//quality.options[r11esponse[2]].selected = true;
				//scale.options[response[3]].selected = true;
			} else {
				alert("No Open Chord could be established for " + tuning);
			}
	}});

}

function chInstrument (inst, changeChord, changeTuning) {
	manualChord(true);
	jQuery.ajax({
		url: chordgenUrl,
		type: "get",
		data: "m=c&instrument=" + escape(inst) + "&json&jmode=i" + ($("input#makeinstdef").is(":checked") ? "&makeInstDef" : ""),
		dataType: "json",
		async: false,
		success: function (data) {
			$("span#instname").text (data.instrument);
			$("span#instlist ul li a").each (function () {
				if ($(this).text() == data.instrument) {
					$(this).addClass ("currentinst");
				} else {
					$(this).removeClass ("currentinst");
				}
			});
			$("input#instrument").val(data.instrument);
			if (changeTuning) {
				$("input#tuning").val(data.tuning);
			}
			$("div#tuninglist ul").empty();

			for (var i in data.deftunings) {
				var li = $("div#tuninglist ul").append ("<li><a href=\"#\" onClick=\"fillTune('" + data.deftunings[i].tuning + "','" + data.deftunings[i].defscale + "')\">" + data.deftunings[i].name + (data.deftunings[i].altname ? " \"" + data.deftunings[i].altname + "\""  : "")  + " (" + data.deftunings[i].tuning.replace (/,/g,'') + ")</a></li>\n");
			}

			if (changeChord) {
				showChord(false);
			}

	}});
	$('div#instlist').hide();

}

function progress(percent, $element) {
    var progressBarWidth = percent * $element.width() / 100;
    var musicNotes = ["&#9833;","&#9834;","&#9835;","&#9836;","&#9837;","&#9838;","&#9839;"];
    //$element.find('div').css({ width: progressBarWidth }).html(Math.floor(percent) + "%&nbsp;");
    $element.find('div').css({ width: progressBarWidth }).append( musicNotes[Math.floor(Math.random() * musicNotes.length)] + "&nbsp;&nbsp;");
}

function reportBug () {
	window.open("http://tpn.lowtech.org/contact.php");
}

function makeInstDef(inst) {
	jQuery.ajax({
		url: chordgenUrl,
		type: "get",
		data: "m=c&instrument=" + escape(inst) + "&json&jmode=i&makeInstDef",
		dataType: "json",
		async: false,
		success: function (data) {
			alert (inst + " will now be selected next time you visit the page.");
			$("input#makeinstdef").attr('checked', false);
		}
	});
}
