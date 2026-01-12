jQuery(function ($) {
    var $header = $('.site-header');
    var hasFixed = false;

    function checkHeaderPosition() {
        if ($(window).scrollTop() > 1000) {
            if (!hasFixed) {
                $header.addClass('fixed');
                setTimeout(function () {
                    $header.addClass('show');
                }, 10);
                hasFixed = true;
            }
        } else {
            if (hasFixed) {
                $header.removeClass('show fixed');
                hasFixed = false;
            }
        }
    }

    // Check on scroll
    $(window).on('scroll', checkHeaderPosition);

    // Check on page load
    checkHeaderPosition();

}); // jQuery End
