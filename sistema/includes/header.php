
	<div class="header">
		<img src="media/img/favicon.png" class="logo" width="40px"><h1>Gestion Contact Center</h1>
		<img src="media/img/logo_header.png" alt="medplus MP" width="140px">
		<div class="optionsBar">
			<span class="user" style="font-size:15pt;"><?php echo $_SESSION['roles']?></span>
			<span>|</span>
			<span class="user" style="font-size:15pt;"><?php echo $_SESSION['usernames'] ?></span>
			<img class="photouser" src="media/img/user.png">
			<span>|</span>
			<h4><a href="#" id="boton1"> Cerrar sesión</a></h4>
		</div>
	</div>
	<script src="sistema/js/libs/sweetalert2.js"></script>
<script>

		document.getElementById('boton1').onclick = function(){
			Swal.fire({
			title: '¿Estas segura/o de finalizar sesión <?php echo $_SESSION['nombres'] ?>? ',
			icon: 'warning',
			showCancelButton: true,
			showConfirmButton: false,
			cancelButtonColor: '#d33',
			cancelButtonText: 'Cancelar',
			html:'<a href="./config/logout.php"><button class="aceptar"> Aceptar </button></a>'
			})
		}
</script>




