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
     $title = 'Cash Finance';
     $no = 1;

 
    //  $sql = 'SELECT * FROM pattycash';

     $sql = ("SELECT pattycash.id_pattycash, pattycash.date, pattycash.description, pattycash.credit, pattycash.debit, pattycash.saldo, member.full_name, member.id_member, member.file_gambar
        FROM pattycash
        JOIN member ON member.id_member = pattycash.member_id");


    // printah untuk pagination
    $sql_count = "SELECT COUNT(*) FROM pattycash";
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
        <h2>Finance Data</h2>
    
        <?php
        echo '<a href="add-credit.php" class="btn btn-large"><i class="fa fa-plus" aria-hidden="true"
        ></i> Credit</a>';

        echo '<a href="add-debit.php" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"
        ></i> Debit</a>';
        ?>

        <p>Data of all finance NSC</p>
        <div class="row">
            <div class="col-25">
                <input type="search" name="search" placeholder="search.....">
            </div>
        </div><br>

        <div class="row">
            <div class="col-20">
                <input type="text" id="tbDate" name="datefirst" placeholder="Date....">
            </div>

            <div class="col-10">
                S/D 
            </div>
            <div class="col-20">
                <input type="text" id="tbDate1" name="datefirst1" placeholder="Date....">
            </div>

            <div class="col-5">
                <a href="print" class="btn btn-print"><i class="fa fa-print" aria-hidden="true">
                </i> Print</a>
           </div>
        </div><br>  

            <div style="overflow-x:auto;">
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Officer ID</th>
                        <th>Date Input</th>
                        <th>Description</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                        <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                                        
                        <td><?php echo $no; ?></td>
                        <td><img src="<?php echo "../image/".$row['file_gambar']; ?>" width ="50px"; height="50px";></td>
                        <td><?php echo $row['full_name'];?></td>
                        <td><?php echo $row['id_member'];?></td>
                        <td><?php echo $row['date'];?></td>
                        <td><?php echo $row['description'];?></td>
                        <td><?php echo 'Rp.'. number_format($row['credit'],2,",",".");?></td>
                        <td><?php echo 'Rp.'. number_format($row['debit'],2,",",".");?></td>
                        <td><?php echo 'Rp.'. number_format($row['saldo'],2,",",".");?></td>
                        <td>
                            <a class="btn btn-alert" onclick="return confirm('Are you sure you want to delete this data?');" href="delete-finance.php?id=<?php echo $row['id_pattycash'];?>"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
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