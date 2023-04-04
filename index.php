<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
<form action="" method="post">
<?php
//Include the database configuration file
include 'connect.php';

//Fetch all the country data
$query = $db->query("SELECT * FROM country");

//Count total number of rows
$rowCount = $query->num_rows;
?>
<select id="country" name=c>
    <option value="">Select Country</option>
    <?php
    if($rowCount > 0){
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['country'].'">'.$row['country'].'</option>';
        }
    }else{
        echo '<option value="">Country not available</option>';
    }
    ?>
</select>

<select id="state" name=s>
    <option value="">Select country first</option>
</select>

<select id="city" name=ct>
    <option value="">Select state first</option>
</select>
<input type="submit" name="sb" value="CLICK">
</form>
<?php
if(isset($_POST['sb']))
{
    echo $_POST['c']." ".$_POST['ct'];
}


?>

