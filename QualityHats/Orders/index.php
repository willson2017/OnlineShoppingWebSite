<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
?>

<br/><br/>
<div class="container body-content" id="contentBody">

    <h2>Order List</h2>

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>
                    FirstName
                </th>
                <th>
                    LastName
                </th>
                <th>
                    Phone
                </th>
                <th>
                    PostalCode
                </th>
                <th>
                    City
                </th>
                <th>
                    Country
                </th>
                <th>
                    GST
                </th>
                <th>
                    GrandTotal
                </th>
                <th>
                    Total
                </th>
                <th>
                    Status
                </th>
                <th>
                    OrderDate
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            //get database instance
            $dbInstance = DBFunctions::GetDBInstance();
            $result = $dbInstance->GetQueryResult("select * from orders");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["FirstName"] . "</td>";
                echo "<td>" . $row["LastName"] . "</td>";
                echo "<td>" . $row["Phone"] . "</td>";
                echo "<td>" . $row["PostalCode"] . "</td>";
                echo "<td>" . $row["City"] . "</td>";
                echo "<td>" . $row["Country"] . "</td>";
                echo "<td>" . $row["GST"] . "</td>";
                echo "<td>" . $row["GrandTotal"] . "</td>";
                echo "<td>" . $row["Total"] . "</td>";
                echo "<td>" . $row["Status"] . "</td>";
                echo "<td>" . $row["OrderDate"] . "</td>";

                ?>
                <td>
                    <div class="col-md-offset-4">
                        <a href="./edit.php?id=<?php echo $row["OrdersID"] ?>">Edit</a> |
                        <a href="delete.php?id=<?php echo $row["OrdersID"] ?>">Delete</a>
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
