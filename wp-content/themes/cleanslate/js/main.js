jQuery(function($) {
    
    $(document).ready(function () {
        // $('.news').on('click', '#pagination a', function(e){
        //     e.preventDefault();
        //     var link = $(this).attr('href');
        //     $('.news').fadeOut(500, function(){
        //         $(this).load(link + ' .news', function() {
        //             $(this).fadeIn(500);
        //         });
        //     });
        // });
        
        $('#pagination a').on('click', function(e){
            e.preventDefault();
            var link = $(this).attr('href');
            $('.news').fadeOut(500, function(){
                $(this).load(link + ' .news', function() {
                    $(this).html(data);
                    $(this).fadeIn(500);
                });
            });
        });
    });
});