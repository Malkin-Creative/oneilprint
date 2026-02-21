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
    // $('#searchinput').on('click', function() {
    //     const $parent = $(this).closest('form');
    //     const isExpanded = $parent.hasClass('active-search');
    //     const $otherInput = $('#searchinput').siblings('input[type="submit"]').first();

    //     if (isExpanded === false) {
    //         $parent.addClass('active-search');
    //         $parent.attr('aria-expanded', 'true');
    //         $('#searchinput').attr('placeholder', 'Keyword');
    //     }

    //     // Toggle value between "Search" and ""
    //     if ($otherInput.val() === '') {
    //         $otherInput.val('Search');
    //     }
    // });

    // $('#close-search').on('click', function() {
    //     const $parent1 = $(this).closest('form');
    //     const isExpanded1 = $parent1.hasClass('active-search');
    //     const $otherInput1 = $('#searchinput').siblings('input[type="submit"]').first();

    //     if (isExpanded1 === true) {
    //         $parent1.removeClass('active-search');
    //         $parent1.attr('aria-expanded', 'false');
    //         $('#searchinput').attr('placeholder', 'Search');
    //     }

    //     // Toggle value between "Search" and ""
    //     if ($otherInput1.val() === 'Search') {
    //         $otherInput1.val('');
    //     }
    // });

    const $form     = $('#search-form');
    const $input    = $('#searchinput');
    const $closeButton = $('#close-search');

    function openSearch() {
        if (!$form.hasClass('active-search')) {
            $form.addClass('active-search')
                 .attr('aria-expanded', 'true');
            $closeButton.prop('hidden', false);
        }
    }

    function closeSearch() {
        $form.removeClass('active-search')
             .attr('aria-expanded', 'false');
        $closeButton.prop('hidden', true);
    }

    // Expand when input receives focus
    $input.on('focus', function () {
        openSearch();
    });

    // Close button click
    $closeButton.on('click', function () {
        closeSearch();
        $input.blur();
    });

    // Escape key closes (from anywhere inside form)
    $form.on('keydown', function (e) {
        if (e.key === 'Escape') {
            closeSearch();
            $input.blur();
        }
    });

    // Close when focus leaves the entire form
    $form.on('focusout', function (e) {
        // Delay so we can check the new focused element
        setTimeout(function () {
            if (!$form.find(':focus').length) {
                closeSearch();
            }
        }, 0);
    });

    // Click outside closes
    $(document).on('mousedown', function (e) {
        if (!$form.is(e.target) && $form.has(e.target).length === 0) {
            closeSearch();
        }
    });

    // Modal
    const $modal = $('#videoModal');
    const $frameContainer = $modal.find('.video-frame');
    const $closeBtn = $modal.find('.close-modal');
    let $lastFocused = null;

    const focusableSelectors = `
        a[href], button:not([disabled]), textarea, input, select,
        [tabindex]:not([tabindex="-1"])
    `;

    function trapFocus(e) {
        const $focusable = $modal.find(focusableSelectors).filter(':visible');
        const $first = $focusable.first();
        const $last = $focusable.last();

        if (e.key === 'Tab') {
        if (e.shiftKey && $(document.activeElement).is($first)) {
            e.preventDefault();
            $last.focus();
        } else if (!e.shiftKey && $(document.activeElement).is($last)) {
            e.preventDefault();
            $first.focus();
        }
        }

        if (e.key === 'Escape') {
        closeModal();
        }
    }

    function openModal(videoId, $trigger) {
        $lastFocused = $trigger;

        $frameContainer.html(`
        <iframe
            src="https://www.youtube.com/embed/${videoId}?autoplay=1&rel=0"
            title="YouTube video player"
            allow="autoplay; encrypted-media"
            allowfullscreen>
        </iframe>
        `);

        $modal.addClass('active').attr('aria-hidden', 'false');
        $('body').addClass('modal-open');

        $(document).on('keydown.videoModal', trapFocus);

        $closeBtn.focus();
    }

    function closeModal() {
        $modal.removeClass('active').attr('aria-hidden', 'true');
        $frameContainer.empty();
        $('body').removeClass('modal-open');

        $(document).off('keydown.videoModal');

        if ($lastFocused) {
        $lastFocused.focus();
        }
    }

    // Open
    $('.hero-video__wrap__thumb__play-btn').on('click', function () {
        const videoId = $(this).data('video-id');
        openModal(videoId, $(this));
    });

    // Close button
    $closeBtn.on('click', closeModal);

    // Click outside
    $modal.on('click', function (e) {
        if ($(e.target).is($modal)) {
        closeModal();
        }
    });

    //Mega Menu
    var mouseOutHideDelay = 200;
    var mouseTimers = new WeakMap();

    function showMenu($btn, $panel) {
        $btn.attr('aria-expanded', 'true');
        $panel.addClass('is-open');
    }

    function hideMenu($btn, $panel) {
        $btn.attr('aria-expanded', 'false');
        $panel.removeClass('is-open');
    }

    function closeAllMenus() {
        $('.toggle-button[aria-expanded="true"]').each(function () {
            var $btn = $(this);
            var panelId = $btn.attr('aria-controls');
            var $panel = $('#' + panelId);
            hideMenu($btn, $panel);
        });
    }

    // Loop every mega-enabled menu item
    $('nav .menu-item-has-children').each(function () {

        var $container = $(this);
        var $toggleBtn = $container.find('> .toggle-button');
        var panelId    = $toggleBtn.attr('aria-controls');
        var $panel     = $('#' + panelId);
        var $closeBtn  = $panel.find('.close-button');

        if (!$toggleBtn.length || !$panel.length) return;

        // Hover behavior
        $container.on('mouseenter', function () {
            clearTimeout(mouseTimers.get(this));
            showMenu($toggleBtn, $panel);
        });

        $container.on('mouseleave', function () {
            var timer = setTimeout(function () {
                hideMenu($toggleBtn, $panel);
            }, mouseOutHideDelay);

            mouseTimers.set($container[0], timer);
        });

        // Toggle click
        $toggleBtn.on('click', function (e) {
            e.preventDefault();
            var expanded = $toggleBtn.attr('aria-expanded') === 'true';

            closeAllMenus();

            if (!expanded) {
                showMenu($toggleBtn, $panel);
            }
        });

        // Close button click
        $closeBtn.on('click', function () {
            hideMenu($toggleBtn, $panel);
            $toggleBtn.focus();
        });

        // Keyboard handling inside this menu
        $container.on('keydown', function (e) {
            if (e.key === 'Escape') {
                hideMenu($toggleBtn, $panel);
                $toggleBtn.focus();
            }

            // Tab out of last link closes menu
            var $lastLink = $panel.find('a').last();
            if (e.key === 'Tab' && !e.shiftKey && e.target === $lastLink[0]) {
                hideMenu($toggleBtn, $panel);
            }
        });

    });

    // Click outside closes everything
    $('body').on('click', function (e) {
        if (!$(e.target).closest('nav').length) {
            closeAllMenus();
        }
    });

    // Hamburger
    const $toggle = $('.navbar-toggler');
    const $overlay = $('#mobile-menu');

    $toggle.on('click', function(){

        const expanded = $(this).attr('aria-expanded') === 'true';

        $(this)
        .attr('aria-expanded', !expanded)
        .toggleClass('active');

        $overlay
        .toggleClass('active')
        .attr('aria-hidden', expanded);

        $('body').toggleClass('menu-open');

    });

    // Close if clicking outside menu
    $(document).on('click', function(e){
        if (!$(e.target).closest('.mobile-menu-inner, .navbar-toggler').length) {
        closeMenu();
        }
    });

    function closeMenu(){
        $toggle.attr('aria-expanded', false).removeClass('active');
        $overlay.removeClass('active').attr('aria-hidden', true);
        $('body').removeClass('menu-open');
    }

    // Archive pagination
    function togglePager() {
        if (typeof FWP === 'undefined') return;

        var total_pages = FWP.settings.pager.total_pages;
        var $pager = $('.pagination.archive');

        if (!$pager.length) return;

        if (total_pages <= 1) {
            $pager.hide();
        } else {
            $pager.show();
        }
    }

    $(document).on('facetwp-loaded', togglePager);

    // Anchor Scroll
     $('.anchor-scroll').on('click', function(e) {
        var target = $(this).attr('href');
        // Only handle anchor links
        if (target && target.startsWith('#') && $(target).length) {
            e.preventDefault();

            var headerHeight = $('.site-header').outerHeight() || 0; // adjust selector
            var offset = $(target).offset().top - headerHeight;

            $('html, body').stop(true).animate({
                scrollTop: offset
            }, 400, function() {
                window.location.hash = target;
            });

        }
    });

}); // jQuery End

