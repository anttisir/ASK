<?php
session_start();
require_once ('bin/config.php');
/*

	Original author: Antti Sirkiä, sirkia.antti@gmail.com
	
*/

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $site_title;?></title>
		<meta name="author" content="Antti Sirkiä"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="application-name" content="ASK" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script src="libraries/bootstrap/js/bootstrap.min.js"></script>
		<link href="libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
		<link rel="stylesheet" href="libraries/awesome/css/font-awesome.min.css" media="screen" />
		<link rel="stylesheet" href="css/styles.css" media="screen" />
		<script src="js/login_handler.js"></script>
		<script src="js/admin.js"></script>
	</head>
	<body>
	<?php 
		if(isset($_GET['logout'])) {$_SESSION = array(); session_destroy(); } //DEV
	
		if (!isset($_SESSION['username'])) {
		
		?>
		<div id="container_login" class="main login">
			<div class="widget">
				<div class="widget-header">
					<i class="icon-lock"></i>
					<h3>Kirjaudu sisään</h3>
				</div>
				<div class="widget-content">
					<div id="message"></div>
					<div id="loginForm">
						<form class="form-horizontal login" id="form1" name="form1" method="post" action="bin/doLogin.php">
							<fieldset>
								<div class="control-group">
									<label class="control-label">Käyttäjänimi</label>
									<div class="controls">
										<input id="username" name="username" type="text" class="input-xlarge" required="">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Salasana</label>
									<div class="controls">
										<input id="password" name="Password" type="password"  class="input-xlarge" required="">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<button id="login" name="login_btn" class="btn btn-success" type="submit">Kirjaudu</button>
										<button id="forgot" name="forgot_btn" class="btn btn-danger">Unohdin salasanan</button>
									</div>
								</div>
							</fieldset>		
						</form>	
					</div>
					<div id="forgotForm">
							<form action="forgot_password.php" method="POST" id="form2" class="form-horizontal login">
								<fieldset>
									<div class="control-group">
										<label class="control-label">Sähköposti</label>
											<div class="controls">
												<input id="username_forgot" name="username_forgot" type="text"  class="input-xlarge" required="">
											</div>
									</div>
									<div class="control-group">
												<div class="controls">
													<button id="forgot_submit" class="btn btn-success" type="submit" >Lähetä</button> <button id="forgot_takaisin" class="btn btn-danger">Takaisin</button>
												</div>
									</div>
								
								</fieldset>
							</form>
					</div>
				</div>
			</div>
		</div> <!-- end of #container_login -->
		<?php } else {?>
			<div id="container_logged">
				<div id="admin_container">
				<div id="headeruli">
					<p class="admin_view_title"><?php echo $admin_page_title; ?></p>
				
				</div>
				<div id="subnavbarx">
						<ul class="mainnav">
							<li id="uusi_kysely" class="active">
								<i class="icon-pencil"></i>
								<p>Uusi kysely</p>
							</li>
							<li id="arkisto">
								<i class="icon-folder-close"></i>
								<p>arkisto</p>
							</li>
								<li id="profiili">
								<i class="icon-wrench"></i>
								<p>Oma profiili</p>
							</li>
							<li id="kayttajat">
								<i class="icon-user"></i>
								<p>Ylläpitäjät</p>
							</li>
							
						
							<li id="asetukset">
								<i class="icon-cog"></i>
								<p>Asetukset</p>
							</li>
							<li>
								<a href="?logout">
									<i class="icon-off"></i>
									<span>Kirjaudu ulos</span>
								</a>
							</li>
					
						</ul>
				</div>
				<div id="admin_content">
					<div id="kysely_content">
						<div class="widget-wrapper">
							<div class="one widget-header">
								<i class="icon-edit"></i>
									<span>Uusi kysely</span>
							</div>
							<div class="widget-content inner">
								<form class="form-horizontal" id="kysely_lomake" method="POST">
									<fieldset>
										<div class="control-group yla">
										
											<label for="kysymys">Kysymys</label>
											<div class="kentat">
												<input id="kysymys" name="kysymys" type="text" class="input-large" required="">
											
											</div>
											<ol>
												<li class="vastaus_input">
													<label for="ans_opt" >Vastaus </label>
													<input type="text" name="ans_opt[]" id="ans_opt[]" class="vastaus_in"  required="" /> <button class="btn btn-danger remove_btn" type="button">X</button>
												</li>
												<li class="vastaus_input">
													<label for="ans_opt" >Vastaus </label>
													<input type="text" name="ans_opt[]" id="ans_opt[]" class="vastaus_in" required="" /> <button class="btn btn-danger remove_btn" type="button">X</button>
												</li>
												<li class="vastaus_input">
													<label for="ans_opt" >Vastaus </label>
													<input type="text" name="ans_opt[]" id="ans_opt[]" class="vastaus_in"  /> <button class="btn btn-danger remove_btn" type="button">X</button>
												</li>
											</ol>
											<button class="btn btn-primary oikea" id="add_answer" type="button">Lisää vastaus</button>
											<br /><br />
											<label for="target">Teema </label>
											<select id="target" name="target" class="teema_valikko">
												<option value="teema1">Teema1</option> 
												<option value="teema2">Teema2</option> 
											</select>
											<br /><br />
											<label>Kesto</label>
											<div id="aika_nappi">
												<button class="btn aika_nappi" id="miinus" type="button">-</button> 
												<input type="text" class="aika_input" id="aika" name="aika" value="00:15" /> 
												<button class="btn aika_nappi" id="plus" type="button">+</button> 
											</div>
											<br /><br />
											<button class="btn btn-warning preview_btn" name="submit" type="submit" id="preview_btn" >Esikatsele</button>
										</div>
									</fieldset>	
								</form>
							</div>
						</div>
						<div class="widget-wrapper">
							<div class="three widget-header">
								<i class="icon-print"></i>
									<span>Esikatselu</span>
							</div>
							<div class="widget-content inner3">
									<div id="poll_preview">
										Kysymys: <div class="poll_q"></div><br />
										Vastaus vaihtoehdot: <div class="poll_answer_options"></div><br />
										Teema: <div class="poll_theme"></div><br/>
										Kesto: <div class="poll_duration"></div><br />
									</div>
									<div class="oikea">
										<button class="btn btn-success" id="publish_btn" type="button">Julkaise</button>
									</div>
							</div>
						</div>
					</div>
					<div id="kayttajat_content">
						<p>kayttajat</p>
					</div>
					<div id="profiili_content">
						<div class="widget-wrapper">
							<div class="one widget-header">
								<i class="icon-edit"></i>
									<span>Omat tietosi</span>
							</div>
							<div class="widget-content inner">
								<form class="form-horizontal" id="profiili_lomake" method="POST">
									<fieldset>
										<div class="control-group yla">

											<label for="email">Sähköposti</label>
											<div class="kentat">
												<input id="email" name="email" type="text" class="input-large" required="" value="<?php echo $_SESSION['username'];?>">
												
											</div>
											<label for="profile_password">Uusi salasana</label>
											<div class="kentat">
												<input id="profile_password" name="profile_password" type="password" class="input-large" required="" />
												
											</div>
											<label for="profile_password2">Uusi salasana</label>
											<div class="kentat">
												<input id="profile_password2" name="profile_password2" type="password" class="input-large" required="" />
												
											</div>
											<div class="profile_error"></div>
											<div class="oikea">
												<button class="btn btn-success" id="save_profile_btn" type="submit">Tallenna</button>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
					<div id="arkisto_content">
						<p>arkisto</p>
					</div>
					<div id="asetukset_content">
						<p>asetukset</p>
					</div>
				</div>
				</div>
			</div> <!-- end of #container_logged -->
	<?php } ?>
	</body>
</html>
