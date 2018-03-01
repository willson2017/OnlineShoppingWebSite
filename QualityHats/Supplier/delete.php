<!-- Header -->
<?php
require('../Utilities/DBFunctions.php');
?>

<!--Get ID from the index page-->
<?php
global  $id;
global  $row;
$dbInstance = DBFunctions::GetDBInstance();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: ./index.php");
        return;
    }
    $id = intval($_GET['id']);
    //echo "$id";
    try {
        //$result = $dbInstance->GetQueryResult("delete from category where CategoryID = "."$id");
        $result = $dbInstance->DeleteQuery("supplier", "SupplierID", "'$id'");
        if (count($result) == 0) {
            header("Location: ./index.php");
        }
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
    header("Location: ./index.php");
}
?>
