<?php
require 'orm.php';

//create product
if(isset($_POST['addprod']) || !empty($_POST['addprod'])) {

	$product = R::dispense( 'products' );

	$product->name = $_POST['inputTitle'];
	$product->sku = $_POST['inputSKU'];
	$product->slug = $_POST['inputSKU'];
	$product->delivery = $_POST['inputDLY'];
	$product->subcategory_id = $_POST['selectSubCat'];
	$product->quantity = $_POST['inputQTY'];
	$product->costprice = $_POST['inputCP'];
	$product->sellprice = $_POST['inputSP'];
	$product->description = $_POST['textDesc'];

	$id = R::store( $product );
	header("Location: product.php?id=".$id);
	exit();
}

//update product
if(isset($_POST['editprod']) || !empty($_POST['editprod'])) {
	

	$product = getProductById($_POST['pid']);
	$product->name = $_POST['inputTitle'];
	$product->delivery = $_POST['inputDLY'];
	$product->subcategory_id = $_POST['selectSubCat'];
	$product->quantity = $_POST['inputQTY'];
	$product->costprice = $_POST['inputCP'];
	$product->sellprice = $_POST['inputSP'];
	$product->description = $_POST['textDesc'];

	R::store( $product );
	header("Location: product.php?id=".$product->id);
	exit();
}

//Create category
if(isset($_POST["newcat"]) || !empty($_POST['newcat']) ){
	
	try{
		$category = R::dispense( 'categories' );
		$category->name = $_POST["newcat"];
		$id = R::store( $category );
		echo "success";
	}catch(Exception $e){
		echo "error";
	}
	exit();

	
}

//Create Sub category
if((isset($_POST["newsubcat"]) || !empty($_POST['newsubcat'])) && (isset($_POST["cat"]) || !empty($_POST['cat']))){
	
	try{
		$subcat2 = getSubCategoryByCatIdSubName($_POST['cat'], $_POST["newsubcat"]);
		
		if( strtolower($subcat2['name']) == strtolower($_POST["newsubcat"]) ){
			echo "error";
			exit();
		}else{
			$subcategory = R::dispense( 'subcategories' );
			$subcategory->name = $_POST["newsubcat"];
			$subcategory->category_id = $_POST["cat"];
			$id = R::store( $subcategory );
			echo "success";
		}
	}catch(Exception $e){
		echo "error";
	}
	

	
}

?>