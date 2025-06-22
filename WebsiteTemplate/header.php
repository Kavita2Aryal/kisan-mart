<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>FarmForFamily</title>

	<!-- materailizeicon -->
	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
	<!-- fancybox -->
	<link rel="stylesheet" href="./css/fancybox/fancybox.min.css">
	
	<!-- dropzone -->
	<link rel="stylesheet" href="./js/dropzone.min.css">
	
	<!-- sidenav -->
	<!-- <link rel="stylesheet" href="./js/slider/css/pushy.css"> -->
	<!-- slick -->
	<link rel="stylesheet" href="./css/slick/slick-theme.css">
	<link rel="stylesheet" href="./css/slick/slick.css">

	<!-- bootstrap -->
	<link rel="stylesheet" href="./css/bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="./css/bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="./css/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="./node_modules/nouislider/distribute/nouislider.min.css">
	<!-- style -->
	<!-- <link rel="stylesheet" href="./css/style.css"> -->
	<?php 
	if(  $currentpage== 'home'){
		// echo(<link rel="stylesheet" href="./css/otherpage.css">);
		echo '<link rel="stylesheet" href="./css/style.css">'; 
	}
	else{
		echo '<link rel="stylesheet" href="./css/otherstyle.css">';
	}

	?>

</head>
<body>
	
