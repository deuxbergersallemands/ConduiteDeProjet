<!DOCTYPE html>
<html lang="fr">
  <head>
		<meta charset="utf-8">
		<title>Gestion des ateliers</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<!-- <link href="dashboard.css" rel="stylesheet"> -->
		
		<style type="text/css">
			.headerr a:link{text-decoration:none; color:#7a7a7a;}
			.select a{ color:white;}
			.select a:hover{color:#7a7a7a;}
			.headerr a{color:#7a7a7a;}
			.headerr a:hover{color:#40abfd;}
		</style>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

	<script type="text/javascript" src="oXHR.js"></script>
		<script type="text/javascript">	
			function changeimage(url,obj){
				obj.src=url; 
			}
			
			ObjSelec = null;
			vari=null;
			

			
			
		</script>
  </head>
  
  
  
  <body>
	<header style=" z-index: 1; position:fixed;
	top:0;
	left:0;
	height:75px;
	width:100%;
	background: white; color:#7a7a7a; box-shadow:  1px 1px 12px #a9a9a9; font-family: open sans light, Arial, Verdana, sans-serif;" class="headerr" >
		
		<div style="margin-left:7%;"><h3 style="margin-top:2%;" >Gestion des ateliers</strong> </h3>  </div> 
		
	</header>



<?php


if(empty($ateliers)){?> 
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 style="margin-top:1%;"  class="kio page-header">Welcome</h1>
	</div>
	<a style="position:absolute; margin-left:-80%; margin-top:10%;" href="AjoutAtelier.php"  ><img  style =" padding:2px;" src="assets/images/inscrip.png"  
            onMouseOver="changeimage('assets/images/inscrip_.png',this);" onMouseOut="changeimage('assets/images/inscrip.png',this);" /></a>
	<?php }
	
else {?>
	<div style= "position:absolute; left:5%; top:10%; width:80%;">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 style="margin-top:1%;"  class="kio page-header">La liste des ateliers </h1>
	</div>
	

	<div style="margin-left:17%; margin-top:10%;">
		<table style=" border-collapse:collapse; background:#f6f6f6; width:70%;" class="table" >
			<tr style="text-align : center;  border:2px solid white; font-family: open sans semibold, Arial, Verdana, sans-serif; background:#e8e8e8;" VALIGN="MIDDLE" ALIGN="CENTER">
			<th style=" border:2px solid white; display:none;">ID de l'atelier</th>
			<th style=" border:2px solid white; width:150px;">Titre de l'atelier</th>

	
			<?php foreach ($ateliers as $atelier) { ?>
			<tr  style="font-family: open sans , Arial, Verdana, sans-serif; border:2px solid white;">
				<td style=" border:2px solid white; display:none;"><?php echo $atelier->Id; ?></td>
				<td style=" border:2px solid white; ">
					<?php echo  $atelier->Titre ;?>
					<a href="?modifier&amp;id=<?php echo $atelier->Id; ?>"><img style="float:right; margin-left:10px;" src="assets/images/configurer.png" ></a>
					<a href="?supprimer&amp;id=<?php echo $atelier->Id; ?>"><img style="float:right;"  src="assets/images/delete.png" >
				</td>
			</tr>
			
			<?php }?>
		</table>
	</div>
    </div>
	<div style="position:absolute; left:82%; top:35%;">
	<a href="?ajouter" /><img  src="assets/images/actua.png" ><button type="button" class="btn btn-link">Ajouter</button></a><br>
	</div>
	
	<?php }
    
    ?>

	
</body>
</html>
