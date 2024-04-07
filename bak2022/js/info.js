$(function() {
    $(".eventTub li").click(function() {
        var num = $(".eventTub li").index(this);
        $(".eventCnt").addClass('hide');
        $(".eventCnt").eq(num).removeClass('hide');
        $(".eventTub li").removeClass('active');
        $(this).addClass('active')
    });
});

$(function() {
    $(".download .none.btn").remove();
});