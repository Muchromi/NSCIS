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


    $idsubject = $nm_subject ='';
    $idsubjecterr = $nm_subjecterr ='';
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        //idsubject
        if (empty(trim($_POST['id_subject']))) {
          $idsubjecterr = "please fill in the idsubject";
        }else {
          $idsubject = trim($_POST['id_subject']);
        }
    
        // subject
        if (empty(trim($_POST['subject']))) {
          $nm_subjecterr = "please fill in the subject";
        }else {
          $nm_subject = trim($_POST['subject']);
        }
      
        if (!empty($idsubject) && !empty($nm_subject)) {
          $sql = 'UPDATE subject SET ';          
          $sql .= "id_subject = '{$idsubject}', subject = '{$nm_subject}' ";
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

      <div class="column middle">
          <h2>Position Form</h2>
          <p>please fill in your position in the following form</p>
          
          <div class="container">
            <form action="ed.php" method="post" enctype="multipart/form-data">
            
              <!-- position -->
              <div class="row">
                <div class="col-25">
                  <label for="idsubject">Position</label>
                </div>
                <div class="col-75">
                  <input type="text" id="idsubject" value="<?php echo $data['id_subject'] ?>" name="idsubject" placeholder="Your Subject Id..">
                  <span class="error"><?php echo $idsubjecterr; ?></span>
                </div>
              </div>

              <!-- address -->
              <div class="row">
                <div class="col-25">
                  <label for="nm_subject">Subject</label>
                </div>
                <div class="col-75">
                  <input type="text" id="nm_subject" value="<?php echo $data['subject'] ?>" name="nm_subject" placeholder="Your Subject..">
                  <span class="error"><?php echo $nm_subjecterr; ?></span>
                </div>
              </div>

              <div class="row">
                <input type="hidden" name="id" value="<?php echo $data['id_subject'];?>" >
                <input type="submit" name="submit" value="Edit" value="Submit">
              </div>
              </form>
            </div>
      </div>
      <div class="column side">

        </div>
  </div>