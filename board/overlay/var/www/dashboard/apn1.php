<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Calibration Status</title>
</head>
<style>
 
</style>

<body>


<?php
//echo "hello world";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

      //echo "This is post request";
      //echo "<br>";
      //echo "<br>";
	{
    //echo "This is post request";
   
      
      echo "<br>";
      echo "<br>";

      class MyDB2 extends SQLite3
      {
        function __construct()
        {
          $this->open("/home/launchApps/Apps/ChargerApps/sqlite/charger.db");
        }
      }
         $db = new MyDB2();

         if(!$db){
              echo "Could not open DB!!!";
        echo $db->lastErrorMsg();
         } else {
            //echo "Opened database successfully<br/>";
            echo "<br>";
         }


      $a ="";
      

      $sqlb ="replace into keys(key , value) VALUES (";
      $sqle =");";
      $pramCount = 0;

      if(isset($_POST["APN"])){

        $aaa = $_POST["APN"];
        //echo $a;
        $pramCount++;
      }


      

    $sql111 =     $sqlb."'APN',"."'".$aaa."'".$sqle;
    

    {

      //echo "Before execution <br>";
      //echo $sql8;
      $db->exec($sql111);
      

      
      
     if($pramCount ==1)
       {echo '<script type="text/javascript">';  
echo 'window.location.href = "../configpartial/happy.php";';
echo '</script>';}

    }
    $db->close();
}

       
  
            


  
        
  
   
  

}

?>

 </body>
</html>
