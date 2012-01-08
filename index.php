<?php
include("connect.php");
if(!empty($_POST) && isset($_POST["pseudo"]) && !empty($_POST["pseudo"])){
      session_start();
      $pseudo = $_POST["pseudo"];
      $pseudo = mysql_escape_string($pseudo);
      $sql = "SELECT * FROM connected WHERE pseudo LIKE '$pseudo' LIMIT 1";
      $req = mysql_query($sql);
      $data = mysql_fetch_assoc($req);
      if(empty($data)){
	 $ip = $_SERVER["REMOTE_ADDR"];
	 $sql = "INSERT INTO connected(pseudo,ip,date) VALUES ('$pseudo','$ip',".time().")";
	 $req = mysql_query($sql) or die(mysql_error());
	 $idTchat = mysql_insert_id();
      }
      else{
	  if($data["ip"] == $_SERVER["REMOTE_ADDR"] && time()-$data["date"]<60 ){
	      $idTchat = $data["id"];
	  }
	  else if(time()-$data["date"]>60){
	      $idTchat =  $data["id"];
	  }
	  else{
	      $erreur = "Ce pseudo est déja en cours d'utilisation";
	  }
      }
      if(!isset($erreur)){
	    $_SESSION["pseudo"] = $_POST["pseudo"];
	    $_SESSION["idTchat"] = $idTchat;
	    header("location:tchat.php");
      }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="theme/style.css" type="text/css" media="screen" />
</head>

<body>
  <div id="conteneur">
    <h1>Mon tchat</h1>
  <?php if(isset($erreur)){ echo "<p>$erreur</p>"; }?>
    <form action="index.php" method="post">
	Pseudo : <input type="text" name="pseudo"/>
	<input type="submit" value="tchatter"/>
    </form>
  </div>
</body>
</html>