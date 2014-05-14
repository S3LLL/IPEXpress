
$( document ).ready(function() {
	refresh();
});

function reload(){
	$.getJSON("requete/ordinateur.php",function(result){
		$all  = "";
		$todo = [];
		$.each(result, function(i, field){
			$classname = field["os"];
			if (field["boot"]=="asking") {
				$classname = "asking"
			};
			$box = "<div class=" + $classname + "><table>\n";
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
		$("#nbasking").html($todo.length)
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