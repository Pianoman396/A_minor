<?php abspath_check("ABSPATH");

class Quiz{
	public function __construct(){

	}
	// CRUD
	public static function create(){
		// TMP
	}

	public static function read($args = null){

		$args = $args ? $args : array(
		'post_type'   => 'quiz',
		'posts_per_page' => -1,
		//'category'    => 0,
		'orderby'     => 'date',
		'order'       => 'DESC',
		//'include'     => array(),
		//'exclude'     => array(),
		//'meta_key'    => 'step',
		//'meta_value'  =>'',
		'suppress_filters' => true
		) ;


		// just some time
		if(is_integer($args)){
			$post = get_post($args);
			$result = $post;
		}
		if(is_array($args) || $args === null){
			$posts = get_posts($args);
			$result = $posts;
		}

/*
		register_meta( "post", "step", $args);
						//meta-key, meta-value
		add_post_meta($post->ID, "step", "1", true);*/

		return $result;


/* GET ALL POST STEP BY STEP
		foreach($posts as $post){
			setup_postdata($post);
		}
*/

	}
		// update post
	public static function update($array = null){
		if(is_array($array) && $array !== null){
			$result = wp_update_post($array, false);
		}else{
			echo "Data is empty or isn't correct";
		}

		echo $result;
	}

	public static function update_meta($id, $arr){
		// array(
		// 'posts_per_page' => -1,
		// 'category'    => 0,
		// 'orderby'     => 'date',
		// 'order'       => 'DESC',
		// 'include'     => array(),
		// 'exclude'     => array(),
		// 'meta_key'    => 'step',
		// 'meta_value'  =>'',
		// 'post_type'   => 'quiz',
		// 'suppress_filters' => true
		// ) ;
		// $arr = null ? array() : $arr;

		if(is_integer($id) && is_array($arr)){
		    $result = update_post_meta($id, $arr["key"], $arr["value"]);
		}else{
			echo "Can't get data";
		}

		// return $result;
		/*
		print_r("<pre>");
		var_dump($arr["key"] . " value:  " . $arr["value"]);*/
	}

	public static function delete($id){
		if(is_integer($id)){
			$result = wp_delete_post($id, true);
		}
		return $result;
	}

}





 ?>
