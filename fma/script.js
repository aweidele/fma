$ = jQuery;
$(document).ready(function() {
  
  var $retina = window.devicePixelRatio > 1;
  if($retina) {
    $("img").each(function() {
      if($(this).next('input[name="retina"]').val() != undefined) { 
        $retinaURL = $(this).next('input[name="retina"]').val();
        $(this).attr("src",$retinaURL);
      }
    });
  }
  
  $("ul.child-pages li a").click(function(e) {
    e.preventDefault();
    if($(this).parent().index() == 0 ) {
      o = 0;
    } else {
      h = $(this).attr("href");
      o = $(h).offset().top;
    }
    $('html, body').animate({
      scrollTop: o
    }, 2000);
  });
  
  $("#content_right p.back_to_top").click(function(e) {
    $('html, body').animate({
      scrollTop: 0
    }, 3000);
  });
  
  windowResize();
  $(window).resize(function() { windowResize(); });
  $(window).scroll(function() { windowScroll(); });
  
  if( $("#news_posts").length ) { $("#news_posts .post").addClass("abs"); }
  
  if($("#project_posts .project").length) {
    
    $post_slides = new Array();
    $("#project_posts .project").each(function() {
      $post_slides.push(0);
    });
    $("#project_posts .project .nextprev li").click(function() {
      
      if($(this).index()==0) {
        next = -1;
      } else {
        next = 1;
      }
      
      thisSlideshow = $(this).parent().siblings('.slideshow');
      i = $(this).parent().parent().parent().parent().index();
      
      $post_slides[i] += next;
      if($post_slides[i] > $("li",thisSlideshow).length-1) { $post_slides[i] = 0; }
      if($post_slides[i] < 0) { $post_slides[i] = $("li",thisSlideshow).length-1; }
      
      $("li",thisSlideshow).removeClass('active');
      $("li:eq("+$post_slides[i]+")",thisSlideshow).addClass('active');
      
    });
  }
  
  /*** EXPANDED LIST VIEW ***/
  $("#project_list .project_list_column.expanded_list a").click(function(e) {
    e.preventDefault();
    $expand = $(this).parent().parent();
    $expand.siblings('.project_expanded').slideToggle(500);
    $expand.parent().toggleClass('height_auto');
  });
  
  /*** MOBILE MENU ***/
  $("#content_left nav").click(function() {
    $("ul",this).toggleClass("navopen");
  });
  
}); /* document.ready() functions */

$slides = null;
$(window).load(function() {
  windowResize();
  
  if( $("#homepage_slideshow").length )
  {
  	$slides = $("#homepage_slideshow div.slide");
  	$slides.eq(Math.floor(Math.random() * $slides.length)).addClass("active");
  	setTimeout(function(){$slides.removeClass("no_transition");}, 1);
  	
  	$("#homepage_slideshow ul.prevnext").on("click",function(e){
  		$("#homepage_slideshow div.slide.active a")[0].click();
  	});
  }
  
  /* SLIDESHOW */
  if($(".fma_slideshow").length && $(".fma_slideshow .slide").length > 1) {
    $(".fma_slideshow").each(function() {
      $next = 1;
      $rotations = 1;
      $speed = parseInt($("input[type='hidden']",this).val());
      $id = '#'+$(this).attr("id");
      
      $timer = null;
      
      // 0 means no auto.
      if( $speed > 0 )
      {
      	$speed += 2000;
      	$timer = setTimeout(function() { homepageSlideshowGo() },$speed);
      }
    });
    
    $(".fma_slideshow .prevnext li,.project_slideshow_prevnext li,#single_project_slideshow img").click(function(e) {
      e.stopPropagation();
      if( $(this).prop("tagName") == "IMG" ) {
        i = 1;
      } else {
        i = $(this).index();
      }
      
      clearTimeout($timer);
      if(i==0) {
        $next-=2;
        if($next<0) { $next = $($id+" .slide").length-1; }
        homepageSlideshowGo();
      } else {
        //alert("next");
        homepageSlideshowGo();
      }
    });
    
    $(".fma_slideshow").swipe({
      swipeLeft:function(event, direction, distance, duration, fingerCount) {
        clearTimeout($timer);
        $next-=2;
        if($next<0) { $next = $($(this).attr("id")+" .slide").length-1; }
        homepageSlideshowGo();
      },
      swipeRight:function(event, direction, distance, duration, fingerCount) {
        clearTimeout($timer);
        homepageSlideshowGo();
      }
    });
    
    if( $("#homepage_text_container").length ) {
      $hpCurrent = 0;
      //$hpTextSpeed = parseInt($("#homepage_text input[type='hidden']").val()) + 2000;
      //$timer = setTimeout(function() { homepageText(); },$hpTextSpeed);
    }
    
    if( $("#quote_container").length ) {
      $qCurrent = 0;
      //$quote_speed = $("#quote_container input[type='hidden']").val();
      //$qTimer = setTimeout(function() { quoteSlides(); },$quote_speed);
    }
  }
  
  /** NEWS SWIPE **/
  if ($("#single_project_content").length > 0) {
    $url = $("#single_project_top ul.backnext li:eq(1) a").attr("href");
    $("#single_project_content").swipe({
      swipeRight:function(event, direction, distance, duration, fingerCount) {
        window.location = $url;
      }
    });
  }

}); /* window.load() functions */


function homepageSlideshowGo() {
  if($next>$($id+" .slide").length-1) { $next = 0; }
  $($id+" .slide.active").removeClass("active");
  $($id+" .slide:eq("+$next+")").addClass("active");
  $next++;
  
  $rotations++;
  if($rotations % 2) {
    if( $("#homepage_text_container").length ) { homepageText(); }
    if( $("#quote_container").length ) { quoteSlides(); }
  }
  
  if($speed > 0) {
  	$timer = setTimeout(function() { homepageSlideshowGo() },$speed);
  }
}

function homepageText() {
  $hpCurrent++;
  if($hpCurrent > $("#homepage_text_container .slide").length - 1) { $hpCurrent = 0; }
  $("#homepage_text_container .slide.active").removeClass('active');
  $("#homepage_text_container .slide:eq("+$hpCurrent+")").addClass('active');
 // $hptimer = setTimeout(function() { homepageText(); },$hpTextSpeed);
}

function quoteSlides() {
  $qCurrent++;
  if($qCurrent > $("#quote_container .slide").length - 1) { $qCurrent = 0; }
  $("#quote_container .slide").removeClass('active');
  $("#quote_container .slide:eq("+$qCurrent+")").addClass('active');
  //$qTimer = setTimeout(function() { quoteSlides(); },$quote_speed);
}


/** WINDOW RESIZE FUNCTIONS **/
function windowResize() {
  //$("#feedback").fadeIn(10000).css({"z-index":999999});
  $w = $(window).width();
  $h = $(window).height();
  
  /* content width */
  //$("#wrapper").width($w);
  //alert($("#news_top").width()+"/"+$("#news_container").width());
  $contentWidth = $w - $("#content_left").width();
  //$("#content_right").width( $contentWidth );
  $("#content_right.sidebar").css({ "min-height":$h });
  //$("#studio_content,#contact_content").width($contentWidth - $("#subnav").width());
  
  /* Studio Slideshow Resize */
  if( $("#studio_slideshow").length ) {
    $("#studio_slideshow").height( $("#studio_slideshow .slide:eq(0) p.image img").height() + $("#studio_slideshow .slide:eq(0) .slide_text").height() );
  }
  
  /* Single Project Resize */
  if( $("#single_project_slideshow").length ) {
    $("#single_project_slideshow").height( $("#single_project_slideshow .slide:eq(0) p.image").height() );
  }
  
  /* News */
  if( $("#news_posts").length ) { arrangeNews(); }
  
  
  /* homepage */
  $("#homepage_wrapper").height($h);
  
  /* Sectioned Content Pages */
  $sectionStops = new Array();
  $("ul.child-pages li a").each(function() {
    $thisHref = $(this).attr("href");
    $sectionStops.push( Math.floor($($thisHref).offset().top) );
    //console.log( $(this).attr("href") );
  });
  $sectionStops.push(Infinity);
  
  
  $dh = $(document).height();
  
  $("#project_posts .project .thumbnails").height( $("#project_posts .project .thumbnails img").height() );
  
  if( $("#homepage_slideshow").length ) {
    
    /*
    if($w > 760 && $w < 1930) {
      $("#homepage_slideshow .slide img").css({ "min-height":$h,"max-height":0 });
    } else if ($w <= 760) {
      $("#homepage_slideshow .slide img").css({ "min-height":0,"max-height":$h });
    }
    */
    $hp_width = $("#homepage_slideshow img:eq(0)").width();
    $hp_height = $("#homepage_slideshow img:eq(0)").height();
    $h_offset = Math.round(($w - $hp_width - $("#content_left").width()) / 2);
    $v_offset = Math.round(($h - $hp_height) / 2);
    $("#homepage_slideshow .slide").css({"left":$h_offset,"top":$v_offset});
    $("#feedback").html( $w + " / " + $hp_width + " / " +  $("#content_left").width() + "<br />" + $h_offset + " / " + $v_offset );
    
  }
  
  windowScroll();
}

/** WINDOW SCROLL FUNCTIONS **/
function windowScroll() {
  $scrollTop = $(window).scrollTop();
  
  /* Sectioned Content Pages */
  a = 0;
  for(i=0;i<$sectionStops.length;i++) {
    if($scrollTop >= $sectionStops[i] && $scrollTop < $sectionStops[i+1]) {
      a = i;
    }
  }
  
  if( $scrollTop == ($dh - $h) ) { a = $sectionStops.length - 2; }
  
  if(a > -1) {
    if(!$("ul.child-pages li:eq("+a+")").hasClass("active")) {
      $("ul.child-pages li").removeClass("active");
      $("ul.child-pages li:eq("+a+")").addClass("active");
    }
  } else {
    $("ul.child-pages li").removeClass("active");
  }
}

function arrangeNews() {
  // determine number of columns
  $postwidth = $("#news_posts .post").width() + parseInt( $("#news_posts .post").css("margin-right") );
  $numcols = Math.floor( ($contentWidth+10) / $postwidth );
  $cols = Array();
  for(i=0;i<$numcols;i++) { $cols.push(0); }
  
  // place posts in shortest columns
  $("#news_posts .post").each(function() {
  
    $shortest = Infinity;
    for(i=0;i<$numcols;i++) {
      if($cols[i] < $shortest) {
        $shortest = $cols[i];
        s = i;
      }
    }
    
    $left = s * $postwidth;
    $(this).css({
      "left":$left,
      "top":$cols[s]
    });
    
    $cols[s] += $(this).height() + parseInt( $(this).css("margin-bottom") );
  
  }); /** $("#news_posts .post").each() **/
  
  $shortest = -Infinity;
  for(i=0;i<$numcols;i++) {
    if($shortest<$cols[i]) {
      $shortest = $cols[i];
    }
  }
  $("#news_posts").height($shortest+10);
}