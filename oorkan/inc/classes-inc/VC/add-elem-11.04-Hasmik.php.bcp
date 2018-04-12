<?php abspath_check("ABSPATH"); require_once(vc_path_dir( "SHORTCODES_DIR", "vc-single-image.php" ));

class WPBakeryShortCode_VC_image_checklist extends WPBakeryShortCode_VC_Single_image {}

  function vc_image_checklist_output($atts, $content = null){
    extract(
      shortcode_atts(
        array(
          "el_class" => "",
          "images" => "",
          "image_size" => "full",
          "grid_type" => "2x2",
          "descript" => "",
        ), $atts
      )
    );

    if(strpos($image_size, "x") > 0):
      $image_size = explode("x", $image_size);
      array_walk($image_size, function($item) {$item .= "px";});
    endif;

    $output = do_shortcode($content);
    $images_ids = $images !== "" ? explode(",",trim($images)) : null;

    if($images_ids):
      // Creating an alphabet array
      $alphabet = range("A","Z"); $j = 0; // iterator

      // Setting image attributes array
      $img_atts = [
        "class" => "attachment-thumbnail",
        "src"   => vc_asset_url( "vc/blank.gif" )
      ];
      if($grid_type === "4x4") {
        $k = 1;
        $output .= "<div class='oo-hz_slider'>";
        $output .= "<h4 style='text-transform:none;'>". $descript ."</h4>";
        $output .= "<ul>";
        foreach ( $images_ids as $image_id ):
          $img = wp_get_attachment_image($image_id, $image_size, $img_atts);
          $img_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

          $output .= "<li><label><input type='checkbox' class='img_check'><span class='custom--checkbox'></span><span class='custom--checkbox--letter'><i class='image_key'>" . $alphabet[$j] . "</i><i class='image_alt'>" . $img_alt . "</i></span><span class='label-wrapper'></span><span class='style_description'>". $img ."</label></li>"; $j++;
          if($k % 3 === 0) {
            $output .= "</ul><ul>";
          }
          $k++;
        endforeach;
        $output .= "</ul>";
        $output .= "<div class='hz-buttons'>";
        $output .= "<button class='hz-btn-prev'> <i class='fa fa-chevron-left' aria-hidden='true'></i> </button> <button class='hz-btn-next'><i class='fa fa-chevron-right' aria-hidden='true'></i> </button> </div>"; //hz btn
        $output .= "</div>";
      }
      else {

        $output .= "<ul class='". esc_attr($el_class) ." oo_grid-". esc_attr($grid_type) ."' data-name=''><h4 style='text-transform:none;'>". $descript ."</h4>";

        foreach ( $images_ids as $image_id ):
          $img = wp_get_attachment_image($image_id, $image_size, $img_atts);
          $img_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);

          $output .= "<li><label><input type='checkbox' class='img_check'><span class='custom--checkbox'></span><span class='custom--checkbox--letter'><i class='image_key'>" . $alphabet[$j] . "</i><i class='image_alt'>" . $img_alt . "</i></span><span class='label-wrapper'></span><span class='style_description'>". $img ."</label></li>"; $j++;
        endforeach;

        $output .= "</ul>";
      }

    endif;
    // var_dump($output);exit;
    return $output;
  }
  add_shortcode( "vc_image_checklist", "vc_image_checklist_output");



/**/




    function vc_image_checklist_mapping() {
    // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }


        // Map the block with vc_map()
        vc_map(
          array(
            'name' => __('VC Image Checklist', 'bridge-child'),
            'base' => 'vc_image_checklist',
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
                "type" => "attach_images",
                "class" => "",
                "heading" => __("(You can group the images together by using the same alternative text for each image) </br></br>", "bridge-child " ),
                "param_name" => "images",
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
                "heading" => "Image size",
                "param_name" => "image_size",
                "description" => "set image size",
                ),/*

              */array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __( "Grid Type", "bridge-child" ),
                "param_name" => "grid_type",
                "description" => __( "Select the grid type from available options above", "bridge-child" ),
                'value' => __( ['2x2', '3x3', '4x4', '5x5'], 'bridge-child'),
              ),
            )
          )
        );
     }
add_action( "init", "vc_image_checklist_mapping");
