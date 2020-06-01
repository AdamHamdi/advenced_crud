<style>
    .jumbotron {
  width: 50%;
  height: 80%;
  display: grid;
  justify-content: center;
  margin: 50px 30px 30px 25%;
  border: 0.08em solid black;
}
.marginauto {
    margin: 10px auto 20px;
    display: block;
}

</style>
<?php 
include('nav.php')?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body style="background:#f1f2f6">
      <div class="jumbotron ">
          <?php
      while($row=($stmt->fetch_assoc())){?>
          <div class="container">
          
              <h3 class="display-3">User's Details</h3>
              <button class="btn btn-block btn-info">ID:# <?php  echo $row['id'];?></button><br>
              <img src="<?=$row['image'];?>" width="25">
              <hr class="my-2">
              <h5 >Name:<?php  echo $row['name'];?></h5>
              <h5>Email:<?php  echo $row['email'];?></h5>
              <h5>Phone:<?php  echo $row['phone'];?></h5>
          </div>
          <?php } ?>
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>