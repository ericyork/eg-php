<?php $page_title = "Demo Create" ?>
<?php include 'inc/head.php';?>
<?php include 'inc/main-nav.php';?>
<?php
if($_POST){
    // include database connection
    include 'config/database.php';
    try{
        // insert query
        $query = "INSERT INTO products SET name=:name, description=:description, price=:price, created=:created";
        // prepare query for execution
        $stmt = $con->prepare($query);
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['name']));
        $description=htmlspecialchars(strip_tags($_POST['description']));
        $price=htmlspecialchars(strip_tags($_POST['price']));
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        // specify when this record was inserted to the database
        $created=date('Y-m-d H:i:s');
        $stmt->bindParam(':created', $created);
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
    }
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
<main class="page container">
  <h3>Create a Record</h3>
  <p>Fill out the form below to add a new product to the database.</p>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-bordered'>
      <tr>
        <td>Name</td>
        <td><input type='text' name='name' class='form-control' /></td>
      </tr>
      <tr>
        <td>Description</td>
        <td><textarea name='description' class='form-control'></textarea></td>
      </tr>
      <tr>
        <td>Price</td>
        <td><input type='text' name='price' class='form-control' /></td>
      </tr>
      <tr>
        <td></td>
      <td style="text-align:right;">
        <a href='index.php' class='btn btn-danger'>&#8592; All Products</a>
        <input type='submit' value='Save' class='btn btn-primary' />
      </td>
      </tr>
    </table>
</form>
</main>
<?php include 'inc/footer.php';?>
