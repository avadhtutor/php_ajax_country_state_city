<?php
//Include the database configuration file
include 'connect.php';
echo "<script>alert('".$_POST["country_id"]."')</script>";
if(!empty($_POST["country_id"])){
    //Fetch all state data
    $c= $_POST["country_id"];
    $query = $db->query("SELECT * FROM country WHERE country='$c' ");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['state'].'">'.$row['state'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}elseif(!empty($_POST["state_id"])){
    //Fetch all city data
    $s =$_POST["state_id"]; 
    $query = $db->query("SELECT * FROM country WHERE state='$s'");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //City option list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['city'].'">'.$row['city'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>