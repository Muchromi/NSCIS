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
      
    $title = 'Payment';        
    include_once('../include/config.php');
    
    $amount = $member_id = $information = $date = $status ='';
    $amounterr = $member_iderr = $informationerr = $dateerr = $statuserr ='';

    if (isset($_POST['submit'])) {

      $pay = trim($_POST['amount']);
  
      // function change format rupiah
      function changeRupiah($pay){
        $result = preg_replace("/[^0-9]/", "", $pay);
        return $result;
      }
      
      // validate rupiah
      if (empty(trim($pay))) {
        $amounterr = "please fill in the pay"; 
      }else{
        $amount = changeRupiah($pay);
      }


      //member
      if (empty(trim($_POST['member_id']))) {
        $member_iderr = "please fill in the member_id";
      }else {
        $member_id = trim($_POST['member_id']);
      }

      // information
      if (empty(trim($_POST['information']))) {
        $informationerr = "please fill in the information";
      }else {
        $information = trim($_POST['information']);
      }

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
   
      // status
      if (empty(trim($_POST['status']))) {
        $statuscerr = "please fill in the status";
      }else {
        $status = trim($_POST['status']);
      }

      //insert to table
      if (!empty($member_id) && !empty($amount) && !empty($information) && !empty($date) && !empty($status)) {
        $sql = "INSERT INTO payment (member_id, amount, information, date, status) VALUES ('{$member_id}', '{$amount}', '{$information}', '{$date}', '{$status}')";
        $result = mysqli_query($mysqli, $sql);
        

        if (!$result) {
          die(mysqli_error($mysqli));
        }
        
        header('Location: pay.php');
      }

  }


    
    include_once('../include/header-admin.php');
?>

<div class="row">
      <div class="column side">

      </div>

      <div class="column middle">
          <h2>Pay Form</h2>
          <p>please fill in your pays in the following form</p>
          <div class="container">
            <form action="add-pay.php" method="post" enctype="multipart/form-data">
 
              <!-- Price -->
              <div class="row">
                <div class="col-25">
                  <label for="amount">Amount</label>
                </div>
                <div class="col-75">
                  <input type="text" id="dengan-rupiah" name="amount" value="<?php echo $amount; ?>" placeholder="amount..">
                  <span class="error"><?php echo $amounterr; ?></span>
                </div>
              </div>


              <!-- member -->
              <div class="row">
                <div class="col-25">
                  <label for="Member">Member</label>
                </div>
                <div class="col-75">
                  <select id="member_id" name="member_id">
                  <option >---Choose Member---</option>
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

              <!-- Information -->
              <div class="row">
                <div class="col-25">
                  <label for="information">Information</label>
                </div>
                <div class="col-75">
                  <textarea id="information" name="information" value="<?php echo $information; ?> placeholder="Write something.." style="height:200px"></textarea>
                  <span class="error"><?php echo $informationerr; ?></span>
                </div>
              </div>

              <!-- date -->
              <div class="row">
                <div class="col-25">
                  <label for="date">Date</label>
                </div>
                <div class="col-75">
                  <input type="text" id="tbDate" name="date" placeholder="date..">
                </div>
              </div>

              <!-- Status -->
              <div class="row">
                <div class="col-25">
                  <label for="status">Status</label>
                </div>
                <div class="col-75">
                  <select id="status" name="status">
                    <option value="Paid">Paid</option>
                    <option value="Please Paid">Please Paid</option>
                  </select>
                </div>
              </div>

              <div class="row">
                <input type="submit" name ="submit" value="Submit">
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