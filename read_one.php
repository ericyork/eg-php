<?php $page_title = "Single Product" ?>
<?php include 'inc/head.php';?>
<?php include 'inc/main-nav.php';?>
<main class="page container">
  <h3>View Product</h3>
  <?php // get passed parameter value, in this case, the record ID
    // isset() is a PHP function used to verify if a value is there or not
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
  <table class="table table-bordereds">
    <tr>
        <td>Name</td>
        <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><?php echo htmlspecialchars($price, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-outline-primary'>&#8592; All Products</a>
        </td>
    </tr>
  </table>
</main>
<?php include 'inc/footer.php';?>
