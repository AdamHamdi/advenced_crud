<?php 
session_start();
include ("config.php");
$update=false;
    $id="";
    $name="";
    $email="";
    $phone="";
    $image="";

if(isset($_POST['add'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];

  

    $image=$_FILES['image']['name'];
    $tmp_name=$_FILES["image"]["tmp_name"];
    
    $upload='img/'.$image;



    move_uploaded_file($tmp_name,$upload.$image);
   
   
    $query= "INSERT INTO user( name, email,phone,image) VALUES(?,?,?,?)";
     
    $stmt=$conn->prepare($query);
    $stmt->bind_param('ssss',$name,$email,$phone,$upload);
   
    $stmt->execute();

     
     

    header('location:index.php');

    //message de confirmation
    $_SESSION['message']="L'insertion a été effectuée avec success";
    $_SESSION['msg_type']="success";
} 
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
// delete image from img folder
    $sql="SELECT image FROM user WHERE id=?";
    $stmt2=$conn->prepare($sql);
    $stmt2->bind_param('i',$id);
    $stmt2->execute();
    $result2=$stmt2-> get_result();
    $row=$result2->fetch_assoc();

    $imagepath=$row['image'];
    unlink($imagepath);


    $query= "DELETE FROM user WHERE id=?";
     
    $stmt=$conn->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();

    header('location:index.php');
 //message de confirmation
 $_SESSION['message']="the record has been deleted successfully";
 $_SESSION['msg_type']="danger";
  
}
if(isset($_GET['edit'])){
    $id=$_GET['edit'];

    $query= "SELECT * FROM user WHERE id=?";
     
    $stmt=$conn->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result= $stmt->get_result();
    $row=$result->fetch_assoc();

    $id=$row['id'];
    $name=$row['name'];
    $email=$row['email'];
    $phone=$row['phone'];
    $image=$row['image'];

    $update=true;

    }
    if(isset($_POST['update'])){
        $id= $_POST['id'];
        $name=$_POST['name'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];

  

       $oldimage=$_POST['oldimage'];
     if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
        $newimage="img/".$_FILES["image"]["name"];
        unlink($oldimage);
        move_uploaded_file($_FILES['image']['name'],$newimage);
    } else{
        $newimage=$oldimage;
    }
   
        
        $query="UPDATE  user SET name=?, email=?, phone=? ,image=? WHERE id=?";

        $stmt=$conn->prepare($query);
        $stmt->bind_param('ssssi', $name, $email, $phone,$newimage, $id);
   
         $stmt->execute();
        

        $_SESSION['message']="Mise à jour a été effectué avec success";
        $_SESSION['msg_type']="warning";
        header('location:index.php');
    }    

if(isset($_GET['detail'])){
    $id=$_GET['detail'];

    $query= "SELECT FROM user WHERE id=$id";
     
    $stmt=$conn->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();

    header('location:index.php');}

?>