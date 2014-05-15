
function set (idd) {
	$boot = $("#s" + idd).val();
	$.post( "requete/order.php", { id: idd, nom:  $boot} ).done(function( data ) {
		if (data) {
			alert(data);
		};
	});
}