var range = require('../lib/range');

exports['range'] = function (test) {

  test.deepEqual( range.range(), [] );						      // Check empty with no argument
  test.deepEqual( range.range(4), [0, 1, 2, 3, 4] );		// Check a random range with one argument
  test.deepEqual( range.range(-1, 2), [ -1, 0, 1, 2] );	// Check boundaries around zero with two arguments

  test.equal( range.range(101).length, 102 );				    // Check length

  test.done();
};