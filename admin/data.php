<?php
// // Initialize the session
// session_start();
 
// // If session variable is not set it will redirect to login page
// if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
//   header("location: login.php");
//   exit;
// }

// $q="";
// if (isset($_GET['q']) && !empty($_GET['q'])) {
//     $q = $_GET['q'];
//     $sql_where = " WHERE nama LIKE '{$q}%'";
// }

$title = 'Home';
$image = '<img src = "nsc.jpg" alt="">';

include_once 'include/koneksi.php';
include_once 'include/fungsi.php';
// $sql = 'SELECT * FROM angota';
$sql = ("SELECT anggota.id_anggota, anggota.nama, jurusan.jurusan, anggota.tanggal, anggota.kelas, 
				anggota.alamat, anggota.no_hp, anggota.email, anggota.moto, anggota.foto 
                FROM anggota
                JOIN jurusan ON jurusan.id_jurusan = anggota.jurusan_id");

$sql_count = "SELECT COUNT(*) FROM anggota";
if (isset($sql_where)) {
    $sql .= $sql_where;
    $sql_count .= $sql_where;
}
$result_count = mysqli_query($conn, $sql_count);
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

$result = mysqli_query($conn, $sql);

require('include/header.php'); 
require('include/nav.php'); 
require('include/slide.php'); 
 ?>
 <div class="main">
 	<form action="" method="get">
		<label for="q">Cari data : </label>
			<input type="text" id="q" name="q" class="input-q" >
			<input type="submit" name="submit" value="Cari" class="btn btn-primary">
	</form>

    <?php
        if ($result):
    ?>

 	<?php while($row = mysqli_fetch_array($result)): ?>
 	<div class="entry">
 		<hr class="divider" />
        <h2><?php echo $row['nama'];?></h2>
        <img src="<?php echo $row['foto']; ?>"  class="right-img" alt="">
        <!-- <img src="img/sas.png" /> -->
        <p><?php echo readmore($row['moto']);?></p>
        <a href="view-anggota.php?id=<?php echo $row['id_anggota'];?>" class="btn btn-default">View detail</a>
    </div>
    <?php endwhile; ?>

    
        <ul class="pagination">
            <li><a href="?page=<?php if ($page > 1){
                $pagep = $page-1;
            }else{
                $pagep= $page;
            } 
            echo $pagep; ?>">&laquo;</a></li>
            <?php for ($i=1; $i <= $num_page; $i++) { 
                $link = "?page={$i}";
                if (!empty($q)) $link .= "&q={$q}";
                    $class = ($page == $i ? 'active' : '');
                    echo "<li><a class=\"{$class}\" href=\"{$link}\">{$i}</a></li>";
                } ?>
          <li><a href="?page=<?php if ($page < $num_page){
            $pagen = $page+1;
        }else{
            $pagen= $page;
        }
        echo $pagen; ?>">&raquo;</a></li>
        </ul>
    </div>

<?php endif;
require('include/sidebar.php'); 
include_once('include/footer.php'); 
 ?>