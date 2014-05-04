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
            
        } else if( feeds.length > 0 ){
            
            // Un-hide tour column
            $('body.single-artist .tour').show();
            
            var data = '<ul>';
            
            for (var i=0; i<feeds.length; i++) {
                
                var date = feeds[i].datetime;
                var dateFormatted = formatDate(date);
                var location = feeds[i].formatted_location;
                var venue = feeds[i].venue.name;
                
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
    
    $(document).ready(function() {
        
        // Call tour dates functions
        if( $('#tour-dates').length > 0 ) {
            tourDatesFeed(showTourDatesFeed, currentBand);
        }
        
    });
});


/* FitVids
------------------------------------------------------------------------------------------ */
/* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/

(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement('div');
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch

      $allVideos.each(function(){
        var $this = $(this);
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );
