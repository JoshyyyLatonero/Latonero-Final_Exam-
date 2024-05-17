<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'uploaded_img/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'PLEASE FILL IT ALL OUT';
    }else{
        $update = "UPDATE destination SET name='$product_name', price='$product_price', image='$product_image'  WHERE id = '$id'";
        $upload = mysqli_query($conn,$update);
        if($upload){
           move_uploaded_file($product_image_tmp_name, $product_image_folder);
           $message[] = 'PRODUCT UPDATED SUCCESSFULLY!';
        }else{
           $message[] = 'COULD NOT ADD THE PRODUCT';
        }
     }
};
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World</title>
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="C:\xampp\htdocs\santi\Gymshark Official Store - Gym Clothes & Workout Clothes.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
    <body>
    <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<span class="message">'.$message.'</span>';
            }
        }
        ?>
        <br>
        <div class="topnav">
            <div class="topnav">
                <a href="http://localhost/JoshLat/menu.php">MENU</a>
                <a href="http://localhost/JoshLat/cantact.php">CONTACT US</a>
            </div>
        </div>
        <div class="admincrud">
            <div class="adminform centered">
            <?php
                $select = mysqli_query($conn, "SELECT * FROM destination WHERE id = '$id'");
                while($row = mysqli_fetch_assoc($select)){
            ?>  
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <h1>update the product</h1>
                    <input type="text" placeholder="Enter Product Name" name="product_name" value="<?php echo $row['name']; ?>" class="box">
                    <input type="number" placeholder="Enter Product Price" name="product_price" value="<?php echo $row['price']; ?>" class="box">
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
                    <input type="submit" class="btn" name="update_product" value="Update Product">
                </form>
                <?php }; ?>
            </div>
        </div>
        <a href="adminpage.php" class="button">Go Back</a>
    </body>
</html>