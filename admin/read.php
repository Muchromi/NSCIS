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
      
    include_once('../include/header-admin.php');
?>

<div class="row">
        <div class="column side">
            <div class="card">
            <img scr="../pro.jpg" alt="Avatar" style="width:100%" class="imgcard">
            <div class="containercard">
                <h4><b>Asep</b><br>Officer ID:0000000</h4>
                <P>Interior Designer</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi officia nemo eveniet! Esse debitis reiciendis, in earum exercitationem laudantium ratione, quia reprehenderit molestias quis voluptate vitae fugiat vel, adipisci perferendis?</p>
                </div>
                </div>
            </div>

            <div class="column right">
                <div class="container">
                        <h2>Title</h2>
                        <h4>Title Description, Dec 29, 2017</h4>
                        <img scr="../moment.jpg" alt="Avatar" style="with:500px; height:300px;" class="imghome">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse? Perspiciatis nesciunt, dolores nisi veniam ex dolorem harum debitis reiciendis libero esse facilis iste qui natus voluptate doloremque sed pariatur?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse? Perspiciatis nesciunt, dolores nisi veniam ex dolorem harum debitis reiciendis libero esse facilis iste qui natus voluptate doloremque sed pariatur?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse? Perspiciatis nesciunt, dolores nisi veniam ex dolorem harum debitis reiciendis libero esse facilis iste qui natus voluptate doloremque sed pariatur?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse? Perspiciatis nesciunt, dolores nisi veniam ex dolorem harum debitis reiciendis libero esse facilis iste qui natus voluptate doloremque sed pariatur?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse? Perspiciatis nesciunt, dolores nisi veniam ex dolorem harum debitis reiciendis libero esse facilis iste qui natus voluptate doloremque sed pariatur?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse? Perspiciatis nesciunt, dolores nisi veniam ex dolorem harum debitis reiciendis libero esse facilis iste qui natus voluptate doloremque sed pariatur?</p>
                </div>
            
            </div>
