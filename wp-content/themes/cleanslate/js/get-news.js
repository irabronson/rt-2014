jQuery(function($) {
    
    $(document).ready(function () {
        
        
        var getPage = function(e) {
            
            e.preventDefault();
            
            $(this).unbind('click', getPage);
            
            var link = $(this).attr('href');
            $('.secondary').html('Loading...');
            
            $('.secondary').load(link + ' .news', function( response, status, xhr ) {
                bindPagination();
            });
            
        };
        
        var bindPagination = function () {
            $('#pagination a').bind('click', getPage);
        };
        
        bindPagination();
        
    }); // End doc.ready
}); // End jQuery