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
      
    include_once('../include/config.php');
    $title = 'add subject';
    
    $id_subject = $subject ='';
    $id_subjecterr = $subjecterr ='';
    if (isset($_POST['submit'])) {

        //subject
        if (empty(trim($_POST['subject']))) {
          $subjecterr = "please fill in the subject";
        }else {
          $subject = trim($_POST['subject']);
        }

        //id_subject
        if (empty(trim($_POST['id_subject']))) {
          $sid_ubjecterr = "please fill in the id_subject";
        }else {
          $id_subject = trim($_POST['id_subject']);
        }
     

        //insert to table
        if (!empty($subject)) {
          $sql = "INSERT INTO subject (subject, id_subject) VALUES ('{$subject}','{$id_subject}')";
          $result = mysqli_query($mysqli, $sql);
          

          if (!$result) {
            die(mysqli_error($mysqli));
          }
          
          header('Location: subject-matrial.php');
        }

    }
    include_once('../include/header-admin.php');


?>

<div class="row">
    <div class="column side"></div>
    <div class="column middle">
        <h2>Subject Form </h2>
        <p> Please fill in your subject in the following form </p>
    <div class="container">
        <form action="add-subject.php" method="post" enctype="multipart/form-data">

        <!---id_subject --->
        <div class="row">
                <div class="col-25">
                  <label for="id_subject">Subject ID</label>
                </div>
                <div class="col-75">
                  <input type="text" id="id_subject" value="<?php echo $id_subject; ?>" name="id_subject" placeholder="Your subject..">
                  <span class="error"><?php echo $id_subjecterr; ?></span>
                </div>
        </div>

        <!---subject --->
        <div class="row">
                <div class="col-25">
                  <label for="subject">Subject</label>
                </div>
                <div class="col-75">
                  <input type="text" id="subject" value="<?php echo $subject; ?>" name="subject" placeholder="Your subject..">
                  <span class="error"><?php echo $subjecterr; ?></span>
                </div>
        </div>


        <div class="row">
            <input type="submit" name="submit" value="Submit">
        </div>
            </form>
        </div>

    </div>
    <div class="column side"></div>

</div>

<br>
<br>
<br>

<?php
    include_once('../include/footer.php');
?>