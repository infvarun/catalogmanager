<?php 
require 'orm.php';

//Populate Sub-category
if(isset($_GET['subcat']) || !empty($_GET['subcat'])){
	$subcat = getSubCategoryByCategoryId($_GET['subcat']);
	
	if(sizeof($subcat)>0){
		foreach ($subcat as $sc) {
			echo "<option value=".$sc->id.">".$sc->name."</option>";
		}
	}else{
		echo "<option disabled value=0>No Subcategory. Add new first</option>";
	}
}

//Populate Sub-category in product.php
if(isset($_GET['prodsubcat']) || !empty($_GET['prodsubcat'])){
	$subcat = getSubCategoryByCategoryId($_GET['subcat2']);
	
	if(sizeof($subcat)>0){
		foreach ($subcat as $sc) {
			if($_GET['prodsubcat'] == $sc->id){
				echo "<option selected value=".$sc->id.">".$sc->name."</option>";
			}else{
				echo "<option value=".$sc->id.">".$sc->name."</option>";
			}
		}
	}else{
		echo "<option disabled value=0>No Subcategory. Add new first</option>";
	}
}


?>