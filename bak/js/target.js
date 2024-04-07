$(document).ready( function () {
    $(".blank").append();
    $(".blank img").css("vertical-align","text-top");
    $(".blank").after('&nbsp;');
    $('.blank').click(function(){
        window.open(this.href, '_blank');
        return false;
    });
});
