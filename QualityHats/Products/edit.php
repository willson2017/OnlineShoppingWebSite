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
    $strSql = "select p.ProductID,p.CategoryID, p.Description, p.ImagePath, p.ProductName, p.SupplierID, p.UnitPrice, 
                       c.CategoryName, s.SupplierName 
                       from products p
                       inner join category c on p.CategoryID = c.CategoryID
                       inner join supplier s on p.SupplierID = s.SupplierID
                       where p.ProductID = "."$id";
    try {

        $result = $dbInstance->GetQueryResult($strSql);
        if (count($result) == 0) {
            header("Location: ./index.php");
        }
    } catch (Exception $e) {
        header("Location: ./index.php");
    }
    $row = $result->fetch_assoc();
}else {
    $ProductID = $_POST['ProductID'];
    $ProductName = $_POST['ProductName'];
    $CategoryName = $_POST['CategoryList'];
    $SupplierName = $_POST['SupplierList'];
    $UnitPrice = $_POST['UnitPrice'];
    $Description = $_POST['Description'];
    $CurrentTime = date('YmdHHmmss');
    $ImageName = "$_POST[ImagePath]";
    $name = $_FILES["userfile"]["name"];
   // echo "$name";
    $newimagName = "$CurrentTime"."$name";
    $storeImage = empty($name) ? "$_POST[ImagePath]": "$newimagName";
    echo "$newimagName";
    //move file to folder
    if ($_FILES["userfile"]["size"] != 0)
    {
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "../images/ProductImages/" . "$storeImage");
        $storeImage = "../images/ProductImages/"."$storeImage";
    }

    $strSql = "update products set ProductName = '$_POST[ProductName]', CategoryID = '$_POST[CategoryList]', SupplierID = '$_POST[SupplierList]', UnitPrice = '$_POST[UnitPrice]', Description = '$_POST[Description]', ImagePath = '$storeImage' where ProductID = '$_POST[ProductID]'";

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
    <h2>Edit Products</h2>

    <!--    for displaying body start-->
    <form action="edit.php" method="post" enctype="multipart/form-data">
        <div class="form-horizontal">
            <h4>Product</h4>
            <hr />

            <input type="hidden" id="ProductID" name="ProductID" value="<?php echo "$id" ?>"/>
            <div class="form-group">
                <label class="col-md-3 control-label"> Product Name:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="ProductName" name="ProductName" value="<?php echo $row["ProductName"]?>" required/>
                    <span data-valmsg-for="ProductName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Category Name:</label>
                <div class="col-md-6">
                    <select name="CategoryList" class="form-control">
                        <?php
                        $sql="select * from category";
                        $result = $dbInstance->GetQueryResult($sql);
                        //echo "<option value=''>{$row['CategoryName']}</option>";
                        while ($rowCategory = $result->fetch_assoc()) {
                            echo "<option name = 'categoryName_new' value='{$rowCategory['CategoryID']}'>{$rowCategory["CategoryName"]}</option>";
                        }
                        ?>
                    </select>
                    <span data-valmsg-for="CategoryName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Supplier Name:</label>
                <div class="col-md-6">
                    <select name="SupplierList" class="form-control">
                        <?php
                        $sql="select * from supplier";
                        $result = $dbInstance->GetQueryResult($sql);
                        //                        echo "<option value=''>{$row['SupplierName']}</option>";
                        while ($rowCategory = $result->fetch_assoc()) {
                            echo "<option name = 'SupplierName' value='{$rowCategory['SupplierID']}'>{$rowCategory["SupplierName"]}</option>";
                        }
                        ?>
                    </select>
                    <span data-valmsg-for="SupplierName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Unit Price:</label>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id="UnitPrice" name="UnitPrice" value="<?php echo $row["UnitPrice"]?>" required/>
                    <span data-valmsg-for="ProductName" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Description:</label>
                <div class="col-md-6">
                    <textarea cols="40" rows="5" class="form-control" type = "text" id="Description" name="Description" > <?php echo $row["Description"]?> </textarea>
                    <span data-valmsg-for="Description" data-valmsg-replace="true" class="text-danger" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label"> Image:</label>
                <div class="col-md-6">
                    <?php
                    $path = empty($row["ImagePath"]) ? "../images/Default.jpg": $row["ImagePath"];
                    echo "<img id='ProductImage' style='width: 300px; height: 300px;' class ='img-rounded' src=".$path." alt='Product Image' />";
                    ?>
                    <input class="form-control" type="hidden"id="ImagePath" name="ImagePath" value="<?php echo $row["ImagePath"]?>"/>
                </div>
            </div>

            <div class="form-group">
                <label  class="col-md-3 control-label">Change Image</label>
                <div class="col-md-4">
                    <span asp-validation-for="userfile" class="text-danger" />
                    <input type="file" name="userfile" id="userfile"  onchange="imagePreview( this );" accept="image/*" />
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
