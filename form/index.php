<?php 
  $title = "Bienvenue";
  // can use ob_start(); and ob_get_clean(); for storing html content. 
  /* ie: 
  * <?php ob_start(); ?>
  *   <html><!--  Some content --> </html>
  * 
  * <?php  
  *   $content = ob_get_clean();
  *   echo $content;
  * ?>
  * cf: 
  */
  include("template.php");
?>
  <form action="welcome.php" method="POST">
    Intitulé:
    <input type="text" name="sex" placeholder="Monsieur">
    <br>
    <label for="idfirstname">Prénom:</label>
    <input name="idfirstname" placeholder="Jean Paul">
    <label for="idlastname">Nom:</label>
    <input name="idlastname" placeholder="Dubois">
    
    <input type="submit">
  </form>
</body>
</html>