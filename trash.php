<?php include "orm.php"; 
	if(isset($_GET['id']) || !empty($_GET['id'])) {
	  $product = getProductById($_GET['id']);
	  R::trash( $product );
	  header("Location: admin.php");
	  exit();
	}
?>