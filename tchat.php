<?php
session_start();
if(!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"])){
	header("location:index.php");
}
include "connect.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" href="theme/style.css" type="text/css" media="screen" />
  <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="js/tchat.js"></script>
  
  
  
<!-- REQUIRED FOR PARALLAX -->
<script type="text/javascript" language="JavaScript" src="js/jquery.jparallax.min.js" ></script>
<script type="text/javascript" language="JavaScript" src="js/jquery.event.frame.js" ></script>

<link lang="text/css" href="css/styles.css" />


<script type="text/javascript">
jQuery(document).ready(function() 
{
	$('#parallax .parallax-layer')
	.parallax({
		mouseport: $('#parallax'),
		mouseResponse : false
	});
});
</script>  
<!-- /REQUIRED FOR PARALLAX -->

<title>Cow Project</title>

<style>


#content { background-color:#FFFFFF; width:950px; min-height:550px; text-align:left; padding:0px;  }
h1 { padding:20px; background-color:gray; color:white; margin:0; text-shadow: #9E9B9B 2px 2px 2px;  text-align:center;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#E3E1E1', endColorstr='#CCCACA'); /* for IE */
	background: -webkit-gradient(linear, left top, left bottom, from(#E3E1E1), to(#CCCACA)); /* for webkit browsers */
	background: -moz-linear-gradient(top,  #E3E1E1,  #CCCACA); /* for firefox 3.6+ */ 
}
.large { font-size:22px; }
.orange { color:orange; }
.italic { font-style:italic }
.textmiddle {vertical-align:middle;} 
.padout { padding-left:25px; padding-right:25px; }
.rounded-corners {
     -moz-border-radius: 40px;
    -webkit-border-radius: 40px;
    -khtml-border-radius: 40px;
    border-radius: 40px;
}
.rounded-corners-top {
     -moz-border-top-radius: 40px;
    -webkit-border-radius: 40px;
    -khtml-border-radius: 40px;
    border-radius: 40px;
}



h2 { color:blue; font-size:22px; color:white; background-color:gray; padding:10px 10px 10px 20px;
     -moz-border-radius: 40px;
    -webkit-border-radius: 40px;
    -khtml-border-radius: 40px;
    border-radius: 40px;
	text-shadow: #9E9B9B 2px 2px 2px;
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#E3E1E1', endColorstr='#CCCACA'); /* for IE */
	background: -webkit-gradient(linear, left top, left bottom, from(#E3E1E1), to(#CCCACA)); /* for webkit browsers */
	background: -moz-linear-gradient(top,  #E3E1E1,  #CCCACA); /* for firefox 3.6+ */ 
  }
  p {
	margin: 20px !important;
}
.scrolldown { padding-left:20px; color:#EDECE8; font-size:40px; font-weight:bold; vertical-align:middle;
	text-shadow: #6374AB 2px 2px 2px;
 }
 #page-wrap {
     border: 1px solid orange;
    margin: 10px auto;
    width: 950px;
	}
 #parallax-header { height:200px; background-color:gray;  }
 #parallax {position:relative; overflow:hidden; width:950px; height:250px;
	background-image:url('images/background.jpg');
 }
.parallax-viewport {
    position: relative;     /* relative, absolute, fixed */
    overflow: hidden;
}
.parallax-layer {
    position: absolute;
}

</style>
  
  
  <script type="text/javascript">
	<?php
		$sql = "SELECT id FROM messages ORDER BY id DESC LIMIT 1";
		$req = mysql_query($sql) or die(mysql_error());
		$data=mysql_fetch_assoc($req);
	?>
	var lastid = <?php echo $data["id"]; ?>
  </script>
</head>

<body>
  <div id="conteneur" style="width:94%; margin-bottom:200px;">
    <h1>Mon tchat, connectez en tant que <?php echo $_SESSION["pseudo"]; ?></h1>
    <div id="connected">
	
    </div>
    
    <div id="tchat">
	<div id="parallax" class="clear">
	<div class="parallax-layer" style="width:1200px; height:250px;">
		<img src="images/grass.png" alt="" style="width:1200px; height:250px;"/>
	</div>
	<?php
		$sql = "SELECT * FROM messages ORDER BY date DESC LIMIT 15";
		$req = mysql_query($sql) or die(mysql_error());
		$d = array();
		while($data = mysql_fetch_assoc($req)){
			$d[] = $data;
		}
		for($i=count($d)-1;$i>=0;$i--){			
		?>
	<div class="parallax-layer"style="width:150px; height:250px;">
		<img src="images/cow1.png" alt="" style="width:120px; height:150px; margin-top:90px;"/>
	</div>
	 <div class="parallax-layer" style="width:150px; height:250px;">
		<img src="images/cow1.png" alt="" style="width:120px; height:150px; margin-top:90px; margin-left:260px"/>
	</div>
			<div class="parallax-layer" style="width:100px; height:250px; color:#ffffff;"></div> 
		
		<?php
		}
	 ?>
	 </div>
    </div>


	
  </div>
  
  <div id="tchatForm" style="position:fixed;bottom:0;width:100%;">
       <form method="post" action="#">
	  <div style="margin-right:110px;">
	      <textarea name="message" style="width:100%;"></textarea>
	  </div>
	  <div style="position:absolute; top:12px; right:0;">
	      <input type="submit" value="Envoyer"/>
	  </div>
	</form>      
  </div>
</body>
</html>