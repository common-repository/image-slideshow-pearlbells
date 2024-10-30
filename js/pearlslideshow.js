var $jqueryPhotoSlideshow = jQuery.noConflict();
$jqueryPhotoSlideshow(document).ready(function(){
    $jqueryPhotoSlideshow('.slider1').each(function(i){
     $jqueryPhotoSlideshow(this).responsiveSlides({ 
        maxwidth: 800,
        auto: $jqueryPhotoSlideshow(this).data('auto'),
        pager: $jqueryPhotoSlideshow(this).data('pagination'),
        nav: $jqueryPhotoSlideshow(this).data('nav'),
        speed: pearlSlidepluginOptions.pearl_slideshow_speed,
        namespace: "callbacks"  
      });
    });

});


