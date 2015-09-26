<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Modifier un atelier</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
<style type="text/css">
.headerr a:link{text-decoration:none; color:#7a7a7a;}
.headerr a{color:#7a7a7a;}
.headerr a:hover{color:#40abfd;}

#horaires {
	margin-left:300px;
}



#horaires td input[type=checkbox] {
	width:30px!important;
}
</style>


</head>
<body  scrolling=auto>  
	<header style=" z-index: 1; position:fixed;
	top:0;
	left:0;
	height:75px;
	width:100%;
	background: white; color:#7a7a7a; box-shadow:  1px 1px 12px #a9a9a9; font-family: open sans light, Arial, Verdana, sans-serif;" class="headerr" >
		
		<div style="margin-left:7%;"><h3 style="margin-top:2%;" >Gestion des ateliers</strong> </h3>  </div> 
		
	</header>

		<div  class="row">
			<div   class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  <h1 style="margin-top:1%;"  class="kio page-header">Modifier un atelier </h1>
			</div>
		</div>  
		
	<form  role="form" method="post" action="?fait" enctype="application/x-www-form-urlencoded" >
		<div style="font-family: open sans , Arial, Verdana, sans-serif; margin-top:-1%; margin-left :25% ; width : 70%;" >
			<div  class="infoperso">
            <input type="hidden" name="id" value="<?php echo $atelier->Id; ?>" />
			<label for="titre" > Titre :  </label>
                <input id="titre"   type="text" class="input" name="titre" value="<?php echo $atelier->Titre; ?>" required autofocus> <br><br>
			<label for="theme" > Thème :  </label>
                <input id="theme"  type="text" class="input" name="theme" value="<?php echo $atelier->Theme; ?>"  required autofocus> <br><br>
			<label for="type" > Type :  </label>
                <input id="type" type="text" class="input" name="type" value="<?php echo $atelier->Type; ?>" required ><br> <br>	
			<label > Laboratoire :  </label>
                <input type="text" class="input" name="laboratoire" value="<?php echo $atelier->Laboratoire; ?>"  required ><br> <br>
			<label > Lieu :  </label>
                <input type="text" class="input" name="lieu" value="<?php echo $atelier->Lieu; ?>"  required ><br> <br>
			<label > Durée :  </label>
                <input type="text" class="input" name="duree" value="<?php echo $atelier->Duree; ?>"  required ><br> <br>
			<label > Capacité :  </label>
                <input type="text" class="input" name="capacite" value="<?php echo $atelier->Capacite; ?>"  required ><br> <br>
			<label > Inscription :  </label> 
			</div> 
		</div>
		<div style="margin-top:-3%; margin-left:45%;" >
			<label for="sur" style="width:80;  font-size:13px; "  >Sur réservation </label>
                <input style="width:35px; margin-right:15px; " id="sur" type="radio"  name="inscription" value="oui"  
                    <?php if ($atelier->Inscription) echo "checked"; ?> required >
			<label for="sans" style="width:110px;  font-size:13px; " >Sans réservation </label>
                <input style="width:35px;  " id="sans"  type="radio"  name="inscription" value="non"  
                    <?php if (!$atelier->Inscription) echo "checked"; ?> required > 
		</div>  
		<div style="font-family: open sans , Arial, Verdana, sans-serif; margin-left :25% ; width : 70%;"  >
			<div  class="infoperso">
			<br>
			<label > Date et horaires :  </label> 
			<table id="horaires">
				<?php
				for ($i=1; $i<=5; $i++) {
					?>
					<tr>
						<td style='width:180px;'>
							<label style='width:auto;display:inline;' for="<?php echo weeksDay($i, true); ?>M"><?php echo weeksDay($i); ?> matin</label>
							<input style='width:auto;height:auto;display:inline;' value ="<?php echo weeksDay($i); ?>Am"
                                id="<?php echo weeksDay($i, true); ?>M" type="checkbox"  name='horaires[]'
                                <?php if ($atelier->{weeksDay($i)} & 1) echo "checked"; ?> >
						</td>
						<td style='width:180px;'>
							<label style='width:auto;display:inline;' for="<?php echo weeksDay($i, true); ?>P"><?php echo weeksDay($i); ?> après-midi</label>
							<input style='width:auto;height:auto;display:inline;' value ="<?php echo weeksDay($i); ?>Ap"
                                id="<?php echo weeksDay($i, true); ?>P" type="checkbox"  name='horaires[]'
                                <?php if ($atelier->{weeksDay($i)} & 2) echo "checked"; ?> >
						</td>
					</tr>
					<?php
				}
				
				function weeksDay($index, $firstletteronly = false) {
					switch($index) {
						case 1 : $day = "Lundi"; break;
						case 2 : $day = "Mardi"; break;
						case 3 : $day = "Mercredi"; break;
						case 4 : $day = "Jeudi"; break;
						case 5 : $day = "Vendredi"; break;
						case 6 : $day = "Samedi"; break;
						case 7 : $day = "Dim"; break;
					}
					
					if ($firstletteronly) 
						return substr($day,0,2);
					else 
						return $day;
				}
				?>
			</table>
			
			<br><br>
				<label > Résumé :  </label>
                    <textarea type="text" class="input" name="resume" required ><?php echo $atelier->Resume; ?></textarea><br> <br> 
				<br><br><label > Animateurs :  </label>
                    <input type="text" class="input" name="animateurs" value="<?php echo $atelier->AnimConf; ?>"  required ><br> <br>
				<label > Partenaires :  </label>
                    <input type="text" class="input" name="partenaires" value="<?php echo $atelier->Partenaires; ?>"  required ><br> <br>
				<label > Public visé :  </label>
                    <textarea type="text" class="input" name="public" required ><?php echo $atelier->PublicVise; ?></textarea><br> <br>  
				<br><br><label > Contenu :  </label>
                    <input type="text" class="input" name="contenu" value="<?php echo $atelier->Contenu; ?>"  required ><br> <br>
			</div>
			<br>
			<button class="btn" style=" color:white; background-color:#40abfd;margin-left:60%; margin-top:-5%; " type="submit" > Enregistrer</button> 
		</div>	
	</form>
  </body>
</html>
