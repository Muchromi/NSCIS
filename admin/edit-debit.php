<?php
    error_reporting(E_ALL | E_WARNING | E_NOTICE);
    ini_set('display_errors', TRUE);
   
      // Initialize the session
      session_start();
    
      // If session variable is not set it will redirect to login page
      if(!isset($_SESSION['id_member']) || empty($_SESSION['id_member'])){
        header("location:login.php");
        exit;
      }
      
    include_once('../include/header-admin.php');
?>

<div class="row">
    <div class="column side">

    </div>

    <div class="column middle">
        <h2>Debit Form</h2>
        <p>Please fill in your Debit in the following form</p>

        <div class="container">
            <form action="#">

            <!--date-->
            <div class="row">
                <div class="col-25">
                    <label for="date">Date</label>
                </div>
                <div class="col-75">
                    <input type="text" id="tbDate" name="date" placeholder="Date....">
                </div>
            </div>
                        
            <!--debit-->
            <div class="row">
                <div class="col-25">
                    <label for="debit">Debit</label>
                </div>
                <div class="col-75">
                    <input type="text" id="dengan-rupiah" name="debit" placeholder="Debit....">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="description">Description</label>    
                </div>
                <div class="col-75">
                    <textarea id="description" name="description" placeholder="Write Something.." style="height:200px"></textarea>
                </div>
            </div>
            
            <div class="row">
                <input type="submit" value="Submit">
            </div>
            </form>
        </div>
    </div>
    <div class="column side">

    </div>
</div>

<?php
    include_once('../include/footer.php');
?>