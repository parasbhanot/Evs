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
  <style>
    .rcorner1 {
  border-radius: 25px;
  border: 2px solid #fff; background-color: #fff; 
  padding: 20px; margin-top: 40px; margin-bottom: 20px;
  width: 1000px;
  height: 1525px;}
  </style>
 </head>


<body>
   <!--                                   SIDENAV 
  ===============================================================================================-->
<div class="wrap_navbar" style="min-height: 1560px;">
        <ul class="wrap_navbar_list">
          <li class="wrap_navbar_list_item"><h1>  DASHBOARD</h1></li>
          <li class="wrap_navbar_list_item" ><a href="" id="back_navbar">Home &#8594;</a></li>
          <li class="wrap_navbar_list_item" ><a href="../dashboard/dashboard.php">Config pages</a></li>
          <li class="wrap_navbar_list_item" ><a href="dropdown.php">Config Keys</a></li>
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

       <div class="wrap_content">
      <!--                                   CARD BODY
  ===============================================================================================-->
  
         <div class="rcorner1">
          <div id='cssmenu'>
           <ul>
             <li><h2>CONFIG-KEYS</h2></li>
             <li><img src="images/index1.png" style="float: right; margin-left: 500px;"></li>
           </ul>
          </div>
            <div class="tab-content col-md-12">
             <!--                                   CONFIG KEYS
  ===============================================================================================-->

              <form class="form-horizontal" id="config_form" name="configForm" method="post" >

               <?php
               
                 if ($_SERVER['REQUEST_METHOD'] === 'GET')
                   {
                    class MyDB extends SQLite3
                    {
                     function __construct()
                     {
                      $this->open("/home/launchApps/Apps/ChargerApps/sqlite/charger.db");
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
                           $value_2 = null;
           
                          while($row = $ret->fetchArray(SQLITE3_ASSOC))
                           {

                             if (
                               ($row['key'] === 'ClockAlignedDataInterval') ||
                               ($row['key'] === 'GetConfigurationMaxKeys') ||
                               ($row['key'] === 'LightIntensity') ||
                               ($row['key'] === 'BlinkRepeat') ||
                               ($row['key'] === 'MaxEnergyOnInvalidId') ||
                               ($row['key'] === 'MeterValuesAlignedData') ||
                               ($row['key'] === 'MeterValuesAlignedDataMaxLength') ||
                               ($row['key'] === 'MeterValuesSampledData') ||
                               ($row['key'] === 'MeterValuesSampledDataMaxLength') ||
                               ($row['key'] === 'MinimumStatusDuration') ||
                               ($row['key'] === 'fwdir') ||
                               ($row['key'] === 'StopTxnAlignedData') ||
                               ($row['key'] === 'StopTxnAlignedDataMaxLength') ||
                               ($row['key'] === 'StopTxnSampledData') ||
                               ($row['key'] === 'StopTxnSampledDataMaxLength') ||
                               ($row['key'] === 'SupportedFeatureProfiles') ||

                               ($row['key'] === 'SupportedFeatureProfilesMaxLength') ||
                               ($row['key'] === 'TransactionMessageAttempts') ||
                               ($row['key'] === 'TransactionMessageRetryInterval') ||
                               ($row['key'] === 'WebSocketPingInterval') ||
                               ($row['key'] === 'LocalAuthListMaxLength') ||
                               ($row['key'] === 'SendLocalListMaxLength') ||
                               ($row['key'] === 'ChargeProfileMaxStackLevel') ||
                               ($row['key'] === 'ChargingScheduleAllowedChargingRateUnit') ||
                               ($row['key'] === 'ChargingScheduleMaxPeriods') ||
                               ($row['key'] === 'ocppserver') ||
                               ($row['key'] === 'customserver') ||
                               ($row['key'] === 'DCMeter2') ||
                               ($row['key'] === 'MeterValueSampleInterval') ||
         
         
                               ($row['key'] === 'ConnectionTimeOut') ||
                               ($row['key'] === 'HeartBeatInterval') ||
                               ($row['key'] === 'listVersion') ||
                               ($row['key'] === 'fwd_retrivedate') ||
                               ($row['key'] === 'fwd_retryinterval') ||
                               ($row['key'] === 'fwd_location') ||
                               ($row['key'] === 'ResetRetries') ||
                               ($row['key'] === 'defaultTag') ||
                               ($row['key'] === 'DCMeter1') ||
                               ($row['key'] === 'NumberOfConnectors') ||
                               ($row['key'] === 'ReserveConnectorZeroSupported')
                                )
     
                               {
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

              <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key_1.'</div>'?>
              </label>
              <div class="col-sm-3">
              <?php echo "<input type=\"text\" name=\"".$key_1."\" value=\"".$value_1."\" placeholder=\"Enter Value\" class=\"form-control\" style=\"font-family:Poppins-Regular font-size: 15px\">"; ?>
               </div>

               <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key_2.'</div>'?>
               </label>
               <div class="col-sm-3">
               <?php echo "<input type=\"text\" name=\"".$key_2."\" value=\"".$value_2."\" placeholder=\"Enter Value\" class=\"form-control\" style=\"font-family:Poppins-Regular font-size: 15px\">"; ?>
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
while($row = $ret->fetchArray(SQLITE3_ASSOC))
             {
       if ($row['key'] === 'UnlockConnectorOnEVSideDisconnect') {
        $key1=$row['key'];
        $value1=$row['value'];
         }
      if ($row['key'] === 'LocalAuthListEnabled') {
        $key2=$row['key'];
        $value2=$row['value'];
        }
      if ($row['key'] === 'StopTransactionOnEVSideDisconnect') {
        $key3=$row['key'];
        $value3=$row['value'];
      }if ($row['key'] === 'AuthorizationCacheEnabled') {
        $key4=$row['key'];
        $value4=$row['value'];
      }if ($row['key'] === 'StopButtoninFreeMode') {
        $key5=$row['key'];
        $value5=$row['value'];
      }if ($row['key'] === 'LocalPreAuthorize') {
        $key6=$row['key'];
        $value6=$row['value'];
      }if ($row['key'] === 'StopTransactionOnInvalidId') {
        $key7=$row['key'];
        $value7=$row['value'];
      }if ($row['key'] === 'AllowOfflineTxForUnknownId') {
        $key8=$row['key'];
        $value8=$row['value'];
      }if ($row['key'] === 'FreeMode') {
        $key9=$row['key'];
        $value9=$row['value'];
      }if ($row['key'] === 'LocalAuthorizeOffline') {
        $key10=$row['key'];
        $value10=$row['value'];
      }if ($row['key'] === 'fwd_retries') {
        $key11=$row['key'];
        $value11=$row['value'];

      }if ($row['key'] === 'ocppen') {
        $key12=$row['key'];
        $value12=$row['value'];
        
      }


}?>
<div class="form-group">
  <hr>
          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key1.'</div>'?>
          </label>
          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="UnlockConnectorOnEVSideDisconnect">
              <option value="<?php echo $value1; ?>" selected="selected"><?php echo $value1;?></option>
              <option value="<?php if($value1=='0'){echo "1";} else {echo "0";}?>"> <?php if($value1=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key2.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="LocalAuthListEnabled">
              <option value="<?php echo $value2;?>" selected="selected"><?php echo $value2;?></option>
              <option value="<?php if($value2=='0'){echo "1";} else {echo "0";}?>"> <?php if($value2=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key3.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="StopTransactionOnEVSideDisconnect">
              <option value="<?php echo $value3;?>" selected="selected"><?php echo $value3;?></option>
              <option value="<?php if($value3=='0'){echo "1";} else {echo "0";}?>"> <?php if($value3=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key4.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="AuthorizationCacheEnabled">
              <option value="<?php echo $value4;?>" selected="selected"><?php echo $value4;?></option>
              <option value="<?php if($value4=='0'){echo "1";} else {echo "0";}?>"> <?php if($value4=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key5.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="StopButtoninFreeMode">
              <option value="<?php echo $value5;?>" selected="selected"><?php echo $value5;?></option>
              <option value="<?php if($value5=='0'){echo "1";} else {echo "0";}?>"> <?php if($value5=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key6.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="LocalPreAuthorize">
              <option value="<?php echo $value6;?>" selected="selected"><?php echo $value6;?></option>
              <option value="<?php if($value6=='0'){echo "1";} else {echo "0";}?>"> <?php if($value6=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key7.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="StopTransactionOnInvalidId">
              <option value="<?php echo $value7;?>" selected="selected"><?php echo $value7;?></option>
              <option value="<?php if($value7=='0'){echo "1";} else {echo "0";}?>"> <?php if($value7=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key8.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="AllowOfflineTxForUnknownId">
              <option value="<?php echo $value8;?>" selected="selected"><?php echo $value8;?></option>
              <option value="<?php if($value8=='0'){echo "1";} else {echo "0";}?>"> <?php if($value8=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key9.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="FreeMode">
              <option value="<?php echo $value9;?>" selected="selected"><?php echo $value9;?></option>
              <option value="<?php if($value9=='0'){echo "1";} else {echo "0";}?>"> <?php if($value9=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key10.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="LocalAuthorizeOffline">
              <option value="<?php echo $value10;?>" selected="selected"><?php echo $value10;?></option>
              <option value="<?php if($value10=='0'){echo "1";} else {echo "0";}?>"> <?php if($value10=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key11.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="fwd_retries">
              <option value="<?php echo $value11;?>" selected="selected"><?php echo $value11;?></option>
              <option value="<?php if($value11=='0'){echo "1";} else {echo "0";}?>"> <?php if($value11=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

          <label class="col-sm-3 control-label" for="textinput" style="text-align: left" style="margin-bottom: 10px" ><?php echo '<div style="color:#808080;font-family: Poppins-Regular;font-size: 15px;">'.$key12.'</div>'?>
          </label>

          <div class="col-sm-3" style="margin-bottom: 15px;">
              <select class="form-control" name="ocppen">
              <option value="<?php echo $value12;?>" selected="selected"><?php echo $value12;?></option>
              <option value="<?php if($value12=='0'){echo "1";} else {echo "0";}?>"> <?php if($value12=='0'){echo "1";} else {echo "0";}?></option>
            </select>
          </div>

    </div>
          

      <?php         
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
          $this->open("/home/launchApps/Apps/ChargerApps/sqlite/charger.db");
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


      $a1 ="";
        $b1="";
      $c1 ="";
        $d1 ="";
      $e1 ="";
        $f1 ="";
      $g1 ="";
        $h1 ="";
      $i1 ="";
        $j1 ="";
      $k1 ="";
        $l1 ="";
      $m1 ="";
      $n1 ="";
      $o1 ="";
      $p1 ="";

       $q ="";
        $r ="";
      $s ="";
        $t ="";
      $u ="";
        $v ="";
      $w ="";
        $x ="";
      $y ="";
        $z ="";
      $aa ="";
        $bb ="";
      $cc ="";
      $dd ="";
      $ee ="";
      $ff ="";


      $gg ="";
      $hh ="";
      $ii ="";
      $jj ="";
      $kk ="";
      $ll ="";
      $mm ="";
      $nn ="";
      $oo ="";
      $pp ="";
      $qq ="";
      $rr ="";
      $ss ="";
      $tt ="";
      $uu ="";
      $vv ="";
      $ww ="";
      $xx ="";
      $yy ="";
      $zz ="";

      $sqlb ="replace into keys(key , value) VALUES (";
      $sqle =");";
      $pramCount = 0;

      if(isset($_POST["ClockAlignedDataInterval"])){

        $a1 = $_POST["ClockAlignedDataInterval"];
        //echo $a1;
        $pramCount++;
      }


      if(isset($_POST["GetConfigurationMaxKeys"])){

        $b1 = $_POST["GetConfigurationMaxKeys"];
        //echo $b1;
        $pramCount++;
      }

      if(isset($_POST["LightIntensity"])){

        $c1 =  $_POST["LightIntensity"];
        //echo $c1;
        $pramCount++;
      }

      if(isset($_POST["BlinkRepeat"])){

        $d1 =  $_POST["BlinkRepeat"];
        //echo $d1;
        $pramCount++;
      }


      if(isset($_POST["MaxEnergyOnInvalidId"])){

        $e1 =  $_POST["MaxEnergyOnInvalidId"];
        //echo $e1;
        $pramCount++;
      }


      if(isset($_POST["MeterValuesAlignedData"])){

        $f1 =  $_POST["MeterValuesAlignedData"];
        //echo $f1;
        $pramCount++;

      }


      if(isset($_POST["MeterValuesAlignedDataMaxLength"])){

        $g1 =  $_POST["MeterValuesAlignedDataMaxLength"];
        //echo $g1;
        $pramCount++;
      }


      if(isset($_POST["MeterValuesSampledData"])){

        $h1 =  $_POST["MeterValuesSampledData"];
        //echo $h1;
        $pramCount++;
      }

      if(isset($_POST["MeterValuesSampledDataMaxLength"])){

        $i1 =  $_POST["MeterValuesSampledDataMaxLength"];
        //echo $i1;
        $pramCount++;
      }

      if(isset($_POST["MinimumStatusDuration"])){

        $j1 = $_POST["MinimumStatusDuration"];
        //echo $j1;
        $pramCount++;
      }

      if(isset($_POST["fwdir"])){

        $k1 =  $_POST["fwdir"];
        //echo $k1;
        $pramCount++;
      }


      if(isset($_POST["StopTxnAlignedData"])){

        $l1 =  $_POST["StopTxnAlignedData"];
        //echo $l1;
        $pramCount++;
      }

      if(isset($_POST["StopTxnAlignedDataMaxLength"])){

        $m1 =  $_POST["StopTxnAlignedDataMaxLength"];
        //echo $m1;
        $pramCount++;
      }

      if(isset($_POST["StopTxnSampledDataMaxLength"])){

        $n1 =  $_POST["StopTxnSampledDataMaxLength"];
        //echo $n1;
        $pramCount++;
      }

      if(isset($_POST["SupportedFeatureProfiles"])){

        $o1 =  $_POST["SupportedFeatureProfiles"];
        //echo $o1;
        $pramCount++;
      }

      if(isset($_POST["StopTxnSampledData"])){

        $p1=  $_POST["StopTxnSampledData"];
        //echo $p1;
        $pramCount++;
      }

 if(isset($_POST["MeterValueSampleInterval"])){

        $q = $_POST["MeterValueSampleInterval"];
        //echo $q;
        $pramCount++;
      }


      if(isset($_POST["TransactionMessageAttempts"])){

        $r = $_POST["TransactionMessageAttempts"];
        //echo $r;
        $pramCount++;
      }

      if(isset($_POST["TransactionMessageRetryInterval"])){

        $s =  $_POST["TransactionMessageRetryInterval"];
        //echo $s;
        $pramCount++;
      }

      

      if(isset($_POST["WebSocketPingInterval"])){

        $t =  $_POST["WebSocketPingInterval"];
        //echo $t;
        $pramCount++;
      }



      if(isset($_POST["LocalAuthListMaxLength"])){

        $u =  $_POST["LocalAuthListMaxLength"];
        //echo $u;
        $pramCount++;
      }


      if(isset($_POST["SendLocalListMaxLength"])){

        $v =  $_POST["SendLocalListMaxLength"];
        //echo $v;
        $pramCount++;
      }

  
      if(isset($_POST["ChargeProfileMaxStackLevel"])){

        $w = $_POST["ChargeProfileMaxStackLevel"];
        //echo $w;
        $pramCount++;
      }

      if(isset($_POST["ChargingScheduleAllowedChargingRateUnit"])){

        $x =  $_POST["ChargingScheduleAllowedChargingRateUnit"];
        //echo $x;
        $pramCount++;
      }


      if(isset($_POST["ChargingScheduleMaxPeriods"])){

        $y =  $_POST["ChargingScheduleMaxPeriods"];
        //echo $y;
        $pramCount++;
      }

      if(isset($_POST["ocppserver"])){

        $z =  $_POST["ocppserver"];
        //echo $z;
        $pramCount++;
      }

      if(isset($_POST["customserver"])){

        $aa =  $_POST["customserver"];
        //echo $aa;
        $pramCount++;
      }

      if(isset($_POST["DCMeter2"])){

        $bb =  $_POST["DCMeter2"];
        //echo $bb;
        $pramCount++;
      }

      if(isset($_POST["SupportedFeatureProfilesMaxLength"])){

        $cc=  $_POST["SupportedFeatureProfilesMaxLength"];
        //echo $cc;
        $pramCount++;
      }



      if(isset($_POST["HeartBeatInterval"])){

        $dd =  $_POST["HeartBeatInterval"];
        //echo $dd;
        $pramCount++;
      }


      if(isset($_POST["ConnectionTimeOut"])){

        $ee =  $_POST["ConnectionTimeOut"];
        //echo $ee;
        $pramCount++;
      }



      if(isset($_POST["listVersion"])){

        $ff =  $_POST["listVersion"];
        //echo $ff;
        $pramCount++;
      }

      if(isset($_POST["fwd_retrivedate"])){

        $gg =  $_POST["fwd_retrivedate"];
        //echo $gg;
        $pramCount++;
      }

      if(isset($_POST["fwd_retryinterval"])){

        $hh = $_POST["fwd_retryinterval"];
        //echo $hh;
        $pramCount++;
      }

      if(isset($_POST["fwd_location"])){

        $ii =  $_POST["fwd_location"];
        //echo $ii;
        $pramCount++;
      }


      if(isset($_POST["ResetRetries"])){

        $jj =  $_POST["ResetRetries"];
        //echo $jj;
        $pramCount++;
      }

      if(isset($_POST["defaultTag"])){

        $kk =  $_POST["defaultTag"];
        //echo $kk;
        $pramCount++;
      }

      if(isset($_POST["DCMeter1"])){

        $ll =  $_POST["DCMeter1"];
        //echo $ll;
        $pramCount++;
        
      }

      if(isset($_POST["NumberOfConnectors"])){

        $mm =  $_POST["NumberOfConnectors"];
        //echo $mm;
        $pramCount++;
      }

      if(isset($_POST["ReserveConnectorZeroSupported"])){

        $nn =  $_POST["ReserveConnectorZeroSupported"];
        //echo $nn;
        $pramCount++;
        //echo $pramCount;
      }
      if(isset($_POST["UnlockConnectorOnEVSideDisconnect"])){

        $oo =  $_POST["UnlockConnectorOnEVSideDisconnect"];
        //echo $oo;
        $pramCount++;
        //echo $pramCount;
       // echo $pramCount;
      }

      if(isset($_POST["LocalAuthListEnabled"])){

        $pp =  $_POST["LocalAuthListEnabled"];
        echo $pp;
        $pramCount++;
        echo $pramCount;
      }

      if(isset($_POST["StopTransactionOnEVSideDisconnect"])){

        $qq =  $_POST["StopTransactionOnEVSideDisconnect"];
        echo $qq;
        $pramCount++;

      }

      if(isset($_POST["AuthorizationCacheEnabled"])){

        $rr =  $_POST["AuthorizationCacheEnabled"];
       echo $rr;
        $pramCount++;
      }

      if(isset($_POST["StopButtoninFreeMode"])){

        $ss =  $_POST["StopButtoninFreeMode"];
        echo $ss;
        $pramCount++;
      }

      if(isset($_POST["LocalPreAuthorize"])){

        $tt =  $_POST["LocalPreAuthorize"];
        echo $tt;
        $pramCount++;
      }
      if(isset($_POST["StopTransactionOnInvalidId"])){

        $uu =  $_POST["StopTransactionOnInvalidId"];
        echo $uu;
        $pramCount++;
      }
      if(isset($_POST["AllowOfflineTxForUnknownId"])){

        $vv =  $_POST["AllowOfflineTxForUnknownId"];
       echo $vv;
        $pramCount++;
      }
      if(isset($_POST["FreeMode"])){

        $ww =  $_POST["FreeMode"];
        echo $ww;
        $pramCount++;
      }
      if(isset($_POST["LocalAuthorizeOffline"])){

        $xx =  $_POST["LocalAuthorizeOffline"];
        echo $xx;
        $pramCount++;
      }
      if(isset($_POST["fwd_retries"])){

        $yy =  $_POST["fwd_retries"];
       echo $yy;
        $pramCount++;
      }
      if(isset($_POST["ocppen"])){

        $zz =  $_POST["ocppen"];
        echo $zz;
        $pramCount++;
      }
      //echo $pramCount;


    $sql17 =    $sqlb."'ClockAlignedDataInterval',"."'".$a1."'".$sqle;
    $sql18 =    $sqlb."'GetConfigurationMaxKeys',"."'".$b1."'".$sqle;
    $sql19 =    $sqlb."'LightIntensity',"."'".$c1."'".$sqle;
    $sql20 =    $sqlb."'BlinkRepeat',"."'".$d1."'".$sqle;
    $sql21 =    $sqlb."'MaxEnergyOnInvalidId',"."'".$e1."'".$sqle;
    $sql22 =    $sqlb."'MeterValuesAlignedData',"."'".$f1."'".$sqle;
    $sql23 =    $sqlb."'MeterValuesAlignedDataMaxLength',"."'".$g1."'".$sqle;
    $sql24 =    $sqlb."'MeterValuesSampledData',"."'".$h1."'".$sqle;
    $sql25 =    $sqlb."'MeterValuesSampledDataMaxLength',"."'".$i1."'".$sqle;
    $sql26 =    $sqlb."'MinimumStatusDuration',"."'".$j1."'".$sqle;
    $sql27 =    $sqlb."'fwdir',"."'".$k1."'".$sqle;
    $sql28 =    $sqlb."'StopTxnAlignedData',"."'".$l1."'".$sqle;
    $sql29 =    $sqlb."'StopTxnAlignedDataMaxLength',"."'".$m1."'".$sqle;
    $sql30 =    $sqlb."'StopTxnSampledDataMaxLength',"."'".$n1."'".$sqle;
    $sql31 =    $sqlb."'SupportedFeatureProfiles',"."'".$o1."'".$sqle;
    $sql32 =    $sqlb."'StopTxnSampledData',"."'".$p1."'".$sqle;

     $sql33 =   $sqlb."'MeterValueSampleInterval',"."'".$q."'".$sqle;
    $sql34 =    $sqlb."'TransactionMessageAttempts',"."'".$r."'".$sqle;
    $sql35 =    $sqlb."'TransactionMessageRetryInterval',"."'".$s."'".$sqle;
    $sql36 =    $sqlb."'WebSocketPingInterval',"."'".$t."'".$sqle;
    $sql37 =    $sqlb."'LocalAuthListMaxLength',"."'".$u."'".$sqle;
    $sql38 =    $sqlb."'SendLocalListMaxLength',"."'".$v."'".$sqle;
    $sql39 =    $sqlb."'ChargeProfileMaxStackLevel',"."'".$w."'".$sqle;
    $sql40 =    $sqlb."'ChargingScheduleAllowedChargingRateUnit',"."'".$x."'".$sqle;
    $sql41 =    $sqlb."'ChargingScheduleMaxPeriods',"."'".$y."'".$sqle;
    $sql42 =    $sqlb."'ocppserver',"."'".$z."'".$sqle;
    $sql43 =    $sqlb."'customserver',"."'".$aa."'".$sqle;
    $sql44 =    $sqlb."'DCMeter2',"."'".$bb."'".$sqle;
    $sql45 =    $sqlb."'SupportedFeatureProfilesMaxLength',"."'".$cc."'".$sqle;

    $sql46 =    $sqlb."'HeartBeatInterval',"."'".$dd."'".$sqle;
    $sql47 =    $sqlb."'ConnectionTimeOut',"."'".$ee."'".$sqle;
    $sql48 =    $sqlb."'listVersion',"."'".$ff."'".$sqle;
    $sql49 =    $sqlb."'fwd_retrivedate',"."'".$gg."'".$sqle;
    $sql50 =    $sqlb."'fwd_retryinterval',"."'".$hh."'".$sqle;
    $sql51 =    $sqlb."'fwd_location',"."'".$ii."'".$sqle;
    $sql52 =    $sqlb."'ResetRetries',"."'".$jj."'".$sqle;
    $sql53 =    $sqlb."'defaultTag',"."'".$kk."'".$sqle;
    $sql54 =    $sqlb."'DCMeter1',"."'".$ll."'".$sqle;
    $sql55 =    $sqlb."'NumberOfConnectors',"."'".$mm."'".$sqle;
    $sql56 =    $sqlb."'ReserveConnectorZeroSupported',"."'".$nn."'".$sqle;

    $sql57 =    $sqlb."'UnlockConnectorOnEVSideDisconnect',"."'".$oo."'".$sqle;
    $sql58 =    $sqlb."'LocalAuthListEnabled',"."'".$pp."'".$sqle;
    $sql59 =    $sqlb."'StopTransactionOnEVSideDisconnect',"."'".$qq."'".$sqle;
    $sql60 =    $sqlb."'AuthorizationCacheEnabled',"."'".$rr."'".$sqle;
    $sql61 =    $sqlb."'StopButtoninFreeMode',"."'".$ss."'".$sqle;
    $sql62 =    $sqlb."'LocalPreAuthorize',"."'".$tt."'".$sqle;
    $sql63 =    $sqlb."'StopTransactionOnInvalidId',"."'".$uu."'".$sqle;
    $sql64 =    $sqlb."'AllowOfflineTxForUnknownId',"."'".$vv."'".$sqle;
    $sql65 =    $sqlb."'FreeMode',"."'".$ww."'".$sqle;
    $sql66 =    $sqlb."'LocalAuthorizeOffline',"."'".$xx."'".$sqle;
    $sql67 =    $sqlb."'fwd_retries',"."'".$yy."'".$sqle;
    $sql68 =    $sqlb."'ocppen',"."'".$zz."'".$sqle;
    //
    //echo $sql57;


    if($pramCount === 52 ){

      //echo "Before execution <br>";
      //echo $sql8;
      $db->exec($sql17);
      $db->exec($sql18);
      $db->exec($sql19);
      $db->exec($sql20);
      $db->exec($sql21);
      $db->exec($sql22);
      $db->exec($sql23);
      $db->exec($sql24);
      $db->exec($sql25);
      $db->exec($sql26);
      $db->exec($sql27);
      $db->exec($sql28);
      $db->exec($sql29);
      $db->exec($sql30);
      $db->exec($sql31);
      $db->exec($sql32);

       $db->exec($sql33);
      $db->exec($sql34);
      $db->exec($sql35);
      $db->exec($sql36);
      $db->exec($sql37);
      $db->exec($sql38);
      $db->exec($sql39);
      $db->exec($sql40);
      $db->exec($sql41);
      $db->exec($sql42);
      $db->exec($sql43);
      $db->exec($sql44);
      $db->exec($sql45);
      $db->exec($sql46);
      $db->exec($sql47);
      $db->exec($sql48);

      $db->exec($sql49);
      $db->exec($sql50);
      $db->exec($sql51);
      $db->exec($sql52);
      $db->exec($sql53);
      $db->exec($sql54);
      $db->exec($sql55);
      $db->exec($sql56);
      $db->exec($sql57);
      $db->exec($sql58);
      $db->exec($sql59);
      $db->exec($sql60);
      $db->exec($sql61);
      $db->exec($sql62);
      $db->exec($sql63);
      $db->exec($sql64);
      $db->exec($sql65);
      $db->exec($sql66);
      $db->exec($sql67);
      $db->exec($sql68);
      

      $pramCount = 0;
      $db->close();




       echo '<script type="text/javascript">';  
echo 'window.location.href = "happy.php";';
echo '</script>';

    }else if($pramCount === 0){

      echo '<script type="text/javascript">';  
echo 'window.location.href = "sorry.php";';
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

</body>
</html>