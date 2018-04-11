<?php abspath_check("ABSPATH"); //require_once vc_path_dir( "SHORTCODES_DIR", "vc-single-image.php" );

class WPBakeryShortCode_VC_meething_place extends WPBakeryShortCode {}

	function vc_meething_place_output($atts, $content=null){
		 extract(
		 	shortcode_atts(
        		array(
        		  "el_class" => "",
        		  "field_content" => "",
        		  "numbers" => "1,2,3,4,5,6",
        		  "grid_type" => "2x2",
        		), $atts
     	 	)
    	 );

       $output  = do_shortcode($content);
       $fields  = $field_content !== "" ? explode(",",trim($field_content)) : null;
       // $nums    = explode(",",trim($numbers));
       $output .= "<ul class='oo_meeting_loc'>"; //Hasmik changed class
       $alphabet = range("A","Z"); $i = 0;

       foreach($fields as $field):
           $output .= "<li class='oo_field_itm'><label><span class='oo_alphabet'>". $alphabet[$i] ."</span> <span class='oo_desc'>". $field ."</span> <input type='radio' name='input'><span class='custom_checkbox'></span><span class='label-wrapper'></span></label></li>"; $i++;
       endforeach;
       $output .= "</ul>";
   		 return $output;
	}
	add_shortcode( "vc_meething_place", "vc_meething_place_output");

	function vc_meething_place_mapping() {
		    if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('VC Meething Place', 'bridge-child'),
            'base' => 'vc_meething_place',
            'description' => __('Description', 'bridge-child'),
            'content_element' => true,
            'show_settings_on_create' => true,
            'category' => __('Custom VC Elements', 'bridge-child'),
            'params' => array(/*

              */array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Please input numbers, separated by comma", "bridge-child" ),
                "param_name" => "numbers",
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
                "heading" => "Please input info, separated by comma",
                "param_name" => "field_content",
                "description" => "Set field contents",
                ),
              )
            )
          );
	}
	add_action("init","vc_meething_place_mapping");

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
