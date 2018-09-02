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
    
    // Tooltip test
    $('[data-toggle="tooltip"]').tooltip();
    
    // for report page
    $("#report-select").change(function(){
                var n=location.pathname+"?mid="+$(this).val();
                return window.location.href=n;
    });
});
