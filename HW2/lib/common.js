var functions = {
  /*
   * stristr()-implementation by Kevin van Zonneveld and Onno Marsman
   * URL: http://phpjs.org/functions/stristr:538
   */
  stristr: function (haystack, needle, bool) {
    var pos = 0;

    haystack += '';
    pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
    if (pos == -1) {
      return false;
    } else {
      if (bool) {
        return haystack.substr(0, pos);
      } else {
       return haystack.slice(pos);
      }
    }
  },
  /*
   * inArray()-implementation by jQuery 
   * URL: http://api.jquery.com/jQuery.inArray/#valuearray
   */
  inArray: function (needle, haystack) {
    var length = haystack.length;
    for(var i = 0; i < length; i++) {
        if(haystack[i] == needle) return true;
    }
    return false;
  }

}

module.exports = functions;