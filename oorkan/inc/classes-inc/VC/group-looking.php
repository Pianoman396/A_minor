<?php abspath_check("ABSPATH"); //require_once vc_path_dir( "SHORTCODES_DIR", "vc-single-image.php" );

class WPBakeryShortCode_VC_group_looking extends WPBakeryShortCode {}

	function vc_group_looking_output($atts, $content=null){
		 extract(
		 	shortcode_atts(
        		array(
        		  "el_class" => "",
              "field_content" => "",
        		  "descript" => "",
        		), $atts
     	 	)
    	 );

       $output  = do_shortcode($content);
       $fields  = $field_content !== "" ? explode(",",trim($field_content)) : null;
       // $nums    = explode(",",trim($numbers));
       $alphabet= range("A","Z"); $i = 0;
       $output .= "<ul class='oo_purchase'><h4 style='text-transform:none;'>". $descript ."</h4>"; // Hasmik changed class
         foreach($fields as $fld):
          $output .= "<li class='oo_group_itm'><label><span class='oo_alphabet'>". $alphabet[$i] . "</span>"."<span class='oo_desc'>" . ($fld !== "" ? $fld : "no input data") . "</span>" ."<input type ='checkbox'><span class='custom_checkbox'></span><span class='label-wrapper'></span></label></li>"; $i++;
         endforeach;
       $output .= "</ul>";




    	 // $contents = $fild_content !== "" ? explode(",",trim($fild_content)) : null;

   		 // if($images_ids):
   		 //   // Creating an alphabet array
   		 //   $alphabet = range("A","Z"); $i = 0; // iterator

   		 //   // Setting image attributes array
   		 //   $img_atts = [
   		 //     "class" => "attachment-thumbnail",
   		 //     "src"   => vc_asset_url( "vc/blank.gif" )
   		 //   ];

   		 //   $output .= "<ul class='". esc_attr($el_class) ." oo_select--angel--". esc_attr($grid_type) ."' data-name=''>";

   		 //   foreach ( $images_ids as $image_id ):
   		 //     $img = wp_get_attachment_image($image_id, $image_size, $img_atts);

   		 //     $output .= "<li><input type='checkbox' class='img_check'><span class='custom--checkbox'></span><span 		class='custom--checkbox--letter'> " . $alphabet[$i] . " </span>". $img ."</li>"; $i++;
   		 //   endforeach;

   		 //   $output .= "</ul>";

   		 // endif;

   		 return $output;
	}
	add_shortcode( "vc_group_looking", "vc_group_looking_output");

	function vc_group_looking_mapping() {
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('VC Group Looking', 'bridge-child'),
            'base' => 'vc_group_looking',
            'description' => __('Description', 'bridge-child'),
            'content_element' => true,
            'show_settings_on_create' => true,
            'category' => __('Custom VC Elements', 'bridge-child'),
            'params' => array(/*

              */array(
                "type" => "textfield",
                "class" => "",
                "heading" => __( "Content Description", "bridge-child" ),
                "param_name" => "descript",
                "description" => __( "Please add description to the checklist", "bridge-child" ),
              ),/*

              */array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Please input info, separated by comma", "bridge-child" ),
                "param_name" => "field_content",
                "description" => __( "Selecting images for output", "bridge-child" ),
                'value' => __( "", 'bridge-child' ),
              ),/*

              */array(
                  'type' => 'textfield',
                  'heading' => __('Extra class name', 'bridge-child'),
                  'param_name' => 'el_class',
                  'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'bridge-child')
              ),/*

              */array(
                "type" => "textfield",
                "heading" => "Please input numbers, separated by comma",
                "param_name" => "numbers",
                "description" => "Set field contents",
                ),
              )
            )
          );
	}
	add_action("init","vc_group_looking_mapping");

  /*

  $vc_params_list = array(
  // Default
  'textfield',
  'dropdown',
  'textarea_html',
  'checkbox',
  'posttypes',
  'taxonomies',
  'taxomonies',
  'exploded_textarea',
  'exploded_textarea_safe',
  'textarea_raw_html',
  'textarea_safe',
  'textarea',
  'attach_images',
  'attach_image',
  'widgetised_sidebars',
  // Advanced
  'colorpicker',
  'loop',
  'vc_link',
  'options',
  'sorted_list',
  'css_editor',
  'font_container',
  'google_fonts',
  'autocomplete',
  'tab_id',
  'href',
  'params_preset',
  'param_group',
  'custom_markup',
  'animation_style',
  'iconpicker',
  'el_id',

  */
