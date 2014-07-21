<?php
	include 'class.jqCode.php';
	if(!isset($_SESSION['jq_set']) or count($_SESSION['jq_set']) != 3)
		$_SESSION['jq_set'] = $paswd -> se_set();
	if(isset($_GET['jq_out'])){
		$tmp = $paswd -> str_decode($_GET['jq_out'],$_SESSION['jq_set']);
		//print_r($tmp);
		$_SESSION['jq_set'] = $paswd -> se_set();
	}
?>
<script src="jquery.min.js"></script> 
<script src="class.jqCode.js"></script> 
<form id = "login" method='get'>
	<input id = 'pw' type = 'password' name = 'pw' />
	<input id = 'pw' type = 'password' name = 'o00' />
	<input type = 'submit'>
</form>
<script>
	$('#login').jqCode();
</script>