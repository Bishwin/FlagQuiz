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
    
    <div class="header clearfix"><!---HEADER--->
      <nav>
        <ul class="nav nav-pills pull-right">
          <li role="presentation" class="active"><a href="https://w1441879.users.ecs.westminster.ac.uk/604cwk2/index.php">Home</a></li>
        </ul>
      </nav>
      <h3 class="masthead-brand">Whose Flag Is It Anyway?</h3>
    </div><!---/HEADER--->
    
    <div class="row marketing"><!---CONTENT--->
	  <h3>You scored <?=$score;?> /10!</h3>
      
	  <div class="col-lg-6"><!---LEFT COLUMN--->
	    <?php //if num of questions is odd arrange so columns display correctly
	  	  if($qNum %2 ==0) {
	  	    $col1 = $qNum/2;
          }
          else {
            $num = $qNum -1;
	  		$col1 = ($num /2)+1;
	  		$col2 = $num/2;
          }
          
          for($i=0; $i<$col1;$i++){ //loop through half questions for col1 +1 if odd ?>
	  	    <h4><u>Question <?=$i+1?></u></h4>
            <img src="<?php echo $results[$i]['image'] ?>" height=100 width=200><br>
	  		<p>You said: <?=$results[$i]['input']."<br>";
	   		if($results[$i]['res']){ //display diff msg if correct/incorrect ?>
			  <span class="correct">You Answered Correctly!</span></p>
            <?php }
            else { ?>
              <span class="wrong">Incorrect! It was <?=$results[$i]['country']?></span></p>
            <?php }
                echo "<span class='average'>".$results[$i]['average']."% of players got this correct!</span></p>";
          } ?>
	  		
      </div><!---/LEFT COLUMN--->
      
	  <div class="col-lg-6"><!---RIGHT COLUMN--->
        <?php
          for($i= $col1; $i<$qNum;$i++){?>
		    <h4><u>Question <?=$i+1?></u></h4>
			<img src="<?php echo $results[$i]['image'] ?>" height=100 width=200><br>
			<p>You said: <?=$results[$i]['input']."<br>";
			if($results[$i]['res']){ ?>
			  <span class="correct">You Answered Correctly!</span></p>
            <?php }
            else { ?>
              <span class="wrong">Incorrect! It was <?=$results[$i]['country']?></span></p>
            <?php }
            echo "<span class='average'>".$results[$i]['average']."% of players got this correct!</span></p>";
          } ?> 
          <a href=start><button type="button" class="btn btn-primary btn-block">Play Again</button></a>
      </div><!---/RIGHT COLUMN--->  
    </div><!---/CONTENT---> 
    
    <footer class="footer">
      <p>&copy; Jake Huggins - w1441879 - 2015</p>
    </footer>
  </div> <!-- /container -->
</body>
</html>
