<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="model.css">
    <title>Superuser</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
  </script>

<body>

    <!-- Navigation bar starts here -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
   <a class="navbar-brand" href="#">Version Update</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
     </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="superuser.php">Refresh</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../index.php">Log-out</a>
            </li>
          </ul>
        </div>
  </div>
</nav>

   
     <!-- Page Content starts here-->
<div class="container">
  <div class="row">
    <div class="row" style="margin-top:20px;" >

         <!-- Current version starts here-->
      <div class="col-lg-4 col-md-6 mb-4" >
        <div class="card h-100">
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Current Version</a>
            </h4>
                 
            <div class="container">
              <div class="row">
                <div class="col-sm-12 col-sm-offset-1">
                  <div class="list-group" id="list1">
        
                     <?php
                     $people = array();
                     $Ckey=array();
                     $Cval=array();
                     $lines = file('current_version.txt');
                     foreach($lines as $line){
                     $data = explode(',', $line);
                     $Ckey[] = $data[0];
                     $Cval[] = $data[1];
                     }
                     ?>

                      <form method="post" action="#">
                        <a href="#" class="list-group-item"> <input type="checkbox" name="check1" value="value1"><?php echo " $Ckey[0] : $Cval[0]"  ?></input> </a>
                        <a href="#" class="list-group-item"> <input type="checkbox" name="check2" class="pull-right" >  <?php echo " $Ckey[1] : $Cval[1]"  ?></a>
                        <a href="#" class="list-group-item"> <input type="checkbox" name="check3"class="pull-right">  <?php echo " $Ckey[2] : $Cval[2]"  ?></a>
                        <a href="#" class="list-group-item"> <input type="checkbox" name="check4"class="pull-right">  <?php echo " $Ckey[3] : $Cval[3]"  ?></a>
                        <a href="#" class="list-group-item"> <input type="checkbox" name="check5"class="pull-right">  <?php echo " $Ckey[4] : $Cval[4]"  ?></a>
                  </div>
                </div>
                 <input class="btn btn-primary" onClick="check_uncheck_checkbox(this.checked);" type="button" value="Reset" style="margin-right: 10px;margin-top: 10px; ">
                 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-top: 10px;">Update</button>
               
               <!-- The Modal -->
                <div class="modal" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">
      
                       <!-- Modal body -->
                      <div class="modal-body">
                           Do you want to update?
                      </div>
        
                       <!-- Modal footer -->
                      <div class="modal-footer">
     
                       <form method="POST"> 
                        <input type="submit" name="test" id="test" value="RUN" /></input><br/>
                       </form>

                       <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                     </form>
          </div>
            <div class="card-footer">
              <small class="text-muted"></small>
            </div>
        </div>
      </div>
           <!-- End of current version -->
            

  

           <!-- Available version starts here -->
      <div class="col-lg-4 col-md-6 mb-4" >
        <div class="card h-100">
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Available Version</a>
            </h4>
                 
            <div class="container">
              <div class="row">
                <div class="col-sm-12 col-sm-offset-1">
                  <div class="list-group" id="list1">
                 
                    <?php
                    $people = array();
                    $Akey=array();
                    $Aval=array();
                    $lines = file('available_version.txt');
                    foreach($lines as $line){
                               $data = explode(',', $line);
                               $Akey[] = $data[0];
                               $Aval[] = $data[1];
                             }
                    ?>
                     <a href="#" class="list-group-item">   <?php echo " $Akey[0] : $Aval[0]"  ?> </a>
                     <a href="#" class="list-group-item">   <?php echo " $Akey[1] : $Aval[1]"  ?></a>
                     <a href="#" class="list-group-item">   <?php echo " $Akey[2] : $Aval[2]"  ?></a>
                     <a href="#" class="list-group-item">   <?php echo " $Akey[3] : $Aval[3]"  ?></a>
                     <a href="#" class="list-group-item">   <?php echo " $Akey[4] : $Aval[4]"  ?></a>
        
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="card-footer" style="margin-top: 47px;">
              <small class="text-muted"></small>
            </div>
        </div>
      </div>
                <!-- Available version ends here -->


                <!-- Updated version starts here -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h4 class="card-title">
              <a href="#">Updated Version</a>
            </h4>
            <div class="container">
              <div class="row">
                <div class="col-sm-12 col-sm-offset-1">
                  <div class="list-group" id="list1">

                   <?php

                   if (isset($_POST['test'])){
                    if (isset($_POST['check1'])) {
                       echo "<a href=\"#\" class=\"list-group-item\">$Akey[0] : $Aval[0]</a>";
                        }
                    if (isset($_POST['check2'])) {
                        echo "<a href=\"#\" class=\"list-group-item\">$Akey[1] : $Aval[1]</a>";
                        }
                    if (isset($_POST['check3'])) {
                        echo "<a href=\"#\" class=\"list-group-item\">$Akey[2] : $Aval[2]</a>";
                        }
                    if (isset($_POST['check4'])) {
                        echo "<a href=\"#\" class=\"list-group-item\">$Akey[3] : $Aval[3]</a>";
                        }
                    if (isset($_POST['check5'])) {
                        echo "<a href=\"#\" class=\"list-group-item\">$Akey[4] : $Aval[4]</a>";
                        }
                          }
                            ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <small class="text-muted"></small>
          </div>
        </div>
      </div>
             <!-- Updated version ends here -->
            
    </div>
     <!-- /.row -->
  </div>
   <!-- /.col-lg-9 -->
</div>
 <!-- /.container -->

    
    <!-- Footer starts from here -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Version information@Delta</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>

      function check_uncheck_checkbox(isChecked) {
        $('input[type="checkbox"]').each(function() {
          this.checked = false;
        });
      }
    
    </script>

  </body>

</html>
