
window.onload=function() {
	if (document.getElementById("photo") && document.getElementById("photolink")) {
		setTimeout('changePhoto(1)', 5000);
	}
}

$(function(){
	$('a.ext').on('click',function(e){
		e.preventDefault();
		window.open($(this).attr('href'));
});
});


//for(i=0; i<photos.length; i++) {
//	//alert(i);
//	imageObj.src = photos[i];
//}

function changePhoto(a) {

	if (a>= photos.length)
		a = 0;

	document.getElementById("photo").src = photos_thumbnail[a];
	document.getElementById("photolink").href = photos_href[a];

	a++;

	setTimeout('changePhoto(' + a + ")", 5000);
}
