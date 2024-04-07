$(function(){
  $(window).on('resize',function(){
    flexW();
  });
  $(window).on("scroll", function(){
    $(".m-header").css("left", -$(window).scrollLeft());
    if($(window).scrollLeft()==0){
      $(".m-header").css("left","auto");
    }
  });
  flexW();
  $('a[href^="#"]').on('click', function(){
    var speed = 300;
    var href= $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top;
    $('body,html').animate({scrollTop:position}, speed, 'swing');
    return false;
  });
})
/*------------------------------------------------------------------------------*/
var spw =768;
function flexW() {
  cw = $(window).innerWidth();
  if(cw<spw){
    $('img').each(function(){
      $(this).attr("src",$(this).attr("src").replace('_pc', '_sp'));
    });
    $('.m-sankain04').after($('.m-sankain03'))

    var h = $(".l-header").height();


    $(".l-mainimg").css("marginTop",h+"px");
    $(".anchor").css("marginTop",-h+"px");
    $(".anchor").css("paddingTop",h+"px");


  }else{
    $('img').each(function(){
      $(this).attr("src",$(this).attr("src").replace('_sp', '_pc'));
    });
    $('.m-sankain02').after($('.m-sankain03'))


    $(".l-mainimg").css("marginTop",81+"px");
    $(".anchor").css("marginTop",-81+"px");
    $(".anchor").css("paddingTop",81+"px");
  }
}