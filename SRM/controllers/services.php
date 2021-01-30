<?php
?>

<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/theme.css">

</head>
<body>
<button class="tablink" onclick="openPage('customer', this, 'green')" id="defaultOpen">Customer</button>
<button class="tablink" onclick="openPage('employee', this, 'green')">Employee</button>
<button class="tablink" onclick="openPage('complete', this, 'green')">Complete</button>


<div id='customer' class="container-large">
    <div class="grid">
        <label>Service Id</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>User Id</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Ticket Number</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Company Name</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Concern Person</label><input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Contact Number</label><input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Address</label> <textarea  class="form-control"></textarea>

    </div>
    <div class="grid">
        <label>PO Number</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Entry Date</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>E-mailId</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Remark</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Snapshot</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Page Id</label><input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Is Available</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Product Name</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Quantity</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Service Type</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Warranty Type</label> <input type="text" class="form-control">
    </div>


</div>
<div id='employee' class="container-large">
    <div class="grid">
        <label>Employee Id</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Ticket Number</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Record Manager</label><input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Service Type 2</label><input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Expiry Date</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Payment Mode</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Remark 2</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Exp Price</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Warranty Type 2</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Material Rec Date</label><input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Attendant By</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Site Attend Date</label> <input type="text" class="form-control">
    </div>
    <div class="grid">
        <label>Complain Status</label> <input type="text" class="form-control">
    </div>
</div>
    <div id="complete" class="container-large">
        <div class="grid">
            <label>Employee Id</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Ticket Number</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Material Received</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Recieve Quantity</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Warranty Type 3</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Fault Description</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Completion Date</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Remark 3</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Billing Amount</label> <input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Rating</label><input type="text" class="form-control">
        </div>
        <div class="grid">
            <label>Remark By Customer</label><input type="text" class="form-control">
        </div>

    </div>

</div>
<button id="Add" class="btn btn-primary">Add Product</button>
<button id="Remove" class="btn btn-primary">Remove Product</button>
<div id="textboxDiv"></div>
</body>
<script>

    function openPage(pageName, elmnt, color) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("container-large");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    $(document).ready(function () {
        $("#Add").on("click", function () {
            $("#textboxDiv").append("<div><br><input type='text' /><br></div>");
        });
        $("#Remove").on("click", function () {
            $("#textboxDiv").children().last().remove();
        });


    });
</script>
</html>



