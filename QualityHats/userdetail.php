<!-- Header -->
<?php
require('header.php');
require('./Utilities/DBFunctions.php');
$dbInstance = DBFunctions::GetDBInstance();
?>

<script>
    function showmsg() {
        alert("The fuction is still working   :-)");
    }
</script>

<br/><br/>
<div class="container body-content" id="contentBody">

    <h2>Manage your account.</h2>
    <h4>Change your account settings</h4>
    <hr/>

<?php
    //get database instance

    $sqlStr = "select * from users where Email='$_SESSION[username]'";
    $result = $dbInstance->GetQueryResult($sqlStr);
    $rowUser = $result->fetch_assoc();

?>

    <div class="container">
        <dl class="dl-horizontal">
            <dt>Password:</dt>
            <dd>
                <a herf="" onclick="showmsg()">Change</a>
            </dd>
            <dt>Mobile No:</dt>
            <dd>
                <?php echo $rowUser['MobileNo'] ?>
            </dd>
            <dt>Address:</dt>
            <dd>
                <?php echo $rowUser['Address'] ?>
            </dd>
        </dl>
    </div>
    <?php
    if (@$_SESSION['role'] != '1') {
    ?>
        <h2><span class="glyphicon glyphicon glyphicon-shopping-cart"></span> Order Information: </h2>
        <table class="table">
            <thead>
            <tr>
                <th>
                    ProductName
                </th>
                <th>
                    FirstName
                </th>
                <th>
                    LastName
                </th>
                <th>
                    Mobile Phone
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
                    Total (Sum)
                </th>
                <th>
                    Status
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            //get database instance

            $sqlStrOrder = "select * from orders where UserID = '$_SESSION[userid]'";
            $result = $dbInstance->GetQueryResult($sqlStrOrder);
            while ($rowOrderInfo = $result->fetch_assoc())
            {
                echo "<tr>";
                echo "<td>" . $rowOrderInfo["ProductName"] . "</td>";
                echo "<td>" . $rowOrderInfo["FirstName"] . "</td>";
                echo "<td>" . $rowOrderInfo["LastName"] . "</td>";
                echo "<td>" . $rowOrderInfo["Phone"] . "</td>";
                echo "<td>" . $rowOrderInfo["City"] . "</td>";
                echo "<td>" . $rowOrderInfo["Country"] . "</td>";
                echo "<td>" . $rowOrderInfo["GST"] . "</td>";
                echo "<td>" . $rowOrderInfo["GrandTotal"] . "</td>";
                echo "<td>" . $rowOrderInfo["Total"] . "</td>";
                echo "<td>" . $rowOrderInfo["Status"] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    <?php
    }
    ?>

</div>



<!-- Footer -->
<?php
require ('footer.php');
?>
