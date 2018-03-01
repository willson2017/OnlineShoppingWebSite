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

        $result = $dbInstance->GetQueryResult("select * from category where CategoryID = "."$id");
        if (count($result) == 0) {
            header("Location: ./index.php");
        }
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
    //$row = mysqli_fetch_row($result)[1];
    $row = $result->fetch_assoc();
}else {
    $strSql = "update category set CategoryName = '$_POST[CategoryName]' where CategoryID = $_POST[CategoryID]";
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
    <h2>Edit Category</h2>

<!--    for displaying body start-->
    <form action="edit.php" method="post">
        <div class="form-horizontal">
            <h4>Category</h4>
            <hr />

            <input type="hidden" id="CategoryID" name="CategoryID" value="<?php echo "$id" ?>"/>
            <div class="form-group">
                <label class="col-md-4 control-label">Category Name: </label>
                <div class="col-md-4">
                    <input class="form-control" type = "text" id="CategoryName" name="CategoryName" value="<?php echo $row["CategoryName"] ?>" required/>
                    <span data-valmsg-for="CategoryName" data-valmsg-replace="true" class="text-danger" />
                </div>
            <div class="col-md-4">
                <input type="submit" value="Save" class="btn btn-default" />
            </div>
            </div>
        </div>
    </form>
    <div >
        <a href="./index.php">Back to List</a>
    </div>

<!--    for displaying body end-->
</div>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
