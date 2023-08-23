<?php
    $supID = "";
    $companyName = "";
    $remember = "no";
    $error = false;
    $loginOK = null;

    if(isset($_POST["submit"])){
        if(isset($_POST["supplierID"])) $supID = $_POST["supplierID"];
        if(isset($_POST["companyName"])) $companyName = $_POST["companyName"];
        if(isset($_POST["remember"])) $remember = $_POST["remember"];

        //echo ($username.".".$password.".".$remember);
        if(empty($supID) || empty($companyName)) {
            $error=true;
        }

        //set cookies for remembering the username
        if(!empty($companyName) && $remember == "yes") {
            setcookie("companyName", $companyName, time()+60*60*24*2, "/");
        }

        if(!$error){
            //check username and password with the database record
            require_once("hw13q1db.php");
            $sql = "select SupplierID from suppliers where CompanyName='$companyName'";
            $result = $mydb->query($sql);
    
            $row=mysqli_fetch_array($result);

            if ($row){
                if(strcmp($supID, $row["SupplierID"]) == 0 ){
                    $loginOK= true;
                } else {
                    $loginOK = false;
                }
            }

            if($loginOK) {
                //set session variable to remember the username
                session_start();
                $_SESSION["companyName"] = $companyName;
                $_SESSION["supplierID"] = $supID;
        
                Header("Location:hw13q1afterLogin.php");
            }
        }
    }
?>

<!doctype html>

<html>
    <head>
        <title>
            Supplier Login
        </title>

        <style>
            .errlabel {
                color: red
            }
        </style>

    </head>

    <body>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

            <h2>Supplier Login Portal</h2>
            <br>

            <label> Company Name: </label>
            <input type="text" name = "companyName" value = "<?php 
                if(!empty($companyName)) 
                    echo $companyName; 
                else if(isset($_COOKIE['companyName'])) {
                    echo $_COOKIE['companyName'];
                }
                ?>" /><?php if($error && empty($companyName)) echo "<span class='errlabel'> Please enter a company name</span>"; ?>
            <br><br>

            <label>Supplier ID: </label>
            <input type="number" name = "supplierID" value = "<?php 
                if(!empty($supID)) 
                    echo $supID; 
                ?>" /><?php if($error && empty($supID)) echo "<span class='errlabel'> Please enter a supplier ID</span>"; ?>
            <br><br>

            <input type="checkbox" name="remember" value="yes"/><label>Remember me</label></td>
            <br><br>

            <?php if(!is_null($loginOK) && $loginOK == false) echo "<span class='errlabel'>Supplier ID and company name do not match.</span>"; ?><br>

            <input type="submit" name="submit" value="Login" />

        </form>
    </body>
</html>