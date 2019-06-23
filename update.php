<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Transfer credit</title>
    <style media="screen">
      body{
        font-family: sans-serif;
        font-size: 11pt;
        background-image: url(feelalive.jpg);
        background-size: cover;
        background-attachment: fixed;
      }

    .detailsbox{
      width: 320px;
      height: 470px;
      background: #000;
      color: #fff;
      top:50%;
      left:50%;
      position: absolute;
      transform: translate(-50%,-50%);
      box-sizing: border-box;
      padding: 70px 30px;
    }

    h1{
        margin: 0;
        padding: 0 0 40px;
        text-align: center;
        font-size: 28px;
    }

    .detailsbox p{
      margin: 0;
      padding: 0;
      font-weight: bold;
    }

    .detailsbox input, select{
      width: 100%;
      margin-bottom: 20px;
    }

    .detailsbox input[type="submit"]{
      border: none;
      outline: none;
      height: 40px;
      background: #005cb7;
      color: #fff;
      font-size: 18px;
      border-radius: 20px;
    }

    .detailsbox select{
        background: #000;
        border: none;
        height: 40px;
        outline: none;
        font-size: 16px;
        color: #fff;
    }

    .detailsbox input[type="number"], input[type="text"]{
        background: #000;
        border: none;
        border-bottom: 1px solid #fff;
        outline:none;
        height: 40px;
        font-size: 16px;
        color: #fff;
    }

    .detailsbox input[type="submit"]:hover{
        cursor: pointer;
        background: #036;
        color: #000;
    }

    </style>
  </head>
  <body>
        <?php
    $mydb = new mysqli('localhost','id9675187_ashish','hello','id9675187_credit') or die(mysqli_error($mydb));
    $result = $mydb->query("SELECT * FROM `User table`") or die($mydb->error);
    ?>
      <div class="detailsbox">
    <h1>Transfer Credits</h1>
    <?php 
        $Users = $_GET['Users'];
    ?>
    <form method="POST">
      <p>From User</p>
        <input type="text" value="<?php echo $Users ?>" name="from_user">
      <p>To User</p>
        <select name="to_user">
          <?php
            while($row = $result->fetch_assoc()) {
                if($row['Users'] != $Users){
                $id = $row['id'];
                $User = $row['Users'];
                echo "<option value='$User'>$User</option>";
                }
            }
          ?>
        </select>
      <p>Credit Amount</p>
      <input type="number" name="credit_amt" min="1" max="1000">
      <input type="submit" name="submit">
    </form>
    <a href="index.php">Go back to view users?</a>
  </div>
    <?php
    //$from_user = $_POST['from_user'];
    
    if(isset($_POST['from_user']) || isset($_POST['to_user']) || isset($_POST['credit_amt'])){
      $credit_amt = $_POST['credit_amt'];
      $to_user = $_POST['to_user'];
      $from_user = $_POST['from_user'];
      $result = $mydb->query("SELECT * FROM `User table` WHERE Users = '$from_user' ") or die($mydb->error);
      $row = mysqli_fetch_array($result);
      $check = 0;
      if($credit_amt > 1000 || $row['current credit'] < $credit_amt)
      {
        echo "<script>alert('Balance not available')</script>";
        $check = 1;
      }
      if($check == 0){
      $mydb->query("UPDATE `User table` SET `current credit` = (`current credit`-$credit_amt)  WHERE Users='$from_user'") or die($mydb->error);
      $mydb->query("UPDATE `User table` SET `current credit` = ($credit_amt+`current credit`) WHERE Users='$to_user'") or die($mydb->error);
      $mydb->query("INSERT INTO `transaction table`(from_user,to_user,value) VALUES('$from_user','$to_user','$credit_amt')" )  or die($mydb->error);
    }
    }
    ?>
  </body>
</html>
