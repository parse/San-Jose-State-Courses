/*
 * Letters-module
 * @author: Anders Hassis
 * @date: 2011-09-26
 */
 
// Include common functions
var common = require('./common');

var letters = {
	l: new Array(),

	/*
	 * Use the given letter
	 * letters.use char -> void
	 */
	use: function(c) {
		if (typeof l == 'undefined') 
			l = new Array();
		
		l.push(c);
	},

	/*
	 * Report if given letter is used or not
	 * letters.isUsed char -> boolean
	 */
	isUsed: function(c) {
		if (typeof l !== 'undefined') 
			return common.inArray(c, l);
		else
			return false;
	},

  /*
	 * Returns all letters guessed so far
	 * letters.guesses void -> string
	 */
	guesses: function() {
		var output = '';

		if (typeof l == 'undefined') 
			l = new Array();

		if (!l) return;

		for (var i = 0; i < l.length; i++) {
			output += l[i];
		}

		return output;
	},

	/*
	 * Re-initialize letters' state
	 * letters.reset void -> void
	 */
	reset: function() {
		l = new Array();
	}
}

module.exports = letters;