(function() {
	"use strict";
    
    window.onload = function(){

        // Header Sticky JS
        const getHeaderId = document.querySelector(".navbar-area");
        if (getHeaderId) {
            window.addEventListener('scroll', event => {
                const height = 150;
                const { scrollTop } = event.target.scrollingElement;
                document.querySelector('#navbar').classList.toggle('sticky', scrollTop >= height);
            });
        }
		// Back to Top
		const getId = document.getElementById("backtotop");
		if (getId) {
			const topbutton = document.getElementById("backtotop");
			topbutton.onclick = function (e) {
				window.scrollTo({ top: 0, behavior: "smooth" });
			};
			window.onscroll = function () {
				if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
					topbutton.style.opacity = "1";
				} else {
					topbutton.style.opacity = "0";
				}
			};
		}
    };

	// Price Range slider JS
	$(function() {
		$( "#slider-range" ).slider({
		range: true,
		min: 130,
		max: 500,
		values: [ 130, 250 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
		});
		$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
		" - $" + $( "#slider-range" ).slider( "values", 1 ) );
	});


    // Hero Slider JS
    $('.hero-slider').owlCarousel({
		loop: true,
        autoplayTimeout: 5000,
		autoplay: false,
        dots: true,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn', // add this
		items: 1,
	});

	// Testimonial Slider JS
	$('.testimonial-cards').owlCarousel({
		nav: true,
		loop: true,
		dots: false,
		margin: 20,
		autoplay: false,
		center: true,
		autoplayHoverPause: true,
		navText: [$('.benefits-next'),$('.benefits-prev')],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 1
			},
			1200: {
				items: 2
			}
		}
	});
	$('.testimonial-slider-2').owlCarousel({
		nav: false,
		loop: true,
		dots: true,
		margin: 25,
		autoplay: false,
		autoplayHoverPause: true,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 2
			},
			1200: {
				items: 2
			}
		}
	});
	$('.testimonial-slider-3').owlCarousel({
		nav: false,
		loop: true,
		dots: false,
		margin: 20,
		autoplay: false,
		autoplayHoverPause: true,
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			},
			1200: {
				items: 3
			}
		}
	});

	// Course Slider JS
	$('.course-slider').owlCarousel({
		nav: true,
		loop: true,
		dots: false,
		margin: 25,
		autoplay: false,
		autoplayHoverPause: true,
		navText: [$('.benefits-next'),$('.benefits-prev')],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});


	// Timer Js
	try {
		const days1 =document.querySelector("#days")
		const hours1 =document.querySelector("#hours")
		const minutes1 =document.querySelector("#minutes")
		const seconds1  =document.querySelector("#seconds")
		const newYears = 'Jan 01 2028 00:00:00';
		function countdown(){
			const newYearsDate = new Date(newYears);
			const currentDate = new Date();

			const totalSeconds = (newYearsDate-currentDate)/10000;
			const days = Math.floor(totalSeconds / 36000 / 24);
			const hours = Math.floor(totalSeconds / 36000 ) % 24;
			const minutes = Math.floor(totalSeconds / 60 ) % 60;
			const seconds = Math.floor(totalSeconds % 60);
			
			days1.innerHTML =   formatTime( days);
			hours1.innerHTML =  formatTime( hours);
			minutes1.innerHTML =formatTime(  minutes);
			seconds1.innerHTML =formatTime(  seconds);
		}
		countdown();
		function formatTime(time){
			return time < 10 ? `0${time}` : time;
		}
		setInterval(countdown,1000);
	} catch {}
	   

	// Benefits Slider JS
	$('.benefits-wapper').owlCarousel({
		nav: true,
		loop: true,
		dots: false,
		margin: 10,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [$('.benefits-next'),$('.benefits-prev')],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	// Product Slider JS
	$('.product-wapper').owlCarousel({
		nav: true,
		loop: true,
		dots: false,
		margin: 10,
		autoplay: true,
		autoplayHoverPause: true,
		navText: [$('.benefits-next'),$('.benefits-prev')],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 2
			},
			1200: {
				items: 3
			}
		}
	});

	// Partner Slider JS
	$(".partner-slider").owlCarousel({
        dots: false,
        loop: true,
        nav: false,
		margin: 25,
		autoplay: true,
        autoplayTimeout: 2000,
		autoplayHoverPause: true,
        responsive:{
            0:{
                items: 2,
            },
			576:{
                items: 3,
            },
            768:{
                items: 3,
            },
            992:{
                items: 4,
            },
            1200:{
                items: 6,
            }
        }
    });

	// Partner Slider Four JS
	$(".partner-slider-four").owlCarousel({
        dots: false,
        loop: true,
        nav: false,
		margin: 25,
		autoplay: true,
        autoplayTimeout: 2000,
		autoplayHoverPause: true,
        responsive:{
            0:{
                items: 2,
            },
			576:{
                items: 3,
            },
            768:{
                items: 3,
            },
            992:{
                items: 4,
            },
            1200:{
                items: 6,
            }
        }
    });

	// Banner Slide Four JS
	$(".banner-slide-four").owlCarousel({
        dots: false,
        loop: true,
        nav: true,
		margin: 0,
		autoplay: false,
        autoplayTimeout: 2000,
		autoplayHoverPause: true,
        items: 1,
		navText: [
			"<i class='ri-arrow-left-line'></i>",
			"<i class='ri-arrow-right-line'></i>",
		],
    });

	// Banner Slider Five JS
	$(".banner-slide-five").owlCarousel({
        dots: false,
        loop: true,
        nav: false,
		margin: 25,
		autoplay: true,
        autoplayTimeout: 2000,
		autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
            },
			576:{
                items: 2,
            },
            768:{
                items: 2,
            },
            992:{
                items: 3,
				stagePadding: 50,
            },
            1200:{
                items: 3,
				stagePadding: 100,
            }
        }
    });

	// Courses Plan Slider JS
	$(".courses-plan-slide").owlCarousel({
        dots: false,
        loop: true,
        nav: false,
		margin: 25,
		autoplay: true,
        autoplayTimeout: 2000,
		autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
            },
			576:{
                items: 1,
            },
            768:{
                items: 2,
            },
            992:{
                items: 3,
            },
            1200:{
                items: 4,
            }
        }
    });

	// Gallery Slider JS
	$(".gallery-slide").owlCarousel({
        dots: false,
        loop: true,
        nav: false,
		margin: 25,
		autoplay: true,
        autoplayTimeout: 2000,
		autoplayHoverPause: true,
        responsive:{
            0:{
                items: 1,
            },
			576:{
                items: 2,
            },
            768:{
                items: 3,
            },
            992:{
                items: 4,
            },
            1200:{
                items: 5,
            }
        }
    });

	// Testimonial Slide Five
	$('.testimonial-slide-five').owlCarousel({
		loop: true,
		margin: 0,
		nav: true,
		mouseDrag: true,
		thumbs: true,
		thumbsPrerendered: true,
		items: 1,
		dots: false,
		autoHeight: true,
		autoplay: true,
		smartSpeed: 1500,
		autoplayHoverPause: true,
		navText: [
			"<i class='ri-arrow-left-line'></i>",
			"<i class='ri-arrow-right-line'></i>",
		],
	});

    // Mixitup JS
	$('#mix-wrapper').mixItUp({
		selectors: {
		  target: '.mix-target'
		}
	  });
	  try {
		var elements = document.querySelectorAll("[id^='my-element']");
		elements.forEach(function(element) {
			element.addEventListener("click", function() {
				elements.forEach(function(el) {
					el.classList.remove("active");
				});
				element.classList.add("active");
			});
		});
	} catch (err) {}
    
    // Counter JS
    if ("IntersectionObserver" in window) {
        let counterObserver = new IntersectionObserver(function (entries, observer) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                let counter = entry.target;
                let target = parseInt(counter.innerText);
                let step = target / 200;
                let current = 0;
                let timer = setInterval(function () {
                    current += step;
                    counter.innerText = Math.floor(current);
                    if (parseInt(counter.innerText) >= target) {
                    clearInterval(timer);
                    }
                }, 10);
                counterObserver.unobserve(counter);
                }
            });
        });
        let counters = document.querySelectorAll(".count");
            counters.forEach(function (counter) {
            counterObserver.observe(counter);
        });
    }
    
    // Magnific Popup JS
	$('.popup-youtube').magnificPopup({
		disableOn: 320,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,
		fixedContentPos: false
	});

	// Gallery Popup JS
	$('.gallery-popup').each(function() {
		$(this).magnificPopup({
			delegate: 'a', 
			type: 'image',
			gallery: {
			  enabled:true
			}
		});
	});

	var selector = '.accordion .accordion-item';
	$(selector).on('click', function(){
		$(selector).removeClass('active');
		$(this).addClass('active');
	});


	$(".switcher input[type='checkbox']").click(function () {
		if ($(this).is(":checked")) {
		  $("#equity").addClass("show");
		  $("#cash").removeClass("show");
		} else if ($(this).is(":not(:checked)")) {
		  $("#cash").addClass("show");
		  $("#equity").removeClass("show");
		}
	});

})();



// Offcanvas Responsive Menu
const list = document.querySelectorAll('.responsive-menu-list');
function accordion(e) {
    e.stopPropagation(); 
    if(this.classList.contains('active')){
        this.classList.remove('active');
    }
    else if(this.parentElement.parentElement.classList.contains('active')){
        this.classList.add('active');
    }
    else {
        for(i=0; i < list.length; i++){
            list[i].classList.remove('active');
        }
        this.classList.add('active');
    }
}
for(i = 0; i < list.length; i++ ){
    list[i].addEventListener('click', accordion);
}
  

// Input Plus & Minus Number JS
$('.input-counter').each(function() {
    var spinner = jQuery(this),
    input = spinner.find('input[type="text"]'),
    btnUp = spinner.find('.plus-btn'),
    btnDown = spinner.find('.minus-btn'),
    min = input.attr('min'),
    max = input.attr('max');
    
    btnUp.on('click', function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });
    btnDown.on('click', function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
            var newVal = oldValue;
        } else {
            var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
    });
});

$(window).on('load', function () {
    $('.masonary-wrapper-activation').imagesLoaded(function () {
        // init Isotope
        var $grid = $('.mesonry-list').isotope({
            percentPosition: true,
            transitionDuration: '0.7s',
            layoutMode: 'masonry',
            filter: '.cat--1',
            masonry: {
                columnWidth: '.resizer',
            }
        });

        // filter items on button click
        $('.isotop-filter').on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $(this).siblings('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
            $grid.isotope({
                filter: filterValue
            });
        });
    });
});

jQuery(document).ready(function($) {
	"use strict";
	$('#customers-testimonials').owlCarousel( {
			loop: true,
			center: true,
			items: 3,
			margin: 30,
			dots:true,
		nav:true,
			autoplayTimeout: 8500,
			smartSpeed: 450,
		  navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
			responsive: {
				0: {
					items: 1
				},
				768: {
					items: 2
				},
				1170: {
					items: 3
				}
			}
		});
	});



	$(document).ready(function() {
		const $navPills = $('#v-pills-tab');
	  
		$('#left-arrow').click(function() {
		  let scrollAmount = $navPills.scrollLeft() - 100; // Adjust scroll amount as needed
		  $navPills.animate({ scrollLeft: scrollAmount }, 300);
		});
	  
		$('#right-arrow').click(function() {
		  let scrollAmount = $navPills.scrollLeft() + 100; // Adjust scroll amount as needed
		  $navPills.animate({ scrollLeft: scrollAmount }, 300);
		});
	  });




	  $(document).ready(function(){
		// Trigger carousel previous
		$(".carousel-control-prev").click(function(){
		  $("#carouselExampleControls").carousel('prev');
		});
	
		// Trigger carousel next
		$(".carousel-control-next").click(function(){
		  $("#carouselExampleControls").carousel('next');
		});
	  });