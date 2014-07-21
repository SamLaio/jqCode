<?php
	include 'class.jqCode.php';
	//echo $_SESSION['jq_ck'];
	$_SESSION['jq_ck'] = rand(10,20);
	$tmp = '';
	for($i = 0; $i <= $_SESSION['jq_ck']; $i++){
		$tmp .= chr(rand(33,126));
	}
	$_SESSION['jq_ck'] = $paswd->encode($tmp,$paswd->code_str());
	if(isset($_POST['jq_out'])){
		$tmp = $paswd -> str_decode($_POST['jq_out'],$_SESSION['jq_set']);
		print_r($tmp);
	}
?>
<script src="jquery.min.js"></script> 
<script src="class.jqCode.js"></script> 
<form id = "login" method='post'>
	<input id = 'pw' type = 'password' name = 'pw' />
	<input id = 'pw2' type = 'password' name = 'o00' />
	<input type = 'submit'>
</form>
<script>
	/*
	Can create obj like $('#login').jqCode({url});
	url is class.jqCode.php path
	*/
	$('#login').jqCode({'jq_ck':'<?php echo $_SESSION['jq_ck'];?>'});
</script>