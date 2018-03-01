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
    //echo "$id";
    try {
        $result = $dbInstance->GetQueryResult("select * from supplier where SupplierID = " . "$id");
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
        <h4>Supplier</h4>
        <hr />
        <dl class="dl-horizontal col-md-5">
            <dt>
                <label class="col-md-4 control-label">Supplier Name: </label>
            </dt>
            <dd>
                <?php echo $row["SupplierName"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">MobilePhone: </label>
            </dt>
            <dd>
                <?php echo $row["MobilePhone"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">WorkPhone: </label>
            </dt>
            <dd>
                <?php echo $row["WorkPhone"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Address: </label>
            </dt>
            <dd>
                <?php echo $row["Address"] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Email: </label>
            </dt>
            <dd>
                <?php echo $row["Email"] ?>
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
