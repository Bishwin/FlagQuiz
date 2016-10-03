<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
	<title>Whose Flag is it Anyway?</title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

	<!-- Custom styles for this template -->
    <link href="../../public/css/jumbotron-narrow.css" rel="stylesheet">
	
	<!--JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="https://w1441879.users.ecs.westminster.ac.uk/604cwk2/index.php">Home</a></li>
          </ul>
        </nav>
        <h3 class="masthead-brand">Whose Flag Is It Anyway?</h3>
      </div>

    <div class="row marketing">
		<form role="form" class="form-horizontal" method="post">
			<div class="col-lg-6">
				<?php //if num of questions is odd arrange so columns display correctly
				if($qNum %2 ==0){
					$col1 = $qNum/2;
				}else{
					$num = $qNum -1;
					$col1 = ($num /2)+1;
					$col2 = $num/2;
				}
				for($i=0; $i<$col1;$i++){ //loop through half questions for col1 +1 if odd ?>
					<h4><u>Question <?=$i+1?></u></h4>
					<img src="<?php echo $question[$i]['image'] ?>" height=100 width=200 border=2><br>
					<input type=hidden name=id<?=$i?> value="<?php echo $question[$i]['id'] ?>">
				
					<?php foreach($question[$i]['countries'] as $c){ //loop through choices adding to radio buttons ?>
					<div class="radio">
						<label>
						<input type="radio" name="name<?=$i?>" required value="<?php echo $c ?>">
						<?php echo $c ?>
						</label>
					</div>
					<?php }
				} ?>
				<br>
			</div>
		
			<div class="col-lg-6">
				<?php
				for($i= $col1; $i<$qNum;$i++){?>
					<h4><u>Question <?=$i+1?></u></h4>
					<img src="<?php echo $question[$i]['image'] ?>" height=100 width=200 border=2><br>
					<input type=hidden name=id<?php echo $i ?> value="<?php echo $question[$i]['id'] ?>">
					<?php foreach($question[$i]['countries'] as $c){ ?>
					<div class="radio">
						<label>
						<input type="radio" name="name<?=$i?>" required value="<?php echo $c ?>">
						<?php echo $c ?>
						</label>
					</div>
					<?php } 
				} ?>
			</div>
            <input type=submit class="btn btn-primary btn-block" value="Submit">
		</form>
    </div>

      <footer class="footer">
        <p>&copy; Jake Huggins - w1441879 - 2015</p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>