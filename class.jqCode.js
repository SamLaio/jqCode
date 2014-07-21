jQuery.fn.extend({
    jqCode: function (settings) {
        var config = {
            'php_path': './'
        };
		var pw_arr = new Array();
		var cki = '', ckm = '';
		if (settings){$.extend(config, settings);}
		$(window).ready(function(){
			$.ajax({
				url: config.php_path+'class.pw_encode.php?get',
				dataType: "json",
				async:false,
				success: function(response) {
					pw_arr = response.pw_array;
					cki = response.pw_ck;
					ckm = response.pw_i;
				}
			});
		});
		
		function str_encode(str){
			if(str == '/' || str == '@' || str == '+')
				str = encodeURIComponent(str);
			else
				str = escape(str);
			if(str == '*')
				str ='%2A';
			for(var i = 0; i < pw_arr.length; i++){
				if(pw_arr[i].name == str){
					return pw_arr[i].c;
				}
			}
		}

		$(this).submit(function(){
			var cap = $(this).find('input');
			var tmp = '';
			for(var i = 0; i < cap.length; i++){
				if(cap[i].type == 'text' || cap[i].type == 'password'){
					for(var j = 0; j< cap[i].name.length;j++)
						tmp += str_encode(cap[i].name[j]);
					tmp += cki;
					for(var j = 0; j< cap[i].value.length;j++)
						tmp += str_encode(cap[i].value[j]);
					tmp += ckm;
				}
			}
			$(this).html("<input id = 'jq_out' name = 'jq_out' />");
			$('#jq_out').val(tmp);
		});
	}
});