<?php
include_once 'dbconnect.php';
$name = $_GET['a'];
$sql = " SELECT * FROM medicine WHERE name='$name'";
$result = $conn->query($sql);
?>
<form action="" method="POST">
    <table border=1>
        <?php
        while ($rows = $result->fetch_assoc()) {
        ?>
            <tr>
            <tr>
                <td><input type="hidden" name="nm" value="<?php echo $rows['name']; ?>">
                    <input type="hidden"  name="mid" value="<?php echo $rows['medicineID']; ?>">
                </td>
            </tr>
            <tr>
                <td>
                     <label for="stck">Update Stock:</label>
                     <input type="text" name="stck" value="<?php echo $rows['stock']; ?>">
                </td>
            </tr>
            <td><input type="submit" name="s" value="Submit"></td>
            </tr>
        <?php
        }
        ?>
    </table>
</form>
<?php
if (isset($_POST['s'])) {

    $m = $_POST['mid'];
    $st = $_POST['stck'];

    $nm = $_POST['nm'];
    include_once 'dbconnect.php';
    $sql = " UPDATE medicine 
             SET medicineID='$m' , stock='$st'
             WHERE name ='$nm'";
    $result_q = $conn->query($sql);
    if($result_q){
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('Medecines.php','_self')</script>"; }
        else{
            $conn -> close(); }
        }

?>
