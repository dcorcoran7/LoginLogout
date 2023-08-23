<!doctype html>

<html>
<head>
  <title>After Login Page</title>
</head>
<body>
  <?php 
    //resume the session variable on this page
    session_start();
    date_default_timezone_set("America/New_York");

    $companyName = $_SESSION["companyName"];
    $supplierID = $_SESSION["supplierID"];
    $timestamp = date("l jS \of F Y h:i:s A");
    $greeting = "";

    if(Date("H:i:s") > "12:00:00") {
      $greeting = "Good Afternoon";
    }
    else {
      $greeting = "Good Morning";
    }

    echo "" .$greeting. ", " .$companyName. "! Please keep in mind that your supplier ID is " .$supplierID. ". Your last login time was " .$timestamp. "."
   
   ?>

   <p><a href="hwq13q1logout.php">Click here to log out</a></p>

</body>
</html>
