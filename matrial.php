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
      
      $title = 'Matrial';
    include_once('header.php');
?>

<div class="row">
            <div class="column full">
                    <h2>Matrials Data</h2>
                    <?php
    echo '<a href="add-matrial.php" class="btn btn-large"> <i class="fa fa-plus" aria-hidden="true"></i> Matrials</a>';
    ?>

                    <p>Data of all Matrials NSC Learning</p>
                    <div class="row">
                        <div class="col-25">
                        <input type="search" name="search" placeholder="search....">
                        </div>
                    </div><br>
                <div style="overflow-x:auto;">
                        <table>
                                <tr>
                                    <th>No.</th>
                                    <th>Mattrial Name</th>
                                    <th>Description</th>
                                    <th>Date Post</th>
                                    <th>Matrial</th>
                                    <th>The Officer</th>
                                    <th>Action</th>
                                </tr>

                                <tr>
                                    <td>1</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Matrial</td>
                                    <td>Sas</td>
                                    <td>&nbsp;</td>
                                    <td>
                                    <a class="btn btn-default" href=""><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    <a class="btn btn-default" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-alert" href=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Matrial</td>
                                    <td>Sas</td>
                                    <td>&nbsp;</td>
                                    <td>
                                    <a class="btn btn-default" href=""><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    <a class="btn btn-default" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-alert" href=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Matrial</td>
                                    <td>Sas</td>
                                    <td>&nbsp;</td>
                                    <td>
                                    <a class="btn btn-default" href=""><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    <a class="btn btn-default" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-alert" href=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Matrial</td>
                                    <td>Sas</td>
                                    <td>&nbsp;</td>
                                    <td>
                                    <a class="btn btn-default" href=""><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    <a class="btn btn-default" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-alert" href=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Matrial</td>
                                    <td>Sas</td>
                                    <td>&nbsp;</td>
                                    <td>
                                    <a class="btn btn-default" href=""><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    <a class="btn btn-default" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-alert" href=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Matrial</td>
                                    <td>Sas</td>
                                    <td>&nbsp;</td>
                                    <td>
                                    <a class="btn btn-default" href=""><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    <a class="btn btn-default" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-alert" href=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>6</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>Matrial</td>
                                    <td>Sas</td>
                                    <td>&nbsp;</td>
                                    <td>
                                    <a class="btn btn-default" href=""><i class="fa fa-download" aria-hidden="true"></i> Download</a>
                                    <a class="btn btn-default" href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                    <a class="btn btn-alert" href=""><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>
                                </tr>
                            </table>
                    </div>
                   
            </div>
    </div>

<?php
    include_once('../include/footer.php');
?>




