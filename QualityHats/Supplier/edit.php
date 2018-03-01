<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
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
//    echo "$id";
    try {

        $result = $dbInstance->GetQueryResult("select * from supplier where SupplierID = "."$id");
        if (count($result) == 0) {
            header("Location: ./index.php");
        }
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
    $row = $result->fetch_assoc();
}else {
    $strSql = "update supplier 
                  set Address = '$_POST[Address]', 
                  Email = '$_POST[Email]',
                  MobilePhone = '$_POST[MobilePhone]',
                  SupplierName = '$_POST[SupplierName]',
                  WorkPhone = '$_POST[WorkPhone]'
                  where SupplierID = $_POST[SupplierID]";
    //echo "$strSql";
    try{
        $result = $dbInstance->GetQueryResult($strSql);
    }catch (Exception $e) {
        header("Location: ./index.php");
    }
    header("Location: ./index.php");
}
?>
<br/><br/>
<div class="container body-content" id="contentBody">
    <h2>Edit Supplier</h2>

    <!--    for displaying body start-->
    <form action="edit.php" method="post">
        <div class="form-horizontal">
            <h4>Supplier</h4>
            <hr />

            <input type="hidden" id="SupplierID" name="SupplierID" value="<?php echo "$id" ?>"/>
            <div class="form-group">
                <label class="col-md-3 control-label"> Supplier Name:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="SupplierName" name="SupplierName" value="<?php echo $row["SupplierName"]?>" required/>
                    <span data-valmsg-for="SupplierName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> MobilePhone:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="MobilePhone" name="MobilePhone" value="<?php echo $row["MobilePhone"]?>" required/>
                    <span data-valmsg-for="MobilePhone" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> WorkPhone:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="WorkPhone" name="WorkPhone" value="<?php echo $row["WorkPhone"]?>" required/>
                    <span data-valmsg-for="WorkPhone" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Address:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Address" name="Address" value="<?php echo $row["Address"] ?>" required/>
                    <span data-valmsg-for="Address" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Email:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Email" name="Email" value="<?php echo $row["Email"] ?>" required/>
                    <span data-valmsg-for="Email" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="col-md-offset-3">
                <input type="submit" value="Save" class="btn btn-default" />
            </div>
        </div>
    </form>
    <div>
        <a href="./index.php">Back to List</a>
    </div>
    <!--    for displaying body end-->
</div>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
