jQuery(function($) {

    // Request tour dates from Band in Town API
    var tourDatesFeed = function(callback, currentBand) {
        
        var band = currentBand;
        var appID = 'RazorandTiePublicity';
        var tourDatesRequestURL = 'http://api.bandsintown.com/artists/' + band + '/events.json?api_version=2.0&app_id=' + appID + '&callback=?';
        
        $.getJSON(tourDatesRequestURL, function(feeds) {
            
            callback(feeds, currentBand);
            
        }).error(function(jqXHR, textStatus, errorThrown) {
            // alert(textStatus + " - " + errorThrown);
        });
        
    };
    
    $(document).ready(function() {
        
        // Create month names array
        var m_names = new Array("January", "February", "March", 
            "April", "May", "June", "July", "August", "September", 
            "October", "November", "December");
            
        // Format dates from json data
        var formatDate = function(date) {
        
          var d = new Date(date);
          var day = d.getDate();
          var month = d.getMonth();
          var year = d.getFullYear();
          var dateFormatted = m_names[month] + ' ' + day + ', ' + year;
          
          return dateFormatted;
          
        };
        
        
        var showTourDatesFeed = function(feeds, currentBand) {
            
            // Only show Tour Column if "On Tour"
            // Check manually if error or no results
            if( feeds.errors ){
                // do nothing
                
            } else if( feeds.length > 1 ){
                
                // Un-hide tour column
                $('body.single-artist .tour').show();
                
                var data = '<ul>';
                
                for (var i=0; i<feeds.length; i++) {
                    
                    var date = feeds[i].datetime;
                    var dateFormatted = formatDate(date);
                    var location = feeds[i].formatted_location;
                    var venue = feeds[i].venue.name;
                    console.log(feeds[i].venue.name);
                    
                    data += '<li>';
                    data += '<span class="date">' +  dateFormatted + '</span>';
                    data += '<span class="venue">' + venue + '</span>';
                    data += '<span class="location">' + location + '</span>';
                    data += '</li>';
                }
                
                data += '</ul>';
                
                // Append tour dates list to Tour Column
                $('body.single-artist #tour-dates').html(data);
                
            } else {
                // do nothing
            }
            
        };
        
        // Call tour dates functions
        tourDatesFeed(showTourDatesFeed, currentBand);
        
    });
});