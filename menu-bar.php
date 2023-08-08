<?php 
   include "dbconfig.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {  
    $session_username = $_SESSION['name']; ?>
   
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <title>Bootstrap Navbar with Dropdown</title> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!--bootstrap cdn  https://www.bootstrapcdn.com/bootstrapicons/  ---> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="employee-dashboard.php">PDP CABLE TV</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
        </li>
        <li class="nav-item">
            <li class="nav-item"><a class="nav-link" href="bill-last5-print.php">Latest Bill</a>
      </li>
            
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Customer
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="search-customer.php">Search Customer</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="customer-history.php">Customer History</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="billing-dashboard.php"><b>Billing Dashboard</b></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="customer-details.php">Customer Details/Action</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Report
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="bill-filter-by-all.php">Bill by All</a>
             <!--<a class="dropdown-item" href="#">Billing Dashboard</a> -->
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="bill-filter-by-user.php">Bill by You</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item" href="user-today-collection.php" target="blank">Today Collection</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Download
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!--<a class="dropdown-item" href="bill-export.php">Download Bill Report</a>-->
            <a class="dropdown-item" onclick="openBill_Export()">Download Bill Report</a>
            <!--<div class="dropdown-divider"></div>-->
        </li>
        <li class="nav-item">
            <li class="nav-item"><a class="nav-link" href="income-expenses.php">Income-Expense</a>
        </li>
        <li class="nav-item">
            <li class="nav-item"><a class="nav-link" href="#"><b><?php echo $session_username ?></b></a>
        </li>
        </ul>
        
        <!-- <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <a class="nav-link" href="logout.php"><button type="button" class="btn btn-success">Logout</button></a>
        </form> -->
        <form class="form-inline my-2 my-lg-0">
                <a class="nav-link" href="pos/billing-dashboard.php"><button type="button" class="btn btn-primary"><b>POS</b></button></a>
        <!--<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
        <a class="nav-link" href="logout.php"><button type="button" class="btn btn-success">Logout</button></a>
        </form>

    </div>
    </nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    function openBill_Export() {
    window.open('bill-export.php', '_blank', 'width=2000, height=750');
}
</script>


</body>
</html>

<?php }else{
	header("Location: index.php");
} ?>