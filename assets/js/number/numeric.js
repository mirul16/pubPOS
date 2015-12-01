jQuery.fn.forceNumeric = function () {
	return this.each(function () {
		$(this).keydown(function (e) {
			var key = e.which || e.keyCode;

			if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
				// numbers   
				key >= 48 && key <= 57 ||
				// Numeric keypad
				key >= 96 && key <= 105 ||
				// . on keypad
				key == 190 ||
				// Backspace and Tab and Enter
				key == 8 || key == 9 || key == 13 ||
				// left and right arrows
				key == 37 || key == 39 ||
				// Del and Ins
				key == 46 || key == 45
			)return true;
		return false;
		});
	});
}