function flash(w,h,u) {
 var flash_tag = "";
 flash_tag = '<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
 flash_tag +='codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" ';
 flash_tag +='WIDTH="'+w+'" HEIGHT="'+h+'" >';
 flash_tag +='<param name="movie" value="'+u+'">';
 flash_tag +='<param name="quality" value="high">';
 flash_tag +='<param name="wmode" value="transparent">';
 flash_tag +='<embed src="'+u+'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" ';
 flash_tag +='wmode="transparent" type="application/x-shockwave-flash" WIDTH="'+w+'" HEIGHT="'+h+'"  ></embed></object>'

 document.write(flash_tag);
}

