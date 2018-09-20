<?php $page_title = "Demo Home" ?>
<?php include 'inc/head.php';?>
<?php include 'inc/main-nav.php';?>
<main class="page container">
  <h3>
    Browse All Products
    <a href='create.php' class='btn btn-success ml-1 mb-1'>Add &#43;</a>
  </h3>
  <?php
  // include database connection
  include 'config/database.php';
  // tells user item was deleted
  $action = isset($_GET['action']) ? $_GET['action'] : "";
  // if it was redirected from delete.php
  if($action=='deleted'){
      echo "<div class='alert alert-success'>Record was deleted.</div>";
  }
  // select all data
  $query = "SELECT id, name, description, price FROM products ORDER BY id DESC";
  $stmt = $con->prepare($query);
  $stmt->execute();
  // this is how to get number of rows returned
  $num = $stmt->rowCount();
  //check if more than 0 record found
  if($num>0){
    echo "<table class='table table-bordered table-striped'>";//start table
    //creating our table heading
    echo "<tr>";
        echo "<th class=\"text-uppercase\">ID</th>";
        echo "<th class=\"text-uppercase\">Name</th>";
        echo "<th class=\"text-uppercase\">Description</th>";
        echo "<th class=\"text-uppercase\">Price</th>";
        echo "<th class=\"text-uppercase\">Action</th>";
    echo "</tr>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // extract row
    extract($row);
    // creating new table row per record
    echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td class=\"font-weight-bold\">{$name}</td>";
        echo "<td>{$description}</td>";
        echo "<td>&#36;{$price}</td>";
        echo "<td>";
            // read one record
            echo "<a href='read_one.php?id={$id}' class='btn btn-info mr-2'>View</a>";
            // we will use this links on next part of this post
            echo "<a href='update.php?id={$id}' class='btn btn-primary mr-2' font-weight-bold>&#9998;</a>";
            // we will use this links on next part of this post
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger font-weight-bold'>&#8722;</a>";
        echo "</td>";
    echo "</tr>";
}
// end table
echo "</table>";
  }
  // if no records found
  else{
      echo "<div class='alert alert-danger'>No records found.</div>";
  }
  ?>
</main>
<?php include 'inc/footer.php';?>
