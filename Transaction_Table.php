<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Transfer statements</title>
    <style media="screen">
    body{
      font-family: sans-serif;
      font-size: 11pt;
      background-image: url(feelalive.jpg);
      background-size: cover;
      background-attachment: fixed;
    }

    table{
        width: 80%;
    }

    table, th, td{
      border: 1px solid black;
      border-collapse: collapse;
      opacity: 0.95;
    }
    th, td{
      padding: 10px;
      text-align: center;
    }

    #sheader{
      background-color: #a70000;
      color: white;
    }
    td:nth-child(even){
      background-color: #e8e8e8
    }
    td:nth-child(odd){
      background-color: white;
    }
    #header{
        background-color: #005cb7;
    }
    
    input{
        margin:auto;
        display:block;
        background: #005cb7;
        color: #fff;
        font-size: 18px;
        border-radius: 20px;
        border: none;
          outline: none;
          height: 40px;
          width: 320px;
    }
    
    input:hover{
        cursor: pointer;
        background: #036;
        color: #000;
    }

    </style>
  </head>
  <body>
  <?php
      $mydb = new mysqli('localhost','id9675187_ashish','hello','id9675187_credit') or die(mysqli_error($mydb));
      $result = $mydb->query("Select * from `transaction table`") or die($mydb->error);
    ?>
    <table align="center">
      <thead><td id="header" colspan="7"><h1>Transaction Table</h1></td></thead>
      <thead id="sheader">
        <tr>
          <th colspan="2">From User</th>
          <th colspan="2">To User</th>
          <th colspan="2">Credits</th>
        </tr>
      </thead>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td colspan="2"><?php echo $row['from_user']; ?></td>
            <td colspan="2"><?php echo $row['to_user']; ?></td>
            <td colspan="2"><?php echo $row['value']; ?></td>
          </tr>
        <?php endwhile; ?>
    </table><br>
    <form action="index.php">
      <input type="submit" name="go back" value = "Go Back"/>
    </form>
  </body>
</html>
