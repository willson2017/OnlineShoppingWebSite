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
        <h2>Create A Category</h2>

        <!--    for displaying body start-->
        <form action="create.php" method="post">
            <div class="form-horizontal">
                <h4>Category</h4>
                <hr />
                <div class="form-group">
                    <label class="col-md-4 control-label">Category Name: </label>
                    <div class="col-md-4">
                        <input class="form-control" type = "text" id="CategoryName" name="CategoryName" value="" required/>
                        <span data-valmsg-for="CategoryName" data-valmsg-replace="true" class="text-danger" />
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Create" class="btn btn-default" />
                    </div>
                </div>
            </div>
        </form>
        <div >
            <a href="./index.php">Back to List</a>
        </div>

        <!--    for displaying body end-->
    </div>
<?php
}else {
    $categoryName = $_POST['CategoryName'];
    $strSql = "insert into category (CategoryName) value ('$categoryName')";
    //echo "$strSql";
    try{
        $result = $dbInstance->GetQueryResult($strSql);
    }catch (Exception $e) {
        header("Location: ./index.php");
    }
    header("Location: ./index.php");
}
?>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
