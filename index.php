<?php
    
      // Initialize the session
      session_start();
    
      // If session variable is not set it will redirect to login page
      if(!isset($_SESSION['id_member']) || empty($_SESSION['id_member'])){
        header("location:login.php");
        exit;
      }
    
    
    $title = 'Home';

    include_once('include/config.php');


    include_once('header.php');
?>

<div class="row">
        <div class="column side">
                <div class="card">
                <img src="<?php echo "image/".$_SESSION['file_gambar']; ?>" alt="Avatar" style="width:100%" class="imgcard" >
                <div class="containercard">
                    <h4><b><?php echo $_SESSION['full_name']?></b><br>Officer ID: <u><?php echo $_SESSION['id_member']?></u></h4> 
  
                        <?php
                          include_once('include/config.php');
                          $ids = $_SESSION['id_member'];
                            $query = ("SELECT member.id_member, position.position
                                    FROM member 
                                    JOIN position ON position.idposition = member.position_id
                                    WHERE id_member = '{$ids}'");
                            $results = mysqli_query($mysqli, $query);
                            
                            while ($post = mysqli_fetch_array($results))
                                {
                                    echo "<p><b>Position: </b>".$post['position']."</p>";               
                                }
                        ?>
            
                    <p><b>Bio:</b><br><?php echo $_SESSION['bio']?></p>
                </div>
                </div>
        </div>
        
        <div class="column right">
            <div class="container">
                    <h2>Title</h2>
                    <h4>Title description, Dec 29, 2017</h4>
                    <img src="moment.jpg" alt="Avatar" style="width:500px; height:300px;" class="imghome" >
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                        Fugiat ipsa laborum esse eos, assumenda itaque similique ad, 
                        voluptas ipsum distinctio nobis sint magnam inventore delectus 
                        voluptate dignissimos? Iusto, magnam. Amet.</p>
                    <a href="read" class="btn btn-large">Read more...</a>
            </div><br>
            
            <div class="container">
                    <h2>Title</h2>
                    <h4>Title description, Dec 29, 2017</h4>
                    <img src="moment.jpg" alt="Avatar" style="width:500px; height:300px;" class="imghome" >
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                        Fugiat ipsa laborum esse eos, assumenda itaque similique ad, 
                        voluptas ipsum distinctio nobis sint magnam inventore delectus 
                        voluptate dignissimos? Iusto, magnam. Amet.</p>
                    <a href="add-matrial" class="btn btn-large">Read more...</a>
            </div><br>

            <div class="container">
                    <h2>Title</h2>
                    <h4>Title description, Dec 29, 2017</h4>
                    <img src="moment.jpg" alt="Avatar" style="width:500px; height:300px;" class="imghome" >
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                        Fugiat ipsa laborum esse eos, assumenda itaque similique ad, 
                        voluptas ipsum distinctio nobis sint magnam inventore delectus 
                        voluptate dignissimos? Iusto, magnam. Amet.</p>
                    <a href="add-matrial" class="btn btn-large">Read more...</a>
            </div><br>

            <div class="container">
                    <h2>Title</h2>
                    <h4>Title description, Dec 29, 2017</h4>
                    <img src="moment.jpg" alt="Avatar" style="width:500px; height:300px;" class="imghome" >
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                        Fugiat ipsa laborum esse eos, assumenda itaque similique ad, 
                        voluptas ipsum distinctio nobis sint magnam inventore delectus 
                        voluptate dignissimos? Iusto, magnam. Amet.</p>
                    <a href="add-matrial" class="btn btn-large">Read more...</a>
            </div><br>

            <div class="container">
                    <h2>Title</h2>
                    <h4>Title description, Dec 29, 2017</h4>
                    <img src="moment.jpg" alt="Avatar" style="width:500px; height:300px;" class="imghome" >
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                        Fugiat ipsa laborum esse eos, assumenda itaque similique ad, 
                        voluptas ipsum distinctio nobis sint magnam inventore delectus 
                        voluptate dignissimos? Iusto, magnam. Amet.</p>
                    <a href="add-matrial" class="btn btn-large">Read more...</a>
            </div><br>

            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#">1</a>
                <a class="active" href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div>
        </div>
        

        

        <!-- <div class="column side">
            <h2>Title</h2>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                Fugiat ipsa laborum esse eos,.....</p>
        </div> -->
        
    </div>

<?php
    include_once('include/footer.php');
?>