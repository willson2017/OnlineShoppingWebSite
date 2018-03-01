<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
?>

<!--Get ID from the index page-->
<?php
$dbInstance = DBFunctions::GetDBInstance();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    ?>
    <br/><br/>
    <div class="container body-content" id="contentBody">
        <h2>Create A Supplier</h2>

        <!--    for displaying body start-->
        <form action="create.php" method="post">
            <div class="form-horizontal">
                <h4>Supplier</h4>
                <hr/>
                <div class="form-group">
                    <label class="col-md-3 control-label">Supplier Name: </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" id="SupplierName" name="SupplierName" value=""
                               required/>
                        <span data-valmsg-for="SupplierName" data-valmsg-replace="true" class="text-danger"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">MobilePhone: </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" id="MobilePhone" name="MobilePhone" value="" required/>
                        <span data-valmsg-for="MobilePhone" data-valmsg-replace="true" class="text-danger"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">WorkPhone: </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" id="WorkPhone" name="WorkPhone" value="" required/>
                        <span data-valmsg-for="WorkPhone" data-valmsg-replace="true" class="text-danger"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Address: </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" id="Address" name="Address" value="" required/>
                        <span data-valmsg-for="Address" data-valmsg-replace="true" class="text-danger"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Email: </label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" id="Email" name="Email" value="" required/>
                        <span data-valmsg-for="Email" data-valmsg-replace="true" class="text-danger"/>
                    </div>
                </div>
                <div class="col-md-offset-2">
                    <input type="submit" value="Create" class="btn btn-default"/>
                </div>
            </div>
        </form>

        <div>
            <a href="./index.php">Back to List</a>
        </div>
        <!--    for displaying body end-->
    </div>
    <?php
} else {
    $suppliername = $_POST['SupplierName'];
    $addrss = $_POST['Address'];
    $email = $_POST['Email'];
    $mobilephone = $_POST['MobilePhone'];
    $workphone = $_POST['WorkPhone'];

    $strSql = "insert into supplier (SupplierName, Address, Email, MobilePhone,WorkPhone)
               value ('$suppliername', '$addrss', '$email', '$mobilephone', '$workphone')";
    //echo "$strSql";
    try {
        $result = $dbInstance->GetQueryResult($strSql);
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
    header("Location: ./index.php");
}
?>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
