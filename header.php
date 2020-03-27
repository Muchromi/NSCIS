<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- menampilkan icon pada title -->
    <link href="../nsc.jpg" rel="icon">

    <link rel="stylesheet" href="style/style.css" type="text/css" />
    <link rel= "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <script type= "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type= "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>
    <script>
    $(document).ready(function() {
        $('input[id$=tbDate]').datepicker({});
        $('input[id$=tbDate1]').datepicker({});
    });
    </script>

    <!-- printah untuk menampilkan title sesuai file -->
    <title><?php echo $title; ?></title>

</head>
<body>
    <div class="header">
        <img class="himg" src="nsc.jpg" style="width:150px">
        <p style="font-size: 1cm;"><b><u>NSCIS</u></b><br>Ngoding Study Club Information System</p>
    </div>

    <div class="topnav" id="myTopnav">
        <a href="index.php">Home</a>
        <a href="matrial.php">Matrial</a>
        <div class="dropdown">
            <button class="dropbtn">Finance <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="pay.php">Pay Cash</a>
                <a href="finance.php">Cash Finance</a>
            </div>
            </div>
            <a href="login.php" onclick="return confirm('Are you sure you want to logout?');" style="float: right">Logout</a>
            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
    </div>