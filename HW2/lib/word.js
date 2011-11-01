/*
 * Word-module
 * @author: Anders Hassis
 * @date: 2011-09-26
 */

// Include common functions
var common = require('./common');

var word = {
	keyword: null,

  /*
	 * Initialize with the given word or phrase
	 * word.init string -> void
	 */
	init: function(word) {
		keyword = word;
	},

	/*
	 * Argument is guesses (a string of guessed char's)
	 * word.solved string -> boolean
	 */
	solved: function(guessed) {
		return (guessed === keyword);
	},

	/*
	 * Reset keyword
	 * word.reset void -> void
	 */
	reset: function() {
		keyword = null;
	},

	/*
	 * Returns an array of the complete keyword with false where it isn't completed
	 * word.status string -> array
	 */
	status: function(str) {
		var retArray = new Array();

		if (!keyword) return retArray;

		for (var i = 0; i < keyword.length; i++) {
			if (common.stristr(str, keyword.substring(i, i+1)))
				retArray[i] = keyword.substring(i, i+1);
			else
				retArray[i] = false;
		}

		return retArray;
	}
}

module.exports = word;