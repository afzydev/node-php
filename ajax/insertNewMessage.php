<?php
	use ElephantIO\Client;
	use ElephantIO\Engine\SocketIO\Version1X;
	require __DIR__ . '/../elephant.io/vendor/autoload.php';
	include_once( dirname( __FILE__ ) . '/../class/Database.class.php' );

	$pdo = Database::getInstance()->getPdoObject();

	$name = $_POST[ 'name' ];
	$message = $_POST[ 'message' ];

	$query = $pdo->prepare( 'INSERT INTO message VALUES( \'\', :name, :message )' );
	$query->execute( array( 'name' => $name, 'message' => $message ) );

	$client = new Client(new Version1X('http://localhost:3000'));

	$client->initialize();
	$client->emit('yourmessage', ['name' => $name,'message' => $message]);
	$client->close();
?>
