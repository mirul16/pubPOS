<?php 

class random_string {
	
	function random_str() {
		$string= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'; 
		$result = ''; 
	
		for ($i=0; $i<6; $i++){ 
			$pos = rand(0, strlen($string)-1); 
			$result .= $string{$pos}; 
		} 
		return $result; 
	}
}

?>