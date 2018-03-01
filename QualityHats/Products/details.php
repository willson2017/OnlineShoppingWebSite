<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
?>

<!--Get ID from the index page-->
<?php
global $id;
global $row;
$dbInstance = DBFunctions::GetDBInstance();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: ./index.php");
        return;
    }
    $id = intval($_GET['id']);
    $strSql = "select p.ProductID,p.CategoryID, p.Description, p.ImagePath, p.ProductName, p.SupplierID, p.UnitPrice, 
                       c.CategoryName, s.SupplierName 
                       from products p
                       inner join category c on p.CategoryID = c.CategoryID
                       inner join supplier s on p.SupplierID = s.SupplierID
                       where p.ProductID = "."$id";
    //echo "$id";
    try {
        $result = $dbInstance->GetQueryResult($strSql);
        if (count($result) == 0) {
            header("Location: ./index.php");
        }
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
    $row = $result->fetch_assoc();
}
?>
<br/><br/>

<div class="container body-content" id="contentBody">
    <h2>Detail Information</h2>
    <!--    for displaying body start-->
    <div>
        <h4>Product</h4>
        <hr />
        <dl class="dl-horizontal col-md-5">
            <dt>
                <label class="col-md-4 control-label">Product Name: </label>
            </dt>
            <dd>
                <?php echo $row["ProductName"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Category Name: </label>
            </dt>
            <dd>
                <?php echo $row["CategoryName"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Unit Price: </label>
            </dt>
            <dd>
                <?php echo $row["UnitPrice"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Description: </label>
            </dt>
            <dd>
                <?php echo $row["Description"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Image: </label>
            </dt>
            <dd>
                <?php
                $img = empty($row["ImagePath"])? "../images/default_hat.jpg":$row["ImagePath"];
                echo "<img style='width: 180px; height: auto;' class ='img-rounded' src=".$img." alt='Product Image' />";
                ?>
            </dd>

        </dl>
    </div>
</div>
<div class="col-md-offset-2">
    <a href="./index.php">Back to List</a>
</div>

<!--    for displaying body End-->

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
