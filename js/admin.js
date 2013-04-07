$(function() {
	//alustus, kaikki piiloon paitsi etusivu
	$("#admin_content").children().hide();
	$("#kysely_content").show();

	//navigaatio
	// -----------------------------------------------------------------
	$("#uusi_kysely").live("click", function() {
		$("#admin_content").children().hide();
		$("#kysely_content").show();
		$('.mainnav li').removeClass('active');
		$('#uusi_kysely').addClass('active');
	});
	
	$("#kayttajat").live("click", function() {
		$("#admin_content").children().hide();
		$("#kayttajat_content").show();
		$('.mainnav li').removeClass('active');
		$('#kayttajat').addClass('active');
	});
	
	$("#profiili").live("click", function() {
		$("#admin_content").children().hide();
		$("#profiili_content").show();
		$('.mainnav li').removeClass('active');
		$('#profiili').addClass('active');
	});
	
	$("#asetukset").live("click", function() {
		$("#admin_content").children().hide();
		$("#asetukset_content").show();
		$('.mainnav li').removeClass('active');
		$('#asetukset').addClass('active');
	});
	$("#arkisto").live("click", function() {
		$("#admin_content").children().hide();
		$("#arkisto_content").show();
		$('.mainnav li').removeClass('active');
		$('#arkisto').addClass('active');
	});
	
	// navigaation loppu
	
	//Kyselylomake
	// -----------------------------------------------------------------
	
	$('#add_answer').live("click", function() {
		var a = $('.vastaus_input').length;
		if(a < 6) {
			$('.vastaus_input:last').clone().insertAfter('.vastaus_input:last');
			$('.vastaus_in:last').val('');
			
		}
		return false;
	});
	
	$('.remove_btn').live("click", function() {
		
		var a = $('.vastaus_input').length;
		if(a > 2) {
			$(this).parent().fadeOut(function() {
				$(this).detach();
				
			});
		}
		return false;
	});
	
	$('#plus').click( function () {		
		var a = $('#aika').val();
		var t = parse(a);
		t = t + 15;
		$('#aika').val(formatTime(t));
	return false;
		
	});
	$('#miinus').click( function () {		
		var a = $('#aika').val();
		var t = parse(a);
		t = t - 15;
		if ( t > 0) {
			$('#aika').val(formatTime(t));
		}
	return false;
		
	});
	
	function parse(a) {
		var k = a.split(":");
		var s = parseInt(k[0], 10) * 60 + parseInt(k[1], 10);
		return s;
	}
	
	function formatTime(a) {
		var minutes = Math.floor(a / 60);
		var seconds = a % 60;
		if (minutes < 10) {
			minutes = "0"+minutes;
	}
		if (seconds < 10) {
			seconds = "0"+seconds;
		}
		return minutes+":"+seconds;
	}
	
	$('#preview_btn').live("click", function () {
		var print = "";
	
		var values = {};
		var question = $('#kysymys').val();
		var theme = $('#target').val();
		var duration = $('#aika').val();
		var answer_options = new Array();
		$.each($('.vastaus_in').serializeArray(), function(i, field) {
			values[field.name] = field.value;
			if(values[field.name].length > 0) {
				answer_options.push(values[field.name]);
			}
		});
		$('.poll_duration').html(duration);
		$('.poll_theme').html(theme);
		$('.poll_q').html(question);
		$.each(answer_options, function( key, value) {
			print += ((key+1) + '. ' + value+'<br>');
		});
		$('.poll_answer_options').html(print);
		
		return false;
	});
	
		$('#publish_btn').live("click", function () {
		var data_in = $('#kysely_lomake').serialize();

		$.ajax({
			type: "POST",
			  url: "bin/publish.php",
			  data: data_in,
			  success: function(response) {
				if(response == "success") {
					$('#kysely_lomake')[0].reset();
				
				}
			}
		});
		
		return false;
	});
	
	
	
	$('#save_profile_btn').live("click", function() {
		var pass1 = $('#profile_password').val();
		var pass2 = $('#profile_password2').val();
			if (pass1 !== pass2) {
				console.log("moi");
				$('.profile_error').html('<p>Salasanat eivät täsmää!</p>');
			} else {
				$('.profile_error').val('').hide();
			}
		return false;
	});
});	

