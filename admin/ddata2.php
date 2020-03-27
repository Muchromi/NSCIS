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

    // $title = 'Add Announce';
    
    $date = $title = $description = $foto = $member_id ='';
    $dateerr = $titleerr = $descriptionerr = $fotoerr = $member_iderr ='';
    
    if (isset($_POST['submit'])) {

        //title
        if (empty(trim($_POST['title']))) {
          $titleerr = "please fill in the title";
        }else {
          $title = trim($_POST['title']);
        }

        $date = trim($_POST['date']);
  
      // function change format date 'd/m/Y'
      function changeTanggal($date){
        $break = explode('/',$date);
        $array = array($break[2],$break[0],$break[1]);
        $unite = implode('-',$array);
        return $unite;
      }
      
      // validate tanggal
      if (empty(trim($date))) {
        $dateerr = "please fill in the date"; 
      }else{
        $date = changeTanggal($date);
      }
     
        // description
        if (empty(trim($_POST['description']))) {
          $descriptionerr = "please fill in the description";
        }else {
          $description = trim($_POST['description']);
        }

        //member
        if (empty(trim($_POST['member_id']))) {
            $member_iderr = "please fill in the member";
          }else {
            $member_id = trim($_POST['member_id']);
          }

          //gambar
        $tmp_file = $_FILES["foto"]["tmp_name"];
        $nm_file = $_FILES["foto"]["name"];
        $ukuran_file = $_FILES["foto"]["size"];
        $dir = "../image/$nm_file";
        move_uploaded_file($tmp_file, $dir);
        
        $size = 1044070;
        
        if($ukuran_file > $size){
            $fotoerr = 'Ukuran Maksimal 100mb, saat ini ukuran file '.$ukuran_file;
            exit();
        }  

        //insert to table
        if (!empty($title) && !empty($description) && !empty($date)) {
          $sql = "INSERT INTO announce (date, title, description, foto, member_id) VALUES ('{$date}','{$title}','{$description}','{$nm_file}','{$member_id}')";
          $result = mysqli_query($mysqli, $sql);
          

          if (!$result) {
            die(mysqli_error($mysqli));
          }
          
          header('Location: data.php');
        }

    }
    include_once('../include/header-admin.php');


?>

<div class="row">
    <div class="column side"></div>
    <div class="column middle">
        <h2>Announce Form </h2>
        <p> Please fill in your announce in the following form </p>
    <div class="container">
        <form action="ddata2.php" method="post" enctype="multipart/form-data">

        <!-- member -->
        <div class="row">
                <div class="col-25">
                  <label for="majors">Member</label>
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

        <!-- Date -->
        <div class="row">
                <div class="col-25">
                  <label for="date">Date</label>
                </div>
                <div class="col-75">
                  <input type="text" id="tbDate" name="date" placeholder="date..">
                  <span class="error"><?php echo $dateerr; ?></span>
                </div>
              </div>

        <!---title --->
        <div class="row">
                <div class="col-25">
                  <label for="title">Title</label>
                </div>
                <div class="col-75">
                  <input type="text" id="title" value="<?php echo $title; ?>" name="title" placeholder="Your title..">
                  <span class="error"><?php echo $titleerr; ?></span>
                </div>
        </div>

        <!--- Description --->
        <div class="row">
            <div class="col-25">
                <label for="description">Description</label>
            </div>
        <div class="col-75">
            <textarea id="address" name="description" placeholder="write something.." style="height:200px">
            </textarea>
        </div>
        </div>

        <!-- photo -->
        <div class="row">
                  <div class="col-25">
                    <label for="bio">Photo</label>
                  </div>
                  <div class="col-75">
                    <input type="file" name="foto" placeholder="Your photo..">
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