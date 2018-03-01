<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
?>

<br/><br/>
<div class="container body-content" id="contentBody">

    <h2>Products List</h2>
    <p>
        <a href="./create.php">Create New</a>
    </p>
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
            //get database instance
            $dbInstance = DBFunctions::GetDBInstance();
            $strSql = "select p.ProductID,p.CategoryID, p.Description, p.ImagePath, p.ProductName, p.SupplierID, p.UnitPrice, 
                       c.CategoryName, s.SupplierName 
                       from products p
                       inner join category c on p.CategoryID = c.CategoryID
                       inner join supplier s on p.SupplierID = s.SupplierID";
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
                        <a href="./edit.php?id=<?php echo $row["ProductID"] ?>">Edit</a> |
                        <a href="details.php?id=<?php echo $row["ProductID"] ?>">Details</a> |
                        <a href="delete.php?id=<?php echo $row["ProductID"] ?>">Delete</a>
                    </div>
                </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
