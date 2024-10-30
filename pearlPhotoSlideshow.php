<?php
/*
Plugin Name: Photo Slideshow (Responsive)
Plugin URI: http://pearlbells.co.uk/
Description: Image Slideshow Pearlbells
Version:  4.0
Author:Pearlbells
Author URI: http://pearlbells.co.uk/contact-page
License: GPL2
*/
/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version. 

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.

*/
namespace photoslideshowpearlbells;
include_once 'includes/form.php';
include_once 'includes/data.php';
include_once 'includes/optionsValues.php';
include_once 'includes/style.php';

class pearlPhotoSlideshow extends \WP_Widget {
    
     private $objOptions;
     private $objData;
     private $objForm;
     
     public function __construct() {
         add_action( 'admin_menu', array( $this, 'menu' ) );
         $this->objOptions = new pearlImageOptionsValues;
         $this->objOptions->add_options();
         $this->objData = new pearlImageSliderData;
         $this->objForm = new pearlDisplayForm;
         new pearlImageStyleData;
         register_deactivation_hook(__FILE__, array( $this, 'pearl_uninstall' ));
         $params = array( 
                    'description' => 'Display Photo Gallery',
                    'name' => 'Photo Slideshow');
         parent::__construct('pearlPhotoSlideshow','',$params);
         
     }
     
     public function pearl_uninstall() {
        $this->objOptions->delete_options();
     }
     
     public function menu() {
        add_options_page('Photo Slideshow','Photo Slideshow','manage_options',__FILE__,array($this,'opt_page')); 
         
     }
  
     public function opt_page() {
         
         $this->postData();
     }
     
     public function postData() {
         
        if($_REQUEST['submit']) 
            $this->objOptions->update_options();
            
        $this->objForm->optionsForm();
    }
    
    public function form($instance)
    {
        extract($instance);
       
        ?>
         <p>
            <label for="<?php echo $this->get_field_id('title')?>"> Title : </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title');?>"
                   name="<?php echo $this->get_field_name('title');?>"
                   value="<?php if(isset($title)) echo esc_attr($title);?>"/>
        </p>
         <p>
            <label for="<?php echo $this->get_field_id('ids')?>"> Image Ids : </label>
            <input class="widefat" type="text" id="<?php echo $this->get_field_id('ids');?>"
                   name="<?php echo $this->get_field_name('ids');?>"
                   value="<?php if(isset($ids)) echo esc_attr($ids);?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('caption')?>"> Show / Hide Caption : </label>
            <select id="<?php echo $this->get_field_id('caption'); ?>" name="<?php echo $this->get_field_name('caption'); ?>" class="widefat" style="width:100%;">
                <option <?php selected( $instance['caption'], 'yes' ); ?> value="yes">Yes</option>
                <option <?php selected( $instance['caption'], 'no' ); ?> value="no">No</option>    
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('pagination')?>"> Show / Hide Pagination : </label>
            <select id="<?php echo $this->get_field_id('pagination'); ?>" name="<?php echo $this->get_field_name('pagination'); ?>" class="widefat" style="width:100%;">
                <option <?php selected( $instance['pagination'], 'yes' ); ?> value="yes">Yes</option>
                <option <?php selected( $instance['pagination'], 'no' ); ?> value="no">No</option>    
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('nav')?>"> Show / Hide Navigation : </label>
            <select id="<?php echo $this->get_field_id('nav'); ?>" name="<?php echo $this->get_field_name('nav'); ?>" class="widefat" style="width:100%;">
                <option <?php selected( $instance['nav'], 'yes' ); ?> value="yes">Yes</option>
                <option <?php selected( $instance['nav'], 'no' ); ?> value="no">No</option>    
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('auto')?>"> Auto Start : </label>
            <select id="<?php echo $this->get_field_id('auto'); ?>" name="<?php echo $this->get_field_name('auto'); ?>" class="widefat" style="width:100%;">
                <option <?php selected( $instance['auto'], 'yes' ); ?> value="yes">Yes</option>
                <option <?php selected( $instance['auto'], 'no' ); ?> value="no">No</option>    
            </select>
        </p>
        <?php 
    }
    
    public function widget($args , $instance)
    {
        extract($args);
        extract($instance);
        echo $before_title . $title . $after_title;  
       
        $display_image = $this->objData->pearl_Image_Slider_getImage($instance);
        echo $display_image;
    }  
}
add_action('widgets_init',function ()
{
    register_widget('photoslideshowpearlbells\pearlPhotoSlideshow');
});
?>