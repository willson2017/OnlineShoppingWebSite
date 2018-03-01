<!-- Header -->
<?php
ob_start();
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
require("./operation.php");

if (isset($_GET['id']))
{
    myclass::myfun($_GET['id'], $_GET['action'], $_GET['name']);
}
?>

<br/><br/>
<div class="container body-content" id="contentBody">

    <h2>Member Products List</h2>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>
                    Product Image
                </th>
                <th>
                    Product Name
                </th>
                <th>
                    Category Name
                </th>
<!--                <th>-->
<!--                    Supplier-->
<!--                </th>-->
                <th>
                    Unit Price
                </th>
                <th>
                    Description
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            if (@$_SESSION['purchased'] == '1')
            {
                myclass::myfun(0, 'clear', '');
                unset($_SESSION['purchased']);
            }
            //get database instance
            $dbInstance = DBFunctions::GetDBInstance();

            $pageSize=3;
            $rowCount=0;
            $pageNow=1;
            $pageCount=0;
            if(!empty($_GET['pageNow'])){
                $pageNow=$_GET['pageNow'];
            }
            $sqlcount='select count(*) from products';
            $resl =$dbInstance->GetQueryResult($sqlcount);
            if($row=($resl->fetch_row())){
                $rowCount=$row[0];
            }
            $pageCount=ceil($rowCount/$pageSize);
            $pageStart=($pageNow-1)*$pageSize;

            $strSql = "select p.ProductID,p.CategoryID, p.Description, p.ImagePath, p.ProductName, p.SupplierID, p.UnitPrice, 
                        c.CategoryName, s.SupplierName 
                        from products p, category c, supplier s
                        where p.CategoryID = c.CategoryID and p.SupplierID = s.SupplierID limit $pageStart, $pageSize";
            $result = $dbInstance->GetQueryResult($strSql);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>";
                $path = empty($row["ImagePath"]) ? "../images/default_hat.jpg": $row["ImagePath"];
                echo "<img style='width: 150px; height: auto;' class ='img-rounded' src=".$path." alt='Product Image' />";
                echo "";
                echo "</td>";

                echo "<td>" . $row["ProductName"] . "</td>";
                echo "<td>" . $row["CategoryName"] . "</td>";
//                echo "<td>" . $row["SupplierName"] . "</td>";
                echo "<td>" . $row["UnitPrice"] . "</td>";
                echo "<td class='wrapper' width='150px'>" . $row["Description"] . "</td>";
                ?>
                <td>
                    <div class="col-md-offset-4">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <a href="?action=add&id=<?php echo $row["ProductID"] ?>&name=<?php echo $row["ProductName"]?>" class="btn">Add to cart</a>

                    </div>
                </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="col-md-offset-6">
        <h5>
            <?php
            for($i=1;$i<=$pageCount;$i++){
                echo "<a href='?pageNow=$i'>$i</a> ";
            }
            ?>
        </h5>
    </div>

    <!--shopping cart-->
    <hr />
    <h2><span class="glyphicon glyphicon glyphicon-shopping-cart"></span></h2>
    <div class="row">
        <div class="col-sm-2">
            <h4 class="display-4">Item ID</h4>
        </div>
        <div class="col-sm-2">
            <h4 class="display-4">Hat Name</h4>
        </div>
        <div class="col-sm-2">
            <h4 class="display-4">Hat Category</h4>
        </div>
        <div class="col-sm-2">
            <h4 class="display-4">Quantity</h4>
        </div>
        <div class="col-sm-2">
            <h4 class="display-4">Price</h4>
        </div>
    </div>
    <?php
    $item = @$_SESSION['items'];
    if (!empty($item))
    {
        foreach ($item as $value)
        {
            if ($value['number'] > 0)
            {
                echo "<div class=\"row\">";
                echo "<div class=\"col-sm-2\">";
                echo "<h4>".$value['itemsid']."</h4>";
                echo " </div>";
                echo "<div class=\"col-sm-2\">";
                echo "<h4 >".$value['names']."</h4>";
                echo " </div>";
                echo "<div class=\"col-sm-2\">";
                echo "<h4 >".$value['categoryname']."</h4>";
                echo " </div>";
                echo "<div class=\"col-sm-2\">";
                echo "<h4 >".$value['number']."<a href='?action=remove&id=$value[itemsid]'><span class=\"glyphicon glyphicon-remove-circle\"></span></a>"."</h4>";
                echo " </div>";
                echo "<div class=\"col-sm-2\">";
                echo "<h4 >"."$".$value['unitprice']."</h4>";
                echo " </div>";
                echo "</div>";
            }
        }
    }
    ?>
</div>

<?php
    $sub = @$_SESSION['sub'];
    $gst = @$_SESSION['gst'];
    $total = @$_SESSION['total'];
    if (!empty($sub) && !empty($gst) && !empty($total)) {
        echo "<div class=\"row\">";
        echo "<h4 class=\" col-md-4 col-md-offset-3\"></h4>";
        echo "<h4 class=\" col-md-1 display-4\">GST(15%):</h4>";
        echo "<h4 class=\" col-sm-2 display-4\">".  "$".$gst."</h4>";
        echo "</div>";

        echo "<div class=\"row\">";
        echo "<h4 class=\" col-md-4 col-md-offset-3\"></h4>";
        echo "<h4 class=\" col-md-1 display-4\">SubAmount:</h4>";
        echo "<h4 class=\" col-sm-2 display-4\">". "$".$sub."</h4>";
        echo "</div>";

        echo "<div class=\"row\">";
        echo "<h4 class=\" col-md-4 col-md-offset-3\"></h4>";
        echo "<h4 class=\" col-md-1 display-4\"><b>Total:</b></h4>";
        echo "<h4 class=\" col-sm-2 display-4\">".  "$".$total."</h4>";
        echo "</div>";
        echo "<div class=\"row\">";
        echo "<h4 class=\" col-md-4 col-md-offset-3\"></h4>";
        echo " <div class=\"col-md-1 \">";
        echo "<a href='?action=clear&id=0'>";
        echo " Remove All <span class=\"glyphicon glyphicon-step-forward\"></span>";
        echo "</a>";
        echo "</div>";
        echo " <div class=\"col-sm-2\">";
        if (@$_SESSION['loginflag'] == '1') {
            echo "<a href=\"../Orders/create.php\">";
        }else{
            echo "<a href=\"../login.php\">";
        }
        echo "Proceed To Checkout <span class=\"glyphicon glyphicon-step-forward\"></span>";
        echo "</a>";
        echo "</div>";
        echo "</div>";
    }
?>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
