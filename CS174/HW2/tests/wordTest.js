/*
 * Test suite for word-module 
 * @author: Anders Hassis
 * @date: 2011-09-26
 */
var word = require('../lib/word');

exports['word'] = function (test) {

	// Test empty init
	word.init();
	test.deepEqual( word.status('test'), [] );
	word.reset();

	// Test simple word
  word.init('anders');
	test.deepEqual( word.status('ae'), ['a', false, false, 'e', false, false] );

	// Test simple word with two occurences of one letter
  word.init('andersa');
	test.deepEqual( word.status('ae'), ['a', false, false, 'e', false, false, 'a'] );

  test.done();
};