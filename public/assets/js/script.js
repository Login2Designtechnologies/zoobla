jQuery(document).ready(function($) {
    jQuery(document).ready(function() {
        var sync1 = jQuery("#sync1");
        var sync2 = jQuery("#sync2");
        var slidesPerPage = 4; //globaly define number of elements per page
        var syncedSecondary = true;
    
        sync1.owlCarousel({
          items: 1,
          slideSpeed: 3000,
          autoplay:false,
          nav: true,
          animateIn: "fadeIn",
          autoplayHoverPause: true,
          autoplaySpeed: 1400,
          dots: false,
          loop: true,
          responsiveClass: true,
          responsive: {
            0: {
              items: 1,
            },
            600: {
              items: 1,
            }
          },
          responsiveRefreshRate: 200,
          navText: [
            '<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 3px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>',
            '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 3px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'
          ]
        }).on("changed.owl.carousel", syncPosition);
    
        sync2.on("initialized.owl.carousel", function() {
          sync2.find(".owl-item").eq(0).addClass("current");
        }).owlCarousel({
          items: slidesPerPage,
          dots: true,
          smartSpeed: 1000,
          slideSpeed: 1000,
          slideBy: slidesPerPage,
          responsiveRefreshRate: 100
        }).on("changed.owl.carousel", syncPosition2);
    
        function syncPosition(el) {
          var count = el.item.count - 1;
          var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
    
          if (current < 0) {
            current = count;
          }
          if (current > count) {
            current = 0;
          }
    
          sync2.find(".owl-item").removeClass("current").eq(current).addClass("current");
          var onscreen = sync2.find(".owl-item.active").length - 1;
          var start = sync2.find(".owl-item.active").first().index();
          var end = sync2.find(".owl-item.active").last().index();
    
          if (current > end) {
            sync2.data("owl.carousel").to(current, 100, true);
          }
          if (current < start) {
            sync2.data("owl.carousel").to(current - onscreen, 100, true);
          }
        }
    
        function syncPosition2(el) {
          if (syncedSecondary) {
            var number = el.item.index;
            sync1.data("owl.carousel").to(number, 100, true);
          }
        }
    
        sync2.on("click", ".owl-item", function(e) {
          e.preventDefault();
          var number = jQuery(this).index();
          sync1.data("owl.carousel").to(number, 300, true);
        });
      });


      // Checkout fixed
      $(window).scroll(function() {
        if ($(window).scrollTop() > 80) {
          $('.checkout-summary').addClass('newClass');
        } else {
          $('.checkout-summary').removeClass('newClass');
        }
      
        if ($(document).height() - $(window).height() - $(window).scrollTop() < 600) {
          $('.checkout-summary').removeClass('newClass');
        }
      });
      

    // <!-- image change on hover -->
    function changeImage(anything) {
        document.getElementById('imagechangemenu').src = anything;
        document.getElementById('imagechangemenu1').src = anything;
    }
    // ./<!-- image change on hover -->

    // <!-- stickey header -->
    window.addEventListener("scroll", function () {
        var header = document.querySelector("header");
        header.classList.toggle("color-header", window.scrollY > 0);
    })
    // ./<!-- stickey header -->

    // 
    humbarg = document.querySelector(".menuToggle_zoobla");
    humbarg.onclick = function () {
        navBar = document.querySelector(".navbar_zoobla");
        navBar.classList.toggle("active");
    }
    // 


    var tabwrapWidth= $('.tabs-wrapper').outerWidth();
    var totalWidth=0;
    jQuery("ul li").each(function() { 
      totalWidth += jQuery(this).outerWidth(); 
    });
    if(totalWidth > tabwrapWidth){
      $('.scroller-btn').removeClass('inactive');
    }
    else{
      $('.scroller-btn').addClass('inactive');
    }

    if($("#scroller").scrollLeft() == 0 ){
      $('.scroller-btn.left').addClass('inactive');
    }
    else{
       $('.scroller-btn.left').removeClass('inactive');
    }
		var liWidth= $('#scroller li').outerWidth();
		var liCount= $('#scroller li').length;
		var scrollWidth = liWidth * liCount;

				$('.right').on('click', function(){
          $('.nav-tabs').animate({scrollLeft: '+=200px'}, 300);
          console.log($("#scroller").scrollLeft() + " px");
				});
				
				$('.left').on('click', function(){
					$('.nav-tabs').animate({scrollLeft: '-=200px'}, 300);
				});
      scrollerHide()
     
      function scrollerHide(){
        var scrollLeftPrev = 0;
        $('#scroller').scroll(function () {
            var $elem=$('#scroller');
            var newScrollLeft = $elem.scrollLeft(),
                width=$elem.outerWidth(),
                scrollWidth=$elem.get(0).scrollWidth;
            if (scrollWidth-newScrollLeft==width) {
                $('.right.scroller-btn').addClass('inactive');
            }
            else{

                 $('.right.scroller-btn').removeClass('inactive');
            }
            if (newScrollLeft === 0) {
              $('.left.scroller-btn').addClass('inactive');
            }
            else{

                 $('.left.scroller-btn').removeClass('inactive');
            }
            scrollLeftPrev = newScrollLeft;
        });
      }
	});


    // number increase descrease

    const plus = document.querySelector(".plus"),
    minus = document.querySelector(".minus"),
    num = document.querySelector(".num");

    window.addEventListener("load", ()=> {
        if (localStorage["num"]) {
            num.innerText = localStorage.getItem("num");
        } else {
            let a = "01";
            num.innerText = a;
        }
    });

    plus.addEventListener("click", ()=> {
        a = num.innerText;
        a++;
        a = (a < 10) ? "0" + a : a;
        localStorage.setItem("num", a);
        num.innerText = localStorage.getItem("num");
    });

    minus.addEventListener("click", ()=> {
        a = num.innerText;
        if (a > 1) {
            a--;
            a = (a < 10) ? "0" + a : a;
            localStorage.setItem("num", a);
            num.innerText = localStorage.getItem("num");
        }
    }); 
        

// stickey header


        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("color-header", window.scrollY > 0);
        });



        // owal curosal
        $(document).ready(function () {
            var itemsMainDiv = ('.MultiCarousel');
            var itemsDiv = ('.MultiCarousel-inner');
            var itemWidth = "";
        
            $('.leftLst, .rightLst').click(function () {
                var condition = $(this).hasClass("leftLst");
                if (condition)
                    click(0, this);
                else
                    click(1, this)
            });
        
           ResCarouselSize();
        
        
        
        
            $(window).resize(function () {
                ResCarouselSize();
            });
        
            //this function define the size of the items
            function ResCarouselSize() {
                var incno = 0;
                var dataItems = ("data-items");
                var itemClass = ('.item');
                var id = 0;
                var btnParentSb = '';
                var itemsSplit = '';
                var sampwidth = $(itemsMainDiv).width();
                var bodyWidth = $('body').width();
                $(itemsDiv).each(function () {
                    id = id + 1;
                    var itemNumbers = $(this).find(itemClass).length;
                    btnParentSb = $(this).parent().attr(dataItems);
                    itemsSplit = btnParentSb.split(',');
                    $(this).parent().attr("id", "MultiCarousel" + id);
        
        
                    if (bodyWidth >= 1200) {
                        incno = itemsSplit[3];
                        itemWidth = sampwidth / incno;
                    }
                    else if (bodyWidth >= 992) {
                        incno = itemsSplit[2];
                        itemWidth = sampwidth / incno;
                    }
                    else if (bodyWidth >= 768) {
                        incno = itemsSplit[1];
                        itemWidth = sampwidth / incno;
                    }
                    else {
                        incno = itemsSplit[0];
                        itemWidth = sampwidth / incno;
                    }
                    $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                    $(this).find(itemClass).each(function () {
                        $(this).outerWidth(itemWidth);
                    });
        
                    $(".leftLst").addClass("over");
                    $(".rightLst").removeClass("over");
        
                });
            }
        
        
            //this function used to move the items
            function ResCarousel(e, el, s) {
                var leftBtn = ('.leftLst');
                var rightBtn = ('.rightLst');
                var translateXval = '';
                var divStyle = $(el + ' ' + itemsDiv).css('transform');
                var values = divStyle.match(/-?[\d\.]+/g);
                var xds = Math.abs(values[4]);
                if (e == 0) {
                    translateXval = parseInt(xds) - parseInt(itemWidth * s);
                    $(el + ' ' + rightBtn).removeClass("over");
        
                    if (translateXval <= itemWidth / 2) {
                        translateXval = 0;
                        $(el + ' ' + leftBtn).addClass("over");
                    }
                }
                else if (e == 1) {
                    var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                    translateXval = parseInt(xds) + parseInt(itemWidth * s);
                    $(el + ' ' + leftBtn).removeClass("over");
        
                    if (translateXval >= itemsCondition - itemWidth / 2) {
                        translateXval = itemsCondition;
                        $(el + ' ' + rightBtn).addClass("over");
                    }
                }
                $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
            }
        
            //It is used to get some elements from btn
            function click(ell, ee) {
                var Parent = "#" + $(ee).parent().attr("id");
                var slide = $(Parent).attr("data-slide");
                ResCarousel(ell, Parent, slide);
            }
        
        });



       

// Cart js
        function openCart() {
            document.getElementById("cartDrawer").style.right = "0";
            document.getElementById("overlay").style.display = "block";
          }
      
          function closeCart() {
            document.getElementById("cartDrawer").style.right = "-510px";
            document.getElementById("overlay").style.display = "none";
          }


        //   



     

