jQuery(function($) {
    
    $(document).ready(function () {
        
        // The filtering functionality
        $('ul#filters a').click(function(e) {
            
            e.preventDefault();
            
            var filterVal = $(this).attr('data-filter');
            var itemsLength = $('.artists .artist:visible').length;
            
            $('.artists .artist:visible').each(function(i) {
                $(this).fadeOut(30, function(){
                    if(itemsLength == ++i) {
                        show(filterVal);
                    }
                });
            });
        });
        
        var show = function(filterVal) {
            if(filterVal == 'all') {
                $('.artists .artist').fadeIn(200);
            } else {
                $('.artists .artist').each(function() {
                    if($(this).attr('data-filter') === filterVal ) {
                        $(this).fadeIn(200);
                    }
                });
            }
        };
        
        // Adds/removes 'active' class to selected item
        // Adds the 'active' class to the first anchor $('ul#filters a').first().addClass("active");
        $('ul#filters a').click(function(){
            $('ul#filters .active').removeClass('active');
            $(this).addClass('active');
        });
        
        // Preselecting a filter option
        $('#filters a[data-filter="razor-tie"]').trigger('click');
        
        // Sets timeout and fades in content
        // Best for 'FlashOfUnfilteredContent'
        setTimeout(function (){
            $('.primary').fadeTo( 150 , 1 );
        }, 150);
        
    }); // End doc.ready
}); // End jQuery