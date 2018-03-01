<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
$dbInstance = DBFunctions::GetDBInstance();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
?>
<br/><br/>
<div class="container body-content" id="contentBody">
    <h2>Create An Order</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <div class="form-horizontal">
            <h4>Product</h4>
            <hr />
            <div class="form-group">
                <label class="col-md-3 control-label">First Name:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="FirstName" name="FirstName" value="" required/>
                    <span data-valmsg-for="FirstName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Last Name:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="LastName" name="LastName" value="" required/>
                    <span data-valmsg-for="LastName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Phone:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Phone" name="Phone" value="" required/>
                    <span data-valmsg-for="Phone" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Postal Code:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="PostalCode" name="PostalCode" value="" required/>
                    <span data-valmsg-for="PostalCode" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">City:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="City" name="City" value="" required/>
                    <span data-valmsg-for="City" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Country:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Country" name="Country" value="" required/>
                    <span data-valmsg-for="Country" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Status:</label>
                <div class="col-md-6">
                    <select name="Status" class="form-control" method="post">
                        <option value="Waiting">Waiting</option>
                        <option value="Shipped">Shipping</option>
                    </select>
                    <span data-valmsg-for="Status" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label">Address:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="Address" name="Address" value="" required/>
                    <span data-valmsg-for="Address" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-10">
                    <button type="submit" class="btn btn-default btn-lg">
                        Place Order <span class="glyphicon glyphicon-fast-forward"></span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
}else{
    $CurrentTime = date('YmdHHmmss');
    $item = @$_SESSION['items'];
    foreach ($item as $value)
    {
        $array_products[] = $value['names'];

    }

    //for userid
//    $strSql = "insert into orders(Address, City, Country, FirstName, GST, GrandTotal, LastName,OrderDate, Phone, PostalCode, Status, Total, ProductName, UserId)
//               value('$_POST[Address]', '$_POST[City]', '$_POST[Country]', '$_POST[FirstName]', '$_SESSION[gst]', '$_SESSION[sub]', '$_POST[LastName]', '$CurrentTime', '$_POST[Phone]', '$_POST[PostalCode]', '$_POST[Status]', '$_SESSION[total]', '$array_products[0]', '')";
    $strSql = "insert into orders(Address, City, Country, FirstName, GST, GrandTotal, LastName,OrderDate, Phone, PostalCode, Status, Total, ProductName, UserID)
               value('$_POST[Address]', '$_POST[City]', '$_POST[Country]', '$_POST[FirstName]', '$_SESSION[gst]', '$_SESSION[sub]', '$_POST[LastName]', '$CurrentTime', '$_POST[Phone]', '$_POST[PostalCode]', '$_POST[Status]', '$_SESSION[total]', '$array_products[0]', '$_SESSION[userid]')";
    try{
        $result = $dbInstance->GetQueryResult($strSql);
    }catch (Exception $e) {
        header("Location: ./index.php");
    }
    $_SESSION['naddress'] = $_POST['Address'];
    $_SESSION['ncity']  = $_POST['City'];
    $_SESSION['ncountry']  = $_POST['Country'];
    $_SESSION['nfirstname']  = $_POST['FirstName'];
    $_SESSION['nlastname']  = $_POST['LastName'];
    $_SESSION['ncurdate']  = $CurrentTime;
    $_SESSION['nphone']  = $_POST['Phone'];
    $_SESSION['npostalcode']  = $_POST['PostalCode'];
    $_SESSION['nstatus']  = $_POST['Status'];
    $_SESSION['nordername']  = $array_products[0];
    $_SESSION['purchased'] = 1;

    //echo "test";
    header("Location: ./purchased.php");

}

?>



<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
