/*
 * Test suite for letters-module 
 * @author: Anders Hassis
 * @date: 2011-09-26
 */

var letters = require('../lib/letters');

exports['letters'] = function (test) {
	letters.use('a');
	letters.use('n');

	test.equal( letters.guesses(), 'an' );
	test.ok(letters.isUsed('a'));
	test.ifError( letters.isUsed('c') )
	
	letters.reset();
	test.ifError( letters.isUsed('a') )

  test.done();
};