<?php
  $sex = $_POST["sex"];
  $first = $_POST["idfirstname"];
  $last = $_POST["idlastname"];
  
  if (!isset($sex) || !isset($first) || !isset($last)) {
    header("Location: index.php");
  }

  $title = "Bienvenue";
  include("template.php");
?>
  <p>Bienvenue 
    <span id="sex"><?php echo $sex; ?></span>
    <span id="firstname"><?php echo $first; ?></span>
    <span id="lastname"><?php echo $last; ?></span>
  </p>
</body>
</html>