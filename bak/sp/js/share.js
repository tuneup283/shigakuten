$(function(){
// タブの切り替え
	$(".courseField #type01Area").addClass("target");
	$(".courseField .tabSwitch li:first-child a").addClass("selected");
	$(".tabSwitch a").click(function(){
		$(".courseField > div").removeClass();
		$($(this).attr("href")).addClass("target");
		$(".courseField .tabSwitch li a").removeClass();
		$(this).addClass("selected");
		return false;
	});

// ページトップへのスムーズスクロール
	$(".pagetop a").click(function(){
	$('html,body').animate({ scrollTop: $($(this).attr("href")).offset().top }, 'slow','swing');
	return false;
	})
});