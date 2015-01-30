<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>FOSSGIS 2015</title>
  <link rel="stylesheet" href="css/foundation.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/app.css">
  <script src="js/vendor/modernizr.js"></script>
  <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
  <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
  <script src="phonegap.js" type="text/javascript"></script>

</head>
<body >
   <div class="row">
		<img src="img/header.png" height="100%" alt="SchlossMuenster">
		
	</div>

   <div class="row">  
   <!-- </div>
Verschiebt alles nach links
  </div> -->

  <div class="large-12 columns">
  <br>
    
    <dl class="tabs"  align="center" data-tab data-options="deep_linking:true" data-options="scroll_to_content: false">
        <dd>		<a href="#">Aktuelles</a></dd>
        <dd class="active"><a href="#">Veranstaltungen</a></dd>
        <dd>        <a href="#">Navigation</a></dd>
		<dd>		<a href="#">Schwarzes Brett</a></dd>
    </dl>
      <div class="tabs-content">
	  
        <div class="content" id="News">
          <strong class="hide-for-small-only">
		  <figure>
				<img width="880" height="130" alt="BannerFOSSGISMUENSTERAktAllg" src="img/BannerFOSSGISMUENSTERAktAllg.jpg"/>
		  </figure>
		  </strong>
		<div> 
			<a class="twitter-timeline" align="center" href="https://twitter.com/FOSSGIS2015" data-widget-id="542438223738187776">Tweets von @FOSSGIS2015 </a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    	  </div>
        </div>
		
        <div class="content active" id="Veranstaltungen">
		<strong class="hide-for-small-only">
		<figure>
				<img width="880" height="130" alt="BannerFOSSGISMUENSTERVeranstaltungs" src="img/BannerFOSSGISMUENSTERVeranstaltungs.jpg"/>
	
			</figure>
		</strong>

			  <div class="row collapse">
				<div class="large-10 columns small-12 columns">
					<input type="text" placeholder="Finde Veranstaltungen">
				</div>
				<div class="large-2 columns small-12 columns">
				  <a href="#" class="alert button expand" id="search">Search</a>
				  <style>
					#search{
					  padding-top: 0.3rem;
					  padding-right: 2rem;
					  padding-bottom: 0.3rem;
					  padding-left: 2rem;
					  font-size: 1.5rem;}
				  </style>
				</div>
			  </div>
		         
		  <dl class="accordion" data-accordion>
		  <dd class="accordion-navigation">
			<a href="#panel1">Mittwoch</a>
			<div id="panel1" class="content active">
			 <dl class="tabs" data-tab>
				<dd class="active"><a href="#panel3-1">Aula</a></dd>
				<dd><a href="#panel1-2">S10</a></dd>
				<dd><a href="#panel1-3">S2</a></dd>
				<dd><a href="#panel1-4">S1</a></dd>
				<dd><a href="#panel1-5">Studlab1</a></dd>
				<dd><a href="#panel1-6">Studlab2</a></dd>
				<dd><a href="#panel1-7">Studlab3</a></dd>
			</dl>
			  <div class="tabs-content">
				<div class="content active" id="panel1-1">
				  <?php
						// attempt a connection
						ini_set('display_errors', '1');
						error_reporting(E_ALL | E_STRICT);
						include("config.php");

						//-----------------------------------------------------------
						
						// execute query
						$sql = "SELECT title, start , subtitle, description, duration
								FROM Speech
								WHERE room_id =  'Aula'
								AND DATE =  '2015-03-11'
								Order by start";
	
						//-----------------------------------------------------------
						
						$result = mysqli_query($connection, $sql);
						

						// iterate over result set
						// print each row
						$number = 0;
						while ($row = mysqli_fetch_array($result)) {
							$title = (string)$row[0];
							$start = (string)$row[1];
							$subtitle = (string)$row[2];
							$description = (string)$row[3];
							$number = $number + 1;
							$duration = (string)$row[4];
							
						
							echo '<p>' . $start . ' : '  . $title . ' ';
							echo '<a href="#" class="button" data-reveal-id="infos' . $number . '"> weitere Informationen</a>';
							echo ' ';
							echo '<a href="#" class="button"> Merken</a>';	
							echo ' ';
							echo '<a href="participate.php" class="button"> Teilnehmen </a>';
							
							echo '<div id="infos' . $number . '" class="reveal-modal" data-reveal>';
							echo '	<h2>' . $title . '</h2>';
							echo '	<p class="lead">' . $subtitle .'</p>';
							echo ' <p> Dauer: ' . $duration . '</p>';
							echo '	<p>' . $description . '</p>';
							echo '	<a class="close-reveal-modal">&#215;</a>';
							echo '</div>';

						}

						// close connection
						//mysql_close();
					?>
				</div>
				<div class="content" id="panel1-2">
					<?php
						// attempt a connection
						//ini_set('display_errors', '1');
						//error_reporting(E_ALL | E_STRICT);
						//include("config.php");

						//-----------------------------------------------------------
						
						// execute query
						$sql = "SELECT title, start , subtitle, description, duration
								FROM Speech
								WHERE room_id =  'S10'
								AND DATE =  '2015-03-11'
								Order by start";
	
						//-----------------------------------------------------------
						
						$result = mysqli_query($connection, $sql);
						

						// iterate over result set
						// print each row
						while ($row = mysqli_fetch_array($result)) {
							$title = (string)$row[0];
							$start = (string)$row[1];
							$subtitle = (string)$row[2];
							$description = (string)$row[3];
							$number = $number + 1;
							$duration = (string)$row[4];
							
						
							echo '<p>' . $start . ' : '  . $title . ' ';
							echo '<a href="#" class="button" data-reveal-id="infos' . $number . '"> weitere Informationen</a>';
							echo ' ';
							echo '<a href="#" class="button"> Merken</a>';	
							echo ' ';
							echo '<a href="participate.php" class="button"> Teilnehmen </a>';
							
							echo '<div id="infos' . $number . '" class="reveal-modal" data-reveal>';
							echo '	<h2>' . $title . '</h2>';
							echo '	<p class="lead">' . $subtitle .'</p>';
							echo ' <p> Dauer: ' . $duration . '</p>';
							echo '	<p>' . $description . '</p>';
							echo '	<a class="close-reveal-modal">&#215;</a>';
							echo '</div>';

						}

						// close connection
						//mysql_close();
					?>
				</div>
				<div class="content" id="panel1-3">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel1-4">
				  <p>fourth panel content goes here...</p>
				</div>
				<div class="content" id="panel1-5">
				  <p>fifth panel content goes here...</p>
				</div>
				<div class="content" id="panel1-6">
				  <p>sixth panel content goes here...</p>
				</div>
				<div class="content" id="panel1-7">
				  <p>seventh panel content goes here...</p>
				</div>
			  </div>
			</div>
		  </dd>
		   <dd class="accordion-navigation">
			<a href="#panel2">Donnerstag</a>
			<div id="panel2" class="content">
			
		   <dl class="tabs" data-tab>
				<dd class="active"><a href="#panel2-1">Aula</a></dd>
				<dd><a href="#panel2-2">S10</a></dd>
				<dd><a href="#panel2-3">S2</a></dd>
				<dd><a href="#panel2-4">S1</a></dd>
				<dd><a href="#panel2-5">Studlab1</a></dd>
				<dd><a href="#panel2-6">Studlab2</a></dd>
				<dd><a href="#panel2-7">Studlab3</a></dd>
			</dl>
			  <div class="tabs-content">
				<div class="content active" id="panel2-1">
				  <p>First panel content goes here...</p>
				</div>
				<div class="content" id="panel2-2">
				  <p>Second panel content goes here...</p>
				</div>
				<div class="content" id="panel2-3">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel2-4">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel2-5">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel2-6">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel2-7">
				  <p>Third panel content goes here...</p>
				</div>
			  </div>
			</div>
		  </dd>
		  <dd class="accordion-navigation">
			<a href="#panel3">Freitag</a>
			<div id="panel3" class="content">
			  
			  <dl class="tabs" data-tab>
				<dd class="active"><a href="#panel3-1">Aula</a></dd>
				<dd><a href="#panel3-2">S10</a></dd>
				<dd><a href="#panel3-3">S2</a></dd>
				<dd><a href="#panel3-4">S1</a></dd>
				<dd><a href="#panel3-5">Studlab1</a></dd>
				<dd><a href="#panel3-6">Studlab2</a></dd>
				<dd><a href="#panel3-7">Studlab3</a></dd>
			</dl>
			  <div class="tabs-content">
				<div class="content active" id="panel3-1">
				  <p>First panel content goes here...</p>
				</div>
				<div class="content" id="panel3-2">
				  <p>Second panel content goes here...</p>
				</div>
				<div class="content" id="panel3-3">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel3-4">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel3-5">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel3-6">
				  <p>Third panel content goes here...</p>
				</div>
				<div class="content" id="panel3-7">
				  <p>Third panel content goes here...</p>
				</div>
			  </div>
			</div>
			 </dd>
			</div>
  
  <div class="content" id="Navigation">
	<strong class="hide-for-small-only">
		<figure>
				<img width="880" height="130" alt="BannerFOSSGISMUENSTERNavigation" src="img/BannerFOSSGISMUENSTERNavigation.jpg"/>
	
		</figure>
	</strong>
   <div id="map">
   <style>#map { height: 400px; }  </style>
   <script type="text/javascript" >
   	var map = L.map('map').setView([51.969103, 7.595748],16);
	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 20,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
		}).addTo(map);

	L.marker([51.969103, 7.595748]).addTo(map).bindPopup("IfGi").openPopup();
	L.marker([51.963772, 7.613425]).addTo(map).bindPopup("Schloss").openPopup();
   </script>
   </div>
   </br>
   <p> <a href="http://www.stadtwerke-muenster.de/fis/5991" class="button">Bushaltestelle Mendelstraße</a>
		<a href="http://www.stadtwerke-muenster.de/fis/1362" class="button">Bushaltestelle Landgericht</a></p> 
   <p> Raumpläne? </p>
  </div>


            
      <div class="content" id="schwarzesBrett">
	    <strong class="hide-for-small-only">
			<figure>
				<img width="880" height="130" alt="BannerFOSSGISMUENSTERSchwarz" src="img/BannerFOSSGISMUENSTERSchwarz.jpg"/>
			</figure>
		</strong>
			<p><img src="img/schwarzesBrett.png" alt="schwarzes Brett"></p>
			<ul class="small-block-grid-1 medium-block-grid-3">
			<li>
 			<ul class="accordion">
			  <li class="accordion-navigation">
				<a href="schwarzesBrett#panel1">Kommentar erstellen</a>
				<div id="panel1" class="content">
				 <form>
					  <div class="row">
						<div class="large-12 columns">
						  <label>Überschrift
							<input type="text" placeholder="Thema" />
						  </label>
						</div>
					  </div>

					  <div class="row">
						<div class="large-12 columns">
						  <label>Notiz
							<textarea placeholder="Inhalt"></textarea>
						  </label>
						</div>
					  </div>
					  <div class="row">
					  </br>
					  <input type="submit" name="submit1" style="BACKGROUND-COLOR: #FA751A; COLOR: white" value="Abschicken" class="default button">
					  </div>
				 </form>
			    </div>
			  </li>
			</ul> 
			</li>			
			</ul>
			
	
	  </div>
        </div>

    </div>
  </div>
  </div>
  
  
 
   <!-- Footer -->
   
  <ul class="breadcrumbs">
  <li class="current"><a href="#">Home</a></li>
  <li><a href="Kontakt.html">Kontakt</a></li>
  <li><a href="Impressum.html">Impressum</a></li>
  <li><a href="FAQ.html">FAQ</a></li>
</ul>


  <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script src="js/foundation/foundation.interchange.js"></script>
  <script src="js/foundation/foundation.offcanvas.js"></script>
  <script>
    $(document).foundation();
    $("#swap").on("replace", function() {
      $(document).foundation();
    });
  </script>
</body>
</html>