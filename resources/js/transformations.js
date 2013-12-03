/**
 * Translates an object in the coordinates.  If coordinates
 * are not specified, then it is positioned in the center.
 * @param o Object
 * @param frame Parent object of o
 * @param x x coordinate
 * @param y y coordinate
 * @param oTrueWidth true width of o (as it may be hidden and report 0 as width)
 * @param oTrueHeight true height of o (as it may be hidden and report 0 as height)
 */
function translate(o, frame, x, y, oTrueWidth, oTrueHeight) {
	if (x == null) {
		// width dimensions
		divWidth = frame.width();
		imgWidth = oTrueWidth;
		
		// sets position in the center of the containing div
		x = (divWidth/2) - (imgWidth/2);
	}

	if (y == null) {
		// height dimensions
		divHeight = frame.height();
		imgHeight = oTrueHeight;

		// sets position in the center of the containing div
		y = (divHeight/2) - (imgHeight/2);
	}

	o.css({top: y, left: x});
}

/**
 * Rotates an object in the specified degrees
 * @param o Object
 * @param degrees degrees to rotate
 */
function rotate(o, degrees) {
	// rotation through css3
	var prevStateWebkit = ((o.css('-webkit-transform') != 'none')? o.css('-webkit-transform') : '');
	var prevStateMoz = ((o.css('-moz-transform') != 'none')? o.css('-moz-transform') : '');
	var prevStateCss3 = ((o.css('transform') != 'none')? o.css('transform') : '');
	o.css({
        "-webkit-transform":  "rotate(" + degrees + "deg) " + prevStateWebkit,
        "-moz-transform": "rotate(" + degrees + "deg) " + prevStateMoz,
        // "-ms-transform: rotate(" + degrees + "deg)",
        // "-o-transform: rotate(" + degrees + "deg)",
        "transform": "rotate(" + degrees + "deg) " + prevStateCss3 /*
													 * For modern
													 * browsers(CSS3)
													 */
    });
}

/**
 * Flips an object
 * @param o Object
 * @param direction Direction of flipping. 1, horizontally. 2, vertically. 3, both.
 */
function flip(o, direction) {
	// Direction values:
	// 0 - default
	// 1 - flip horizontally
	// 2 - flip vertically
	// 3 - double flip
	
	if (direction != 0) {
		var scaleX = 1;
		var scaleY = 1;
		var filterMS = "none";
		
		if (direction == 1) {
			scaleX = -1;
			filterMS = "FlipH";
		} else if (direction == 2) {
			scaleY = -1;
			filterMS = "FlipV";
		} else if (direction == 3) {
			scaleX = -1;
			scaleY = -1;
			filterMS = "FlipH FlipV";
		} 

		var prevStateWebkit = ((o.css('-webkit-transform') != 'none')? o.css('-webkit-transform') : '');
		var prevStateMoz = ((o.css('-moz-transform') != 'none')? o.css('-moz-transform') : '');
		var prevStateCss3 = ((o.css('transform') != 'none')? o.css('transform') : '');
		o.css({
			"-webkit-transform": "scale(" + scaleX + ", " + scaleY + ") " + prevStateWebkit,
			"-moz-transform": "scale(" + scaleX + ", " + scaleY + ") " + prevStateMoz,
			"transform": "scale(" + scaleX + ", " + scaleY + ") " + prevStateCss3,
			"filter": filterMS
			// -ms-filter: "FlipH";
			// -o-transform: scaleX(-1);
		});
		
	} 

}

function randomBackgroundColor(o, color) {
	if (color.length <= 1) 
		color = '#'+Math.floor(Math.random()*16777215).toString(16);
	
	o.css('background-color', color);
}
