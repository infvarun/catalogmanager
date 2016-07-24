<?php include "orm.php"; ?>
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

        .tabpane {
		    display: inline-block;
		    overflow-y: scroll;
		    max-height:500px;
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
                    <li><a href="search"><i class="fa fa-search-plus" aria-hidden="true"></i> Product Search</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                   
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-plus-square" aria-hidden="true"></i> Add / Create New<span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="Add-Product"><i class="fa fa-btn fa-sign-out"></i>Product</a></li>
                                <li><a href="#catModal" role="button" data-toggle="modal"><i class="fa fa-btn fa-sign-out"></i>Category</a></li>
                                <li><a href="#subcatModal" role="button" data-toggle="modal"><i class="fa fa-btn fa-sign-out"></i>Sub-Category</a></li>
                                <li><a href=""><i class="fa fa-btn fa-sign-out"></i>Tags</a></li>
                            </ul>
                        </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="panel panel-primary">
	            	<?php $products_all = getAllProducts(); ?>
	                <div class="panel-heading lead">
	                	Welcome to Catalog View
	                	<span class="pull-right"> 
	                		<?php
	                		 echo "Total Products: <span class='badge'>".sizeof($products_all)."</span>"; 
	                		 ?>
	                	</span>
	                </div>

	                <div class="panel-body tabpane">
		                <table class="table table-bordered">
		                	<tr class="active" style="color:#0288D1">
		                		<th>NAME</th>
								<th>SKU</th>
								<th>STOCK</th>
								<th>COST</th>
								<th>PRICE</th>
								<th>DELIVERY</th>
								<th>DESCRIPTION</th>
								<th>MANAGE</th>
							</tr>
							<?php 
								
								foreach ($products_all as $prod) {
									echo "<tr>";
										$name=substr($prod->name,0,30);
										if(strlen($name)>29){
											echo "<td>". $name." ...</td>";
										}else{
											echo "<td>". $name." </td>";
										}
										echo "<td>".$prod->sku."</td>";
										echo "<td style='width:3%'>".$prod->quantity."</td>";
										echo "<td>".$prod->costprice."</td>";
										echo "<td>".$prod->sellprice."</td>";
										echo "<td style='width:3%'>".$prod->delivery."</td>";
										$desc=substr($prod->description,0,60);
										if(strlen($desc)>59){
											echo "<td style='width:40%'>". $desc." (...)</td>";
										}else{
											echo "<td style='width:40%'>". $desc." </td>";
										}
										echo "<td style='width:3%; color:#E91E63'>
												<a href='product?id=".$prod->id."' style='color:#4CAF50' class='btn btn-default btn-xs' aria-label='Left Align'>
  													<i class='fa fa-cogs' aria-hidden='true'></i>
												</a>

												<a href='trash?id=".$prod->id."' style='color:#F44336' class='btn btn-default btn-xs' aria-label='Left Align'>
  													<i class='fa fa-trash' aria-hidden='true'></i>
												</a>
											</td>";
									echo "</tr>";
								}
								


							?>
						</table>
	                </div>

	                <div class="panel-footer">
	                	<div class="text-center">
		                	<ul class="pagination pagination-sm">
							  <li class="disabled"><a href="#">&laquo;</a></li>
							  <li class="active"><a href="#">1</a></li>
							  <li><a href="#">2</a></li>
							  <li><a href="#">3</a></li>
							  <li><a href="#">4</a></li>
							  <li><a href="#">5</a></li>
							  <li><a href="#">&raquo;</a></li>
							</ul>
						</div>
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
	<script src="js/bootstrap-modal.js"></script>
    <script>
    $(document).ready(function(){


    });
    
    //Create new category
    function createCat(){
        var newcat = _("catName").value;
        var shloader = _("showloader");

        _("catcreate").style.display = "none";
        var ajax = ajaxObj("POST", "action-form.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if(ajax.responseText != "success"){
              		shloader.innerHTML = "Category : "+newcat+", already exist.";
              		_("catcreate").style.display = "block";
            } else {
              window.scrollTo(0,0);
              _("newcatform").innerHTML = "<h4 class='text-success'>Success!</h4><p class='well'>Category : "+newcat+", Created successfully!";
              shloader.innerHTML = "";
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
              _("newsubcatform").innerHTML = "<h4 class='text-success'>Success!</h4><p class='well'>Sub-Category : "+newsubcat+", Created successfully!";
              shloader.innerHTML = "";
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
        <button type="button" onclick="
            location.reload();" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create New Category</h4>
      </div>
      <div class="modal-body">
      	<p class="text-info" style="text-align:center" id="showloader"></p>
        <form class="form-horizontal" id="newcatform" action="action-form.php">
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
        <button type="button" onclick="
            location.reload();" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
