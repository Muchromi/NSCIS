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
    $title = 'Mattrials';
    $no = 1;

    // $sql = 'SELECT * FROM announce';

    $sql = ("SELECT announce.id_announce, announce.date, announce.description, announce.title, announce.foto, member.id_member, member.full_name, member.file_gambar
    FROM announce
    JOIN member ON member.id_member = announce.member_id");


    // printah untuk pagination
    $sql_count = "SELECT COUNT(*) FROM materi";
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
    <div class="column left">
    </div>
    <div class="col-75">
        <h2>Mattrials</h2>

        <?php
        echo '<a href="add-matrial.php" class="btn btn-large"><i class="fa fa-plus" aria-hidden="true"></i> Matterial</a>';
        ?>

        <p> Data of all staf officier mattrial</p>
        <div style="overflow-x:auto;">
            <div class="row">
                <div class="col-25">
                    <input type="search" name="search" placeholder="search.....">
                </div>
            </div><br>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Cover</th>
                    <th>Subject</th>
                    <th>Mattrial Name</th>
                    <th>Description</th>
                    <th>Date Post</th>
                    <th>Matrial</th>
                    <th>The Officer</th>
                    <th>Action</th>
                </tr>
                <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                                        
                        <td><?php echo $no; ?></td>
                        <td><img src="<?php echo "../image/".$row['file_gambar']; ?>" width ="50px"; height="50px";></td>
                        <td><?php echo $row['full_name'];?></td>
                        <td><?php echo $row['id_member'];?></td>
                        <td><?php echo $row['title'];?></td>
                        <td><?php echo $row['date'];?></td>
                        <td><?php echo $row['description'];?></td>
                        <td><img src="<?php echo "../image/".$row['foto']; ?>" width ="50px"; height="50px";></td>                       
                        <td>
                            <a class="btn btn-default" href="edit-announce.php?id=<?php echo $row['id_announce'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                            <a class="btn btn-alert" onclick="return confirm('Are you sure you want to delete this data?');" href="delete-announce.php?id=<?php echo $row['id_announce'];?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    <?php endwhile; ?>
            </table>
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
</div>

<br>
<?php
    include_once('../include/footer.php');
?>