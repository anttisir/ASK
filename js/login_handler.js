$(document).ready(function() {
	$('#forgotForm').hide();
	$("#username").focus();
	$("#login").click(function() {

		var action = $("#form1").attr('action');
		var form_data = {
			username: $("#username").val(),
			password: $("#password").val(),
			is_ajax: 1
		};
		
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response) {
				if(response == 'success') {
					$("#form1").slideUp('fast', function() {
						 $("#message").html("<p class='success'>Sisäänkirjautuminen onnistui!</p>"); 
					});
					setTimeout(function() {
						window.location.href="admin.php";
					}, 1000);
				}else {
					$('#username').val('');
					$('#password').val('');
					$("#message").html("<p class='error'>Käyttäjänimi tai salasana väärin!</p>").show();
					$("#username").focus();
				}
			}
		});
		return false;
	});
	
	$('#forgot').click( function () {
		$('#loginForm').hide();
		$('#forgotForm').show();
		$('#username_forgot').val('');
		$('#username_forgot').focus();
		$('#message').hide();
		return false;
	});
	
	$('#forgot_submit').click( function () {
		
		var action = $("#form2").attr('action');
		var user = $('#username_forgot').val();
		
		$.ajax({
			type: "POST",
			url: 'bin/'+action,
			data: {u:user},
			success: function(response) {
				if(response == 1) {
					$('#message').show();
					$("#message").html("<p>Salasanasi on lähetetty sähköpostiisi</p>");
					$('#username').val('');
					$('#password').val('');
					$('#forgotForm').hide();
					$('#loginForm').show();
				} else {
					$('#username_forgot').val('');
					$("#message").html("<p>Käyttäjää ei ole olemassa.</p>");
					$('#message').show();
				}
			}	
		});
		return false;
	});
	
	$('#forgot_takaisin').click( function () {
		$('#password').val('');
		$('#forgotForm').hide();
		$('#loginForm').show();
		$('#message').hide();
		$('#username').val('').focus();
	return false;
	});
	
});