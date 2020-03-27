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
    $title = 'Position';
    $no = 1;

    $sql = 'SELECT * FROM position';

    // printah untuk pagination
    $sql_count = "SELECT COUNT(*) FROM position";
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
        <h2>Position Data</h2>

        <?php
        echo '<a href="add-position.php" class="btn btn-large"><i class="fa fa-plus" aria-hidden="true"></i> Position</a>';
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
                    <th>Position</th>
                    <th>Job Desc</th>
                    <th>Action</th>
                </tr>
                <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                                        
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row['position_name'];?></td>
                        <td><?php echo $row['job_desc'];?></td>
                        <td>
                            <a class="btn btn-default" href="edit-position.php?id=<?php echo $row['id_position'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                            <a class="btn btn-alert" onclick="return confirm('Are you sure you want to delete this data?');" href="delete-position.php?id=<?php echo $row['id_position'];?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
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

<?php
    include_once('../include/footer.php');
?>