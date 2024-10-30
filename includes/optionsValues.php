<?php
namespace photoslideshowpearlbells;
class pearlImageOptionsValues {

    public function add_options()
    {
        add_option('pearl_slideshow_character_count','15','','yes');
        add_option('pearl_slideshow_speed','2000','','yes');
    }
    
    public function update_options() {
        
        $ok = false;
        $message = '';
        $optionValues = $_POST;
   
        foreach($optionValues as $key => $value){
            
          if ( get_option( $key ) !== false ) {
            update_option($key,$value);
			$ok = true;
          }
            
        }
        
        if($ok)
            $message = '<div id="message" class="updated fade"><p>Options Saved</p></div>';
        else
            $message = '<div id="message" class="error fade"><p>Failed to save options</p></div> ';
        echo $message;
          
    }
    
    public function delete_options()
    {
        delete_option('pearl_slideshow_character_count');
        delete_option('pearl_slideshow_speed');
    }  
}
?>
