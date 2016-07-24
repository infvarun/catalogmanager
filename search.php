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
                </ul>

            </div>
        </div>
    </nav>


    <div class="container">

      <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <form role="search">
                  <div class="form-group has-warning">
                    <input type="text" id="txtSearch" name="txtSearch" maxlength="50" class="form-control" placeholder="Start typing any product attribute">                 
                  </div>
                  
                </form>
          </div>
        </div>

      <div class="row">
          <div class="col-md-12">
              <div class="panel panel-primary">
                <?php $products_all = getAllProducts(); ?>
                  <div class="panel-heading lead">
                    Product Search <a id="imgSearch" class="btn btn-default btn-xs" /><i class="fa fa-refresh" aria-hidden="true"></i> Reset</a> 

                    <span class="pull-right"> 
                      <?php
                       echo "Total Products: <span class='badge'>".sizeof($products_all)."</span>"; 
                       ?>
                    </span>
                  </div>

                  <div class="panel-body tabpane">
                    
                    <table id="tblSearch" class="table table-bordered">
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
        jQuery.expr[":"].containsNoCase = function(el, i, m) {
             var search = m[3];
             if (!search) return false;
            return eval("/" + search + "/i").test($(el).text());
         };
  
          jQuery(document).ready(function() {
            // used for the first example in the blog post
            jQuery('li:contains(\'DotNetNuke\')').css('color', '#0000ff').css('font-weight', 'bold');
  
            // hide the cancel search image
             jQuery('#imgSearch').hide();
 
             // reset the search when the cancel image is clicked
           jQuery('#imgSearch').click(function() {
                resetSearch();
            });
 
            // cancel the search if the user presses the ESC key
             jQuery('#txtSearch').keyup(function(event) {
                if (event.keyCode == 27) {
                    resetSearch();
                 }
            });
 
             // execute the search
             jQuery('#txtSearch').keyup(function() {
                 // only search when there are 3 or more characters in the textbox
                if (jQuery('#txtSearch').val().length > 2) {
                     // hide all rows
                    jQuery('#tblSearch tr').hide();
                   // show the header row
                    jQuery('#tblSearch tr:first').show();
                     // show the matching rows (using the containsNoCase from Rick Strahl)
                     jQuery('#tblSearch tr td:containsNoCase(\'' + jQuery('#txtSearch').val() + '\')').parent().show();
                    // show the cancel search image
                    jQuery('#imgSearch').show();
               }
                else if (jQuery('#txtSearch').val().length == 0) {
                     // if the user removed all of the text, reset the search
                     resetSearch();
                }
  
                // if there were no matching rows, tell the user
                 if (jQuery('#tblSearch tr:visible').length == 1) {
                    // remove the norecords row if it already exists
                     jQuery('.norecords').remove();
                     // add the norecords row
                    jQuery('#tblSearch').append('<tr class="norecords"><td colspan="5" class="Normal">No records were found</td></tr>');
                 }
            });
        });
  
         function resetSearch() {
            // clear the textbox
            jQuery('#txtSearch').val('');
             // show all table rows
            jQuery('#tblSearch tr').show();
             // remove any no records rows
             jQuery('.norecords').remove();
             // remove the cancel search image
             jQuery('#imgSearch').hide();
             // make sure we re-focus on the textbox for usability
           jQuery('#txtSearch').focus();
         }

    });
    
   
    </script>

</body>
</html>
