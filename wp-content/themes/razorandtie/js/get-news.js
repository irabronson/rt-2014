jQuery(function($) {
    
    $(document).ready(function () {
        
        
        var getPage = function(e) {
            
            e.preventDefault();
            
            $(this).unbind('click', getPage);
            
            var link = $(this).attr('href');
            $('#news').html('Loading...');
            
            $('#news').load(link + ' .news-wrapper', function( response, status, xhr ) {
                bindPagination();
            });
            
        };
        
        var bindPagination = function () {
            $('#pagination a').bind('click', getPage);
        };
        
        bindPagination();
        
    }); // End doc.ready
}); // End jQuery