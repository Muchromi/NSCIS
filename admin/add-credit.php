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
      
    $title = 'Credit Finance';        
    include_once('../include/config.php');
    
    $kredit = $description = $date = $member_id ='';
    $krediterr = $descriptionerr = $dateerr = $member_iderr ='';

    if (isset($_POST['submit'])) {

      //the officer
      // $officer = $_SESSION['member_id'];

      //date
      $dates = trim($_POST['date']);
  
      // function change format date 'd/m/Y'
      function changeTanggal($dates){
        $break = explode('/',$dates);
        $array = array($break[2],$break[0],$break[1]);
        $unite = implode('-',$array);
        return $unite;
      }
      
      // validate tanggal
      if (empty(trim($dates))) {
        $dateerr = "please fill in the dates"; 
      }else{
        $date = changeTanggal($dates);
      }

      $kredit = trim($_POST['kredit']);
  
      // function change format rupiah
      function changeRupiah($kredit){
        $result = preg_replace("/[^0-9]/", "", $kredit);
        return $result;
      }
      
           //member
           if (empty(trim($_POST['member_id']))) {
            $member_iderr = "please fill in the position";
          }else {
            $member_id = trim($_POST['member_id']);
          }

      // validate rupiah
      if (empty(trim($kredit))) {
        $krediterr = "please fill in the credit"; 
      }else{
        $kredit_result = changeRupiah($kredit);
      }

      // description
      if (empty(trim($_POST['description']))) {
        $descriptionerr = "please fill in the desc";
      }else {
        $description = trim($_POST['description']);
      }

      //total
      $query = "SELECT * FROM pattycash ORDER BY id_pattycash DESC LIMIT 1";
      $last_query = mysqli_query($mysqli, $query);
      while ($saldo = mysqli_fetch_array($last_query)){
          $result_saldo = $saldo['saldo'] - $kredit_result = changeRupiah($kredit);
      }

      //insert to table
      if (!empty($date) && !empty($kredit_result) && !empty($description)) {
        $sql = "INSERT INTO pattycash (date, credit, description, saldo, member_id) VALUES ('{$date}', '{$kredit_result}', '{$description}', '{$result_saldo}', '{$member_id}')";
        $result = mysqli_query($mysqli, $sql);    

        if (!$result) {
          die(mysqli_error($mysqli));
        }
        
        header('Location: finance.php');
      }
      


    }

    include_once('../include/header-admin.php');
?>

<div class="row">
      <div class="column side">

      </div>

      <div class="column middle">
          <h2>Credit Form</h2>
          <p>please fill in your credit in the following form</p>
          
          <div class="container">
            <form action="add-credit.php" method="post" enctype="multipart/form-data">

<!-- member -->
              <div class="row">
                <div class="col-25">
                  <label for="majors">Member</label>
                </div>
                <div class="col-75">
                  <select id="member_id" name="member_id">
                  <option >---Choose Position---</option>
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
            <!-- date -->
            <div class="row">
                <div class="col-25">
                  <label for="date">Date</label>
                </div>
                <div class="col-75">
                  <input type="text" id="tbDate" name="date" placeholder="date..">
                  <span class="error"><?php echo $dateerr; ?></span>
                </div>
              </div>
 
              <!-- credit -->
              <div class="row">
                <div class="col-25">
                  <label for="credit">Credit</label>
                </div>
                <div class="col-75">
                  <input type="text" id="dengan-rupiah"  value="<?php echo $kredit; ?>" name="kredit" placeholder="credit..">
                  <span class="error"><?php echo $krediterr; ?></span>
                </div>
              </div>


              <!-- Description -->
              <div class="row">
                <div class="col-25">
                  <label for="description">Description</label>
                </div>
                <div class="col-75">
                  <textarea id="description" name="description" value="<?php echo $description; ?> placeholder="Write something.." style="height:200px"></textarea>
                  <span class="error"><?php echo $descriptionerr ?></span>
                </div>
              </div>

              <div class="row">
                <input type="submit" name="submit"; value="Submit">
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