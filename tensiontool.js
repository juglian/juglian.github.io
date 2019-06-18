
var noteNames = [ "C", "C#", "D", "C#", "E", "F", "F#", "G", "G#", "A", "A#", "B" ];

var loadedAll = false;

function mkUrl() {
	var p = $('textarea#strings').val();
	p = p.replace (/#/g, '%23');
	var url = 'length=' + $('input#length').val()  + ($('select#units').val() == 'mm' ? 'mm' : '')
		+ '&wmat=' + $('input:radio[name=wmat]:checked').val()
		+ '&smat=' + $('input:radio[name=smat]:checked').val()
		+  ($('input#courses').prop ('checked') ? '&courses' : '')
		+ "&strings=" + p.replace (/(\r\n|\n|\r)/gm, '');
	//alert (url);
	//$("img#tensionimg").css ('border','1px solid red');
	return url;
}

function savePreset() {
	var url = mkUrl();

	document.location = "tensiontool.php?preset=" + encodeURIComponent(url) + "&save";
	//$.ajax({
	//	url: url + "&preset",
	//	context: document.body
	//}).done(function(data) {
	//});
}

function toggleExtra (pPar) {
	//var pPar = pLink.parent().parent();

	if (pPar.find($('div.extra')).length == 0) {
		pPar.append ('<div class="extra"></div>');
		pPar.find($('div.extra')).hide();
		loadMore(pPar.attr('id'));
	}

	var pExtra = pPar.find($('div.extra'));

	if (pExtra.is (':visible')) {
		pExtra.hide ('fast');
		pPar.find('div a.loadmore span').text ('Show');
		$("a#loadall span").text ('Show');
	} else {
		pExtra.show ('fast');
		pPar.find('div a.loadmore span').text ('Hide');
	}


}

function edToStrings(dir) {
	if (dir) {
		$("div#tuninged").html("");
		$("div#tuninged").append ("<form/>");

		var p = $('textarea#strings').val().split (/,/);

		for (i=0;i<p.length;i++) {
			var course = $('input#courses').prop ('checked') ? true : false;

			if (p[i].match(/\*2/)) {
				course = true;
			} else if (p[i].match(/\*1/)) {
				course = false;
			}

			if (p[i].match(/=/)) {
				eqroot = "=";
			} else if (p[i].match(/>/)) {
				eqroot = ">";
			} else {
				eqroot = false;
			}

			p[i] = p[i].replace (/\*[12]/, '');

			var startfret = 0;

			if (p[i].match(/@\d{1,2}/)) {
				startfret = p[i].replace (/.*@(\d{1,2})/, '$1');
			}

			p[i] = p[i].replace (/@\d{1,2}/, '');

			p[i] = p[i].replace (/^\n/, '');

			p[i] = p[i].split (/-/);
			//alert (p[i][0]);
			//alert (p[i]);
			$("div#tuninged form").append ('<div style="border:1px solid #000;margin-top:2px;margin-bottom:2px;background-color:#FFF;"/>');
			j = $("div#tuninged form div:last");
			j.append ("<select class=\"note\"/>");
			for (n=0;n<noteNames.length;n++) {
				//alert (noteNames[n] + " <=> " + p[i][0]);
				j.find ($("select.note")).append("<option " + (noteNames[n] == p[i][0] ? 'selected="selected" ' : '') + "value=\"" + noteNames[n] + "\">" + noteNames[n] + "</option>\n");
			}

			j.append ("<select class=\"octave\"/>");
			for (n=0;n<=8;n++) {
				//alert (noteNames[n] + " <=> " + p[i][0]);
				j.find ($("select.octave")).append("<option " + (n == p[i][1] ? 'selected="selected" ' : '') + "value=\"" + n + "\">" + n + "</option>\n");
			}

			j.append ('<select class="pw" onchange="loadGauges($(this).parent())">' + 
					'<option value="p">plain</option>' +
					'<option value="w"' + (p[i][3] == 'w' ? ' selected="selected"' : '') + '">wound</option>' +
					"</select");

			var smat = "";
			if (p[i].length == 5) {
				smat = p[i][4];
			} else {
				smat = $('input:radio[name=smat]:checked').val();
			}

			//alert (smat);

			j.append ('<select onchange="loadGauges($(this).parent())" class="smat">' + 
					'<option value="s"' + (smat == 's' ? ' selected="selected"' : '') + '>steel</option>' +
					'<option value="n"' + (smat == 'n' ? ' selected="selected"' : '') + '>nylon</option>' +
					"</select");


			j.append ('<select class="gauge"/>');

			loadGauges (j);

			j.find ($('select.gauge option[value="' + p[i][2] + '"]')).attr ('selected', 'selected');
			//var pw = ;

			j.append ('<select class="course">' + 
					'<option value="1">single</option>' +
					'<option value="2"' + (course ? ' selected="selected"' : '') + '>double</option>' +
					"</select");

			//j.append ("<br/>\n");

			j.append (" <b>@</b> ");

			j.append ("<select class=\"startfret\"/>");
			for (n=0;n<=12;n++) {
				//alert (noteNames[n] + " <=> " + p[i][0]);
				j.find ($("select.startfret")).append("<option " + (n == startfret ? 'selected="selected" ' : '') + "value=\"" + n + "\">" + n + "</option>\n");
			}

			//j.append (" <b>=</b> ");

			j.append ('<select style="display:none" class="eqroot" onchange=\"fixEq($(this))\">' + 
					'<option value=""></option>' +
					'<option value="eq"' + (eqroot == "=" ? ' selected="selected"' : '') + '>=</option>' +
					'<option value="gt"' + (eqroot == ">" ? ' selected="selected"' : '') + '>&gt;</option>' +
					"</select");

			/*
			j.append ("<input type=\"radio\" name=\"eqroot\" value=\"eq\"" + (eqroot == "=" ? " checked=\"checked\"" : "") + "/>");

			j.append (" &gt;");
			j.append ("<input type=\"radio\" name=\"eqroot\" value=\"gt\"" + (eqroot == ">" ? " checked=\"checked\"" : "") + "/>");
			*/

			j.append ("<span style=\"float:right\">"
				+ " | "
				+ "<input type=\"button\" class=\"eqbtn\" onclick=\"eqToString($(this).parent().parent(), 'eq')\" value=\"=\"/>"
				+ "<input type=\"button\" class=\"gtbtn\" onclick=\"eqToString($(this).parent().parent(), 'gt')\" value=\">\"/>"
				+ "<input type=\"button\" class=\"copybtn\" onclick=\"copyString($(this).parent().parent())\" value=\"+\"/>"
				+ "<input type=\"button\" class=\"delbtn\" onclick=\"delString($(this).parent().parent())\" value=\"-\"/>"
				+ "</span>");

		}

		$("div#tuninged form").bind ('change', function () { edToStrings(false) });
	} else {
		$("textarea#strings").val("");
		var lines = [];
		var str = "";

		$("div#tuninged form div").each (function () {
			str = $(this).find ($('select.note')).val();
			str += "-" + $(this).find ($('select.octave')).val();
			str += "-" + $(this).find ($('select.gauge')).val();
			str += "-" + $(this).find ($('select.pw')).val();

			if ($(this).find ($('select.smat')).val() != $('input:radio[name=smat]:checked').val()) {
				str += "-" + $(this).find ($('select.smat')).val();
			}

			if ( ($('input#courses').prop ('checked') && $(this).find ($('select.course')).val() == 1)
			|| ((!$('input#courses').prop ('checked')) && $(this).find ($('select.course')).val() == 2) ) {
					str += "*" + $(this).find ($('select.course')).val();
			}

			if ($(this).find ($('select.startfret')).val() != 0) {
				str += "@" + $(this).find ($('select.startfret')).val();
			}

			if ($(this).find ($('select.eqroot')).val() == "eq") {
				str += "=";
			} else if ($(this).find ($('select.eqroot')).val() == "gt") {
				str += ">";
			}

			/*
			if ($(this).find ($('input:radio[name=eqroot]:checked')).val() == "eq") {
				str += "=";
			} else if ($(this).find ($('input:radio[name=eqroot]:checked')).val() == "gt") {
				str += ">";
			}
			*/

			lines.push (str);


		});

		$("textarea#strings").val(lines.join (",\n"));

	}
}

function eqToString (strDiv, eqdir) {
	strDiv.find ($('select.eqroot option[value="' + eqdir + '"]')).attr ('selected', 'selected');
	fixEq(strDiv.find($('select.eqroot')));
	edToStrings (false);
	eqTension();
}

function fixEq (cur) {
	$('div#tuninged select.eqroot').not(cur).each (function () {
		$(this).val (0);
	});

}

function toggleEdTuning() {
	if ($("div#tuninged").is (":visible")) {
		edToStrings(false);
		$("a#toggleted span").text ('show');
		$('div.rightsectout').css ('width', '');
		//$('div.rightsectout').css ('margin-top', '');
		//$('div#topcont').css ('overflow', '');
		$('div#tuningcont').css ('width', '');
		$('div#smatcont').css ('width', '');
		$("textarea#strings").parent().css('float', 'left');
		$("textarea#strings").show();
		$("div#tuninged").hide();
		//$("div.rightsectin").append($("div#stats").detach());
		//$("div#stats").css ('float', '');
	} else {
		edToStrings(true);
		$("a#toggleted span").text ('hide');
		//$('div.rightsectout').css ('width', '100%');
		$('div.rightsectout').css ('width', '520px');
		//$('div.rightsectout').css ('width', '570px');
		//$('div.rightsectout').css ('margin-top', '12px');
		//$('div#topcont').css ('overflow', 'hidden');
		$('div#tuningcont').css ('width', '100%');
		$('div#smatcont').css ('width', '100%');
		$("textarea#strings").parent().css('float', '');
		$("textarea#strings").hide();
		$("div#tuninged").show();
		//$("div.rightsectin").prepend($("div#stats").detach());
		//$("div#stats").css ('float', 'right');
	}

}

function copyString(strDiv) {
	strDiv.before (strDiv.clone()).hide().fadeIn ('slow');
	//strDiv.css ('background-color', 'green')
	//strDiv.animate ( { "background-color" : 'green' }, 500 );
}

function delString (strDiv) {
	if (confirm("delete this string and associated data?")) {
		//strDiv.fadeOut('fast', function() { $(this).remove() });
		strDiv.remove();
	}
}

function loadGauges (strDiv) {
	jQuery.ajax({
		url: 'tension.php',
		type: "get",
		data: "gauges=" + strDiv.find ('select.smat').val() + ',' + strDiv.find ('select.pw').val(),
		dataType: "json",
		async: false,
		context: strDiv.find ($("select.gauge")),
		success: function (data) {
			var oldGauge = $(this).val();
			$(this).hide();
			$(this).html("");
			for (var g in data.mass) {
				$(this).append('<option value="' + g + '">' + g + "</option>\n");
			}
			if (oldGauge)
				$(this).find ($('option[value="' + oldGauge + '"]')).attr ('selected', 'selected');

			$(this).fadeIn ('fast');

		}
	});
}

function loadMore(i) {
	if (!loadedAll) {
		$("div#extradata").load ("tensiontool.php?extra=" + (i == false ? "all" : i), function() {
			$(this).find ($("div")).each (function () {
				var ins = $(this).attr('class');
				if (i == false || i == ins) {
					$(this).find ($("img")).each (function() {
						//$(this).css ('border', '2px solid green');
						//$(this).css ('box-shadow', '2px 2px 5px 2px green');
						//$(this).css ('margin', '4px');
						$("div#" + ins + " div.extra").append( $(this).detach() );
						$("div#" + ins + " div.extra").append( "<br/>" );
						mkImgLink($("div#" + ins + " div.extra").find ($('img')).last());
					});
					if (i == false) {
						$("div#" + ins + " div.extra").hide();
						toggleExtra($("div#" + ins));
					}
				}
			});
			$(this).html();
			if (i == false) {
				loadedAll = true;
				$("a#loadall span").text ('Hide');
			}
		});
	} else {
		if ($("a#loadall span").text () == 'Show') {
			$("div.preset").each (function() {
				$(this).find ("div.extra").each (function () {$(this).hide()});
				toggleExtra ($(this));
			});
			$("a#loadall span").text ('Hide');
		} else {
			$("div.preset").each (function() {
				$(this).find ("div.extra").each (function () {$(this).show()});
				toggleExtra ($(this));
			});
			$("a#loadall span").text ('Show');
		}
	}
	//} else {
	//	$("a.loadmore").remove();
	//}
}

function eqTension() {
	getTension(true);
}

function getTension(eq) {
	var url = mkUrl();

	if (eq)
		url += "&eq";

	$("img#tensionimg").attr('src', 'tension.php?' + url);

	jQuery.ajax({
		url: 'tension.php',
		type: "get",
		data: url + "&info",
		dataType: "json",
		async: true,
		success: function (data) {
			$("img#tensionimg").attr('alt', data.alt.replace (/"/, "\\\""));
			var imgurl = "drawgraph.php?numatpoint&max=auto&scale=@170";
			var tensiondata = "";
			var gaugedata = "";
			var labeldata = "";
			var freqdata = "";
			for (i=data.data.length-1;i>=0;i--) {
				tensiondata += data.data[i].tension + ":";
				gaugedata += (data.data[i].gauge) + ":";
				freqdata += (data.data[i].freq) + ":";
				labeldata += (data.data[i].note) + ",";
			}

			labeldata = labeldata.replace (/,$/, '');
			tensiondata = tensiondata.replace (/:$/, '');
			gaugedata = gaugedata.replace (/:$/, '');
			freqdata = freqdata.replace (/:$/, '');

			$('div#stats').html(
					"<img src=\"" + imgurl + "&title=Tension (lbs)&data==" + tensiondata + "&labels=" + labeldata + "\"/>\n"
					+ "<img src=\"" + imgurl + "&title=String Gauge&c=1&data==" + gaugedata + "&labels=" + labeldata + "\"/>\n"
					+ "<img src=\"" + imgurl + "&title=Frequency (Hz)&c=2&data==" + freqdata + "&labels=" + labeldata + "\"/>\n"
					);

			if (eq) {
				$('textarea#strings').val (data.newStrings.join (",\n"));
			}

			if ($("div#tuninged").is(":visible")) {
				$('textarea#strings').val ( $('textarea#strings').val ().replace (/[=>]/, ''));
				edToStrings(true);
			}
	}});
}

function fillForm(o) {
	var url = o.find ('img').attr('src');

	var wmat;
	var smat;
	var units;

	var courses = url.match (/courses/) ? true : false;

	if (url.match (/smat=./))
		smat = url.replace (/.*smat=([^\&]*).*/, '$1').replace (/,/g,',\n');
	else
		smat = "s";
	
	if (url.match (/length=[\d\.]*mm/))
		units = 'mm';
	else
		units = '';

	if (url.match (/wmat=./))
		wmat = url.replace (/.*wmat=([^\&]*).*/, '$1').replace (/,/g,',\n');
	else
		wmat = "ni";

	$("input#length").val (url.replace (/.*length=([^\&]*).*/, '$1').replace (/,/g,',\n'));
	//$("textarea#strings").html ("");
	$("textarea#strings").val (url.replace (/.*strings=([^\&]*).*/, '$1').replace (/,/g,',\n').replace (/%23/g,'#'));
	$("input[name=smat][value=" + smat + "]").prop ('checked', true);
	$("input[name=wmat][value=" + wmat + "]").prop ('checked', true);
	$('select#units option[value="' + units + '"]').attr ('selected', 'selected');

	$("input#courses").prop ('checked', courses);

	fixWmat();

	//if ($("div#stringed").is(':visible'))
		edToStrings (true);

	getTension(false);
}

function toggleStats(a) {
	$("div#stats").toggle ('fast');
	if (a.find("span").text() == "show")
		a.find("span").text("hide")
	else
		a.find("span").text("show")

}

function toggleInfo(a) {
	$("div#moreinfo").toggle ('fast');
	if (a.find("span").text() == "more")
		a.find("span").text("less")
	else
		a.find("span").text("more")

}

$(document).ready (function () {

	$("div.jsonly").show();
	$("div.nojs").hide();
	$("div#stats").hide();
	$("div#moreinfo").hide();
	$("div#tuninged").hide();

	$("form").trigger("reset");
	$("input[name=wmat]").prop ('disabled', false);
	//getTension();

	$("div#extradata").hide();

	$('img.instimg').each (function () {
		mkImgLink($(this));
	});

	$("form").bind ('change', function() {
		fixWmat();
	});

	$("form").on('submit',function(e) {
		e.preventDefault();
	});

	$("div.preset").each (function () {
		$(this).prepend ("<div style=\"float:right\"><a class=\"link loadmore\" onclick=\"toggleExtra($(this).parent().parent())\"><span>Show</span> Extra Presets</a></div>");
	});

});

function mkImgLink (el) {
	//alert (el.attr ('src'));
	var imglink = $('<a href="#" onclick="fillForm($(this))"></a>').insertBefore (el);
	imglink.append (el.detach());
	if (imglink.find('img').hasClass('default')) {
		fillForm(imglink);
	}
	jQuery.ajax({
		url: imglink.find('img').attr ('src') + "&info",
		type: "get",
		dataType: "json",
		async: true,
		success: function (data) {
			imglink.find('img').attr('alt', data.alt);
		}
	});
}

function showLink (str) {
	window.prompt("Copy and paste this link to share your preset","http://chordgen.rattree.co.uk/tensiontool.html?preset=" + str);
}

function fixWmat() {
	if ($("input:radio[name=smat]:checked").val() == "n")
		$("input[name=wmat]").prop ('disabled', true);
	else
		$("input[name=wmat]").prop ('disabled', false);
}
