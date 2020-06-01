<?php
$conn= new mysqli("localhost","root","","advenced_crud");

if($conn->connect_error){

    die("could not connect to the database!".$conn->connect_error);
}









?>