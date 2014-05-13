
$( document ).ready(function() {
	reload();
});

function reload(){
	$.getJSON("json.php",function(result){
		$all = "";
		$.each(result, function(i, field){
			$box = "<div class=" + field["os"] + "><table>\n";
			$.each(field, function(j,param){
				$box += "<tr><td>" + j + ":</td><td>" + param + "</td></tr>\n";
			});
			$box += "</table></div>\n";
			$all += $box;
			
		});
		$("#computers").html($all);
	});
	setTimeout(reload, 3000);
};