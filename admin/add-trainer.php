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

    $title = 'Add Trainer';
    
    $id_trainer = $subject = $exp = $member_id = '';
    $id_trainererr = $subjecterr = $experr = $member_iderr = '';
    
    if (isset($_POST['submit'])) {

        //member
        if (empty(trim($_POST['member_id']))) {
            $member_iderr = "please fill in the member";
          }else {
            $member_id = trim($_POST['member_id']);
          }
        
        //subject
        if (empty(trim($_POST['subject']))) {
            $subjecterr = "please fill in the subject";
          }else {
            $subject = trim($_POST['subject']);
          }
     
        // experience
        if (empty(trim($_POST['experience']))) {
          $experr = "please fill in the experience";
        }else {
          $exp = trim($_POST['experience']);
        }
  
        //insert to table
        if (!empty($subject) && !empty($exp) && !empty($member_id)) {
          $sql = "INSERT INTO trainer (subject, experience, member_id) VALUES ('{$subject}','{$exp}','{$member_id}')";
          $result = mysqli_query($mysqli, $sql);
          

          if (!$result) {
            die(mysqli_error($mysqli));
          }
          
          header('Location: trainer.php');
        }

    }
    include_once('../include/header-admin.php');


?>

<div class="row">
    <div class="column side"></div>
    <div class="column middle">
        <h2>Trainer Form </h2>
        <p> Please fill in your trainer in the following form </p>
    <div class="container">
        <form action="add-trainer.php" method="post" enctype="multipart/form-data">

        <!-- member -->
        <div class="row">
                <div class="col-25">
                  <label for="majors">Trainer</label>
                </div>
                <div class="col-75">
                  <select id="member_id" name="member_id">
                  <option >---Choose Trainer---</option>
                    <?php
                      include_once '../include/config.php';
                      $query ='SELECT * FROM member';
                            $hasil = mysqli_query($mysqli, $query);
                              while ($qtabel = mysqli_fetch_array($hasil))
                                {
                                    echo '<option value="'.$qtabel['id_member'].'">'.$qtabel['full_name'].'</option>';               
                                } 
                        
                    ?>
                    <span class="error"><?php echo $member_iderr; ?></span>
                  </select>
                </div>
              </div>

              <!-- Subject -->
                <div class="row">
                    <div class="col-25">
                    <label for="majors">Subject</label>
                     </div>
                     <div class="col-75">
                     <select id="id_subject" name="id_subject">
                     <option >---Choose Subject---</option>
                      <?php
                         include_once '../include/config.php';
                        $query ='SELECT * FROM subject';
                            $hasil = mysqli_query($mysqli, $query);
                            while ($qtabel = mysqli_fetch_array($hasil))
                                {
                                    echo '<option value="'.$qtabel['id_subject'].'">'.$qtabel['subject'].'</option>';               
                                } 
                                
                    ?>
                    <span class="error"><?php echo $member_iderr; ?></span>
                  </select>
                </div>
              </div>


        <!--- Experience --->
        <div class="row">
            <div class="col-25">
                <label for="description">Experience</label>
            </div>
        <div class="col-75">
            <textarea id="address" name="description" placeholder="write something.." style="height:200px">
            </textarea>
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