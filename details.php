<style>
    .jumbotron {
  width: 40%;
  height: 88%;
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
include('nav.php');
include('action.php');
if(isset($_GET['detail'])){
    $id=$_GET['detail'];

    $query= "SELECT * FROM user WHERE id=?";
     
    $stmt=$conn->prepare($query);
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result= $stmt->get_result();
    $row=$result->fetch_assoc();

    $vid=$row['id'];
    $vname=$row['name'];
    $vemail=$row['email'];
    $vphone=$row['phone'];
    $vimage=$row['image'];


}
?>
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
      <div class="jumbotron bg-info">
          <div class="container">
              <h4 class="display-4 text-light" style="font-family:sans-serif;">User's Details</h4>
              <b><p class="bg-light p-2 rounded text-center text-dark">ID :<?php echo $vid;?></p></b><br>
              <p class="text-center"><img src="<?php echo $vimage;?>" width="180"></p>
              <hr class="my-2">
              <h5 class="display-5 text-light" style="color:black;">Name : <?php echo $vname;?></h5>
              <h5 class="display-5 text-light" style="color:black;">Email : <?php echo $vemail;?></h5>
              <h5  class="display-5 text-light" style="color:black;">Phone : <?php echo $vphone;?></h5>
          </div>
          
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>