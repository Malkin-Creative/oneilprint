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
    $('#searchinput').on('click', function() {
        const $parent = $(this).closest('form');
        const isExpanded = $parent.hasClass('active-search');
        const $otherInput = $('#searchinput').siblings('input[type="submit"]').first();

        if (isExpanded === false) {
            $parent.addClass('active-search');
            $parent.attr('aria-expanded', 'true');
            $('#searchinput').attr('placeholder', 'Keyword');
        }

        // Toggle value between "Search" and ""
        if ($otherInput.val() === '') {
            $otherInput.val('Search');
        }
    });

    $('#close-search').on('click', function() {
        const $parent1 = $(this).closest('form');
        const isExpanded1 = $parent1.hasClass('active-search');
        const $otherInput1 = $('#searchinput').siblings('input[type="submit"]').first();

        if (isExpanded1 === true) {
            $parent1.removeClass('active-search');
            $parent1.attr('aria-expanded', 'false');
            $('#searchinput').attr('placeholder', 'Search');
        }

        // Toggle value between "Search" and ""
        if ($otherInput1.val() === 'Search') {
            $otherInput1.val('');
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

}); // jQuery End

