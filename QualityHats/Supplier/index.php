<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
?>

<br/><br/>
<div class="container body-content" id="contentBody">

    <h2>Supplier List</h2>
    <p>
        <a href="./create.php">Create New</a>
    </p>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>
                    Supplier Name
                </th>
                <th>
                    MobilePhone
                </th>
                <th>
                    WorkPhone
                </th>
                <th>
                    Address
                </th>
                <th>
                    Email
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            //get database instance
            $dbInstance = DBFunctions::GetDBInstance();
            $result = $dbInstance->GetQueryResult("select * from supplier");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["SupplierName"] . "</td>";
                echo "<td>" . $row["MobilePhone"] . "</td>";
                echo "<td>" . $row["WorkPhone"] . "</td>";
                echo "<td>" . $row["Address"] . "</td>";
                echo "<td>" . $row["Email"] . "</td>";
                ?>
                <td>
                    <div class="col-md-offset-4">
                        <a href="./edit.php?id=<?php echo $row["SupplierID"] ?>">Edit</a> |
                        <a href="details.php?id=<?php echo $row["SupplierID"] ?>">Details</a> |
                        <a href="delete.php?id=<?php echo $row["SupplierID"] ?>">Delete</a>
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
