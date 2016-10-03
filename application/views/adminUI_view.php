<!DOCTYPE html>
<html lang="en">
<head>
  <title>admin</title>
  <meta charset="utf-8"> 
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link href="../public/css/adminCSS.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h1>Admin Interface</h1>
    <h4>Add, edit, or remove questions from the quiz generator</h4>
    <table class="table table-striped">
      <thead>
        <tr>          
          <th>Country</th>
          <th>Flag URL</th>
          <th>Flag</th>
          <th>Actions</th>
        </tr>
        <tr>		  
          <td><input class="form-control countryName-input"></td>
		  <td><input class="form-control flag-url-input"></td>
          <td><span class="image"></span></td>
		  <td><button class="btn btn-primary add-country">Add</button></td>
        </tr>
      </thead>
      <tbody class="country-list"></tbody>
    </table>
  </div>
  
  <script type="text/template" class="country-list-template">
    <td><span class="countryName"><%= name %></span></td>
    <td><span class="flag-url"><%= flag %></span></td>
    <td><img src="<%=flag %>" class="img-rounded flag-view" alt="" width="100" height="50"></td>
	<td>
      <button class="btn btn-warning edit-country">Edit</button>
      <button class="btn btn-danger delete-country">Delete</button>
      <button class="btn btn-success update-country" style="display:none">Update</button>
      <button class="btn btn-danger cancel" style="display:none">Cancel</button>
    </td>
  </script>

  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone.js"></script>
  <script src="../public/js/adminUI.js" type="text/javascript"></script>
</body>
</html>