<footer class="container-fluid border-top border-bottom">
    <p style="text-align: center; margin-top: 1em;">&copy; 2018 Comm429</p>
</footer>
<!-- Bootstrap JS Dependencies (first jQuery, then Popper.js, then Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type='text/javascript'>
  // confirm record deletion
  function delete_user( id ){
      var answer = confirm('Are you sure? This cannot be undone.');
      if (answer){
          // if user clicked ok,
          // pass the id to delete.php and execute the delete query
          window.location = 'delete.php?id=' + id;
      }
  }
</script>
</body>
</html>
