// Nelson's modified execute.js
function thirty_pc() {
    var height = $(window).height();
    var thirtypc = (95 * height) / 100;
    var slight = (100 * height) / 100 - 43;
    var fully = (100 * height) / 100;
    var float = (100 * height) / 100 - 100;
    var sixty = (70 * height) / 100;
    var seventypcd = (85 * height) / 100;
    var fifty = (50 * height) / 100;
    var seventypc = (90 * height) / 100;
    var forty = (15 * height) / 100;
    thirtypc = parseInt(thirtypc) + 'px';
    
    //	$(".topwithbanneracross").css('marginTop',fully);
    //	$(".dl-menuwrapper").css('minHeight',fifty);
    //	$(".dl-menuwrapper").css('maxHeight',fifty);
    
    $(".home-feature").css('height',thirtypc);
    $(".gettit").css('height',fully);
    $(".home .feature-spacer").css('height',fully);
    $("#supersized").css('height',fully);
    $(".singleimage").css('height',fully);
    $(".intro-holster").css('height',fully);
    $(".homevideo").css('height',fully);
    $(".carousello").css('height',sixty);
    $(".totality").css('height',fully);
    $(".sic .feature-spacer").css('height',50);
    $(".slidban").css('height',sixty);
    $(".slidbantop").css('height',sixty);
}

(function(){
    var $w = $(window);
	var $circ = $('.animated-circle');
	var $progCount = $('.progress-count');
	var $prog2 = $('.progress-indicator-2');

	var wh, h, sHeight;

	function setSizes(){
		wh = $w.height();
		h = $('.pagecontent').height();
		sHeight = h - wh + 1000;
	}

	setSizes();

	$w.on('scroll', function(){
		var perc = Math.max(0, Math.min(1, $w.scrollTop()/sHeight ));
		updateProgress(perc);
	}).on('resize', function(){
		setSizes();
		$w.trigger('scroll');
	});

	function updateProgress(perc){
		var circle_offset = 126 * perc;
		$circ.css({
			"stroke-dashoffset" : 126 - circle_offset
		});
		$progCount.html(Math.round(perc * 100) + "%");

		$prog2.css({width : perc*100 + '%'});
	}

}());


$(document).ready(function() {
	thirty_pc();
	$(window).bind('resize', thirty_pc);

    $(".fixed-nav li a").addClass('whipper');
    var submit = $("#sleek");
    
    function validateEmail(email) {
        var email_check = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return email_check.test(email);
    }
    
    submit.submit(function (e) {
        var name, email, message;
        
        name = $("#author").val();
        email = $("#emaild").val();
        message = $("#commenters").val();
        
        if ((name === "" || null) || (email === "" || null) || (!validateEmail(email)) || (message === "" || null)) {
            e.preventDefault();
            
            if (name === "" || null) {
                $(".error-name").css("display","block");
                $("#author").css("outline","1px solid #ff0000");
            } else {
                $(".error-name").css("display","none");
                $("#author").css("outline","none");
            }
            
            if ((email === "" || null) || (!validateEmail(email))) {
                $(".error-email").css("display","block");
                $("#emaild").css("outline","1px solid #ff0000");
            } else {
                $(".error-email").css("display","none");
                $("#emaild").css("outline","none");
            }
            
            if (message === "" || null) {
                $(".error-message").css("display","block");
                $("#commenters").css("outline","1px solid #ff0000");
            } else {
                $(".error-message").css("display","none");
                $("#commenters").css("outline","none");
            }
        } 
    
    });

});

var getHiddenElementHeight = function(element){
    var tempId = 'tmp-'+Math.floor(Math.random()*99999);//generating unique id just in case
    $(element).clone()
    .css('position','absolute')
    .css('height','auto').css('width','1000px')
    //inject right into parent element so all the css applies (yes, i know, except the :first-child and other pseudo stuff..
    .appendTo($(element).parent())
    .css('left','-10000em')
    .addClass(tempId).show();
    h = $('.'+tempId).height();
    $('.'+tempId).remove();
    return h;
};

$(document).ready(function(){
    
    var $document = $(document),
    $element = $('.progress-indicator'),
    className = 'hasScrolled';
    
    $document.scroll(function() {
        $element.toggleClass(className, $document.scrollTop() >= 550);
    });
    
    // Subtle Parallax	
    $(window).bind('scroll',function(e){
        parallaxScroll();
    });
	
	function parallaxScroll(){
		var scrolledY = $(window).scrollTop();
		var scrollBottom = $(window).scrollTop() + $(window).height();
	
		$('.feature-holster').css('marginTop','-'+((scrolledY*0.2))+'px');
		$('.sliding').css('marginTop','-'+((scrolledY*0.2))+'px');
		$('.interiorfeature').css('marginTop','-'+((scrolledY*0.2))+'px');
		$('.homevideo').css('marginTop','-'+((scrolledY*0.2))+'px');
		$('.home-intro').css('transform', 'translate3d(0px, -'+(scrolledY*0.06)+"px"+',0px)');
		$('.bg-img').css('transform', 'translate3d(0px,'+(scrolledY*0.06)+"px"+',0px)');
	}  
});

$(document).ready(function()  {
    $(".totality").animate({
        opacity: 1
    }, 3000, function() {
        // Animation complete.
    });
      
    $("#stackers").animate({
        opacity: 1
    }, 3000, function() {
        // Animation complete.
    });
    // $(window).resize(function(){location.reload();});
	
	if ($(".theslip")) {
    	$(".theslip").stick_in_parent({ offset_top: 350,sticky_class : "vislip" });
	}
	
	// NAVIGATION OPEN AND CLOSE
   $(".bar-holster").click(function(e){
    e.preventDefault();
        var bion = $("body");
        if(bion.hasClass('navopen'))
            bion.removeClass('navopen');
        else
            bion.addClass('navopen');
    });

       $(".nav-closer").click(function(e){
        e.preventDefault();
        $('body').removeClass('navopen');
     });
		
    // BALANCING HEIGHTS
    var heighters = $('.home-custom article').height();
    var heighter = $('.about-text').height();
    $('.home-custom aside').css('height', heighters);
    $('.about-left').css('height', heighter);


    // SEARCH OPEN AND CLOSE
    $(".fixed-nav .searcher").click(function(e){
    e.preventDefault();
        var bion = $("body");
        var searchy = $("#search");
        
        if(bion.hasClass('opensearch'))
            bion.removeClass('opensearch');
        else
            bion.addClass('opensearch');
    });

    $(".search-closer").click(function(e){
        e.preventDefault();
        $('body').removeClass('opensearch');
     });

	$(".fixed-nav .searcher").click(function(e){
		$("#search").focus();
	});


    // INFO OPEN AND CLOSE
    $(".fixed-nav .info").click(function(e){
    e.preventDefault();
        var bion = $("body");
        if(bion.hasClass('openinfo'))
            bion.removeClass('openinfo');
        else
            bion.addClass('openinfo');
    });

    $(".info-closer").click(function(e){
        e.preventDefault();
        $('body').removeClass('openinfo');
     });

    // IN VIEW ANIMATIONS
    $('.home-custom aside .sock-lining').bind('inview', function (event, visible) {
      if (visible === true) {
            $(this).addClass("viola");
        } else {
            $(this).removeClass("viola");
      }
    });

   $(".comment-click").click(function(e){
    e.preventDefault();
        var bion = $(".usercomments");
        if(bion.hasClass('usercomment-opend'))
            bion.removeClass('usercomment-opend');
        else
            bion.addClass('usercomment-opend');
    });


    // SCROLL FADING
    var fadeStart=0; // 100px scroll or less will equiv to 1 opacity
    var fadeUntil=500; // 200px scroll or more will equiv to 0 opacity
    var fading = $('.feature-holster');

    $(window).bind('scroll', function(){
        var offset = $(document).scrollTop(), opacity=0;
        if( offset<=fadeStart ){
            opacity=1;
        }else if( offset<=fadeUntil ){
            opacity=1-offset/fadeUntil;
        }
        fading.css('opacity',opacity);

    });
	
	// TABS FUNCTION //
	$('.tabs-wrapper').each(function() {
		$(this).find(".tab-content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(this).find(".tab-content:first").show(); //Show first tab content
	});
	$("ul.tabs li").click(function(e) {
		$(this).parents('.tabs-wrapper').find("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(this).parents('.tabs-wrapper').find(".tab-content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$("li.tab-item:first-child").css("background", "none" );
		$(this).parents('.tabs-wrapper').find(activeTab).fadeIn(); //Fade in the active ID content
		e.preventDefault();
	});
	$("ul.tabs li a").click(function(e) {
		e.preventDefault();
	});
	$("li.tab-item:last-child").addClass('last-item');
	
	// TOGGLE FUNCTION //
	$('#toggle-view li').click(function () {
        var text = $(this).children('div.panel');
        if (text.is(':hidden')) {
            text.slideDown('200');
            $(this).children('span').addClass('toggle-minus');     
            $(this).addClass('activated');     
        } else {
            text.slideUp('200');
			$(this).children('span').removeClass('toggle-minus'); 
            $(this).children('span').addClass('toggle-plus'); 
            $(this).removeClass('activated');		
        }
         
    });
    
    //loader line fixer
    setTimeout(function()
    {
        $('#homepage .logo, #homepage .line, nav').animate({'opacity': '1'}, 400);
        
    }, 400);
    
    
		$(".navitem li").hover(function() {
			
			$(this).find("span").stop().css('display','block').animate({ bottom: "0px", opacity: "1"  }, 300);
		
		},function(){
		
			$(this).find("span").stop().css('display','none').animate({ bottom: "-10px", opacity: "0"  }, 300);
		
		});   

	// MOBILE NAV
	$('.smn_button_menus').click(function() {
		if (!$(this).hasClass('active')) {
			// DROP MENU DOWN
			$(this).addClass('active');
			$(this).parent().find('.sub-menu').slideDown();
		} else {
			/*
			// RESET
			$('.smn_button_menus').removeClass('active');
			$('.smn_list_div .sub-menu').slideUp();
			*/

			$(this).removeClass('active');
			$(this).parent().find('.sub-menu').slideUp();
		}
	});

	$('.smn_button_tabs').click(function() {
		if (!$(this).hasClass('active')) {
			// DROP MENU DOWN
			$(this).addClass('active');
			$(this).parent().find('.smn_container_tabs').slideDown();
		} else {
			// RESET
			$(this).removeClass('active');
			$(this).parent().find('.smn_container_tabs').slideUp();
		}
	});
	
	
}); // End $(document).ready

$(window).load(function() {
    if ($('.topslide')) {
        $('.topslide').iosSlider({ desktopClickDrag: true, scrollbar: true, scrollbarDrag: true, responsiveSlides: true, responsiveSlideContainer: true, keyboardControls: true, scrollbarLocation: 'bottom', autoSlide: true, autoSlideTimer: 2000, navNextSelector: $('#nextSlide'), navPrevSelector: $('#previousSlide'), });
    }
    
    $(".touchcarousel").touchCarousel({				
		itemsPerPage: 1,	
		autoplay: true,
		scrollbar: true,
		scrollbarAutoHide: false,
		scrollbarTheme: "dark",				
		pagingNav: false,
		itemFallbackWidth: 500,
		snapToItems: false,
		scrollToLast: false,
		useWebkit3d: true,
		loopItems: true
	});	
			
}); // End $(window).load

if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({ scrollTop: 0 }, 700);
    });
}
