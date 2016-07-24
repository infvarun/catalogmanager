<?php include "orm.php"; 
if(isset($_GET['id']) || !empty($_GET['id'])) {
  $product = getProductById($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>shopXadmin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Lato';
        }

        label {
            color:#E91E63;
            font-weight: bold;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="#" style="color:#E91E63">
                    shopXadmin
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="admin"><i class="fa fa-dashcube" aria-hidden="true"></i> Product View</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                   
                        
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-primary">
	                <div class="panel-heading lead">
	                	<?php echo $product->name; ?>
	                </div>

	                <div class="panel-body">
		                <form class="form-horizontal" action="action-form.php" method="POST">
                          <fieldset>
                            <div class="form-group">
                              <label for="inputTitle" class="col-lg-2 control-label">Product Title</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="Enter Product Name/ Title" required maxlength="255" value="<?php echo $product->name; ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputSKU" class="col-lg-2 control-label">SKU Code</label>
                              <div class="col-lg-10">
                                <input readonly type="text" class="form-control" id="inputSKU" name="inputSKU" placeholder="Enter unique SKU Code" required minlength="2" maxlength="10" value="<?php echo $product->sku; ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputDLY" class="col-lg-2 control-label">Delivery Charge</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" id="inputDLY" name="inputDLY" placeholder="Delivery Charge (enter 0 for free)" required minlength="1" maxlength="10" value="<?php echo $product->delivery; ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="select" class="col-lg-2 control-label">Category</label>
                              <div class="col-lg-10">
                                <select class="form-control" id="selectCat" name="selectCat">
                                  <?php
                                    $categories = getAllCategory();
                                    $thisCategory = getThisCategoryBySubCatId($product->subcategory_id);
                                    foreach ($categories as $cat) {
                                      if($thisCategory['category_id'] == $cat->id){
                                        echo "<option selected value='".$cat->id."'>".$cat->name."</option>";
                                      }else{
                                        echo "<option value='".$cat->id."'>".$cat->name."</option>";
                                      }
                                    }
                                  ?>
                                </select>
                                <a id="addcatid" href="#catModal" role="button" data-toggle="modal" class="btn-sm pull-right">Add New Category</a>
                               </div>
                            </div>

                            <div class="form-group">
                              <label for="select" class="col-lg-2 control-label">Sub-Category</label>
                              <div class="col-lg-10">
                                <select class="form-control" id="selectSubCat" name="selectSubCat">
                                </select>
                                <a id="addsubcatid" href="#subcatModal" role="button" data-toggle="modal" class="btn-sm pull-right">Add Sub-Category</a>
                               </div>
                            </div>

                            <div class="form-group">
                              <label for="inputQTY" class="col-lg-2 control-label">Stock</label>
                              <div class="col-lg-10">
                                <input type="text" name="inputQTY" class="form-control" id="inputQTY" placeholder="Enter initial stock" required minlength="1" maxlength="11" value="<?php echo $product->quantity; ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputCP" class="col-lg-2 control-label">Cost Price Rs.</label>
                              <div class="col-lg-10">
                                <input type="text" name="inputCP" class="form-control" id="inputCP" placeholder="Enter Unit Cost Price" required minlength="1" maxlength="15" value="<?php echo $product->costprice; ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="inputSP" class="col-lg-2 control-label">Selling Price Rs.</label>
                              <div class="col-lg-10">
                                <input type="text" class="form-control" name="inputSP"  id="inputSP" placeholder="Enter Unit Selling Price" required minlength="1" maxlength="15" value="<?php echo $product->sellprice; ?>">
                              </div>
                            </div>

                            <div class="form-group">
                              <label for="textDesc" class="col-lg-2 control-label">Description</label>
                              <div class="col-lg-10">
                                <textarea class="form-control" rows="2" id="textDesc" name="textDesc"><?php echo $product->description; ?>
                                </textarea>
                                <span class="help-block">You can use &lt;br/&gt; for line-break. e.g. Amazing &lt;br/&gt; Product. - Here Amzing and product will appear in 2 different line at frontend. </span>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-lg-10 col-lg-offset-2">
                                <button class="btn btn-success btn-lg pull-right" id="addProduct" name="addProduct">
                                    <i class="fa fa-cart-plus" aria-hidden="true"></i> Save Changes 
                                </button>
                              </div>
                            </div>
                            <input type="hidden" value="8861728005" name="editprod"/>
                            <input type="hidden" value="<?php echo $product->id; ?>" name="pid"/>
                          </fieldset>
                    </form>
	                </div>

	                <div class="panel-footer">
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

    <!-- JavaScripts -->
    <script src="js/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){

        //Subcategory
        $("#selectSubCat").load("data-service.php?subcat2=" + $("#selectCat").val()+"&prodsubcat=<?php echo $product->subcategory_id ?>");
        $("#selectCat").change(function() {
          $("#selectSubCat").load("data-service.php?subcat2=" + $("#selectCat").val()+"&prodsubcat=<?php echo $product->subcategory_id ?>");
        });

        //on closing sub cat modal
        $("#subcatclose").click(function() {
          $("#selectSubCat").load("data-service.php?subcat2=" + $("#selectCat").val()+"&prodsubcat=<?php echo $product->subcategory_id ?>");
        });

    });
    
     //Create new category
    function createCat(){
        var newcat = _("catName").value;
        var shloader = _("showloader");

        var ajax = ajaxObj("POST", "action-form.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if(ajax.responseText != "success"){
                    shloader.innerHTML = "Category : "+newcat+", already exist.";
            } else {
              window.scrollTo(0,0);
              _("showloader").innerHTML = "Category : "+newcat+", Created successfully!";
            }
              }
            }
            ajax.send("newcat="+newcat);

        }

        //Create new sub category
    function createSubCat(){
        var newsubcat = _("subcatName").value;
        var cat = _("selectCat2").value;
        var shloader = _("showloader2");

        _("subcatcreate").style.display = "none";
        var ajax = ajaxObj("POST", "action-form.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if(ajax.responseText != "success"){
                    shloader.innerHTML = "SORRY : Sub Category : "+newsubcat+", for this Category already exist.";
                    _("subcatcreate").style.display = "block";
            } else {
              window.scrollTo(0,0);
              shloader.innerHTML = "Sub-Category : "+newsubcat+", Created successfully!";
              _("subcatcreate").style.display = "block";
            }
              }
            }
            ajax.send("newsubcat="+newsubcat+"&cat="+cat);

        }
    </script>

    <!-- Category Modal -->
<div class="modal fade" id="catModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create New Category</h4>
      </div>
      <div class="modal-body">
        <p class="text-info" style="text-align:center" id="showloader"></p>
        <form class="form-horizontal" id="newcatform" action="action-form.php" method="GET">
          <fieldset>
            <div class="form-group">
              <label for="catName" class="col-lg-2 control-label" style="color:#E91E63">Name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="catName" name="catName" placeholder="Enter Category Name" required minlength="2" maxlength="255">
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-right" id="catcreate" onclick="createCat()">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- Sub-Category Modal -->
<div class="modal fade" id="subcatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="subcatclose" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create New Sub-Category</h4>
      </div>
      <div class="modal-body">
        <p class="text-info" style="text-align:center" id="showloader2"></p>
        <form class="form-horizontal" id="newsubcatform" action="action-form.php">
          <fieldset>
                
            <div class="form-group">
              <label for="selectCat2" class="col-lg-2 control-label" style="color:#E91E63">Category</label>
              <div class="col-lg-10">
                <select class="form-control" id="selectCat2" name="selectCat2">
                    <option disabled value="0">Select a category</option>
                  <?php
                    $categories = getAllCategory();
                    foreach ($categories as $cat) {
                        echo "<option value='".$cat->id."'>".$cat->name."</option>";
                    }
                  ?>
                </select>
               </div>
            </div>

            <div class="form-group">
              <label for="subcatName" class="col-lg-2 control-label" style="color:#E91E63">Name</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="subcatName" name="subcatName" placeholder="Enter Sub-Category Name" required minlength="2" maxlength="255">
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary pull-right" id="subcatcreate" onclick="createSubCat()">Add</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>