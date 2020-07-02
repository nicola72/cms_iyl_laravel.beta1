(function (factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD
		define(['jquery'], factory);
	} else if (typeof exports === 'object') {
		// CommonJS
		factory(require('jquery'));
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			// If we can't parse the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write

		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setTime(+t + days * 864e+5);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));

	jQuery.noConflict();
$(document).ready(function(){

	var c_acceptance = $.cookie('c_acceptance');
	if(typeof c_acceptance === "undefined"){
		$.cookie('c_acceptance', 'no', { expires: 365, path: '/' });
		c_acceptance="no";
	}

	if(c_acceptance=="no"){
		
			var html = '<div class="left" id="cookies" style="text-align:center;">Questo sito utilizza cookies per migliorare l\'esperienza di navigazione (vedi <a target="_blank" href="it/policy.php" style="text-decoration:none;"><span style="color:#900; font-weight:bold; text-decoration:none;">Policy</span></a>)&nbsp;Continuando la navigazione, accetti l\'utilizzo dei cookies <a id="cookies_ok" onclick="AcceptCookies();" href="javascript:void(0);" style="text-decoration:none;"><span style="color:#900; font-weight:bold; text-decoration:none;">OK</span></a></div>';
		
	

		
		
		
		html = html+'<style>#cookies {background: #fcfcfc none repeat scroll 0 0; border-top: 1px solid #ccc; bottom: 0;height: auto;line-height: 1.5em;padding: 3px 5% 0;position: fixed;width: 90%;z-index: 9999; text-align:center; padding-bottom:10px;}</style>';
		$("body").append(html);
	}

});


function AcceptCookies(){
	
	$.cookie('c_acceptance', 'si', { path: '/' });
	$("#cookies").fadeOut('slow');
	
}


