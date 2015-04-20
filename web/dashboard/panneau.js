
function set (idd) {
	$boot = $("#s" + idd).val();
	$.post( "requete/order.php", { id: idd, nom:  $boot} ).done(function( data ) {
		if (data) {
			alert(data);
		}
		else {
			$("#c" + idd).html($("#s" + idd + " option:selected").text());
		}
	});
}

function del(idd) {
	$.post( "requete/delete.php", { id: idd} ).done(function( data ) {
		if (data) {
			alert(data);
		}
		else {
			$("#t" + idd).remove();
		}
	});
}