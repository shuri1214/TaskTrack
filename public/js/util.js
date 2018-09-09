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
        setInterval(function(){ 
	        $('#perform-message').addClass('magictime vanishOut');
        }, 1300 );
    }
    
    $()
    
    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // for report page
    $("#report-select").change(function(){
                var n=location.pathname+"?mid="+$(this).val();
                return window.location.href=n;
    });
/*
    $("#report-table").DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
        },
        "paging"        : false,
        "order"         : [[ 0, 'desc' ]],
        "lengthChange"  : false,
        "searching"     : false,
        "info"          : false,
        "scrollX"       : true,
        "bAutoWidth"     : false,
    });
*/  
    $("#report-table").tablesorter({
            sortList: [[0,1]]
         });
});
