function correctPNG() // correctly handle PNG transparency in Win IE 5.5 or higher.
 {
 for(var i=0; i<document.images.length; i++)
 {
 var img = document.images[i]
 var imgName = img.src.toUpperCase()
 if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
 {
 var imgID = (img.id) ? "id='" + img.id + "' " : ""
 var imgClass = (img.className) ? "class='" + img.className + "' " : ""
 var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
 var imgStyle = "display:inline-block;" + img.style.cssText
 if (img.align == "left") imgStyle = "float:left;" + imgStyle
 if (img.align == "right") imgStyle = "float:right;" + imgStyle
 if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
 var strNewHTML = "<span " + imgID + imgClass + imgTitle
 + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
 + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
 + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>"
 img.outerHTML = strNewHTML
 i = i-1
 }
 }
 }

var data = navigator.appName.toUpperCase();
if (data .indexOf("EXPLORER") >= 0)window.attachEvent("onload", correctPNG);
else window.captureEvents("onload", correctPNG);



/**
 * block right click
 */
document.oncontextmenu = function() { return false };


/**
 * google analytics
 */
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
var head = document.getElementsByTagName("head");

if(head){
 var element = document.createElement('script');
 element.src = gaJsHost+ "google-analytics.com/ga.js";
 element.type= "text/javascript";
 head[0].appendChild(element)
}else{
 document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' ? type='text/javascript'%3E%3C/script%3E"));
}

function startAnalytics() {
 try{
 var pageTracker = _gat._getTracker("UA-11238420-1");
 pageTracker._initData();
 pageTracker._trackPageview();
 }catch(e){}
}

if (window.addEventListener) {
 window.addEventListener('load', startAnalytics, false);
} else if (window.attachEvent) {
 window.attachEvent('onload', startAnalytics);
}

function newUp(delDayStr) {
 delDay = new Date(delDayStr);
 nowDay = new Date();
 if(nowDay <= delDay) {
 document.write("<img src='../../../../__image__/other/new.gif' border='0' hspace='0'>");
 }
}

function newUpTop(delDayStr) {
 delDay = new Date(delDayStr);
 nowDay = new Date();
 if(nowDay <= delDay) {
 document.write("<img src='../../../../__image__/other/_new.jpg' border='0' hspace='0'>");
 }
}

document.write("<script type='text/javascript' src='/__image__/other/jquery-1.4.2.js'></script>");
document.write("<script type='text/javascript' src='/__image__/other/img_protect.js'></script>");
