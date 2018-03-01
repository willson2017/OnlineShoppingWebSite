<!-- Header -->
<?php
ob_start();
require('header.php');
require('./Utilities/DBFunctions.php');
?>

<!--Get ID from the index page-->
<?php
$dbInstance = DBFunctions::GetDBInstance();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    ?>
    <br/><br/>
    <div class="container body-content" id="contentBody">
        <h2>Create a new account.</h2>

        <!--    for displaying body start-->
        <form action="register.php" method="post" onsubmit="return CheckTotalItems()">
            <div class="form-horizontal">
                <hr />

                <div class="form-group">
                    <label class="col-md-1 control-label ">Email:</label>
                    <div class = 'col-md-1'></div>
                    <div class="col-md-8">
                        <input class="form-control" type = "text" id="Email" name="Email" value="" required/>
                        <span data-valmsg-for="Email" class="text-danger"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label">Password:</label>
                    <div class = 'col-md-1'></div>
                    <div class="col-md-8">
                        <input class="form-control" type = "password" id="Password" name="Password" value="" autocomplete="off" required lay-verify="required"/>
                        <span data-valmsg-for="Password" class="text-danger"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label">Confirm Password:</label>
                    <div class = 'col-md-1'></div>
                    <div class="col-md-8">
                        <input class="form-control" type = "password" id="ConfirmPassword" name="ConfirmPassword" value="" autocomplete="off" required lay-verify="required"/>
                        <span data-valmsg-for="ConfirmPassword" class="text-danger"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label">MobileNo:</label>
                    <div class = 'col-md-1'></div>
                    <div class="col-md-8">
                        <input class="form-control" type = "text" id="MobileNo" name="MobileNo" value="" required/>
                        <span data-valmsg-for="MobileNo" class="text-danger"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label">Address:</label>
                    <div class = 'col-md-1'></div>
                    <div class="col-md-8">
                        <input class="form-control" type = "text" id="Address" name="Address" value="" required/>
                        <span data-valmsg-for="Address" class="text-danger"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default" onclick="sendmsg()">Register</button>
                    </div>
                </div>
            </div>
        </form>

        <div >
            <a href="./index.php">Back to List</a>
        </div>

        <!--    for displaying body end-->
    </div>
    <?php
}else {
    $passwd = md5($_POST[Password]);
    $Address = $_POST['Email'];
    if ($Address != '')
    {
        $SubjectTitle = "Welcome information from QualityHats";
        $Msg ="Hello, " .$_POST['Email']." Thank you very much for registering on our website, and enjoy your shopping time!";
        $MailType = 'plain';
        mail($Address,"Enjoy your email","Enjoy your email in plain text","FROM: $Address");
    }

    $strSql = "insert into users (Name, Email, Password, Role, MobileNo, Address, Disabled, EmailConfirmed)
               value ('$_POST[Email]', '$_POST[Email]', '$passwd', '0', '$_POST[MobileNo]', '$_POST[Address]', 'false', 'true')";

    try{
        $result = $dbInstance->GetQueryResult($strSql);

    }catch (Exception $e) {
        header("Location: ./index.php");    }
    header("Location: ./login.php");
    ob_end_flush();
}
?>

<!-- Footer -->
<?php
require ('footer.php');
?>
