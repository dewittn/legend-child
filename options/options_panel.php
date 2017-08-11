<?php
// Nelson's Patched version



/*-----------------------------------------------------------------------------------*/
/* Admin Interface
/*-----------------------------------------------------------------------------------*/
$functions_path = get_bloginfo('template_directory') . '/';
$themename = "Legend";
function patched_misfit_add_admin() {

    global $themename, $shortname, $query_string;

    if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'misfit' ) {
		if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
			$options =  get_option('of_template');
			of_reset_options($options,'misfit');
			header("Location: options_panel.php?page=misfit&reset=true");
			die;
		}
    }

    $tt_page = add_object_page($themename, $themename, 'administrator', 'misfit','patched_misfit_options_page', get_template_directory_uri().'/options/images/littlehenry-icon.png');

	add_action("admin_print_scripts-$tt_page", 'of_load_only');
	add_action("admin_print_styles-$tt_page",'of_style_only');
}


/*-----------------------------------------------------------------------------------*/
/* Build the Options Page
/*-----------------------------------------------------------------------------------*/

function patched_misfit_options_page(){
    $options =  get_option('of_template');
    $themename =  get_option('of_themename');
?>

<div class="wrap" id="msn_container">
  <div id="of-popup-save" class="of-save-popup">
    <div class="of-save-save">Options Updated</div>
  </div>
  <div id="of-popup-reset" class="of-save-popup">
    <div class="of-save-reset">Options Reset</div>
  </div>
  <form action="" enctype="multipart/form-data" id="ofform">
    <div id="header">


        <div class="options_header">

	    	<center><img src="<?php echo get_template_directory_uri() ?>/options/images/littlehenry.png" style="width: 137px; margin-left: 0px; margin-top: -19px;" /></center>
	   	 	<div class="theme_name">
	   	 		<span style="margin-top: 5px; margin-right: 00px;">LEGEND<small> 1.3</span><strong style="margin: 10px 0;">Misfit Themes Framework 1.03</strong></small>
	   	 		<input type="submit" value="Save All Changes" class="button-primary" style="float: right;" />

	    	</div>
		</div>


      <div class="icon-option"> </div>
      <div class="clear"></div>
    </div>
    <?php
		// Rev up the Options Machine
        $return = patched_misfit_machine($options);
        ?>
    <div id="main">
      <div id="of-nav">
        <ul>
          <?php echo $return[1] ?>
        </ul>
      </div>
      <div id="content"> <?php echo $return[0]; /* Settings */ ?> </div>
      <div class="clear"></div>
    </div>
    <div class="save_bar_top">
    <img style="display:none;" src="<?php echo get_template_directory_uri() ?>/options/images/wpspin_light.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
    <input type="submit" value="Save All Changes" class="button-primary" />
  </form>
  <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="ofform-reset">
    <span class="submit-footer-reset">
    <input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('CAUTION: Any and all settings will be lost! Click OK to reset.');" />
    <input type="hidden" name="of_save" value="reset" />
    </span>
  </form>
</div>
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div>
<!--wrap-->
<?php
}




/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action
/*-----------------------------------------------------------------------------------*/

function patched_of_ajax_callback() {
	global $wpdb; // this is how you get access to the database


	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){

		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/\s+/', '', $filename['name']);

		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';
		$uploaded_file = wp_handle_upload($filename,$override);

				$upload_tracking[] = $clickedID;
				update_option( $clickedID , $uploaded_file['url'] );

		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){

			$id = $_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);

	}
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];

		parse_str($data,$output);
		//print_r($output);

		//Pull options
        	$options = get_option('of_template');

		foreach($options as $option_array){

			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';

			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}

			if(isset($option_array['id'])) { // Non - Headings...


					$type = $option_array['type'];

					if ( is_array($type)){
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];
								if($new_value == ''){ $new_value = $std; }
								update_option( $id, stripslashes($new_value));
							}
						}
					}
					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save

						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save

						update_option($id,'true');
					}
					elseif($type == 'multicheck'){ // Multi Check Save

						$option_options = $option_array['options'];

						foreach ($option_options as $options_id => $options_value){

							$multicheck_id = $id . "_" . $options_id;

							if(!isset($output[$multicheck_id])){
							  update_option($multicheck_id,'false');
							}
							else{
							   update_option($multicheck_id,'true');
							}
						}
					}

					elseif($type != 'upload_min'){

						update_option($id,stripslashes($new_value));
					}
				}
			}

	}

  die();

}



/*-----------------------------------------------------------------------------------*/
/* Cases fpr various option types
/*-----------------------------------------------------------------------------------*/

function patched_misfit_machine($options) {

    $counter = 0;
	$menu = '';
	$output = '';
	foreach ($options as $value) {

		$counter++;
		$val = '';
		//Start Heading

		 if ( $value['type'] != "heading" && $value['type'] != "openleft" && $value['type'] != "closeleft" && $value['type'] != "openright" && $value['type'] != "closeright" && $value['type'] != "opencontainer" && $value['type'] != "closecontainer")
		 {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
			$output .= '<div class="section section-'.$value['type'].' '. $class .'">'."\n";
			$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";

		 }

		 //End Heading
		$select_value = '';
		switch ( $value['type'] ) {

		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			// if ( $std != "") { $val = $std; }
			if( $std != $val ) { $values = stripslashes( $std ); } else { $values = stripslashes( $val ); }
			$output .= '<input class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $values .'" />';
		break;



		case 'openleft':

		/* Font Size */


			$output .= '<div class="left-floating">';


		break;


		case 'closeleft':

			$output .= '</div>';


		break;


		case 'openright':

		/* Font Size */

			$output .= '<div class="right-floating">';


		break;


		case 'closeright':

			$output .= '</div><div class="clear"></div>';


		break;


		case "opencontainer":

			$std =  $value['std'];
			$sitd =  $value['id'];
			$output .= '<div class="'.$std.' hpcontent" rel="'.$sitd.'">';


		break;

		case "closecontainer":

			$output .= '</div><div class="clear"></div>';


		break;



		case 'select':

			$output .= '<select class="of-input chosen-select" name="'. $value['id'] .'" id="'. $value['id'] .'">';

			$select_value = get_option($value['id']);

			foreach ($value['options'] as $option) {

				$selected = '';

				 if($select_value != '') {
					 if ( $select_value == $option) { $selected = ' selected="selected"';}
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
				 }

				 $output .= '<option'. $selected .'>';
				 $output .= $option;
				 $output .= '</option>';

			 }
			 $output .= '</select>';


		break;






		case 'fontsize':

		/* Font Size */
			$val = $default['size'];
			if ( $typography_stored['size'] != "") { $val = $typography_stored['size']; }
			$output .= '<select class="of-typography of-typography-size chosen-select" name="'. $value['id'].'_size" id="'. $value['id'].'_size">';
				for ($i = 9; $i < 71; $i++){
					if($val == $i){ $active = 'selected="selected"'; } else { $active = ''; }
					$output .= '<option value="'. $i .'" ' . $active . '>'. $i .'px</option>'; }
			$output .= '</select>';


		break;







		case "multicheck":

			$std =  $value['std'];

			foreach ($value['options'] as $key => $option) {

			$tt_key = $value['id'] . '_' . $key;
			$saved_std = get_option($tt_key);

			if(!empty($saved_std))
			{
				  if($saved_std == 'true'){
					 $checked = 'checked="checked"';
				  }
				  else{
					  $checked = '';
				  }
			}
			elseif( $std == $key) {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';                                                                                    }
			$output .= '<input type="checkbox" class="checkbox of-input" name="'. $tt_key .'" id="'. $tt_key .'" value="true" '. $checked .' /><label for="'. $tt_key .'">'. $option .'</label><br />';

			}
		break;








		case 'textarea':

			$cols = '8';
			$ta_value = '';

			if(isset($value['std'])) {

				$ta_value = $value['std'];

				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}

			}
				$std = get_option($value['id']);
				if( $std != $ta_value) { $ta_value = stripslashes( $std ); } else { $ta_value = stripslashes( $value['std'] ); }
				$output .= '<textarea class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';


		break;








		case "radio":

			 $select_value = get_option( $value['id']);


			 $output .= '<div class="sidestack">';
			 $url = get_bloginfo('template_url');
			 $isse = 0;
			 foreach ($value['options'] as $key => $option)
			 {
			$isse++;
				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; }
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .= '<label class="fb" for="fb1">';
				$output .= '<input class="trigger of-input of-radio hpradiocontent-'.$isse.'"  data-rel="hpcontent-'.$isse.'" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'';
				$output .= '<img src="'. $url . '/options/images/homevariations/' .$isse . '.png"><span class="radiarrow"></span></label>';

			}

			$output .= '</div>';

		break;



		case "radio2":
			$select_value = get_option( $value['id']);
			$output .= '<div class="font-choice">';
		 	$isse = 0;
			foreach ($value['options'] as $key => $option) {
				$isse++;
			 	$checked = '';
			 	if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; }
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .= '<div class="font-container"><input type="radio" class="radio " id="font_source_'.$key.'" name="'.$value['id'].'" value="'.$key.'" '.$checked.'/><span>'.$option.'</span></div>';
			}
			$output .= '</div>';

		break;
			


		case 'codeblock':



			$block_value = '';
			$template = get_template_directory_uri();


			if (plugin_basename($_GET['page']) == 'misfit') {


			$Facebook = get_page_with_template('page-Facebook');
			$Facebook_url = get_permalink($Facebook);
				if($Facebook) {
					$Facebook_code = file_get_contents($Facebook_url);
				} else {
					$Facebook_code = file_get_contents($template . "/options/nothinghere.htm");
				}


			}

			$code = htmlentities($Facebook_code);
			if(isset($value['std'])) {

				$block_value = $value['std'];

				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}

			}
				$std = get_option($value['std']);
				if( $std != "") { $block_value = stripslashes( $std ); }
				$output .= '<script type="text/javascript">
    function selectText() {
        if (document.selection) {
        var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById("blocker"));
        range.select();
        }
        else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById("blocker"));
        window.getSelection().addRange(range);
        }
    }
    </script>
<div id="blocker" onclick="selectText()">' . htmlentities($Facebook_code)  . '</div>


			     <div class="fielddescription"><p class="wpbutton"><a href="' . $Facebook_url . '" target="_blank">See Preview</a></p><p class="wpbutton"><a href="http://misfitthemes.com/facebook-landing-page-generator/" target="_blank">Learn More</a></p></div>';


			break;



			case 'codeblocktwo':



			$block_value = '';
			$template = get_template_directory_uri();


			if (plugin_basename($_GET['page']) == 'misfit') {


			$mailchimp = get_page_with_template('page_mailchimp');
			$mailchimp_url = get_permalink($mailchimp);
				if($mailchimp) {
					$mailchimp_code = file_get_contents($mailchimp_url);
				} else {
					$mailchimp_code = file_get_contents($template . "/options/nothinghere.htm");
				}



			}


			if(isset($value['std'])) {

				$block_value = $value['std'];

				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}

			}
				$std = get_option($value['std']);
				if( $std != "") { $block_value = stripslashes( $std ); }
				$output .= '<script type="text/javascript">
    function selectTexts() {
        if (document.selection) {
        var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById("blockers"));
        range.select();
        }
        else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById("blockers"));
        window.getSelection().addRange(range);
        }
    }
    </script>
<div id="blockers" onclick="selectTexts()">' . htmlentities($mailchimp_code)  . '</div>


			     <div class="fielddescription"><p class="wpbutton"><a href="' . $mailchimp_url . '" target="_blank">See Preview</a></p><p class="wpbutton"><a href="http://misfitthemes.com/facebook-landing-page-generator/" target="_blank">Learn More</a></p></div>';


			break;




	case 'codeblockthree':



			$block_value = '';
			$template = get_template_directory_uri();


			if (plugin_basename($_GET['page']) == 'misfit') {


			$Facebook = get_page_with_template('page_newsletter');
			$Facebook_url = get_permalink($Facebook);
				if($Facebook) {
					$Facebook_code = file_get_contents($Facebook_url);
				} else {
					$Facebook_code = file_get_contents($template . "/options/nothinghere.htm");
				}


			}

			$code = htmlentities($Facebook_code);
			if(isset($value['std'])) {

				$block_value = $value['std'];

				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}

			}
				$std = get_option($value['std']);
				if( $std != "") { $block_value = stripslashes( $std ); }
				$output .= '<script type="text/javascript">
    function selectText() {
        if (document.selection) {
        var range = document.body.createTextRange();
            range.moveToElementText(document.getElementById("blocker"));
        range.select();
        }
        else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById("blocker"));
        window.getSelection().addRange(range);
        }
    }
    </script>
<div id="blocker" onclick="selectText()">' . htmlentities($Facebook_code)  . '</div>


			     <div class="fielddescription"><p class="wpbutton"><a href="' . $Facebook_url . '" target="_blank">See Preview</a></p><p class="wpbutton"><a href="http://misfitthemes.com/facebook-landing-page-generator/" target="_blank">Learn More</a></p></div>';


			break;




		case "checkbox":

		   $std = $value['std'];

		   $saved_std = get_option($value['id']);

		   $checked = '';

			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox of-input" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />';

		break;








		case "upload":

			$output .= misfit_uploader_function($value['id'],$value['std'],null);

		break;









		case "upload_video":

			$output .= misfit_uploader_function2($value['id'],$value['std'],null);

		break;









		case "upload_min":

			$output .= misfit_uploader_function($value['id'],$value['std'],'min');

		break;


		case "color":
			$val = $value['std'];
			$stored  = get_option( $value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div id="' . $value['id'] . '_picker" class="colorSelector"><div></div></div>';
			$output .= '<input class="of-color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
		break;









		case "images":
			$i = 0;
			$select_value = get_option( $value['id']);

			foreach ($value['options'] as $key => $option)
			 {
			 $i++;

				 $checked = '';
				 $selected = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
				    } else {
						if ($value['std'] == $key) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && !isset($select_value)) { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						elseif ($i == 1  && $value['std'] == '') { $checked = ' checked'; $selected = 'of-radio-img-selected'; }
						else { $checked = ''; }
					}

				$output .= '<span>';
				$output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="'.$key.'" name="'. $value['id'].'" '.$checked.' />';
				$output .= '<div class="of-radio-img-label">'. $key .'</div>';
				$output .= '<img src="'.$option.'" alt="" class="of-radio-img-img '. $selected .'" onClick="document.getElementById(\'of-radio-img-'. $value['id'] . $i.'\').checked = true;" />';
				$output .= '</span>';

			}

		break;








		case "info":
			$default = $value['std'];
			$output .= $default;
		break;










		case "heading":

			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$jquery_click_hook = preg_replace("/\s+/", "", strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;




		case "hidden-sections":

			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			if( $std != "") { $values = stripslashes( $std ); }

			$sections = array('Blog','Content','Portfolio');
			$saved_sections = array();
			

			if(!empty($std)) {

				// test out the value
				// print_r(get_option($value['id']));

				$saved_sections = explode(',', $std);
				$output .= '<ul id="sortable">';

				foreach ($saved_sections as $section) {
					$output .= '<li id="'.$section.'" class="ui-state-default">'.$section.'</li>';
				}
				
				$output .= '</ul>';

			} else {

				// test out the value
				// print_r(get_option($value['id']));

				$output .= '<ul id="sortable">';

				foreach ($sections as $section) {
					$output .= '<li id="'.$section.'" class="ui-state-default">'.$section.'</li>';
				}
				
				$output .= '</ul>';

			}

			$output .= '<input class="sortable of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="hidden" value="" />';

		break;

		}

		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){

					$id = $array['id'];
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){$std = $saved_std;}
					$meta = $array['meta'];

					if($array['type'] == 'text') { // Only text at this point

						 $output .= '<input class="input-text-small of-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != "heading" && $value['type'] != "openleft" && $value['type'] != "closeleft" && $value['type'] != "openright" && $value['type'] != "closeright" && $value['type'] != "opencontainer" && $value['type'] != "closecontainer") {
			if ( $value['type'] != "checkbox" )
				{
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; }
			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}

	}
    $output .= '</div>';
    return array($output,$menu);

}




?>