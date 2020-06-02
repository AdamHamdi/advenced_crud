<?php 
include("nav.php");
include("action.php");
 
$mysqli= new mysqli('localhost','root','','advenced_crud')or die(mysqli_error($mysqli));
$query=("SELECT * FROM user ")or(die($mysqli->error));
$stmt=$mysqli->prepare($query);
$stmt->execute();
$result=$stmt->get_result();
 //pre_r($result);
//pre_r($result->fetch_assoc());
function pre_r($array) {
     echo'<pre>';
     print_r($array);
     echo'</pre>';
 }              


?>

<!doctype html>
<html lang="en">
  <head>
    <title>Index</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background:#f1f2f6">
      <div class="container"><br>
      <h3 style="font-family:sans-serif;text-align:center;" class="text-info">Advanced crud app using php and mysql</h3><hr>
      <?php if(isset($_SESSION['message'])){?>
      
      <div class="alert alert-<?=$_SESSION['msg_type'];?>" role="alert">
           <a href="#" class="alert-link"> </a><?=$_SESSION['message'];?>
       </div>
       <?php } unset($_SESSION['message']); ?>
          <div class="row">
              <div class="col-md-3">
                <h3 style="font-family:sans-serif;" class="text-info">Add Record</h3>  
                <form action="action.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group">
                        
                        <input  class="form-control required  " type="text" name="name" value="<?php echo $name;?>" required placeholder="User Name">
                    </div>
                    <div class="form-group">
                     
                        <input  class="form-control  " type="text" name="email" value="<?php echo $email;?>" required placeholder="User Email">
                    </div>
                    <div class="form-group">
                        
                        <input  class="form-control  " type="text" name="phone" value="<?php echo $phone;?>" placeholder="User phone" required>
                    </div>
                    <div class="form-group">
                        
                        <input type="hidden" name="oldimage" value="<?php echo $image;?>">
                    <input type="file"  class="custom-file" name="image" >
                    <img src="<?php echo $image;?>" width="120" class="img-fluid img-thumbnail">
                    </div>
                    <div class="form-group">
                    <?php if($update==true){ ?>
                    <input name="update" type="submit" class="btn btn-warning btn-block" value="Update Record">
                    <?php } else { ?>
                        <input type='submit' class="btn btn-info btn-block" name="add" value="Add Record">
                    <?php }?>
                    </div>
                    </form>            
              </div>
              <div class="col-md-9 ">
              <h3 class="text-info" style="font-family:sans-serif;text-align:center;">Records in database :</h3>
              <table class="table table-striped">
                        <thead  class="thead-light">
                        <tr>
                           <th scope="col">#</th>
                           <th scope="col">Picture </th>
                           <th scope="col">Name </th>
                           <th scope="col">Email</th>
                           <th scope="col">Phone</th>
                           <th scope="col" class="text-center">Actions</th>
                  </tr>
                        </thead>
                        <?php 
                        while($row=($result->fetch_assoc())){?>
                        
                        <tbody>
                            <tr>
                                <td><?php  echo $row['id'];?></td>
                                <td><img src= "<?php echo $row['image']; ?>" width="25px"></td>
                                <td><?php  echo $row['name'];?></td>
                                <td><?php  echo $row['email'];?></td>
                                <td><?php  echo $row['phone'];?></td>
                                <td>
                                    <a href="details.php?<?php echo $row['id'];?>" class='btn btn-sm btn-info' name="detail">Details</a>
                                    <a href="index.php?edit=<?php echo $row['id']?>" class='btn btn-sm btn-success' name="edit">Edit</a>
                                    <a href="action.php?delete=<?php echo $row['id'];?>" class='btn btn-sm btn-danger' onclick="return confirm('Do you want to delete this record')" name="delete">Delete</a>
                                    
                                </td>
                                
                            </tr>
                  
                        </tbody>
                        <?php } ?>
                    </table>

              </div>
          </div>
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>