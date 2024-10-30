<?php
namespace photoslideshowpearlbells;
class pearlImageStyleData {
    
    public function __construct() {         
        add_action( 'wp_enqueue_scripts', array($this,'safely_add_stylesheet') );
        add_action('wp_head', array($this,'pearl_script'));
    }
    
    public function safely_add_stylesheet() {
         wp_enqueue_style( 'pearl_photo_slideshow', plugins_url('../css/pearl_slideshow_css.css', __FILE__) );
    }
         
    public function pearl_script()
    {            
         // create array of all scripts
        $scripts = array( 'jquery' => 'js/jquery.js',
                          'mainslides' => 'js/responsiveslides.js',
                          'pearlslideshow' => 'js/pearlslideshow.js');
       
       $pluginOptions = array(
            'pearl_slideshow_speed' => get_option( 'pearl_slideshow_speed' )
       );

        foreach( $scripts as $key => $sc )
        {
           wp_deregister_script( $key );
           wp_register_script( $key, plugin_dir_url(dirname(__FILE__)).$sc , array('jquery') );
           wp_enqueue_script( $key );  
        }
        wp_localize_script( 'pearlslideshow', 'pearlSlidepluginOptions', $pluginOptions ); 
    }

    
}
?>
