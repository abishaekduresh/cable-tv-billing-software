<?php 
   session_start();
   require "dbconfig.php";
   require "component.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {


// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM settings"; // Replace 'your_table_name' with your actual table name

$result = $con->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Loop through each row and fetch the data
    while ($row = $result->fetch_assoc()) {
        $appName = $row['appName'];
        $addr1 = $row['addr1'];
        $addr2 = $row['addr2'];
        $phone = $row['phone'];
        $footer1 = $row['prtFooter1'];
        $footer2 = $row['prtFooter2'];
    }
} else {
    echo "No data found.";
}

$hidePromotion = ($footer1 == NULL);


?>

<html>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
        <style>
            body {
            font-family: Arial, sans-serif; 
            }
            table
                {
                    border: 1px solid  #000000;
                    padding: 0px;
                    border-spacing: 0px;
                    border-collapse: collapse;
                    width: 100%;
                    margin-left: auto;
                    margin-right: auto;
                }
            td,th
                {
                    border: 0px solid  #cccccc;
                    height: 28px;
                    vertical-align: center;
                    padding-left: 5px;
                    font-size: 16px;
                }
            .b_f
            {
                border:1px blue; 
                border-bottom-style: solid;
                border-top-style: solid;
                border-left-style: solid;
                border-right-style: solid;
            }
            .b_l
            {
                border:1px; 
                border-left-style: solid;
            }
            .b_r
            {
                border:1px; 
                border-right-style: solid;
            }		
            .b_t
            {
                border:1px; 
                border-top-style: solid;
            }			
            .b_b
            {
                border:1px; 
                border-bottom-style: solid;
            }					
    
            .spacer {
                margin-bottom: 2px; /* Use margin to create vertical spacing */
            }
            .spacer2 {
                margin-bottom: 5px; /* Use margin to create vertical spacing */
            }

            .container {
                padding: 5px; /* Use padding to create space inside an element */
                border: 1px solid #000; /* Add a 1px solid black border around the container */
                max-width: 300px; /* Optionally set a maximum width for the container */
                margin: 0 auto; /* Center the container horizontally on the page */
            }
            div.page
            {
                page-break-after: always;
                page-break-inside: avoid;
            }
        </style>	
    </head>
    
    <body>

<?php

    
    $group_id = $_GET['group_id'];
    $date = $_GET['date'];
    
    $query = mysqli_query($con, "SELECT * FROM billgroupdetails WHERE group_id = '$group_id' AND date = '$date' AND status='approve'");
    
    if (mysqli_num_rows($query) > 0) {
    
        $row = mysqli_fetch_array($query);
        $billBy = $row["billBy"];
        $billNo = $row["billNo"];
        $date = $row["date"];
        $time = $row["time"];
        $billTo = $row["groupName"];
        $cusphone = $row["phone"];
        $billAmount= $row["billAmount"];
        $oldMonthBal = $row["oldMonthBal"];
        $hideoldMonthBalRow = ($oldMonthBal == 0);
        $discount = $row["discount"];
        $hideDiscountRow = ($discount == 0); // Determine if the discount row should be hidden
        $Rs = $row["Rs"];
        $hideRsRow = ($discount == 0 && $oldMonthBal == 0); // Determine if the discount row should be hidden
        $pMode = $row["pMode"];
        
        $hideStatusRow = ($pMode === 'cash' || $pMode === 'gpay' || $pMode === 'Paytm');

            if (isset($_SESSION['id'])) {
                $userId = $_SESSION['id'];
                $username = $_SESSION['username'];
                $role = $_SESSION['role'];
                $action = "Group Bill Printed - $billTo";
            
                logUserActivity($userId, $username, $role, $action);
            }
?>

        <table>
        <tr>
            <td>
                <center>
                    <p style="font-family:Arial; font-size:17px"><b><?= $appName ?></b>
                        <br><?= $addr1 ?>, <?= $addr2 ?>
                        <br>Phone : +91 <?= $phone ?></p>
                </center>
            </td>
        </tr>
        </table>

        <table align="center">
            <tr>
                <td style="border:1px; border-left-style:solid;">B.No</td>
                <td align="left" colspan="2" style="border:1.5px; border-right-style:solid;"><b><?= $billNo ?></b></td>
            </tr>
            
            <tr>
                <td style="border:1px; border-left-style:solid;">Date</td>
                <td align="left" colspan="2" style="border:1.5px; border-right-style:solid;"><?= formatDate($date) ?>&nbsp;&nbsp;<?= convertTo12HourFormat($time) ?></td>
            </tr>
            
            <tr>
                <td style="border:1px; border-left-style:solid;">Name</td>
                <td colspan="2" style="border:1.5px; border-right-style:solid;"><?= $billTo ?></td>
            </tr>
            
            <tr>
                <td style="border:1px; border-left-style:solid;">STB</td>
                <td colspan="2" style="border:1.5px; border-right-style:solid;">
                <?php
                    $query = "SELECT stbNo FROM billgroup WHERE group_id = '$group_id' 
                                AND date = '$date' AND status = 'approve'";
                    $result = mysqli_query($con, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $stbNoValue = $row["stbNo"];
                            echo $stbNoValue . "<br>";
                        }
                    } else {
                        echo "STB No. Query execution failed: " . mysqli_error($con);
                    }
                    ?>
                    <!-- Print the total count -->
                    <b>Total Count : <?= mysqli_num_rows($result) ?></b>
                </td>
            </tr>
            <tr>
                <td style="border:1px; border-left-style:solid;">Mobile</td>
                <td colspan="2" style="border:1.5px; border-right-style:solid;"><b><?= $cusphone ?></b></td>
            </tr>		
            
        </table>
        <table align="center">
    
            <tr>
                <td colspan="2" align="right" style="padding-right:20px;border:1px;border-left-style:solid;"><b>Bill Amount</b></td>
                <td align="right" style="padding-right:20px;  border:1px; border-left-style:solid;border-right-style:solid;"><b><?= $billAmount ?></b></td>
            </tr>
    
            <tr <?php if ($hideoldMonthBalRow) echo 'style="display: none;"'; ?>>
                <td colspan="2" align="right" style="padding-right:20px;border:1px;border-left-style:solid;"><b>Old Balance</b></td>
                <td align="right" style="padding-right:20px;  border:1px; border-left-style:solid;border-right-style:solid;"><b><?= $oldMonthBal ?></b></td>
            </tr>
    
            <tr>
                <td colspan="2" align="right" style="padding-right:20px;border:1px;border-left-style:solid;"><b>Discount</b></td>
                <td align="right" style="padding-right:20px;  border:1px; border-left-style:solid;border-right-style:solid;"><b><?= $discount ?></b></td>
            </tr>
    
            <tr>
                <td colspan="2" align="right" style="padding-right:20px;border:1px;border-left-style:solid;"><b>Payable</b></td>
                <td align="right" style="padding-right:20px;  border:1px; border-left-style:solid;border-right-style:solid; border-top-style:solid;"><b>₹ &nbsp;<?= $Rs ?></b></td>
            </tr>
            
            <tr <?php if ($hideStatusRow) echo 'style="display: none;"'; ?>>
                <td colspan="3" align="center" style="border:1.5px; border-top-style:solid;"><b> Credit Bill </b></td>
            </tr>

            <tr <?php if (!$hideStatusRow) echo 'style="display: none;"'; ?>>
                <td colspan="3" align="center" style="border:1.5px; border-top-style:solid;"><b>Paid</b></td>
            </tr>

            <tr <?php if ($hidePromotion) echo 'style="display: none;"'; ?>>
                <td colspan="3" align="center" style="border:1.5px; border-top-style:solid;"><?= $footer1 ?><br/><b><?= $footer2 ?></b></td>
            </tr>

            <tr>
                <td colspan="3" align="center" style="border:1px; border-top-style:solid; font-size: 14px;">Bill Printed on&nbsp;
                    <?PHP 
                        $current_result = splitDateAndTime(strtotime($currentDateTime)); 
                        formatDate($current_result['date']);
                        echo '&nbsp';
                        $t=convertTo12HourFormat($current_result['time']);
                        echo $t;
                    ?>
                </td>
            </tr>

        </table>

    </body>
    </html>
    
    <?php 

    // Auto print using JavaScript
    echo "<script type='text/javascript'>
        window.onload = function() {
            window.print();
        }
    </script>";

        // Redirect function
        function redirect($url)
        {
            echo "<script>
                setTimeout(function(){
                    window.location.href = '$url';
                }, 200);
            </script>";
        }

        // Usage example
        $url = "billing-group-dashboard.php"; // Replace with your desired URL
        redirect($url);
        
} else {
    echo "No data found.";

    function redirect($url)
    {
        echo "<script>
            setTimeout(function(){
                window.location.href = '$url';
            }, 200);
        </script>";
    }

    $url = "billing-group-dashboard.php"; // Replace with your desired URL
    redirect($url);
    
    function closeTab() {
      echo "<script>
        setTimeout(function(){
          window.close();
        }, 200);
      </script>";
    }

    

?>



<?php }}else{
	header("Location: index.php");
} ?>