// Script Source: CodeLifter.com
// Copyright 2003
// Do not remove this notice.

// SETUPS:
// ===============================

// Set the horizontal and vertical position for the popup

PositionX = 100;
PositionY = 100;

// Set these value approximately 20 pixels greater than the
// size of the largest image to be used (needed for Netscape)

defaultWidth  = 800;
defaultHeight = 600;

// Set autoclose true to have the window close automatically
// Set autoclose false to allow multiple popup windows

var AutoClose = true;

// Do not edit below this line...
// ================================
if (parseInt(navigator.appVersion.charAt(0))>=4){
	var isNN=(navigator.appName=="Netscape")?1:0;
	var isIE=((navigator.appName.indexOf("Microsoft")!=-1)||(!isNN))?1:0;}

var optNN='scrollbars=no,width='+defaultWidth+',height='+defaultHeight+',left='+PositionX+',top='+PositionY;
var optIE='scrollbars=no,width='+defaultWidth+',height='+defaultHeight+',left='+PositionX+',top='+PositionY;

function popImage(imageURL,imageTitle){
	if (isNN){imgWin=window.open('about:blank','',optNN);}
	if (isIE){imgWin=window.open('about:blank','',optIE);}
	with (imgWin.document){
		writeln('<html><head><title>Loading...</title><style type="text/css"><!-- body { margin: 0px; } --></style>');writeln('<sc'+'ript>');
		writeln('var isNN,isIE;');writeln('if (parseInt(navigator.appVersion.charAt(0))>=4){');
		writeln('isNN=(navigator.appName=="Netscape")?1:0;');writeln('isIE=((navigator.appName.indexOf("Microsoft")!=-1)||(!isNN))?1:0;}');
		writeln('function reSizeToImage(){');writeln('if (isIE){');writeln('window.resizeTo('+defaultWidth+','+defaultHeight+');');
		writeln('width='+defaultWidth+'-(document.body.clientWidth-document.images[0].width);');
		writeln('height='+defaultHeight+'-(document.body.clientHeight-document.images[0].height);');
		writeln('window.resizeTo(width,height);}');writeln('if (isNN){');       
		writeln('window.innerWidth=document.images["screenshot"].width;');writeln('window.innerHeight=document.images["screenshot"].height;}}');
		writeln('function doTitle(){document.title="JKArena Level Pack: '+imageTitle+'";}');writeln('</sc'+'ript>');
		if (!AutoClose) writeln('</head><body bgcolor=000000 scroll="no" onload="reSizeToImage();doTitle();self.focus()">')
		else writeln('</head><body bgcolor=000000 scroll="no" onload="reSizeToImage();doTitle();self.focus()" onblur="self.close()">');
		writeln('<img name="screenshot" alt="'+imageTitle+'" src='+imageURL+' style="display:block"></body></html>');
		close();		
	}
}

function changeClose(){
	if(document.changeCloseForm.changeCloseBox.checked) {
		AutoClose = true;
	}
	else {
		AutoClose = false;
	}
}