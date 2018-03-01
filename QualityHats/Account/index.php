<!-- Header -->
<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
$dbInstance = DBFunctions::GetDBInstance();
if (isset($_GET['id']) && isset($_GET['flag']))
{
    if ($_GET['flag'] == 0)
    {
        $strSql = "update users set Disabled = 'true' where UserId = $_GET[id]";
    }else
    {
        $strSql = "update users set Disabled = 'false' where UserId = $_GET[id]";
    }
    $dbInstance->GetQueryResult($strSql);
}
?>

<br/><br/>
<div class="container body-content" id="contentBody">
    <h2>Account List</h2>

    <div class="container">
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>
                Email
            </th>
            <th>
                EmailConfirmed
            </th>
            <th>
                Enabled
            </th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = $dbInstance->GetQueryResult("select * from users");
        while ($row = $result->fetch_assoc()) {
            if ($row['Name'] != 'admin@email.com')
            {
                echo "<tr>";
                echo "<td>" . $row["Email"] . "</td>";

                if ($row["EmailConfirmed"] == 'true')
                {
                    echo "<td>"."<input checked=\"checked\" class=\"check-box\" disabled=\"disabled\" type=\"checkbox\" style=\"zoom:150%;\">". "</td>";
                }else{
                    echo "<td>"."<input class=\"check-box\" disabled=\"disabled\" type=\"checkbox\" style=\"zoom:150%;\">". "</td>";
                }

                if ($row["Disabled"] == 'true')
                {
                    echo "<td>"."<input checked=\"checked\" class=\"check-box\" disabled=\"disabled\" type=\"checkbox\" style=\"zoom:150%;\">". "</td>";
                    echo "<td>"."<a href='?id=$row[UserId]&flag=1'>Disable</a>". "</td>";
                }else{
                    echo "<td>"."<input class=\"check-box\" disabled=\"disabled\" type=\"checkbox\" style=\"zoom:150%;\">". "</td>";
                    echo "<td>"."<a href='?id=$row[UserId]&flag=0'>Enable</a>". "</td>";
                }
            }

        }
        ?>


        </tbody>
    </table>


</div>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>

