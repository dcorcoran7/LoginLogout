<!doctype html>

<html>
<head>
  <title>Log Out Page</title>
</head>
<body>
  <?php
    session_start();

    //unset($_SESSION["username"]);
    $companyName = $_SESSION["companyName"];
    $_SESSION = array();

    session_destroy();



    echo "<p>Goodbye, ".$companyName."</p>";
    echo "You have successfully logged out. Please <a href='hw13q1.php'>Click here to login again</a>";

  ?>


</body>
</html>