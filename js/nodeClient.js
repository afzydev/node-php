var socket = io('http://localhost:3000');

$( "#messageForm" ).submit( function() {
	var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();

	$.ajax({
		url: "./ajax/insertNewMessage.php",
		type: "POST",
		data: { name: nameVal, message: msg },
		success: function(data) {
			//socket.emit( 'message', { name: nameVal, message: msg } );
		}
	});

	return false;
});

socket.on( 'yourmessage', function( data ) {
	$('#messages tr:first').after('<tr><td>'+data.name+'</td><td>'+data.message+'</td></tr>');
});
