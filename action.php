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
    $name=strip_tags($_POST['name']);
    $email=strip_tags($_POST['email']);
    $phone=strip_tags($_POST['phone']);

    $image=strip_tags($_FILES['image']['name']);
    $tmp_name=$_FILES["image"]["tmp_name"];
    
    $upload='img/'.$image;
    move_uploaded_file($tmp_name,$upload);
   
   
    $query= "INSERT INTO user( name, email,phone,image) VALUES(?,?,?,?)";
     
    $stmt=$conn->prepare($query);
    $stmt->bind_param('ssss',$name,$email,$phone,$upload);
   
    $stmt->execute();

     
     

    header('location:index.php');

    //message de confirmation
    $_SESSION['message']="L'insertion a été effectuée avec success";
    $_SESSION['msg_type']="success";
} 

//////////////////////////delete
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
// delete image from img folder
    $sql="SELECT image FROM user WHERE id=?";
    // Prépare une requête SQL pour l'exécution
    $stmt2=$conn->prepare($sql);
    //The PDOStatement::bindParam() function is an inbuilt function in PHP which is used to bind a parameter to the specified variable name. This function bound the variables, pass their value as input and receive the output value, if any, of their associated parameter
    $stmt2->bind_param('i',$id);
    //The PHP Execute command can be used to execute a PHP script or function.
    $stmt2->execute();
    //Call to return a result set from a prepared statement query.
    $result2=$stmt2-> get_result();
    //The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array. 
    $row=$result2->fetch_assoc();

    $imagepath=$row['image'];
    //The unlink() function is an inbuilt function in PHP which is used to delete files.
    unlink($imagepath);


    $query= "DELETE FROM user WHERE id=?";
     
    $stmt=$conn->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();
//en haut de l'interface
    header('location:index.php');
 //message de confirmation
 $_SESSION['message']="the record has been deleted successfully";
 $_SESSION['msg_type']="danger";
  
}
//////////////////////////////// edit ////////////////////////////////////////////////
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
        $id= strip_tags($_POST['id']);
        $name=strip_tags($_POST['name']);
        $email=strip_tags($_POST['email']);
        $phone=strip_tags($_POST['phone']);

  

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

    

?>