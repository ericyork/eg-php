<?php $page_title = "Edit Product" ?>
<?php include 'inc/head.php';?>
<?php include 'inc/main-nav.php';?>
<main class="page container">
  <h3>Update Product
    <a href='index.php' class='btn btn-primary ml-1 mb-1'>&#8592; Products</a>
  </h3>
  <?php // get passed parameter value, in this case, the record ID
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
    //include database connection
    include 'config/database.php';
    // read current record's data
    try {
        // prepare select query
        $query = "SELECT id, name, description, price FROM products WHERE id = ? LIMIT 0,1";
        $stmt = $con->prepare( $query );
        // this is the first question mark
        $stmt->bindParam(1, $id);
        // execute our query
        $stmt->execute();
        // store retrieved row to a variable
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // values to fill up our form
        $name = $row['name'];
        $description = $row['description'];
        $price = $row['price'];
    }
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
  ?>
  <?php
  // check if form was submitted
  if($_POST){
      try{
          // write update query
          // in this case, it seemed like we have so many fields to pass and
          // it is better to label them and not use question marks
          $query = "UPDATE products
                      SET name=:name, description=:description, price=:price
                      WHERE id = :id";
          // prepare query for excecution
          $stmt = $con->prepare($query);
          // posted values
          $name=htmlspecialchars(strip_tags($_POST['name']));
          $description=htmlspecialchars(strip_tags($_POST['description']));
          $price=htmlspecialchars(strip_tags($_POST['price']));
          // bind the parameters
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':description', $description);
          $stmt->bindParam(':price', $price);
          $stmt->bindParam(':id', $id);
          // Execute the query
          if($stmt->execute()){
              echo "<div class='alert alert-success'>Record was updated.</div>";
          }else{
              echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
          }
      }
      // show errors
      catch(PDOException $exception){
          die('ERROR: ' . $exception->getMessage());
      }
  }
  ?>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
      <tr>
        <td>Name</td>
        <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
      </tr>
      <tr>
        <td>Description</td>
        <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
      </tr>
      <tr>
      <td>Price</td>
      <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
      </tr>
      <tr>
        <td></td>
      <td>
        <input type='submit' value='Save Changes' class='btn btn-primary' />
        <a href='index.php' class='btn btn-danger'>Back to read products</a>
      </td>
      </tr>
    </table>
  </form>
</main>
<?php include 'inc/footer.php';?>
