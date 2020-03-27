<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

// memanggil library FPDF
include_once 'include/config.php';
require('fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string
$pdf->Image('nsc.jpg',10,6,30); 
$pdf->Cell(32,7,'',0,0);
$pdf->Cell(100,7,'Nogoding Study Club',0,1);
$pdf->SetFont('Arial','', 12);
$pdf->Cell(32,7,'',0,0);
$pdf->Cell(100,7,'Merajut mimpi dalam mewujudkan mahasiswa kreatif dan berprestasi',0,1);
$pdf->Ln(2);
$pdf->SetFont('Arial','', 8);
$pdf->SetFillColor(36, 96, 84); 
$pdf->SetTextColor(225); 
$pdf->Cell(0, 7, "www.ngodingstudyclub.org", 0, 1, 'C', true);



$id = $_GET['id'];
$sql = ("SELECT member.id_member, member.first_name, member.last_name, member.full_name, member.email, member.no_hp, 
          member.address, member.bio, member.dob, member.file_gambar, position.position_name, position.job_desc, member.gender, member.password, member.isadmin, member.create, member.place_birth, member.status
          FROM member 
          JOIN position ON position.id_position = member.position_id
          WHERE id_member = '{$id}'");
          
$result = mysqli_query($conn, $sql);
if (!$result) die('Error: Data not Available');


// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

while($row = mysqli_fetch_array($result)){

//foto
$pdf->SetFont('Arial','B',10);
$pdf->Image($row['file_gambar'],20,60,30); 
$pdf->Ln(13);
$pdf->SetTextColor(0,0,0);
//nama
$pdf->Cell(50,6,'',0,0);
$pdf->Cell(35,6,'Name  ',0,0);
$pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(50,6,$row['full_name'],0,1);
// jurusan
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'',0,0);
$pdf->Cell(35,6,'Place of Birth  ',0,0);
$pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,6,$row['place_birth'],0,1);
// kelas
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'',0,0);
$pdf->Cell(35,6,'Gender',0,0);
$pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,6,$row['gender'],0,1);
// alamat
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'',0,0);
$pdf->Cell(35,6,'Address',0,0);
$pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(100,6,$row['address'],0,1);
// Tanggal Daftar
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,6,'',0,0);
$pdf->Cell(35,6,'Job Description ',0,0);
$pdf->Cell(3,6,':',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,6,$row['job_desc'],0,1);
}

$pdf->Ln(30);
// $pdf->Cell(32,7,'',0,0);
$pdf->SetFont('Arial','', 12);
$pdf->MultiCell(190,7,'Dengan ini menyatakan bahwa saya siap untuk mengikuti dan menjalankan segala ketentuan yang ada di ngoding study club dengan sepenuh hati tanpa ada pemaksaan dari pihak manapun.',0,'L',false);

$pdf->Ln(10);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,6,'',0,0);
$pdf->Cell(50,6,' Cikarang,  ',0,12);
$pdf->Ln(15);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,6,'',0,0);
$pdf->Cell(50,6,'(............................)',0,0);
$pdf->SetFont('Arial', '', 12); 
$pdf->SetTextColor(0); 
$pdf->SetXY(10,-40); 
$pdf->Cell(0, 10, "www.ngodingstudyclub.org", 'T', 0, 'C');
$pdf->Output();
?>