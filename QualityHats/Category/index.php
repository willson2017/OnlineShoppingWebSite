<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
?>

<br/><br/>
<div class="container body-content" id="contentBody">

    <h2>Category List</h2>
    <p>
        <a href="./create.php">Create New</a>
    </p>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>
                    Category Name
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            //get database instance
            $dbInstance = DBFunctions::GetDBInstance();
            $result = $dbInstance->GetQueryResult("select * from category");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["CategoryName"] . "</td>";
                ?>
                <td>
                    <div class="col-md-offset-6">
                        <a href="./edit.php?id=<?php echo $row["CategoryID"] ?>">Edit</a> |
                        <a href="details.php?id=<?php echo $row["CategoryID"] ?>">Details</a> |
                        <a href="delete.php?id=<?php echo $row["CategoryID"] ?>">Delete</a>
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
