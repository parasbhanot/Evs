<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--                                   CSS Include Files
  ===============================================================================================-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">   
  <link rel="stylesheet" href="bootstrap/css/topnav.css">
   <link rel="stylesheet" href="bootstrap/css/sidenav.css">
   <link rel="stylesheet" href="bootstrap/css/dashboard.css">

    <!--                                   JavaScript Include Files
  ===============================================================================================-->
  <script src="bootstrap/js/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/sidenav.js"></script>
  <script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
  </script> 
  <script>
    $(document).ready(function()
     {
      navbar();  
     });
  </script> 
 </head>


<body>
   <!--                                   SIDENAV 
  ===============================================================================================-->
  
 <div class="wrap">
  <!--      -->
  <!--      -->
      <div class="wrap_navbar">
        <ul class="wrap_navbar_list">
          <li class="wrap_navbar_list_item"><h1>  DASHBOARD</h1></li>
          <li class="wrap_navbar_list_item" ><a href="dashboard.php" id="back_navbar">Home &#8594;</a></li>
          <li class="wrap_navbar_list_item" ><a href="dashboard.php">Config pages</a></li>
          <li class="wrap_navbar_list_item" ><a href="../configkeys/dropdown.php">Config Keys</a></li>
          <li class="wrap_navbar_list_item" ><a href="">About</a></li>
          <li class="wrap_navbar_list_item" ><a href="">Help</a></li>
          <li class="wrap_navbar_list_item" ><a href="../index.php">Log-Out</a></li>
        </ul>
  <!--          -->
        <div class="wrap_navbar_burger_btn">
          <div class="wrap_navbar_burger_btn_line"></div>
          <div class="wrap_navbar_burger_btn_line"></div>
          <div class="wrap_navbar_burger_btn_line"></div>
        </div>
      </div>
<!--      -->
    <div class="wrap_content">
      <!--                                   CARD BODY
  ===============================================================================================-->
  
     <div class="rcorner">
  
      <div id='cssmenu'>
       <ul>
         <li class='active'><a href='#tab_a' data-toggle="pill">Application Configuration</a></li>
         <li><a href='#tab_b' data-toggle="pill">Calibration</a></li>
         <li><a href='#tab_c' data-toggle="pill">APN Settings</a></li>     
         <li><a href='#tab_d' data-toggle="pill">CalSettings</a></li>
       </ul>
      </div>

        <div class="tab-content col-md-12">

         <div class="tab-pane active" id="tab_a">

          <div class="tab-content col-md-12">
             <!--                                   CONFIG FORM
  ===============================================================================================-->

            <form class="form-horizontal" id="config_form" name="configForm" method="post" >

<?php

   if ($_SERVER['REQUEST_METHOD'] === 'GET')
   {

     class MyDB extends SQLite3
     {
      function __construct()
      {
        $this->open("/home/delsys/product_config.db");
      }
     }
     
     $db = new MyDB();

        if(!$db){
            echo "Could not open DB!!!";
            echo $db->lastErrorMsg();
                } else {
                         // echo "Opened database successfully<br/>";
                            echo "<br>";
                       }

                       //echo "<br>";
                       //echo "<br>";

           $sql = "select * from keys";

           $ret = $db->query($sql);
           $temp = 0;
           $key_1 = null;
           $key_2 = null;
           $value_1 = null;
           $value_1 = null;
      
           while($row = $ret->fetchArray(SQLITE3_ASSOC))
             {

       if
        (
         ($row['key'] === 'product_serial_no') ||
         ($row['key'] === 'product_model') ||
         ($row['key'] === 'product_category') ||
         ($row['key'] === 'ocppen') ||
         ($row['key'] === 'ocppid') ||
         ($row['key'] === 'OCPPEndpointToBackend') ||
         ($row['key'] === 'ChargeBoxSerialNo') ||
         ($row['key'] === 'ChargePointModelNo') ||
         ($row['key'] === 'ChargePointSlNo') ||
         ($row['key'] === 'ChargePointVendor') ||
         ($row['key'] === 'ICCID') ||
         ($row['key'] === 'IMSI') ||
         ($row['key'] === 'MeterSerialNo') ||
         ($row['key'] === 'InputMinVoltage') ||
         ($row['key'] === 'InputMaxVoltage') ||
         ($row['key'] === 'MaxAmbTemp') ||
         ($row['key'] === 'MeterType') ||
         ($row['key'] === 'MaxConnectorTemp')
        ){
          if($temp == 0)
          {
            $key_1 = $row['key'];
            $value_1 = $row['value']; 
          }
          if($temp == 1)
          {
            $key_2 = $row['key'];
            $value_2 = $row['value'];
          }
          if($temp == 1)
          {
          ?>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key_1.'</div>'?></label>
            <div class="col-sm-3">
              <?php echo "<input type=\"text\" name=\"".$key_1."\" value=\"".$value_1."\" placeholder=\"Enter Value\" class=\"form-control\" style=\"font-family:Poppins-Regular font-size: 15px\">"; ?>
              <!--<input type="text" placeholder="State" value=\"".$row['value']."\" class="form-control"> -->
            </div>

            <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key_2.'</div>'?></label>
            <div class="col-sm-3">
               <?php echo "<input type=\"text\" name=\"".$key_2."\" value=\"".$value_2."\" placeholder=\"Enter Value\" class=\"form-control\" style=\"font-family:Poppins-Regular font-size: 15px\">"; ?>
              <!--<input type="text" placeholder="Post Code" class="form-control"> -->
            </div>
          </div>
          <?php
            }
            $temp++;
             if($temp == 2)
             {
              $temp = 0;
             }
           ?>
          <?php       
        }
      }

      $db->close();
      echo "<br>";
      echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"submit1_button\" style=\"float:right; width:20%; font-size:20px;background-color:#1e90ff;color:#fff;\" >  Save</button>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";


   }else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //echo "This is post request";
    if (isset($_POST['submit1_button']))
      
      echo "<br>";
      echo "<br>";

      class MyDB extends SQLite3
      {
        function __construct()
        {
          $this->open("/home/delsys/product_config.db");
        }
      }
         $db = new MyDB();

         if(!$db){
              echo "Could not open DB!!!";
        echo $db->lastErrorMsg();
         } else {
            //echo "Opened database successfully<br/>";
            echo "<br>";
         }


      $a ="";
        $b ="";
      $c ="";
        $d ="";
      $e ="";
        $f ="";
      $g ="";
        $h ="";
      $i ="";
        $j ="";
      $k ="";
        $l ="";
      $m ="";

      $n ="";
      $o ="";
      $p ="";
      $q ="";
      $r ="";

      $sqlb ="replace into keys(key , value) VALUES (";
      $sqle =");";
      $pramCount = 0;

   
     if(isset($_POST["ocppid"])){

        $a = $_POST["ocppid"];
        //echo $a;
        $pramCount++;
      }

      if(isset($_POST["OCPPEndpointToBackend"])){

        $b = $_POST["OCPPEndpointToBackend"];
        //echo $b;
        $pramCount++;
      }

      if(isset($_POST["ChargeBoxSerialNo"])){

        $c =  $_POST["ChargeBoxSerialNo"];
        //echo $c;
        $pramCount++;
      }

      if(isset($_POST["ChargePointSlNo"])){

        $d =  $_POST["ChargePointSlNo"];
        //echo $d;
        $pramCount++;
      }


      if(isset($_POST["ChargePointModelNo"])){

        $e =  $_POST["ChargePointModelNo"];
        //echo $e;
        $pramCount++;
      }


      if(isset($_POST["ChargePointVendor"])){

        $f =  $_POST["ChargePointVendor"];
        //echo $f;
        $pramCount++;

      }


      if(isset($_POST["ICCID"])){

        $g =  $_POST["ICCID"];
        //echo $g;
        $pramCount++;
      }


      if(isset($_POST["IMSI"])){

        $h =  $_POST["IMSI"];
        //echo $h;
        $pramCount++;
      }

      if(isset($_POST["MeterSerialNo"])){

        $i =  $_POST["MeterSerialNo"];
        //echo $i;
        $pramCount++;
      }

      if(isset($_POST["InputMinVoltage"])){

        $j = $_POST["InputMinVoltage"];
        //echo $j;
        $pramCount++;
      }

      if(isset($_POST["InputMaxVoltage"])){

        $k =  $_POST["InputMaxVoltage"];
        //echo $k;
        $pramCount++;
      }


      if(isset($_POST["MaxAmbTemp"])){

        $l =  $_POST["MaxAmbTemp"];
        //echo $l;
        $pramCount++;
      }

      if(isset($_POST["MeterType"])){

        $m =  $_POST["MeterType"];
        //echo $m;
      }

      if(isset($_POST["ocppen"])){

        $o =  $_POST["ocppen"];
        //echo $o;
      }

      if(isset($_POST["MaxConnectorTemp"])){

        $p=  $_POST["MaxConnectorTemp"];
        //echo $p;
      }

      if(isset($_POST["product_serial_no"])){

        $q = $_POST["product_serial_no"];
      
      }

      if(isset($_POST["product_model"])){

        $r = $_POST["product_model"];
      
      }

      //echo $pramCount;

    $sql1 =     $sqlb."'ocppid',"."'".$a."'".$sqle;
    $sql2 =     $sqlb."'OCPPEndpointToBackend',"."'".$b."'".$sqle;
    $sql3 =     $sqlb."'ChargeBoxSerialNo',"."'".$c."'".$sqle;
    $sql4 =     $sqlb."'ChargePointSlNo',"."'".$d."'".$sqle;
    $sql5 =     $sqlb."'ChargePointModelNo',"."'".$e."'".$sqle;
    $sql6 =     $sqlb."'ChargePointVendor',"."'".$f."'".$sqle;
    $sql7 =     $sqlb."'ICCID',"."'".$g."'".$sqle;
    $sql8 =     $sqlb."'IMSI',"."'".$h."'".$sqle;
    $sql9 =     $sqlb."'MeterSerialNo',"."'".$i."'".$sqle;
    $sql10 =    $sqlb."'InputMinVoltage',"."'".$j."'".$sqle;
    $sql11 =    $sqlb."'InputMaxVoltage',"."'".$k."'".$sqle;
    $sql12 =    $sqlb."'MaxAmbTemp',"."'".$l."'".$sqle;
    $sql13 =    $sqlb."'MeterType',"."'".$m."'".$sqle;
    $sql14 =    $sqlb."'ocppen',"."'".$o."'".$sqle;
    $sql15 =    $sqlb."'MaxConnectorTemp',"."'".$p."'".$sqle;
    $sql16 =    $sqlb."'product_serial_no',"."'".$q."'".$sqle;
    $sql17 =    $sqlb."'product_model',"."'".$r."'".$sqle;

    //
    //echo $sql1;


    if($pramCount === 12){

      //echo "Before execution <br>";
      //echo $sql8;
      $db->exec($sql1);
      $db->exec($sql2);
      $db->exec($sql3);
      $db->exec($sql4);
      $db->exec($sql5);
      $db->exec($sql6);
      $db->exec($sql7);
      $db->exec($sql8);
      $db->exec($sql9);
      $db->exec($sql10);
      $db->exec($sql11);
      $db->exec($sql12);
      $db->exec($sql13);
      $db->exec($sql14);
      $db->exec($sql15);
      $db->exec($sql16);
      $db->exec($sql17);

      $pramCount = 0;
      $db->close();

       echo '<script type="text/javascript">';  
echo 'window.location.href = "../configpartial/happy.php";';
echo '</script>';

    }else if($pramCount === 0){

      echo '<script type="text/javascript">';  
echo 'window.location.href = "../configpartial/sorry.php";';
echo '</script>';
      $db->close();

    }
}

 ?>

      </form>
     
      
        </div>
      </div>

 <!--                                  CALIB FORM
  ===============================================================================================-->
    <div class="tab-pane col-md-10" id="tab_b" style="margin-top: 30px;">
      <form class="form-horizontal" action="../calibpartial/partial_calib.php" method="post">

       <div class="form-group">
         <label class="control-label col-sm-6" style="text-align: left; font-family: Poppins-Regular; color: #808080;font-size: 15px;" >Current displayed  at 10 Amps:</label>
         <div class="col-sm-5">
          <input type="text" class="form-control" id="dtenAmps" placeholder="Enter current" name="dtenAmps" style="font-family:Poppins-Regular;color: #555555;font-size: 15px;">
         </div>
       </div>
       <div class="form-group">
        <label class="control-label col-sm-6" style="text-align: left;font-family: Poppins-Regular; color: #808080;font-size: 15px;">Current displayed  at 200 Amps:</label>
         <div class="col-sm-5">
           <input type="text" class="form-control" id="dmaxAmps" placeholder=" Enter current" name="dmaxAmps" style="font-family:Poppins-Regular;color: #555555;font-size: 15px; ">
         </div>
       </div>
       <div class="form-group">
        <label class="control-label col-sm-6" style="text-align: left;font-family: Poppins-Regular; color: #808080;font-size: 15px;">Current measured  at 10 Amps:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="mtenAmps" placeholder=" Enter current" name="mtenAmps"style="font-family:Poppins-Regular;color: #555555;font-size: 15px;">
          </div>
        </div>
        <div class="form-group">
        <label class="control-label col-sm-6" style="text-align: left;font-family: Poppins-Regular; color: #808080;font-size: 15px;">Current measured at 200 Amps:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="mmaxAmps" placeholder=" Enter current" name="mmaxAmps"style="font-family:Poppins-Regular;color: #555555;font-size: 15px;">
          </div>
        </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10"><br>
    <!-- Trigger the modal with a button -->
    <div class="col-sm-12 text-center" >
        <input  type="reset" value="Reset" class="btn btn-primary" style="background-color: #1e90ff;">
         <button type="button" onclick="calculator()"class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="background-color: #1e90ff;">Calculate & Save</button>
         
     </div>
    
     

      <!-- The Modal -->
<div class="container">
  
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Offset & Gain</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
    <label class="control-label col-sm-4" style="text-align: left;">Offset :</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="offset" name="offset">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" style="text-align: left;">Gain :</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="gain" name="gain">
    </div>
  </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

          <input type="submit" class="btn btn-default" name="submit_button" style="float: left;"/>
          
        </div>
      </div>

    </div>
  </div>
  </div>
  </div>
  </div>
  </form>
  </div>

<div class="tab-pane col-md-10" id="tab_c" style="margin-top: 30px;">
<form class="form-horizontal" id="APN_form" name="APNform" method="post" action="apn1.php">
  <?php

   if ($_SERVER['REQUEST_METHOD'] === 'GET')
   {

     class MyDB2 extends SQLite3
     {
      function __construct()
      {
        $this->open("/home/delsys/product_config.db");
      }
     }
        $db = new MyDB2();

        if(!$db){
            echo "Could not open DB!!!";
            echo $db->lastErrorMsg();
                } else {
                         // echo "Opened database successfully<br/>";
                            echo "<br>";
                       }

                        //echo "<br>";
                       //echo "<br>";

           $sql = "select * from keys";

           $ret = $db->query($sql);
           $temp = null;
           $key_1 = null;
           //$key_2 = null;
           $value_1 = null;
           //$value_1 = null;
      
           while($row = $ret->fetchArray(SQLITE3_ASSOC))
             {

       if
        (
          ($row['key'] === 'APN') 
        
        ){
          //if($temp == 0)
          {
            $key_1 = $row['key'];
            $value_1 = $row['value']; 
          }
           
          
          {
          ?>
           <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">Current APN Status</div>'?></label>
            <div>
              <label class="control-label col-sm-6" style="text-align: left; font-family: Poppins-Regular; color: #1e90ff;font-size: 15px;" >
            <?php 
            if(empty($value_1))
            echo "Automatic Mode";
            else
            echo "Manual Mode"; ?>
          </label>
              
            </div>
          </div>
            <div class="form-group">
            <label class="col-sm-6 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key_1.'</div>'?></label>
            <div class="col-sm-4">
              <?php echo "<input type=\"text\" name=\"".$key_1."\" value=\"".$value_1."\" placeholder=\"Enter Value\" class=\"form-control\" style=\"font-family:Poppins-Regular font-size: 15px\">"; ?>
              <!--<input type="text" placeholder="State" value=\"".$row['value']."\" class="form-control"> -->
            </div>

            
          </div>
          <?php
            }
            //$temp++;
             //if($temp == 2)
             {
             // $temp = 0;
             }
           ?>
          <?php
       
        }
      }

      $db->close();
      echo "<br>";
      echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"submit2_button\" style=\"float:right; width:20%; font-size:20px;background-color:#1e90ff;color:#fff;\" >  Save</button>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";


   }

 ?>
</form>

</div>

<div class="tab-pane col-md-10" id="tab_d" style="margin-top: 30px;">
<!--                                   Extra Key Form 
  ===============================================================================================-->

            <form class="form-horizontal" id="extrakey_form" name="extrakey" method="post" >

<?php

   if ($_SERVER['REQUEST_METHOD'] === 'GET')
   {

     class MyDB3 extends SQLite3
     {
      function __construct()
      {
        $this->open("/home/delsys/device_config.db");
      }
     }
        $db = new MyDB3();

        if(!$db){
            echo "Could not open DB!!!";
            echo $db->lastErrorMsg();
                } else {
                         // echo "Opened database successfully<br/>";
                            echo "<br>";
                       }

                        //echo "<br>";
                       //echo "<br>";

           $sql = "select * from keys";

           $ret = $db->query($sql);
           $temp = 0;
           $key_1 = null;
           $key_2 = null;
           $value_1 = null;
           $value_1 = null;
      
           while($row = $ret->fetchArray(SQLITE3_ASSOC))
             {

       if
        (
         ($row['key'] === 'adc4gain') ||       
         ($row['key'] === 'adc4offset') ||
         ($row['key'] === 'opcurroffset1') ||
         ($row['key'] === 'opcurroffset2')
  
        ){
          if($temp == 0)
          {
            $key_1 = $row['key'];
            $value_1 = $row['value']; 
          }
          if($temp == 1)
          {
            $key_2 = $row['key'];
            $value_2 = $row['value'];
          }
          if($temp == 1)
          {
          ?>
           <div class="form-group">
            <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key_1.'</div>'?></label>
            <div class="col-sm-3">
              <?php echo "<input type=\"text\" name=\"".$key_1."\" value=\"".$value_1."\" placeholder=\"Enter Value\" class=\"form-control\" style=\"font-family:Poppins-Regular font-size: 15px\">"; ?>
              <!--<input type="text" placeholder="State" value=\"".$row['value']."\" class="form-control"> -->
            </div>

            <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key_2.'</div>'?></label>
            <div class="col-sm-3">
               <?php echo "<input type=\"text\" name=\"".$key_2."\" value=\"".$value_2."\" placeholder=\"Enter Value\" class=\"form-control\" style=\"font-family:Poppins-Regular font-size: 15px\">"; ?>
              <!--<input type="text" placeholder="Post Code" class="form-control"> -->
            </div>
          </div>
          <?php
            }
            $temp++;
             if($temp == 2)
             {
              $temp = 0;
             }
           ?>
          <?php
       
        }
      }

      $db->close();
      echo "<br>";
      echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"submit3_button\" style=\"float:right; width:20%; font-size:20px;background-color:#1e90ff;color:#fff;\" >  Save</button>";
      echo "<br>";
      echo "<br>";
      echo "<br>";
      echo "<br>";


   }else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    //echo "This is post request";
    if (isset($_POST['submit3_button']))
      
      echo "<br>";
      echo "<br>";

      class MyDB3 extends SQLite3
      {
        function __construct()
        {
          $this->open("/home/delsys/device_config.db");
        }
      }
         $db = new MyDB3();

         if(!$db){
              echo "Could not open DB!!!";
        echo $db->lastErrorMsg();
         } else {
            //echo "Opened database successfully<br/>";
            echo "<br>";
         }


      $a3 ="";
      $b3 ="";
      $c3 ="";
      $d3 ="";
      

      $sqlb ="replace into keys(key , value) VALUES (";
      $sqle =");";
      $pramCount = 0;

      if(isset($_POST["adc4gain"])){

        $a3 = $_POST["adc4gain"];
        //echo $a;
        $pramCount++;
      }

      if(isset($_POST["adc4offset"])){

        $b3 = $_POST["adc4offset"];
        //echo $a;
        $pramCount++;
      }
      if(isset($_POST["opcurroffset1"])){

        $c3 = $_POST["opcurroffset1"];
        //echo $a;
        $pramCount++;
      }
      if(isset($_POST["opcurroffset2"])){

        $d3 = $_POST["opcurroffset2"];
        //echo $a;
        $pramCount++;
      }
      
      //echo $pramCount;


    $sql31 =     $sqlb."'adc4gain',"."'".$a3."'".$sqle;
    $sql32 =     $sqlb."'adc4offset',"."'".$b3."'".$sqle;
    $sql33 =     $sqlb."'opcurroffset1',"."'".$c3."'".$sqle;
    $sql34 =     $sqlb."'opcurroffset2',"."'".$d3."'".$sqle;
    

    //
    //echo $sql1;


    if($pramCount === 4){

      //echo "Before execution <br>";
      //echo $sql8;
      $db->exec($sql31);
      $db->exec($sql32);
      $db->exec($sql33);
      $db->exec($sql34);
      
      $pramCount = 0;
      $db->close();

       echo '<script type="text/javascript">';  
echo 'window.location.href = "../configpartial/happy.php";';
echo '</script>';

    }else if($pramCount === 0){

      echo '<script type="text/javascript">';  
echo 'window.location.href = "../configpartial/sorry.php";';
echo '</script>';
      $db->close();

    }
}

 ?>

      </form>     
      </div>

      </div>
  



</div>
</div>
</div>

</body>
<script>

  function calculator() {

      var offsetCurrent = document.getElementById("dtenAmps").value;

      var maxCurrent = document.getElementById("dmaxAmps").value;

      var actualoffsetCurrent = document.getElementById("mtenAmps").value;

      var actualmaxCurrent = document.getElementById("mmaxAmps").value;

      document.getElementById("offset").value = offsetCurrent;
      //alert("hello world");
      var gain = ((actualmaxCurrent - actualoffsetCurrent) / (maxCurrent - offsetCurrent)).toFixed(3);
      var offset = offsetCurrent - (actualoffsetCurrent / gain ).toFixed(3);;
      
      document.getElementById("offset").value = offset;
      document.getElementById("gain").value = gain;
      //alert(gain);
  }

  </script>
