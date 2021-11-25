<?php
	$errors=array();
		// * presence
		// use trim() so empty spaces don't count
		// use === to avoid false positives
		// empty() would consider "0" to be empty
		function has_presence($presence_value){
			return isset($presence_value) && $presence_value !== "";
		}
		function validate_presence($fields_required){				//argument or parameter need an array
			global $errors;
		//$fields_required =array("username", "password");
			foreach($fields_required as $abc){
				$value = trim($_POST[$abc]);
				if(!has_presence($value)){
					$errors[$abc]=ucfirst($abc) ." can't be blank";
					}
				}
			}
		
		// * string length
		
		// max length
		function has_max_length($value, $max){
			return strlen($value) <= $max;
		}
		//using an assoc array
		function validate_max_lengths($fields_with_max_lengths){		//argument or parameter need an assoc array
			global $errors;
			//$fields_with_max_lengths = array("username"=> 20, "password"=> 8);
			foreach($fields_with_max_lengths as $k => $v){
				$value = trim($_POST[$k]);
				if(!has_max_length($value, $v)){
					$errors[$k]="{$k} is too long";
			}
		}
		}
		// min length
		function has_min_length($value, $min){
			return strlen($value) >= $min;
		}
		//using an assoc array
		function validate_min_lengths($fields_with_min_lengths){		//argument or parameter need an assoc array
			global $errors;
			//$fields_with_min_lengths = array("username"=> 20, "password"=> 8);
			foreach($fields_with_min_lengths as $k => $v){
				$value = trim($_POST[$k]);
				if(!has_min_length($value, $v)){
					$errors[$k]="{$k} is too shorts";
			}
		}
		}
		// * inclusion in a set
		function has_inclusion_in($value, $set){
		 return in_array($value, $set);
		}
?>
