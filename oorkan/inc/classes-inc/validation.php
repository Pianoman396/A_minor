<?php abspath_check("ABSPATH");

class Fields{
	public function __construct(){

	}
	public function save($data){
		try{

		}catch(PDOException $e){

		}
	}
	public function name_fld(){
		if(isset($_POST["input_1"]) && $_POST["input_1"]){
			$name = $_POST["input_1"];
			$name_val = preg_match("/(A-Z_a-z)+/g",$name);

			if($name_val !== 0 && $name_val !== false){

			}

		}
	}
}