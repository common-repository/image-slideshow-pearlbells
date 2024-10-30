<?php
namespace photoslideshowpearlbells;
class pearlDisplayForm {
    
    public function optionsForm() {
        
        $displayOptionsForm = '

         <form method="post" action="'.$PHP_SELF.'">
         <h1>Settings</h1>
         <label for="pearl_slideshow_character_count">No of Character (Title) :</label>
         <input type="text" name="pearl_slideshow_character_count" value="'.get_option('pearl_slideshow_character_count').'"/><br/>
         <label for="pearl_slideshow_speed">Speed :</label>
         <input type="text" name="pearl_slideshow_speed" value="'.get_option('pearl_slideshow_speed').'"/><br/>
         <input type="submit" name="submit" value="Submit"/>
         </form> ';

        echo $displayOptionsForm;
        $this->authorDetails();
    }
    
  
    public function authorDetails() {
        
        $details = ' <p>Created by <a href="http://pearlbells.co.uk/" target="_blank">Pearlbells</a><br/> Follow me : <a href="http://twitter.com/#!/pearlbells" target="_blank">Twitter</a><br/>Please Donate : <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=W884YAWEDPA9U" target="_blank">Click Here</a></p>
         <p>Feel free to email me lizeipe@gmail.com for any advice or suggestion.</p>';
        echo $details;
        
    }
    
}
?>
