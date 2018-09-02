$(function () {
    
    // Scroll
    var topBtn = $('#page-top');
    topBtn.hide();
    // display top-button when moving 200
    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    // to top animation
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 200);
        return false;
    });
    
    // performance success message 
    if($('#perform-message').length){
        $('#perform-message').fadeIn(500, function () {
            $(this).delay(2000).fadeOut("slow");
        });
    }
    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // for report page
    $("#report-select").change(function(){
                var n=location.pathname+"?mid="+$(this).val();
                return window.location.href=n;
    });
});
