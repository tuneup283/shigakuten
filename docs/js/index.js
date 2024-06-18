/*$(function(){
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
})*/
/*------------------------------------------------------------------------------*/
$(function() {
    var pull = $('.head_btn');  
    var menu = $('.head_list');   
    var menuOpen = false;

    pull.on('click', function(e) {  
      e.preventDefault();    
      if(menuOpen){
        menu.slideUp();
        menuOpen = false;
        pull.removeClass('active');
      }else{
        menu.slideDown();
        menuOpen = true; 
        pull.addClass('active');
      }    
    }); 
});
/*------------------------------------------------------------------------------*/
$(function(){
	$(".accordion dt").on("click", function() {
		if ($(this).parent().hasClass("accordion")) {
		$(this).next().slideToggle();
		$(this).toggleClass("open");
		}
	});
});

$(function(){
    $('#contact').before('<div id="page_top"><a href="#"></a></div>');
    var pagetop = $('#page_top');   
    pagetop.hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            pagetop.fadeIn();
        } else {
            pagetop.fadeOut();
        }
    });
});
$(function () {
    /*function nolinkclick() {
        $('.nolink').click(function (e) {
            e.preventDefault();
            $('#modalArea').fadeIn();
            $('#headNav_close , #modalBg').click(function () {
                $('#modalArea').fadeOut();
            });
        });
    }
    nolinkclick();
    $('input[name=entry_check]').on('change', function () {
        if ($(".entry_check_btn:checked").length > 0) {
            $(".entry_btn").addClass('golink');
            $('.nolink').off();
        } else {
            $(".entry_btn").removeClass('golink');
            $(".entry_btn").addClass('nolink');
            nolinkclick();
        }
    });*/
	// エントリーボタン押した時
	/*$('.entry_btn').on('click', function (e) {
		// 「確認しました」にチェックが入っていない場合
		if ($(".entry_check_btn:checked").length == 0) {
			// モーダル表示
			e.preventDefault();
			$('#modalArea').fadeIn();
			$('#headNav_close , #modalBg').click(function () {
				$('#modalArea').fadeOut();
			});
		}
	});*/
});