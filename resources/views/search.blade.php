<!DOCTYPE html>
<html>
<head>
	<title>Find Restaurants</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="{{ mix('js/app.js') }}" async defer></script>

	<style> 
        .input-icons i { 
            position: absolute; 
        } 
          
        .input-icons { 
            width: 100%; 
            margin-bottom: 10px; 
        } 
          
        .icon { 
            padding: 10px; 
            min-width: 40px; 
        } 
          
        .input-field { 
            width: 100%; 
            padding: 10px; 
            text-align: center; 
        } 
    </style> 
</head>
<body>
	<div class="container" id="search">
		<div class="row mb-2">
			<div class="col-md-12">
				<h1 class="float-left p-2" style="color: crimson;">ZResto</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 input-icons">
				<div class="mx-auto" style="text-align: center;">
					<i class="fa fa-search icon" style="font-size: 25px;"></i><input type="text" name="searchCity" class="input-field" style="width: 30%;">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div >
					<search-component></search-component>
				</div>
			</div>
		</div>
	</div>
</body>
</html>