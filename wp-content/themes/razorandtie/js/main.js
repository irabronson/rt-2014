jQuery(function($) {
    
    $(document).ready(function () {
        
        // BROWSER QUERY
        // Add class to <html> based on browser
        if (navigator.userAgent.indexOf('Mac OS X') != -1) {
            // Mac
            if ($.browser.opera) { $('html').addClass('opera-Mac'); }
            if ($.browser.webkit) { $('html').addClass('webkit-Mac'); }
            if ($.browser.mozilla) { $('html').addClass('mozilla-Mac'); }
            if (/camino/.test(navigator.userAgent.toLowerCase())){ $('html').addClass('camino-Mac'); }
            if (/chrome/.test(navigator.userAgent.toLowerCase())) { $('html').addClass('chrome-Mac'); }
            if (navigator && navigator.platform && navigator.platform.match(/^(iPad|iPod|iPhone)$/)) { $('html').addClass('iOS'); }
            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) { $('html').addClass('safari-Mac'); }
        } else {
            // Not Mac
            if ($.browser.opera) { $('html').addClass('opera-Win'); }
            if ($.browser.webkit) { $('html').addClass('webkit-Win'); }
            if ($.browser.mozilla) { $('html').addClass('mozilla-Win'); }
            if (document.all && document.addEventListener) { $('html').addClass('ie9-Win'); }
            if (/chrome/.test(navigator.userAgent.toLowerCase())) { $('html').addClass('chrome-Win'); }
            if (navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1) { $('html').addClass('safari-Win'); }
        }
        
        // Bind Artist Detail Select to Navigation
        $('#artist-detail-nav').on('change', function () {
            if ($(this).val()!='') {
              window.location.href=$(this).val();
            }
        });
        
    }); // End doc.ready
}); // End jQuery