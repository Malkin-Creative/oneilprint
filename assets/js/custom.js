jQuery(function ($) {
    // Cookie Policy and Announcement Bar
    const $cookiePolicy = $('.cookie-policy');
    const $closeCookiePolicy = $('#close-cookie');
    const $announcementBar = $('.announcement-bar');
    const $closeAnnouncementBar = $('#close-announcement');

    if (localStorage.getItem('cookieDismissed') === 'true') {
      $cookiePolicy.attr('aria-hidden', 'true');
    }

    $closeCookiePolicy.on('click', function () {
      $cookiePolicy.attr('aria-hidden', 'true');
      localStorage.setItem('cookieDismissed', 'true');
    });

    if (localStorage.getItem('bannerDismissed') === 'true') {
      $announcementBar.attr('aria-hidden', 'true');
    }

    $closeAnnouncementBar.on('click', function () {
      $announcementBar.attr('aria-hidden', 'true');
      localStorage.setItem('bannerDismissed', 'true');
    });

    //Custom Walker Menu
    const menuLinks = document.querySelectorAll('.menu-item-has-children > a');

    menuLinks.forEach(function(link) {
        const submenu = link.nextElementSibling;

        if (submenu && submenu.classList.contains('sub-menu')) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                submenu.classList.toggle('submenu-open', !expanded);
            });
        }
    });

    // Toggle Search bar
    const $parent = $(this).closest('form');
    const $isExpanded = $parent.hasClass('active-search');
    const $otherInput = $('#searchinput').siblings('input[type="submit"]').first();
    console.log($isExpanded);

    $('#searchinput').on('click', function() {
        if ($isExpanded === true) {
            $parent.addClass('active-search');
            $parent.attr('aria-expanded', 'true');
            $otherInput.val('Search');
        }
    }); 
    $('#close-search').on('click', function() {
        if ($isExpanded === false) {
            $parent.removeClass('active-search');
            $parent.attr('aria-expanded', 'false');
            $otherInput.val('');
        }
    }); 

    // $('#searchinput').on('click', function() {
    //     alert(isExpanded);
    //     $parent.toggleClass('active-search');
    //     $parent.attr('aria-expanded', !isExpanded);

    //     // Toggle value between "Search" and ""
    //     if ($otherInput.val() === 'Search') {
    //         $otherInput.val('');
    //     } else {
    //         $otherInput.val('Search');
    //     }
    // });

}); // jQuery End

