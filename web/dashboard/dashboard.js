
$( document ).ready(function() {
	refresh();
});

function reload(){
	$.getJSON("requete/ordinateur.php",function(result){
		$all  = "";
		$todo = [];
		$.each(result, function(i, field){
			$box = "<div class=" + field["os"] + "><table>\n";
			$.each(field, function(j,param){
				if (j=="boot" && param=="asking") {
					$box += "<tr><td>" + j + ":</td><td><select id='choice" + field["id"] + "'></select></td></tr>\n";
					$todo.push(field["id"]);
				} else {
					$box += "<tr><td>" + j + ":</td><td>" + param + "</td></tr>\n";
				}
			});
			$box += "</table></div>\n";
			$all += $box;
		});
		$("#computers").html($all);
		if ($todo.length>0) {
			$.getJSON("requete/distribution.php",function(distrib){
				$choice = "";
				$.each(distrib, function(k, nom){
					$choice += "<option>" + nom + "</option>";
				});
				$.each($todo,function(l, chid){
					$("#choice" + chid).html($choice);
				});
			});
		};
	});
};

function refresh(){
	reload()
	setTimeout(refresh, 3000);
}