<?php
session_start();
$session_username = $_SESSION['username']; 
include('dbconfig.php');
require "component.php";

if(isset($_POST['save_student']))
{
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);

    $query = "INSERT INTO incomeExpenceinfo (timestamp,category,subcategory) 
    VALUES ('$timestamp','$category','$subcategory')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        
        $res = [
            'status' => 200,
            'message' => 'Group Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        
        $res = [
            'status' => 500,
            'message' => 'Group Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_group']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $category = mysqli_real_escape_string($con, $_POST['category']);
    $subcategory = mysqli_real_escape_string($con, $_POST['subcategory']);
    $billAmt = mysqli_real_escape_string($con, $_POST['billAmt']);


    $query = "UPDATE groupinfo SET category='$category', subcategory='$subcategory', billAmt='$billAmt' 
                WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Group Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Group Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT * FROM groupinfo WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Group Fetch Successfully by id',
            'data' => $student
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Group Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['delete_group']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM groupinfo WHERE id='$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Student Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Student Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
?>