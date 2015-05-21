// ==========================================================================
//
//  Scripts
//    Initialisers, configuration and interactions
//
// ==========================================================================

// --------------------------------------------------------------------------
//   Variables
// --------------------------------------------------------------------------



// --------------------------------------------------------------------------
//   Breakpoints
// --------------------------------------------------------------------------

mediaCheck({

	media: '(max-width: 820px)',

	entry: function() {
		console.log('Entering Mobile');
	},

	exit: function() {
		console.log('Leaving Mobile');
	},

	both: function() {
		console.log('Changing Device Size');
	}
});


// --------------------------------------------------------------------------
//   General
// --------------------------------------------------------------------------

$(function() {

	// --------------------------------------------------------------------------
	//   Initialise
	// --------------------------------------------------------------------------

	FastClick.attach(document.body);


	// --------------------------------------------------------------------------
	//   Global
	// --------------------------------------------------------------------------

	$('a[href="#"]').click(function(event) {
		event.preventDefault();
	});


	// --------------------------------------------------------------------------
	//   Stop auto scrolling on user override
	// --------------------------------------------------------------------------

	if(window.addEventListener) document.addEventListener('DOMMouseScroll', stopScroll, false);
		document.onmousewheel = stopScroll;

	function stopScroll() {
		$('html, body').stop(true, false);	// Stops and dequeue's animations
	}

});


// --------------------------------------------------------------------------
//   Helpers
// --------------------------------------------------------------------------

var hasParent = function(el, id) {
	if (el) {
		do {
			if (el.id === id) {
				return true;
			}
			if (el.nodeType === 9) {
				break;
			}
		}
		while((el = el.parentNode));
	}
	return false;
};

var waitForFinalEvent = (function () {
	var timers = {};
	return function (callback, ms, uniqueId) {
		if (!uniqueId) {
			uniqueId = "Don't call this twice without a uniqueId";
		}
		if (timers[uniqueId]) {
			clearTimeout (timers[uniqueId]);
		}
		timers[uniqueId] = setTimeout(callback, ms);
	};
})();
