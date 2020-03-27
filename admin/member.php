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

    $title='Data Member';
    $no=1;

    // $sql = 'SELECT * FROM member';
    // $result = mysqli_query($mysqli, $sql);
        $sql = ("SELECT member.id_member, member.first_name, member.last_name, member.full_name, member.email, member.no_hp, 
        member.address, member.bio, member.dob, member.file_gambar, position.position_name, member.gender, member.password, member.isadmin, member.create, member.place_birth, member.status, member.religion
        FROM member 
        JOIN position ON position.id_position = member.position_id");

    $sql_count = "SELECT COUNT(*) FROM member";
        if (isset($sql_where)) {
        $sql .= $sql_where;
        $sql_count .= $sql_where;
    }
    $result_count = mysqli_query($mysqli, $sql_count);
    $count = 0;
        if ($result_count) {
        $r_data = mysqli_fetch_row($result_count);
        $count = $r_data[0];
    }
    $per_page = 5;
    $num_page = ceil($count / $per_page); 
    $limit = $per_page;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $offset = ($page - 1) * $per_page;
    } else {
        $offset = 0;
        $page = 1;
    }
    $sql .= " LIMIT {$offset}, {$limit}";    

    $result = mysqli_query($mysqli, $sql);

    include_once('../include/header-admin.php');

?>

<div class="row">
<div class="column full">
        <h2>Member Data</h2>
        <?php
        echo '<a href="add-member.php"class="btn btn-large"><i class="fa fa-plus"
        aria-hidden="true"></i> Member </a>';
        ?>

        <p> Data of all staf officier positions</p>
        <div style="overflow-x:auto;">
        <div class="row">
            <div class="col-25">
                <input type="search" name="search" placeholder="search.....">
            </div>
        </div><br>

            <table>
                <tr>
                    <th>No.</th>
                    <th>Photo</th>
                    <th>Officier ID</th>
                    <!-- <th>First Name</th>
                    <th>Last Name</th> -->
                    <th>Name</th>
                    <th>Position</th>
                    <th>Email</th>
                    <th>No. Phone</th>
                    <th>Bio</th>
                    <th>DoB</th>
                    <th>Gender</th>
                    <th>Religion</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>                                    
                        <td><?php echo $no; ?></td>
                        <td><img src="<?php echo "../image/".$row['file_gambar']; ?>" width ="50px"; height="50px";></td>
                        <td><?php echo $row['id_member'];?></td>
                        <!-- <td><?php echo $row['first_name'];?></td>
                        <td><?php echo $row['last_name'];?></td> -->
                        <td><?php echo $row['full_name'];?></td>
                        <td><?php echo $row['position_name'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['no_hp'];?></td>
                        <td><?php echo $row['bio'];?></td>
                        <!-- <td><?php echo $row['palce_birth'];?></td> -->
                        <td><?php echo $row['dob'];?></td>
                        <td><?php echo $row['gender'];?></td>
                        <td><?php echo $row['religion'];?></td>
                        <td><?php echo $row['address'];?></td>
                       
                        <?php
                            if ($row['status'] == 'Active') {
                                echo"<td style ='color:green'><b>".$row['status']."</b></td>";
                            }else{
                                echo"<td style ='color:red'><b>".$row['status']."</b></td>"; 
                            } 
                        ?>

                        <td>
                            <a class="btn btn-default" href="edit-member.php?id=<?php echo $row['id_member'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                            <a class="btn btn-alert" onclick="return confirm('Are you sure you want to delete this data?');" href="delete-member.php?id=<?php echo $row['id_member'];?>"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                            <a class="btn btn-default" href="view-member.php?id=<?php echo $row['id_member'];?>"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    <!-- <?php print_r($row);?> -->
                    <?php endwhile; ?>

            </table>
        </div>
            <div class="pagination">

            <a href="?page=<?php if ($page > 1){
                            $pagep = $page-1;
                        }else{
                            $pagep= $page;
                        } 
                        echo $pagep; ?>">&laquo;</a>
                        <?php for ($i=1; $i <= $num_page; $i++) { 
                            $link = "?page={$i}";
                            if (!empty($q)) $link .= "&q={$q}";
                                $class = ($page == $i ? 'active' : '');
                                echo "<a class=\"{$class}\" href=\"{$link}\">{$i}</a>";
                            } ?>

                     <a href="?page=<?php if ($page < $num_page){
                        $pagen = $page+1;
                    }else{
                        $pagen= $page;
                    }
                    echo $pagen; ?>">&raquo;</a>

            </div>

    </div>
</div>
<?php
    include_once('../include/footer.php');
?>