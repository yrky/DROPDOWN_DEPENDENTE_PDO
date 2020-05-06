<?php
include('db.php');
$sql="select id,name from country";
$stmt=$con->prepare($sql);
$stmt->execute();
$arrCountry=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Ajax Country State City Dropdown.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<h1>PHP Ajax Country State City Dropdown</h1>
		<form>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label for="country">Country</label>
						<select class="form-control" id="country">
							<option value="-1">Select Country</option>
							<?php
							foreach($arrCountry as $country){
								?>
								<option value="<?php echo $country['id']?>"><?php echo $country['name']?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="state">State</label>
						<select class="form-control" id="state">
							<option>Select State</option>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label for="city">City</label>
						<select class="form-control" id="city">
							<option>Select City</option>
						</select>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div id="divLoading"></div>
	<style>
	#divLoading	{
		display : none;
	}
	#divLoading.show{
		display : block;
		position : fixed;
		z-index: 100;
		background-image : url('http://loadinggif.com/images/image-selection/3.gif');
		background-color:#666;
		opacity : 0.4;
		background-repeat : no-repeat;
		background-position : center;
		left : 0;
		bottom : 0;
		right : 0;
		top : 0;
	}
	#loadinggif.show {left : 50%;
		top : 50%;
		position : absolute;
		z-index : 101;
		width : 32px;
		height : 32px;
		margin-left : -16px;
		margin-top : -16px;
	}
	</style>
	<script>
	$(document).ready(function(){
		jQuery('#country').change(function(){
			var id=jQuery(this).val();
			if(id=='-1'){
				jQuery('#state').html('<option value="-1">Select State</option>');
			}else{
				$("#divLoading").addClass('show');
				jQuery('#state').html('<option value="-1">Select State</option>');
				jQuery('#city').html('<option value="-1">Select City</option>');
				jQuery.ajax({
					type:'post',
					url:'get_data.php',
					data:'id='+id+'&type=state',
					success:function(result){
						$("#divLoading").removeClass('show');
						jQuery('#state').append(result);
					}
				});
			}
		});
		jQuery('#state').change(function(){
			var id=jQuery(this).val();
			if(id=='-1'){
				jQuery('#city').html('<option value="-1">Select City</option>');
			}else{
				$("#divLoading").addClass('show');
				jQuery('#city').html('<option value="-1">Select City</option>');
				jQuery.ajax({
					type:'post',
					url:'get_data.php',
					data:'id='+id+'&type=city',
					success:function(result){
						$("#divLoading").removeClass('show');
						jQuery('#city').append(result);
					}
				});
			}
		});
	});
	</script>
</body>
</html>