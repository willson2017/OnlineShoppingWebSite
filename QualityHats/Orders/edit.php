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

        $result = $dbInstance->GetQueryResult("select * from orders where OrdersID = "."$id");
        if (count($result) == 0) {
            header("Location: ./index.php");
        }
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
    $row = $result->fetch_assoc();
}else {
    $strSql = "update orders set FirstName = '$_POST[FirstName]', LastName = '$_POST[LastName]',Phone = '$_POST[Phone]', PostalCode = '$_POST[PostalCode]', City = '$_POST[City]', Country = '$_POST[Country]',Status = '$_POST[Status]',
                  OrderDate = '$_POST[OrderDate]'
                  where OrdersID = '$_POST[OrdersID]'";
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
    <h2>Edit Orders</h2>

    <!--    for displaying body start-->
    <form action="edit.php" method="post">
        <div class="form-horizontal">
            <h4>Orders</h4>
            <hr />

            <input type="hidden" id="OrdersID" name="OrdersID" value="<?php echo "$id" ?>"/>
            <div class="form-group">
                <label class="col-md-3 control-label"> FirstName:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="FirstName" name="FirstName" value="<?php echo $row["FirstName"]?>" required/>
                    <span data-valmsg-for="FirstName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> LastName:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="LastName" name="LastName" value="<?php echo $row["LastName"]?>" required/>
                    <span data-valmsg-for="LastName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Phone:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Phone" name="Phone" value="<?php echo $row["Phone"]?>" required/>
                    <span data-valmsg-for="Phone" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> PostalCode:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="PostalCode" name="PostalCode" value="<?php echo $row["PostalCode"] ?>" required/>
                    <span data-valmsg-for="PostalCode" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> City:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="City" name="City" value="<?php echo $row["City"] ?>" required/>
                    <span data-valmsg-for="City" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Country:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Country" name="Country" value="<?php echo $row["Country"] ?>" required/>
                    <span data-valmsg-for="Country" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> GST:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="GST" name="GST" value="<?php echo $row["GST"] ?>" required/>
                    <span data-valmsg-for="GST" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> GrandTotal:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="GrandTotal" name="GrandTotal" value="<?php echo $row["GrandTotal"] ?>" required/>
                    <span data-valmsg-for="GrandTotal" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Total:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Total" name="Total" value="<?php echo $row["Total"] ?>" required/>
                    <span data-valmsg-for="Total" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Status:</label>
                <div class="col-md-6">
                    <select name="Status" class="form-control" method="post">
                        <option value="Waiting">Waiting</option>
                        <option value="Shipped">Shipped</option>
                    </select>
                    <span data-valmsg-for="Status" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> OrderDate:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="OrderDate" name="OrderDate" value="<?php echo $row["OrderDate"] ?>" required"/>
                    <span data-valmsg-for="OrderDate" data-valmsg-replace="true" class="text-danger" />
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
