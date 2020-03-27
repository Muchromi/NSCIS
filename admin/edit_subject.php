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
    $title = 'Edit Subject';


    $id_subject = $subject ='';
    $id_subjecterr = $subjecterr ='';
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];

        //subject
        if (empty(trim($_POST['subject']))) {
          $subjecterr = "please fill in the subject";
        }else {
          $subject = trim($_POST['subject']);
        }

        //id_subject
        if (empty(trim($_POST['id_subject']))) {
          $id_subjecterr = "please fill in the id_subject";
        }else {
          $id_subject = trim($_POST['id_subject']);
        }
      
        if (!empty($subject)) {
          $sql = 'UPDATE subject SET ';          
          $sql .= "id_subject = '{$id_subject}', subject = '{$subject}' ";
          $sql .= "WHERE id_subject = '{$id}'";
          $result = mysqli_query($mysqli, $sql);
      
          if (!$result) {
            die(mysqli_error($mysqli));
          }
        header('Location: subject-matrial.php');
      }

    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM subject WHERE id_subject = '{$id} '";
    $result = mysqli_query($mysqli, $sql);
    if (!$result) die('Error: Data not Available');

    $data = mysqli_fetch_array($result);

    function is_select($var, $val) {
      if ($var == $val) return 'selected="selected"';
      return false;
    }
    include_once('../include/header-admin.php');
?>

<div class="row">
      <div class="column side">

      </div>

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
                    <input type="text" id="id_subject" value="<?php echo $data['id_subject'] ?>" name="id_subject" placeholder="Your subject..">
                    <span class="error"><?php echo $id_subjecterr; ?></span>
                    </div>
            </div>
            <!---subject --->
            <div class="row">
                    <div class="col-25">
                    <label for="subject">Subject</label>
                    </div>
                    <div class="col-75">
                    <input type="text" id="subject" value="<?php echo $data['subject'] ?>" name="subject" placeholder="Your subject..">
                    <span class="error"><?php echo $subjecterr; ?></span>
                    </div>
            </div>

              <div class="row">
                <input type="hidden" name="id" value="<?php echo $data['id_position'];?>" >
                <input type="submit" name="submit" value="Edit" value="Submit">
              </div>
              </form>
            </div>
      </div>
      <div class="column side">

        </div>
  </div>