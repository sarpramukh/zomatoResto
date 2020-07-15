<!DOCTYPE html>
<html>
<head>
	<title>Find Restaurants</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="{{ mix('js/app.js') }}" async defer></script>

</head>
<body>
	<div class="container" id="search">
		<div class="row mb-2">
			<div class="col-md-12" style="height: 60px;background-color: lightgreen;">
				<span class="float-left p-2" style="font-size: 20px;text-align: center;">ZomatoRest</span>
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