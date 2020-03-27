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
    $title = 'Edit Member';

    $id_member = $first_name = $last_name = $full_name = $position = $email = $dob = $gender = $religion = $no_hp = $bio = $password = $address = $place_birth = $file_gambar = $status='';
    $id_membererr = $first_nameerr = $last_nameerr = $full_nameerr = $positionerr = $emailerr = $doberr = $gendererr = $religionerr = $doberr = $place_birtherr = $no_hperr = $bioerr = $addresserr = $file_gambarerr = $statuserr ='';
    if (isset($_POST['submit'])) {
        // $id = $_POST['id'];
        
      //id member
      if (empty(trim($_POST['id_member']))) {
        $id_membererr = "please fill in the member";
      }else {
        $id_member = trim($_POST['id_member']);
      } 

      // first name
      if (empty(trim($_POST['first_name']))) {
        $first_nameerr = "please fill in the first_name";
      }else {
        $first_name = trim($_POST['first_name']);
      }

      // last_name
      if (empty(trim($_POST['last_name']))) {
        $last_nameerr = "please fill in the last_name";
      }else {
        $last_name = trim($_POST['last_name']);
      }

      //position
      if (empty(trim($_POST['position']))) {
        $positionerr = "please fill in the position";
      }else {
        $position = trim($_POST['position']);
      }

      // full_name
      if (empty(trim($_POST['full_name']))) {
        $full_nameerr = "please fill in the full_name";
      }else {
        $full_name = trim($_POST['full_name']);
      }

      // status
      if (empty(trim($_POST['status']))) {
        $statuserr = "please fill in the status";
      }else {
        $status= trim($_POST['status']);
      }

      // validate email
      if(empty(trim($_POST['email']))){
        $emailerr = "please fill in the email";   
      }elseif (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
        $emailerr = "not valid";
      } else{
        $vemail = trim($_POST['email']);
        $dataemail = mysqli_query($mysqli, "SELECT * FROM member WHERE email = '{$email}'");
        $check = mysqli_num_rows($dataemail);

        if ($check == 1) {
          $emailerr = "This email is already taken";
        }else{
          $email = trim($_POST['email']);
        }
      }

      // place of birth
      if (empty(trim($_POST['place_birth']))) {
        $place_birtherr = "please fill in the place of birth";
      }else {
        $place_birth = trim($_POST['place_birth']);
      }

      //dob
      $date = trim($_POST['dob']);
  
      // function change format date 'd/m/Y'
      function changeTanggal($date){
        $break = explode('/',$date);
        $array = array($break[2],$break[0],$break[1]);
        $unite = implode('-',$array);
        return $unite;
      }
      
      // validate tanggal
      if (empty(trim($date))) {
        $doberr = "please fill in the dob"; 
      }else{
        $dob = changeTanggal($date);
      }

      //gender
      if (empty(trim($_POST['gender']))) {
        $gendererr = "please fill in the gender";
      }else {
        $gender = trim($_POST['gender']);
      }

      //religion
      if (empty(trim($_POST['religion']))) {
        $religionerr = "please fill in the religion";
      }else {
        $religion = trim($_POST['religion']);
      }

      //number phone
      if (empty(trim($_POST['no_hp']))) {
        $no_hperr = "please fill in the number phone";
      }elseif (!filter_var(trim($_POST['no_hp']), FILTER_SANITIZE_NUMBER_INT)) {
        $no_hperr = "please fill in using numbers";
      }elseif(strlen(trim($_POST['no_hp'])) < 10 || strlen(trim($_POST['no_hp'])) > 14){
        $no_hperr = "Tel number in the range of 11 numbers or 13 numbers";
      }else{
        $no_hp = trim($_POST['no_hp']);
      }

      //bio
      if (empty(trim($_POST['bio']))) {
        $bioerr = "please fill in the bio";
      }else {
        $bio = trim($_POST['bio']);
      }

//password
      $password = trim($_POST['id_member']);
      $hash = password_hash($password, PASSWORD_DEFAULT);

      //address
      if (empty(trim($_POST['address']))) {
        $addresserr = "please fill in the address";
      }else {
        $address = trim($_POST['address']);
      }


      //gambar
      $tmp_file = $_FILES["file_gambar"]["tmp_name"];
      $nm_file = $_FILES["file_gambar"]["name"];
      $ukuran_file = $_FILES["file_gambar"]["size"];
      $dir = "../image/$nm_file";
      move_uploaded_file($tmp_file, $dir);
    
      $size = 1044070;
    
      if($ukuran_file > $size){
        $file_gambarerr = 'Ukuran Maksimal 100mb, saat ini ukuran file '.$ukuran_file;
        exit();
      }  

        //insert to table
        if (!empty($id_member) && !empty($first_name) && !empty($last_name) && !empty($full_name) && !empty($email) && !empty($dob) && !empty($gender) && !empty($religion) && !empty($no_hp) && !empty($bio) && !empty($address) && !empty($place_birth) && !empty($status)) {
          $sql = 'UPDATE member SET ';
          $sql .= " first_name = '{$first_name}', last_name = '{$last_name}', full_name = '{$full_name}', email = '{$email}', no_hp = '{$no_hp}', bio = '{$bio}', dob = '{$dob}', file_gambar = '{$nm_file}', position_id  = '{$position}', gender = '{$gender}', religion = '{$religion}', password = '{$hash}', address = '{$address}', place_birth = '{$place_birth}', status = '{$status}'";
          // if (!empty($gambar))
          // $sql .= ", file_gambar = '{$nm_file}' ";
          $sql .= "WHERE id_member = '{$id_member}'";
          $result = mysqli_query($mysqli, $sql);
          if (!$result) {
            die(mysqli_error($mysqli));
          }
          header('location: member.php');
        } 

    }
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM member WHERE id_member = '{$id} '";
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
          <h2>Biodata Form</h2>
          <p>please fill in your biodata in the following form</p>
          
          
          <div class="container">
            <form action="edit-member.php" method="post" enctype="multipart/form-data">

           <!-- id member -->
            <div class="row">
                <div class="col-25">
                  <label for="fname">Officer ID</label>
                </div>
                <div class="col-75">
                  <input type="text" id="fname" name="id_member" value="<?php echo $data['id_member']; ?>" readonly ">
                  <span class="error"><?php echo $id_membererr; ?></span>
                </div>
              </div>
            
              <!-- first name -->
              <div class="row">
                <div class="col-25">
                  <label for="fname">First Name</label>
                </div>
                <div class="col-75">
                  <input type="text" id="fname" name="first_name" value="<?php echo $data['first_name']; ?>" placeholder="Your name..">
                  <span class="error"><?php echo $first_nameerr; ?></span>
                </div>
              </div>

              <!-- last name -->
              <div class="row">
                  <div class="col-25">
                    <label for="lname">Last Name</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="lname" name="last_name" value="<?php echo $data['last_name']; ?>" placeholder="Your last name..">
                    <span class="error"><?php echo $last_nameerr; ?></span>
                  </div>
                </div>

<!-- full name -->
              <div class="row">
                <div class="col-25">
                  <label for="lname">Full Name</label>
                </div>
                <div class="col-75">
                  <input type="text" id="lname" name="full_name" value="<?php echo $data['full_name']; ?>" placeholder="Your full name..">
                  <span class="error"><?php echo $full_nameerr; ?></span>
                </div>
              </div>
            
              <!-- position -->
              <div class="row">
                <div class="col-25">
                  <label for="majors">Position</label>
                </div>
                <div class="col-75">
                  <select id="position" name="position">
                  <option >---Choose Position---</option>
                    <?php
                      include_once '../include/config.php';
                      $query ='SELECT * FROM position';
                            $hasil = mysqli_query($mysqli, $query);
                              while ($qtabel = mysqli_fetch_array($hasil))
                                {
                                    echo '<option value="'.$qtabel['id_position'].'">'.$qtabel['position_name'].'</option>';               
                                } 
                        
                    ?>
                    <span class="error"><?php echo $positionerr; ?></span>
                  </select>
                </div>
              </div>


              <!-- email -->
              <div class="row">
                  <div class="col-25">
                    <label for="email">Email</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="email" name="email" value="<?php echo $data['email']; ?>" placeholder="Your email..">
                    <span class="error"><?php echo $emailerr; ?></span>
                  </div>
              </div>

              <!-- Place of Birth -->
              <div class="row">
                  <div class="col-25">
                    <label for="email">Place of Birth</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="email" name="place_birth" value="<?php echo $data['place_birth']; ?>" placeholder="Your Place of Birth..">
                    <span class="error"><?php echo $place_birtherr; ?></span>
                  </div>
              </div>

              <!-- dob -->
              <div class="row">
                  <div class="col-25">
                    <label for="dob">Date of Birth</label>
                  </div>
                  <div class="col-75">
                  <?php 
                    // function change format date 'd/m/Y'
                    $date = $data['dob'];
                    function changeEditanggal($date){
                      $break = explode('-', $date);
                      $array = array($break[1],$break[2],$break[0]);
                      $unite = implode('/', $array);
                      return $unite;

                    }
                  ?>
                    <input type="text" id="tbDate" name="dob" value="<?php echo $DoB = changeEditanggal($date); ?>" placeholder="Your DoB..">
                    <!-- <input type="text" id="tbDate" name="dob" value="<?php echo $data['dob']; ?>" placeholder="Your dob.."> -->
                    <span class="error"><?php echo $doberr; ?></span>
                  </div>
              </div>

              <!-- gender -->
              <div class="row">
                  <div class="col-25">
                    <label for="gender">Gender</label>
                  </div>
                  <div class="col-75">
                    <label><input type="radio" value="Male"<?php if($data['gender']=='Male') echo 'checked'?> id="Male" name="gender">Male</label>
                    <label><input type="radio" value="Female" <?php if($data['gender']=='Female') echo 'checked'?> id="Female"  name="gender">Female</label>
                    <span class="error"><?php echo $gendererr; ?></span>
                  </div>
              </div>
              
              <div class="row">
                <div class="col-25">
                  <label for="fname">Religion</label>
                </div>
                <div class="col-75">
                  <input type="text" id="fname" name="religion" value="<?php echo $data['religion']; ?>" placeholder="Your Religion..">
                  <span class="error"><?php echo $religionerr; ?></span>
                </div>
              </div>

<!-- no phone -->
              <div class="row">
                  <div class="col-25">
                    <label for="no_hp">No. Phone</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="no_hp" value="<?php echo $data['no_hp']; ?>" name="no_hp" placeholder="Your No. Phone..">
                    <span class="error"><?php echo $no_hperr; ?></span>
                  </div>
              </div>
            
              <!-- bio -->
              <div class="row">
                  <div class="col-25">
                    <label for="bio">Bio</label>
                  </div>
                  <div class="col-75">
                    <input type="text" id="bio" name="bio" value="<?php echo $data['bio']; ?>" placeholder="Your bio..">
                    <span class="error"><?php echo $bioerr; ?></span>
                  </div>
              </div>

              <!-- address -->
              <div class="row">
                <div class="col-25">
                  <label for="address">Information</label>
                </div>
                <div class="col-75">
                  <textarea id="address" name="address" placeholder="Write something.." style="height:200px">
                  <?php echo $data['information'];?>
                  </textarea>
                  <span class="error"><?php echo $addresserr; ?></span>
                </div>
              </div>

              <!-- status -->
              <div class="row">
                <div class="col-25">
                  <label for="majors">Status</label>
                </div>
                <div class="col-75">
                  <select id="status" name="status">
                  <option value = "Active" >Active</option>
                  <option value ="Unactive">Unactive</option>
                    <span class="error"><?php echo $statuserr; ?></span>
                  </select>
                </div>
              </div>

              <!-- photo -->
              <div class="row">
                  <div class="col-25">
                    <label for="bio">Photo</label>
                  </div>
                  <div class="col-75">
                    <input type="file" name="file_gambar" placeholder="Your photo..">
                  </div>
              </div>

              <div class="row">
                <input type="submit" name="submit" value="Submit">
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