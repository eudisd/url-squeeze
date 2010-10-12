<?php	session_start(); ?>

<!DOCTYPE html>
<html lang='en'>
	<head>
		<title> URL Shortener </title>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<script type='text/javascript'
				src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'>
		</script>

	
		<script type='text/javascript'>
			$(document).ready(function() {
				$('#canvas').hide();
				$('#mylink').click(function(){
					$('#canvas').show('slow');
				});
				$('#close').click(function() {
					$('#canvas').hide('slow');
				});
			});

			function testInput(ele){
				text = ele.innerHTML;
			}
		</script>

		<style type='text/css'>

			html {
				font-family: arial;
				font-size: 12px;
				margin: auto;
			}
			#header {
				width:100%
				margin:auto;
				/* border: 1px solid black; */
			}
			#container {
				width:100%
				margin:auto;
				/* border: 1px solid black; */
				text-align:center;
			}

			#content {
				width:60%
				text-align:center;
				/* border: 1px solid black; */
				
			}

			#footer {
				width:100%
				margin:auto;
				/* border: 1px solid black; */
				text-align:center;
			}

			input#url {
				border: 1px solid red;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
			}

		</style>

	</head>
	<body>
	<div id='header'>
		<div style='width:100%; '>
			<div style='width:40%; display:inline; '> By Eudis Duran, Summer Project : 2 </div>
			<div style=" width:40%; display:inline; 
					margin-left: 50%" ><a href='#' id='mylink'>About this project</a>
			</div>
			
		</div>
		<div id='canvas' style='width:100%; text-align:center; font-style:italic; padding-bottom:1%;
			border:1px solid rgb(100,100,100); -moz-border-radius: 5px; -webkit-border-radius: 5px;'> 
			
			<p style='width:50%; text-align: center;'>
			<hr />
				This small app was written in a day, using <span style='color:red'>Javascript</span>, <span style='color:red'>PHP</span> and <span style='color:red'>HTML5</span> with <span style='color:red'>jQuery</span>.
				It was mostly for learning purposes, as there are many URL shorteners already.
			<hr />
				close: <a href='#' style='text-decoration:none; border:1px solid black;
				-moz-border-radius: 2px; -webkit-border-radius: 2px; padding: 1px 1px 1px 1px;' id='close'> X 
</a>
				
			</p>
			
		</div>
		<p> Created July 1, 2010 </p>
		<p> Version: 0.0.1 </p>		
	</div>	
	<div style='text-align:center; margin: auto; font-size: 24px; font-family: Comic Sans MS'>
		<p> Shorten Your URL! </p>		
		<br /><br />
	</div>
	<hr style='width:40%;' />
	<div id='container'>
		<div id='content'>
				
			<?php	

				

				if($_SESSION['display'] == 'input_box' || !isset($_SESSION['display'])){
					echo "<form action='shorten.php' method='GET'>
						  URL: <input name='long_url' id='url' type='text' />
						  <input type='submit' value='Shorten!' />
					      </form>";
				}
				else {
					echo "<p style='font-size: 14px;'>Use: <a href='http://".$_SESSION['short_url'] . "'>" . 
						$_SESSION['short_url']. "</a></p><p><a 
href='http://www.eudisduran.com/s/'> Shorten Another 
URL</a></p>";
					

						$_SESSION['display'] = 'input_box';
					
				}
			?>
			
		</div>

	<hr style='width:40%' />

	</div>
			
	<br />
	<br />

	<div id='footer'>
		Copyright &copy; Eudis Duran, 2010.
	</div>
	</body>
</html>
