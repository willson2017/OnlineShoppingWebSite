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
        <h2>Create A Product</h2>

        <!--    for displaying body start-->
        <form action="create.php" method="post" enctype="multipart/form-data">
            <div class="form-horizontal">
                <h4>Product</h4>
                <hr />
                <div class="form-group">
                    <label class="col-md-3 control-label">Product Name:</label>
                    <div class="col-md-6">
                        <input class="form-control" type = "text" id="ProductName" name="ProductName" value="" required/>
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
                    <label class="col-md-3 control-label">Unit Price: </label>
                    <div class="col-md-6">
                        <input class="form-control" type = "text" id="UnitPrice" name="UnitPrice" value="" required/>
                        <span data-valmsg-for="UnitPrice" data-valmsg-replace="true" class="text-danger" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"> Description:</label>
                    <div class="col-md-6">
                        <textarea cols="40" rows="5" class="form-control" type = "text" id="Description" name="Description" >  </textarea>
                        <span data-valmsg-for="Description" data-valmsg-replace="true" class="text-danger" />
                    </div>
                </div>

                <div class="form-group">
                    <label  class="col-md-3 control-label">Image</label>
                    <div class="col-md-4">
                        <span asp-validation-for="userfile" class="text-danger" />
                        <input type="file" name="userfile" id="userfile"  onchange="imagePreview( this );" accept="image/*" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"> Image Preview:</label>
                    <div class="col-md-6">
                        <img id="ProductImage" class="img-rounded" style="width: 300px; height: 200px;" src="../images/Default.jpg" alt="Product Image">
                    </div>
                </div>

                <div class="col-md-offset-2">
                    <input type="submit" value="Create" class="btn btn-default" />
                </div>
            </div>
        </form>

        <div >
            <a href="./index.php">Back to List</a>
        </div>
        <!--    for displaying body end-->
    </div>
    <?php
}else { //insert into database
    $CurrentTime = date('YmdHHmmss');
    $name = $_FILES["userfile"]["name"];
    // echo "$name";
    $newimagName = "$CurrentTime"."$name";
    $storeImage = empty($name) ? "../images/default_hat.jpg": "$newimagName";
    echo "$newimagName";
    //move file to folder
    if ($_FILES["userfile"]["size"] != 0)
    {
        move_uploaded_file($_FILES["userfile"]["tmp_name"], "../images/ProductImages/" . "$storeImage");
        $storeImage = "../images/ProductImages/"."$storeImage";
    }

    $strSql = "insert into products (ProductName, CategoryID, SupplierID, UnitPrice, Description, ImagePath) value ('$_POST[ProductName]', '$_POST[CategoryList]', '$_POST[SupplierList]', '$_POST[UnitPrice]', '$_POST[Description]', '$storeImage')";
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
