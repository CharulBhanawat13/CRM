<html>
  <head>
    <meta name="generator"
    content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
    <title></title>
  </head>
  <body>
  <form action="EmployeeModal.php" method="POST">

  <link rel="stylesheet" href="theme.css" />
  <div class="modal-header" id="themodal">
    <button type="button" class="close" data-dismiss="modal">X</button>
    <h1>Add new Employee</h1>
  </div>
  <div class="modal-body">
    <div class="panel panel-default">
      <div class="panel-heading text-center">Employee Information</div>
      <div class="panel-body">
          <table>
            <tr>
              <td>Engineer's Name</td>
              <td>
                <input type="text" name="name" class="form-control" />
              </td>
            </tr>
            </table>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <div class="panel-footer">
    <button type="submit" class="btn btn btn-success" name="save" data-dismiss="modal">Save</button> 
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>
  </div>
</form>

  </body>
</html>


