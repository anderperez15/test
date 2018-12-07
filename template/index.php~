<!DOCTYPE html>
<html>
<head>
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<title>Test</title>
<style>
	*{
		margin: 0;
		padding: 0;
	}
	body{
		background-color: #212;
		display: flex;
		justify-content: center;
		align-items: center;
		min-height: 100vh;
	}
	.box-center{
		background-color: white;
		min-height: 300px;
		height: auto;
		min-width: 400px;
		box-shadow: 0px 2px 2px gray;
		border-radius: 5px;
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
		flex-direction: column;
		padding: 20px;
		align-items: center;
	}
	.container-barra{
		height: 20px;
		width: 100%;
		padding: 0;
		position: relative;
		text-align: center;
		background-color: black;
		z-index: 10;
		border: 1px solid black;
	}
	.barra{
		height: 100%;
		width: 10%;
		background-color: lightblue;
		position: absolute;
		top:0;
		left: 0;
		z-index: 9;
	}
	.container-logo{
		height: 300px;
		width: 300px;
		background-color: black;
		border: 1px dashed white;
		margin-bottom: 20px;
		border-radius: 20px;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.title{
		margin-bottom: 10px;
		color:blue;
	}
	.btn{
		padding: 10px 20px 10px 20px;
		background-color: green;
		border-radius: 4px;
		color:white;
		cursor: pointer;
		font-weight: 600;
		border:none;
	}
	.logo{
		height: 200px;
		width: 200px;
		border-radius: 50%;
		background-color: white;
		background-image: url('./public/logo.png');
		background-repeat: no-repeat;
		background-size: contain;
		background-clip: border-box;
		border-top: 4px solid white;
		border-right: 4px solid white;
		border-bottom: 4px solid white;
		border-left: 4px solid white; 
		display: flex;
		justify-content: center;
		align-items: center;
		position: relative;
	}
	.logo > input{
		height: 100%;
		width: 100%;
		border-radius: 50%;
		opacity: 0;
		position: absolute;
		top: 0;
		left: 0;
		cursor: pointer;
	}
	#message-file{
		font-weight: 800;
		width: 140px;
		text-align: center;
		color: white;
		text-shadow: -1px 1px black, 1px -1px black, 1px 1px black, -1px -1px black;
		background-color: rgba(93, 91, 90, 0.49);
		overflow-wrap: break-word;
	}
	#message{
		margin-top: 20px;
		color:blue;
		font-weight: 600;
		text-align: center;
		overflow-wrap: break-word;
		width: 300px;
	}
</style>
</head>
<body>
	<div class="box-center">
		<div class="title"><h1>Seleccione un video</h1></div>
		<div class="container-logo">
			<div class="logo">
				<input id="file" type="file" name="archivo" onchange="nombreFile()">
				<p id="message-file">Arrastre un video o haga click aqui.</p>
			</div>
		</div>
		<div><button class="btn btn-action" id="send">Porcesar</button></div>
		<div class="container-barra" style="display: none;"><div class="barra"></div><strong style="z-index: 20">cargando...</strong></div>
		<div id="message"></div>
	</div>

	<script type="text/javascript">
	var procesando = false;
		function nombreFile(){
			if($('input[type=file]')[0].files[0]){
				$('#message-file').html($('input[type=file]')[0].files[0].name)
			} else {
				$('#message-file').html('Arrastre un video o haga click aqui.')
			}
		}
		$(document).ready(function() {
			$('#send').click(sendFile);
		});
		function sendFile(e){
			if(!$('input[type=file]')[0].files[0] && procesando){
				return ;
			}
			$('#message').html('Su video se esta subiendo y procesando, esto puede tardar tiempo! Sea paciente.')
			procesando = true
			var data = new FormData();
			jQuery.each($('input[type=file]')[0].files, function(i, file) {
			    data.append('file', file);
			});
			var other_data = $('form').serializeArray();
			$.each(other_data,function(key,input){
			    data.append(input.name,input.value);
			});
			jQuery.ajax({
				url: 'upload.php',
				data: data,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				success: function(data){
					if(data.status === 200){
						$('#message').html(`${data.message}: <a href="${data.url}" target="_blank">${data.url}</a>`)
						procesando = false;
					} else {
						$('#message').html(data.message);
						procesando = false;
					}
				}
			});
		}
	</script>
</body>
</html>