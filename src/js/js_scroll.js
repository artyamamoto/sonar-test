var scrollStep = 1;
function scrollToTop() {
	if(navigator.appName == "Microsoft Internet Explorer" && document.compatMode == "CSS1Compat"){
		var ScrollPs = document.documentElement.scrollTop;
	}else{
		var ScrollPs = document.body.scrollTop || document.documentElement.scrollTop;
	}
	if(scrollStep < 50 && ScrollPs) {
		ScrollPs = (ScrollPs > 2) ? Math.ceil(ScrollPs*.2) : 1;
		scrollStep++;
		scrollBy(0,-ScrollPs);
		setTimeout("scrollToTop()",10);
	}else{
		scrollTo(0,0);
		scrollStep = 1;
	}
}