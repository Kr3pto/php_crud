<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>PHP CRUD</title>
  </head>
  <body>

    <?php require_once'process.php'; ?>


    <?php 
      
    if (isset($_SESSION['message'])): ?>
      <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
        <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);

         ?>
    <?php endif ?>
      </div>

    <div class="container">
    <?php 
    $mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    //pre_r($result);
   /*pre_r($result -> fetch_assoc());*/

   /* function pre_r($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    };*/
     ?>
     <div class="row justify-content-center">
         <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php 
                while($row = $result -> fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["location"]; ?></td>
                        <td>
                        <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </thead>
         </table>

     </div>
 </div>
<div class="row justify-content-center">

    <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
        </div>
         <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" value="<?php echo $location; ?>" class="form-control" placeholder="Enter your location">
        </div>
         <div class="form-group">
          <?php if ($update == true):?>
            <button type="submit" name="update" class="btn btn-info">update</button>
            <?php else : ?>
             <button type="submit" name="save" class="btn btn-primary">Save</button>
           <?php endif; ?>
         </div>
    </form>
</div>



   

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


  </body>
</html>