<?php
require('../ForFolder/folderheader.php');
require('../Utilities/DBFunctions.php');
?>
<br/><br/>

<h2><div class="col-sm-1"></div><span class="glyphicon glyphicon-saved"></span>Thank you For Your Purchase!</h2>

<div class="container body-content" id="contentBody">
    <h4>The following order will be dispatched as per the details below.</h4>
    <div>
        <h4>Purchased Product</h4>
        <hr />
        <dl class="dl-horizontal col-md-5">
            <dt>
                <label class="col-md-4 control-label">FirstName: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['nfirstname'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">LastName: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['nlastname'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Phone: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['nphone'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">PostalCode: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['npostalcode'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Status: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['nstatus'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">OrderDate: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['ncurdate'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Address: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['naddress'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">City: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['ncity'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Country: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['ncountry'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">GST: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['gst'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">GrandTotal: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['sub'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">Total: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['total'] ?>
            </dd>

            <dt>
                <label class="col-md-4 control-label">City: </label>
            </dt>
            <dd>
                <?php echo $_SESSION['ncity'] ?>
            </dd>
            <dd>
                <table class="table">
                    <tr>
                        <th>Products </th>
                        <th>Quantity</th>
                        <th width='auto'>Unit Price</th>
                        <th width='auto'>Order Dates</th>
                    </tr>
                    <?php
                    $item = @$_SESSION['items'];
                    if (!empty($item))
                    {
                        foreach ($item as $value)
                        {
                            if ($value['number'] > 0)
                            {
                                echo "<tr>";
                                echo "<td width='auto'>";
                                echo "$value[names]";
                                echo "</td>";
                                echo "<td width='auto'>";
                                echo "$value[number]";
                                echo "</td>";
                                echo "<td width='auto'>";
                                echo "$value[unitprice]";
                                echo "</td>";
                                echo "<td width='auto'>";
                                echo "$_SESSION[ncurdate]";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <label>GST(15%):</label>
                        </td>
                        <td>
                            <?php echo "$_SESSION[gst]"; ?>
                        </td>

                        <td>
                            <label>Subtotal:</label>
                        </td>
                        <td>
                            <?php echo "$_SESSION[sub]"; ?>
                        </td>

                        <td>
                            <label>Total:</label>
                        </td>
                        <td>
                            <?php echo "$_SESSION[total]"; ?>
                        </td>
                    </tr>
                </table>

            </dd>
        </dl>
    </div>

</div>

<!-- Footer -->
<?php
require('../ForFolder/folderfooter.php');
?>
