/**
 * Update tip for possible causes of error
 * @param t text with tip
 */
function updateTips(t) {
	tips.text(t).addClass("ui-state-highlight");
	setTimeout(function() {
		tips.removeClass("ui-state-highlight", 1500);
	}, 500);
}

/**
 * Checks value of object is between a range
 * @param o Object
 * @param n Object name to appear in the tip
 * @param min Min range
 * @param max Max range
 * @returns true if it is in the desired length.  false otherwise
 */
function checkLength(o, n, min, max) {
	if (o.val().length > max || o.val().length < min) {
		o.addClass("ui-state-error");
		updateTips("La longitud de " + n + " debe estar entre " + min + " y "
				+ max + ".");
		return false;
	} else {
		return true;
	}
}

/**
 * Checks value of object is between a range
 * @param o Object
 * @param n Object name to appear in the tip
 * @param min Min range
 * @param max Max range
 * @returns true if it is in the desired length.  false otherwise
 */
function checkNumeric(o, n) {
	if (!isNumber(o.val())) {
		o.addClass("ui-state-error");
		updateTips("El contenido de " + n + " debe ser numerico.");
		return false;
	} else {
		return true;
	}
}

function isNumber(n) {
	return !isNaN(parseFloat(n)) && isFinite(n);
}

/**
 * Checks value of object matches a regular expression
 * @param o Object
 * @param n Object name to appear in the tip
 * @param min Min range
 * @param max Max range
 * @returns true if it matches.  false otherwise
 */
function checkRegexp(o, regexp, n) {
	if (!(regexp.test(o.val()))) {
		o.addClass("ui-state-error");
		updateTips(n);
		return false;
	} else {
		return true;
	}
}