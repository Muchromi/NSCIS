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
$title = 'View Member';

    $id = $_GET['id'];
    $sql = ("SELECT member.id_member, member.first_name, member.last_name, member.full_name, member.email, member.no_hp, 
              member.address, member.bio, member.dob, member.file_gambar, position.position_name, position.job_desc, member.gender, member.password, member.isadmin, member.create, member.place_birth, member.status
              FROM member 
              JOIN position ON position.id_position = member.position_id
              WHERE id_member = '{$id}'");
    $result = mysqli_query($mysqli, $sql);
    if (!$result) die('Error: Data not Available');

    include_once('../include/header-admin.php');
?>
 
<div class="row">
<?php while($row = mysqli_fetch_array($result)): ?>
        <div class="column side">
                <div class="card">
                <img src="<?php echo "../image/".$row['file_gambar']; ?>" alt="Avatar" style="width:100%" class="imgcard" >
                <div class="containercard">
                    <h4><b><?php echo $row['full_name'];?></b><br>Officer ID: <?php echo $row['id_member'];?></h4> 
                    <p><b><?php echo $row['position_name'];?></b></p> 
                    <p><b>Bio:</b><br><?php echo $row['bio'];?></p>
                </div>
                </div>
        </div>
        
        <div class="column right">
            <div class="container">
                <div class="row">
                <a href="word.php?id=<?php echo $id;?>" class="btn btn-alert">Print</a>

                    <div class="col-15">
                        <label ><b>First Name</b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['first_name'];?></label>
                    </div>
                </div> 
                
                <div class="row">
                    <div class="col-15">
                        <label ><b>Last Name </b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['last_name'];?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-15">
                        <label ><b>Place of Birth </b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['place_birth'].", ".$row['dob']?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-15">
                        <label ><b>Gender</b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['gender'];?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-15">
                        <label ><b>Job Description </b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['job_desc'];?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-15">
                        <label ><b>Email</b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['email'];?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-15">
                        <label ><b>Number Phone</b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['no_hp'];?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-15">
                        <label ><b>Address</b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php echo $row['address'];?></label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-15">
                        <label ><b>Status</b></label>
                    </div>
                    <div class="col-75">
                        <label >: <?php
                                        if ($row['status'] == 'Active') {
                                           echo"<b style ='color:green'>".$row['status']."</b>";
                                        }else{
                                            echo"<b style ='color:red'>".$row['status']."</b>"; 
                                        } 
                                      ?></label>
                    </div>
                </div>



            </div>
        </div>

</div>
    <?php endwhile; ?>