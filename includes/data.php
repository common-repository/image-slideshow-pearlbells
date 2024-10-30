<?php
namespace photoslideshowpearlbells;
class pearlImageSliderData {
    
    public function __construct() {

        add_shortcode('pearl_slideshow_display', array($this,'pearl_Image_Slider_getImage'));
    }

    function pearl_Image_Slider_getImage($atts, $content = null)
    {
        if(is_array($atts))
            $imageIds = explode(',',$atts['ids'] );
        else
            $imageIds =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() );
        $character_length = get_option('pearl_slideshow_character_count');
        $page_pagination = (isset($atts['pagination']) && $atts['pagination'] == 'yes') ? 1 : 0;
        $is_caption = (isset($atts['caption']) && $atts['caption'] == 'yes') ? 1 : 0;
        $nav = (isset($atts['nav']) && $atts['nav'] == 'yes') ? 1 : 0;
        $auto = (isset($atts['auto']) && $atts['auto'] == 'yes') ? 1 : 0;
        $display_image = '<div class="callbacks_container">
                          <ul class="rslides slider1" data-pagination='.$page_pagination.' data-caption='.$is_caption.' data-nav='.$nav.' data-auto='.$auto.'>';
       
        foreach( $imageIds as $imageID  )
        {  
            if(is_object($imageID))
                $imageID = $imageID->ID;
            $display_image .= '<li>';
       
            if( $page_pagination )
                $display_image .= '<a href="#" >';
            $display_image .= wp_get_attachment_image($imageID, $size, false);
            if( $page_pagination )
                $display_image .= '</a>';
            $title = get_the_title($imageID);
            $title_length = strlen(get_the_title($imageID));
           
            if( $is_caption )
            {
                $display_image .= '<p class="caption">'.substr($title,0,$character_length);
                if( $title_length > $character_length ) $display_image .= '. . .';
                $display_image .= '</p>';
            }
            $display_image .= '</li>';

          }
          $display_image .= '</ul></div>';

        return $display_image;		
    }
}
?>
