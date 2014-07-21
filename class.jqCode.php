<?php
	class paswd{
		public function code_str(){
			$re_arr = array();
			for($i = 33; $i <=126; $i++){
				$t = urlencode(chr(rand(33,126)));
				if(!in_array($t,$re_arr))
					$re_arr[urlencode(chr($i))] = $t;
				else
					$i-=1;
			}
			return $re_arr;
		}
		public function decode($str, $arr){
			$tmp = '';
			$str = urldecode($str);
			for($i = 0; $i < strlen($str); $i++){
				$t = substr($str, $i, 1);
				$tmp .= urldecode($arr[urlencode($t)]);
			}
			return $tmp;
		}
		public function encode($str, $arr){
			$tmp = '';
			for($i = 0; $i < strlen($str); $i++){
				$t = urlencode(substr($str, $i, 1));
				foreach($arr as $key => $val){
					if($val == $t)
						$tmp .= $key;
				}
			}
			return $tmp;
		}
		public function se_set(){
			$tmp['pw_array'] = $this->code_str();
			$tmp['pw_ck'] = $this->encode(rand(200,800),$tmp['pw_array']);
			$tmp['pw_i'] = $this->encode(rand(200,800),$tmp['pw_array']);
			return $tmp;
		}
		public function str_decode($str,$arr){
			$tmp = array();
			$fold_arr = explode($arr['pw_i'],$str);
			//print_r($fold_arr);
			foreach($fold_arr as $val){
				if($val !=''){
					$val_out = explode($arr['pw_ck'],$val);
					$tmp[$this ->decode($val_out[0], $arr['pw_array'])] = $this ->decode($val_out[1], $arr['pw_array']);
				}
			}
			return $tmp;
		}
	}
	if(!isset($_SESSION))
		session_start();
	$paswd = new paswd;
	if(isset($_GET['get'])){
		$_SESSION['jq_set'] = $paswd -> se_set();
		$ret = $_SESSION['jq_set'];
		$tmp = array();
		foreach($ret['pw_array'] as $key => $value)
			$tmp[] = array('name'=> $value , 'c'=> $key);
		$ret['pw_array'] = $tmp;
		echo json_encode($ret);
	}
?>