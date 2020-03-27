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
    $title = 'Edit Position';


    $position = $jobdesc ='';
    $positionerr = $jobdescerr ='';
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        //position
        if (empty(trim($_POST['position']))) {
          $positionerr = "please fill in the position";
        }else {
          $position = trim($_POST['position']);
        }
    
        // job description
        if (empty(trim($_POST['jobdesc']))) {
          $jobdescerr = "please fill in the jobdesc";
        }else {
          $jobdesc = trim($_POST['jobdesc']);
        }
      
        if (!empty($position) && !empty($jobdesc)) {
          $sql = 'UPDATE position SET ';          
          $sql .= "position_name = '{$position}', job_desc = '{$jobdesc}' ";
          $sql .= "WHERE id_position = '{$id}'";
          $result = mysqli_query($mysqli, $sql);
      
          if (!$result) {
            die(mysqli_error($mysqli));
          }
        header('Location: position.php');
      }

    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM position WHERE id_position = '{$id} '";
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
            <form action="edit-position.php" method="post" enctype="multipart/form-data">
            
              <!-- position -->
              <div class="row">
                <div class="col-25">
                  <label for="position">Position</label>
                </div>
                <div class="col-75">
                  <input type="text" id="position" value="<?php echo $data['position_name'] ?>" name="position" placeholder="Your position..">
                  <span class="error"><?php echo $positionerr; ?></span>
                </div>
              </div>

              <!-- address -->
              <div class="row">
                <div class="col-25">
                  <label for="jobdesc">Job Description</label>
                </div>
                <div class="col-75">
                  <textarea id="address" name="jobdesc" placeholder="Write something.." style="height:200px">
                  <?php echo $data['job_desc'];?>
                  </textarea>
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