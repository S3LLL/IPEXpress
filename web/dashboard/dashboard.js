
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
			$box = "<div class=" + $classname + " style='background-color:" + color($classname) + ";' ><table>\n";
			$.each(field, function(j,param){
				if (j=="boot" && param=="asking") {
					$box += "<tr><td>" + j + ":</td><td><select onchange='getchoice(" + field["id"] + ")' id='choice" + field["id"] + "'></select></td></tr>\n";
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
				$choice = "<option></option>";
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

function getchoice(id){
  	$.post( "requete/choice.php", { idordi: id, osordi: $("#choice" + id).find(":selected").text() } ).done(function( data ) {
		if (data) {
			alert(data);
		};
	});
}

function color(mot){
	if (mot=="undefined") {
		return "white";
	};
	for (var i = 0, hash = 0; i < mot.length; hash = mot.charCodeAt(i++) + ((hash << 5) - hash));
	for (var i = 0, colour = "#"; i < 3; colour += ("00" + ((hash >> i++ * 8) & 0xFF).toString(16)).slice(-2));
	return colour;
}