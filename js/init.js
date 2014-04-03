	$(function() {
	  $('#slides').slidesjs({
	    width: 700,
	    height: 500,
	    play: {
	        active: true,
	        auto: false,
	        interval: 4000,
	        swap: true
	    },
	    callback: {
	        loaded: function(number) {
	    	   // if img is loaded
	        },
	        start: function(number) {
	           // if animation is started
	        },
	        complete: function(number) {
	          // change slide number on animation complete
	          $('#slidesjs-log .slidesjs-slide-number').text(number);
	        }
	      }
	  });
	});
