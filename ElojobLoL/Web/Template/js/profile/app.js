function getPath(){
    return window.location.pathname.split('/');
}
var App = function() {
    var page, pageContent, header, footer, sidebar, sScroll, sidebarAlt, sScrollAlt;
    var uiInit = function() {
        page = $('#page-container');
        pageContent = $('#page-content');
        header = $('header');
        footer = $('#page-content + footer');
        sidebar = $('#sidebar');
        sScroll = $('#sidebar-scroll');
        sidebarAlt = $('#sidebar-alt');
        sScrollAlt = $('#sidebar-alt-scroll');
        handleSidebar('init');
        handleNav();
        interactiveBlocks();
        scrollToTop();
        templateOptions();
        definicoes();
        discord();
        resizePageContent();
        $(window).resize(function() {
            resizePageContent();
        });
        $(window).bind('orientationchange', resizePageContent);
        var yearCopy = $('#year-copy'),
            d = new Date();
        if (d.getFullYear() === 2014) {
            yearCopy.html('2014');
        } else {
            yearCopy.html('2014-' + d.getFullYear().toString().substr(2, 2));
        }
        chatUi();
        $('[data-toggle="tabs"] a, .enable-tabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
        $('[data-toggle="tooltip"], .enable-tooltip').tooltip({
            container: 'body',
            animation: false
        });
        $('[data-toggle="popover"], .enable-popover').popover({
            container: 'body',
            animation: true
        });
        $('[data-toggle="lightbox-image"]').magnificPopup({
            type: 'image',
            image: {
                titleSrc: 'title'
            }
        });
        $('[data-toggle="lightbox-gallery"]').each(function() {
            $(this).magnificPopup({
                delegate: 'a.gallery-link',
                type: 'image',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    arrowMarkup: '<button type="button" class="mfp-arrow mfp-arrow-%dir%" title="%title%"></button>',
                    tPrev: 'Previous',
                    tNext: 'Next',
                    tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
                },
                image: {
                    titleSrc: 'title'
                }
            });
        });
        var exampleTypeheadData = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "CΓ΄te d'Ivoire", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Democratic Republic of the Congo", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Faeroe Islands", "Falkland Islands", "Fiji", "Finland", "Former Yugoslav Republic of Macedonia", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "North Korea", "Northern Marianas", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn Islands", "Poland", "Portugal", "Puerto Rico", "Qatar", "RΓ©union", "Romania", "Russia", "Rwanda", "SΓ£o TomΓ© and PrΓ­ncipe", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Korea", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Bahamas", "The Gambia", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "US Virgin Islands", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "Wallis and Futuna", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
        $('.input-typeahead').typeahead({
            source: exampleTypeheadData
        });
        $('.select-chosen').chosen({
            width: "100%"
        });
        $('.select-select2').select2();
        $('.input-colorpicker').colorpicker({
            format: 'hex'
        });
        $('.input-colorpicker-rgba').colorpicker({
            format: 'rgba'
        });
        $('.input-slider').slider();
        $('.input-tags').tagsInput({
            width: 'auto',
            height: 'auto'
        });
        $('.input-datepicker, .input-daterange').datepicker({
            weekStart: 1
        });
        $('.input-datepicker-close').datepicker({
            weekStart: 1
        }).on('changeDate', function(e) {
            $(this).datepicker('hide');
        });
        $('.input-timepicker').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: true
        });
        $('.input-timepicker24').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false
        });
        $('.pie-chart').easyPieChart({
            barColor: $(this).data('bar-color') ? $(this).data('bar-color') : '#777777',
            trackColor: $(this).data('track-color') ? $(this).data('track-color') : '#eeeeee',
            lineWidth: $(this).data('line-width') ? $(this).data('line-width') : 3,
            size: $(this).data('size') ? $(this).data('size') : '80',
            animate: 800,
            scaleColor: false
        });
        $('input, textarea').placeholder();
    };
    var pageLoading = function() {
        var pageWrapper = $('#page-wrapper');
        if (pageWrapper.hasClass('page-loading')) {
            pageWrapper.removeClass('page-loading');
        }
    };
    var getWindowWidth = function() {
        return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    };
    var handleNav = function() {
        var upSpeed = 250;
        var downSpeed = 250;
        var menuLinks = $('.sidebar-nav-menu');
        var submenuLinks = $('.sidebar-nav-submenu');
        menuLinks.click(function() {
            var link = $(this);
            if (page.hasClass('sidebar-mini') && page.hasClass('sidebar-visible-lg-mini') && (getWindowWidth() > 991)) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().removeAttr('style');
                } else {
                    $('.sidebar-nav-menu.open').removeClass('open').next().removeAttr('style');
                    link.addClass('open').next().css('display', 'block');
                }
            } else if (!link.parent().hasClass('active')) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed, function() {
                        handlePageScroll(link, 200, 300);
                    });
                    setTimeout(resizePageContent, upSpeed);
                } else {
                    $('.sidebar-nav-menu.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed, function() {
                        handlePageScroll(link, 150, 600);
                    });
                    setTimeout(resizePageContent, ((upSpeed > downSpeed) ? upSpeed : downSpeed));
                }
            }
            link.blur();
            return false;
        });
        submenuLinks.click(function() {
            var link = $(this);
            if (link.parent().hasClass('active') !== true) {
                if (link.hasClass('open')) {
                    link.removeClass('open').next().slideUp(upSpeed, function() {
                        handlePageScroll(link, 200, 300);
                    });
                    setTimeout(resizePageContent, upSpeed);
                } else {
                    link.closest('ul').find('.sidebar-nav-submenu.open').removeClass('open').next().slideUp(upSpeed);
                    link.addClass('open').next().slideDown(downSpeed, function() {
                        handlePageScroll(link, 150, 600);
                    });
                    setTimeout(resizePageContent, ((upSpeed > downSpeed) ? upSpeed : downSpeed));
                }
            }
            link.blur();
            return false;
        });
    };
    var handlePageScroll = function(sElem, sHeightDiff, sSpeed) {
        if (!page.hasClass('disable-menu-autoscroll')) {
            var elemScrollToHeight;
            if (!header.hasClass('navbar-fixed-top') && !header.hasClass('navbar-fixed-bottom')) {
                var elemOffsetTop = sElem.offset().top;
                elemScrollToHeight = (((elemOffsetTop - sHeightDiff) > 0) ? (elemOffsetTop - sHeightDiff) : 0);
                $('html, body').animate({
                    scrollTop: elemScrollToHeight
                }, sSpeed);
            } else {
                var sContainer = sElem.parents('#sidebar-scroll');
                var elemOffsetCon = sElem.offset().top + Math.abs($('div:first', sContainer).offset().top);
                elemScrollToHeight = (((elemOffsetCon - sHeightDiff) > 0) ? (elemOffsetCon - sHeightDiff) : 0);
                sContainer.animate({
                    scrollTop: elemScrollToHeight
                }, sSpeed);
            }
        }
    };
    var handleSidebar = function(mode, extra) {
        if (mode === 'init') {
            handleSidebar('sidebar-scroll');
            handleSidebar('sidebar-alt-scroll');
            $('.sidebar-partial #sidebar').mouseenter(function() {
                handleSidebar('close-sidebar-alt');
            });
            $('.sidebar-alt-partial #sidebar-alt').mouseenter(function() {
                handleSidebar('close-sidebar');
            });
        } else {
            var windowW = getWindowWidth();
            if (mode === 'toggle-sidebar') {
                if (windowW > 991) {
                    page.toggleClass('sidebar-visible-lg');
                    if (page.hasClass('sidebar-mini')) {
                        page.toggleClass('sidebar-visible-lg-mini');
                    }
                    if (page.hasClass('sidebar-visible-lg')) {
                        handleSidebar('close-sidebar-alt');
                    }
                    if (extra === 'toggle-other') {
                        if (!page.hasClass('sidebar-visible-lg')) {
                            handleSidebar('open-sidebar-alt');
                        }
                    }
                } else {
                    page.toggleClass('sidebar-visible-xs');
                    if (page.hasClass('sidebar-visible-xs')) {
                        handleSidebar('close-sidebar-alt');
                    }
                }
                handleSidebar('sidebar-scroll');
            } else if (mode === 'toggle-sidebar-alt') {
                if (windowW > 991) {
                    page.toggleClass('sidebar-alt-visible-lg');
                    if (page.hasClass('sidebar-alt-visible-lg')) {
                        handleSidebar('close-sidebar');
                    }
                    if (extra === 'toggle-other') {
                        if (!page.hasClass('sidebar-alt-visible-lg')) {
                            handleSidebar('open-sidebar');
                        }
                    }
                } else {
                    page.toggleClass('sidebar-alt-visible-xs');
                    if (page.hasClass('sidebar-alt-visible-xs')) {
                        handleSidebar('close-sidebar');
                    }
                }
            } else if (mode === 'open-sidebar') {
                if (windowW > 991) {
                    if (page.hasClass('sidebar-mini')) {
                        page.removeClass('sidebar-visible-lg-mini');
                    }
                    page.addClass('sidebar-visible-lg');
                } else {
                    page.addClass('sidebar-visible-xs');
                }
                handleSidebar('close-sidebar-alt');
            } else if (mode === 'open-sidebar-alt') {
                if (windowW > 991) {
                    page.addClass('sidebar-alt-visible-lg');
                } else {
                    page.addClass('sidebar-alt-visible-xs');
                }
                handleSidebar('close-sidebar');
            } else if (mode === 'close-sidebar') {
                if (windowW > 991) {
                    page.removeClass('sidebar-visible-lg');
                    if (page.hasClass('sidebar-mini')) {
                        page.addClass('sidebar-visible-lg-mini');
                    }
                } else {
                    page.removeClass('sidebar-visible-xs');
                }
            } else if (mode === 'close-sidebar-alt') {
                if (windowW > 991) {
                    page.removeClass('sidebar-alt-visible-lg');
                } else {
                    page.removeClass('sidebar-alt-visible-xs');
                }
            } else if (mode === 'sidebar-scroll') {
                if (page.hasClass('sidebar-mini') && page.hasClass('sidebar-visible-lg-mini') && (windowW > 991)) {
                    if (sScroll.length && sScroll.parent('.slimScrollDiv').length) {
                        sScroll.slimScroll({
                            destroy: true
                        });
                        sScroll.attr('style', '');
                    }
                } else if ((page.hasClass('header-fixed-top') || page.hasClass('header-fixed-bottom'))) {
                    var sHeight = $(window).height();
                    if (sScroll.length && (!sScroll.parent('.slimScrollDiv').length)) {
                        sScroll.slimScroll({
                            height: sHeight,
                            color: '#fff',
                            size: '3px',
                            touchScrollStep: 100
                        });
                        var sScrollTimeout;
                        $(window).on('resize orientationchange', function() {
                            clearTimeout(sScrollTimeout);
                            sScrollTimeout = setTimeout(function() {
                                handleSidebar('sidebar-scroll');
                            }, 150);
                        });
                    } else {
                        sScroll.add(sScroll.parent()).css('height', sHeight);
                    }
                }
            } else if (mode === 'sidebar-alt-scroll') {
                if ((page.hasClass('header-fixed-top') || page.hasClass('header-fixed-bottom'))) {
                    var sHeightAlt = $(window).height();
                    if (sScrollAlt.length && (!sScrollAlt.parent('.slimScrollDiv').length)) {
                        sScrollAlt.slimScroll({
                            height: sHeightAlt,
                            color: '#fff',
                            size: '3px',
                            touchScrollStep: 100
                        });
                        var sScrollAltTimeout;
                        $(window).on('resize orientationchange', function() {
                            clearTimeout(sScrollAltTimeout);
                            sScrollAltTimeout = setTimeout(function() {
                                handleSidebar('sidebar-alt-scroll');
                            }, 150);
                        });
                    } else {
                        sScrollAlt.add(sScrollAlt.parent()).css('height', sHeightAlt);
                    }
                }
            }
        }
        return false;
    };
    var resizePageContent = function() {
        var windowH = $(window).height();
        var sidebarH = sidebar.outerHeight();
        var sidebarAltH = sidebarAlt.outerHeight();
        var headerH = header.outerHeight();
        var footerH = footer.outerHeight();
        if (header.hasClass('navbar-fixed-top') || header.hasClass('navbar-fixed-bottom') || ((sidebarH < windowH) && (sidebarAltH < windowH))) {
            if (page.hasClass('footer-fixed')) {
                pageContent.css('min-height', windowH - headerH + 'px');
            } else {
                pageContent.css('min-height', windowH - (headerH + footerH) + 'px');
            }
        } else {
            if (page.hasClass('footer-fixed')) {
                pageContent.css('min-height', ((sidebarH > sidebarAltH) ? sidebarH : sidebarAltH) - headerH + 'px');
            } else {
                pageContent.css('min-height', ((sidebarH > sidebarAltH) ? sidebarH : sidebarAltH) - (headerH + footerH) + 'px');
            }
        }
    };
    var interactiveBlocks = function() {
        $('[data-toggle="block-toggle-content"]').on('click', function() {
            var blockContent = $(this).closest('.block').find('.block-content');
            if ($(this).hasClass('active')) {
                blockContent.slideDown();
            } else {
                blockContent.slideUp();
            }
            $(this).toggleClass('active');
        });
        $('[data-toggle="block-toggle-fullscreen"]').on('click', function() {
            var block = $(this).closest('.block');
            if ($(this).hasClass('active')) {
                block.removeClass('block-fullscreen');
            } else {
                block.addClass('block-fullscreen');
            }
            $(this).toggleClass('active');
        });
        $('[data-toggle="block-hide"]').on('click', function() {
            $(this).closest('.block').fadeOut();
        });
    };
    var scrollToTop = function() {
        var link = $('#to-top');
        $(window).scroll(function() {
            if (($(this).scrollTop() > 150) && (getWindowWidth() > 991)) {
                link.fadeIn(100);
            } else {
                link.fadeOut(100);
            }
        });
        link.click(function() {
            $('html, body').animate({
                scrollTop: 0
            }, 400);
            return false;
        });
    };
    var chatUi = function() {
        var chatUsers = $('.chat-users');
        var chatTalk = $('.chat-talk');
        var chatMessages = $('.chat-talk-messages');
        var chatInput = $('#sidebar-chat-message');
        var chatMsg = '';
        chatMessages.slimScroll({
            height: 210,
            color: '#fff',
            size: '3px',
            position: 'left',
            touchScrollStep: 100
        });
        $('a', chatUsers).click(function() {
            chatUsers.slideUp();
            chatTalk.slideDown();
            chatInput.focus();
            return false;
        });
        $('#chat-talk-close-btn').click(function() {
            chatTalk.slideUp();
            chatUsers.slideDown();
            return false;
        });
        $('#sidebar-chat-form').submit(function(e) {
            chatMsg = chatInput.val();
            if (chatMsg) {
                chatMessages.append('<li class="chat-talk-msg chat-talk-msg-highlight themed-border animation-slideLeft">' + $('<div />').text(chatMsg).html() + '</li>');
                chatMessages.slimScroll({
                    scrollTo: chatMessages[0].scrollHeight + 'px'
                });
                chatInput.val('');
            }
            e.preventDefault();
        });
    };
    var templateOptions = function() {
        var colorList = $('.sidebar-themes');
        var themeLink = $('#theme-link');
        var themeColor = themeLink.length ? themeLink.attr('href') : 'default';
        var cookies = page.hasClass('enable-cookies') ? true : false;
        var themeColorCke;
        if (cookies) {
            themeColorCke = Cookies.get('optionThemeColor') ? Cookies.get('optionThemeColor') : false;
            if (themeColorCke) {
                if (themeColorCke === 'default') {
                    if (themeLink.length) {
                        themeLink.remove();
                        themeLink = $('#theme-link');
                    }
                } else {
                    if (themeLink.length) {
                        themeLink.attr('href', themeColorCke);
                    } else {
                        $('link[href*="css/themes.css"]').before('<link id="theme-link" rel="stylesheet" href="' + themeColorCke + '">');
                        themeLink = $('#theme-link');
                    }
                }
            }
            themeColor = themeColorCke ? themeColorCke : themeColor;
        }
        $('a[data-theme="' + themeColor + '"]', colorList).parent('li').addClass('active');
        $('a', colorList).click(function(e) {
            themeColor = $(this).data('theme');
            var idTheme = themeColor;
            if (idTheme != 'default') {
                var theme_ = /themes\/(.+?)\.css/.exec(idTheme);
                idTheme = theme_[1];
            }
            $('li', colorList).removeClass('active');
            $(this).parent('li').addClass('active');
            if (themeColor === 'default') {
                if (themeLink.length) {
                    themeLink.remove();
                    themeLink = $('#theme-link');
                }
            } else {
                if (themeLink.length) {
                    themeLink.attr('href', themeColor);
                } else {
                    $('link[href*="css/themes.css"]').before('<link id="theme-link" rel="stylesheet" href="' + themeColor + '">');
                    themeLink = $('#theme-link');
                }
            }
            $.ajax({
                url: base_url + '/api/select-theme',
                type: 'POST',
                dataType: 'json',
                data: 'theme=' + idTheme,
                success: function(data) {}
            });
        });
        $('.dropdown-options a').click(function(e) {
            e.stopPropagation();
        });
        var optMainStyle = $('#options-main-style');
        var optMainStyleAlt = $('#options-main-style-alt');
        if (page.hasClass('style-alt')) {
            optMainStyleAlt.addClass('active');
        } else {
            optMainStyle.addClass('active');
        }
        optMainStyle.click(function() {
            page.removeClass('style-alt');
            $(this).addClass('active');
            optMainStyleAlt.removeClass('active');
        });
        optMainStyleAlt.click(function() {
            page.addClass('style-alt');
            $(this).addClass('active');
            optMainStyle.removeClass('active');
        });
        var optHeaderDefault = $('#options-header-default');
        var optHeaderInverse = $('#options-header-inverse');
        if (header.hasClass('navbar-default')) {
            optHeaderDefault.addClass('active');
        } else {
            optHeaderInverse.addClass('active');
        }
        optHeaderDefault.click(function() {
            header.removeClass('navbar-inverse').addClass('navbar-default');
            $(this).addClass('active');
            optHeaderInverse.removeClass('active');
        });
        optHeaderInverse.click(function() {
            header.removeClass('navbar-default').addClass('navbar-inverse');
            $(this).addClass('active');
            optHeaderDefault.removeClass('active');
        });
    };
    var definicoes = function() {
        $('#avatarDefinicoes').change(function(e) {
            var imagem = $(this).find(':selected').data('imagem');
            $('#avatar-definicoes-imagem').html('<img src="' + imagem + '" class="img-circle" style="max-height: 50px" alt="avatar">');
        }).change();
        $('#capaDefinicoes').change(function(e) {
            var imagem = $(this).find(':selected').data('imagem');
            $('#capa-definicoes-imagem').html('<img src="' + imagem + '" style="max-height: 50px" alt="capa">');
        }).change();
        $('#formDefinicoes').submit(function() {
            $.ajax({
                url: base_url + '/api/update-profile',
                type: 'POST',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data) {
                    $('#retornoDefinicoes').html('');
                    if (data.err_code == '0') {
                        $('#modal-user-settings').modal('hide');
                        location.reload();
                    } else {
                        $('#retornoDefinicoes').html('<p class="text-danger">' + data.err_msg + '</p>');
                    }
                }
            });
            return false;
        });
    };
    var discord = function() {
        $('#cargo-booster-discord').click(function() {
            vex.dialog.confirm({
                message: 'Tem certeza que deseja atribuir o cargo de Booster ao seu Discord?',
                callback: function(value) {
                    if (value) {
                        $.ajax({
                            url: base_url + '/booster/cargo_discord.json',
                            type: 'POST',
                            dataType: 'json',
                            data: $(this).serialize(),
                            success: function(data) {
                                $('#retornoDiscord').html('');
                                if (data.status == '1') {
                                    $('#retornoDiscord').html('<p class="text-success">' + data.mensagem + '</p>');
                                    setTimeout(function() {
                                        $('#modal-user-settings').modal('hide');
                                        location.reload();
                                    }, 5000);
                                } else {
                                    $('#retornoDiscord').html('<p class="text-danger">' + data.mensagem + '</p>');
                                }
                            }
                        });
                    }
                }
            });
        });
        $('#sair-booster-discord').click(function() {
            vex.dialog.confirm({
                message: 'Tem certeza que deseja desconectar o seu Discord do site?',
                callback: function(value) {
                    if (value) {
                        $.ajax({
                            url: base_url + '/booster/sair_discord.json',
                            type: 'POST',
                            dataType: 'json',
                            data: $(this).serialize(),
                            success: function(data) {
                                $('#retornoDiscord').html('');
                                if (data.status == '1') {
                                    $('#retornoDiscord').html('<p class="text-success">' + data.mensagem + '</p>');
                                    setTimeout(function() {
                                        $('#modal-user-settings').modal('hide');
                                        location.reload();
                                    }, 5000);
                                } else {
                                    $('#retornoDiscord').html('<p class="text-danger">' + data.mensagem + '</p>');
                                }
                            }
                        });
                    }
                }
            });
        });
    };
    var dtIntegration = function() {
        $.extend(true, $.fn.dataTable.defaults, {
            "sDom": "<'row'<'col-sm-6 col-xs-5'l><'col-sm-6 col-xs-7'f>r>t<'row'<'col-sm-5 hidden-xs'i><'col-sm-7 col-xs-12 clearfix'p>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
                "sSearch": "<div class=\"input-group\">_INPUT_<span class=\"input-group-addon\"><i class=\"fa fa-search\"></i></span></div>",
                "sInfo": "<strong>_START_</strong>-<strong>_END_</strong> of <strong>_TOTAL_</strong>",
                "oPaginate": {
                    "sPrevious": "",
                    "sNext": ""
                }
            }
        });
        $.extend($.fn.dataTableExt.oStdClasses, {
            "sWrapper": "dataTables_wrapper form-inline",
            "sFilterInput": "form-control",
            "sLengthSelect": "form-control"
        });
    };
    var handlePrint = function() {
        var pageCls = page.prop('class');
        page.prop('class', '');
        window.print();
        page.prop('class', pageCls);
    };
    return {
        init: function() {
            uiInit();
            pageLoading();
        },
        sidebar: function(mode, extra) {
            handleSidebar(mode, extra);
        },
        datatables: function() {
            dtIntegration();
        },
        pagePrint: function() {
            handlePrint();
        }
    };
}();
$(function() {
    App.init();
    if(getPath()[2] == 'atualizacao'){
        $(`[data-active=atualizacoes]`).addClass("active")
    }
    if(getPath()[2] == 'gerenciar-lol'){
        $(`[data-active=cadastrar-lol]`).addClass("active")
    }
    $(`[data-active=${getPath()[2]}]`).addClass("active")
   
});

