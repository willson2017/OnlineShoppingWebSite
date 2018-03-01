<!-- Header -->
<?php
ob_start();
require('header.php');
require('./Utilities/DBFunctions.php');
?>


<br/><br/>
<div class="container body-content" id="contentBody">
    <!--    <h4>Use a local account to log in.</h4>-->

    <div class="row">
        <div class="col-md-8">
            <section>
                <form action="login.php" method="post">
                    <h3>Use a local account to log in.</h3>
                    <hr/>
                    <div class="msg" id="infomsg" name="infomsg" style="display:none"></div>
                    <div class="form-group">
                        <label class="col-md-1 control-label ">Email:</label>
                        <div class="col-md-offset-2 col-md-8">
                            <input class="form-control" type="text" id="Email" name="Email" value="" required/>
                            <span data-valmsg-for="Email" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-1 control-label">Password:</label>
                        <div class="col-md-offset-2 col-md-8">
                            <input class="form-control" type="password" id="Password" name="Password" value=""
                                   autocomplete="off" required lay-verify="required"/>
                            <span data-valmsg-for="Password" class="text-danger"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-offset-2 col-md-8">
                            <div class="checkbox">
                                <label for="RememberMe">
                                    <input data-val="true" data-val-required="The Remember me? field is required."
                                           id="RememberMe" name="RememberMe" type="checkbox" value="true">
                                    Remember me?
                                </label>
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-10">
                            <button type="submit" class="btn btn-default">Log in</button>
                        </div>
                    </div>

                    <br/><br/>
                    <p>
                        <a href="./register.php">Register as a new user?</a>
                    </p>
                    <p>
                        <a href="">Forgot your password?</a>
                    </p>
                </form>
            </section>
        </div>

        <div class="col-md-4">
            <section>
                <h3>Use another service to log in.</h3>
                <hr/>
                <div>
                    <p>
                        There are no external authentication services configured. See <a
                                href="http://go.microsoft.com/fwlink/?LinkID=532715">this article</a>
                        for details on setting up this ASP.NET application to support logging in via external services.
                    </p>
                </div>
            </section>
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dbInstance = DBFunctions::GetDBInstance();
    $email = $_POST['Email'];
    $passwd = md5($_POST['Password']);

    $strSql = "select count(*) from users where Email = '$email' and Password='$passwd'";
    $strSql2 = "select * from users where Email = '$email' and Password='$passwd'";
    try {
        $result = $dbInstance->GetQueryResult($strSql);

        $row = mysqli_fetch_row($result);

        if ($row[0] > 0) {
            $result2 = $dbInstance->GetQueryResult($strSql2);
            $row2 = $result2->fetch_assoc();
            if ($row2['Disabled'] == 'false')
            {
                echo "<script>";
                echo "document.getElementById('infomsg').style.display='block';";
                echo "document.getElementById('infomsg').innerHTML='Your account is locked! Please contact administrator!';";
                //echo "alert(document.getElementById('infomsg').innerHTML);";
                $_SESSION['loginflag'] = '0';
                echo "</script>";
            }else{
                header("Location: ./index.php");
                ob_end_flush();
                $_SESSION['loginflag'] = '1';
                $_SESSION['username']= $email;
                $_SESSION['role'] = $row2['Role'];
                $_SESSION['userid'] = $row2['UserId'];
            }

        } else {
            echo "<script>";
            echo "document.getElementById('infomsg').style.display='block';";
            echo "document.getElementById('infomsg').innerHTML='Please check your username and password again !';";
            //echo "alert(document.getElementById('infomsg').innerHTML);";
            $_SESSION['loginflag'] = '0';
            echo "</script>";
            if (@$_SESSION['loginflag'] == '' && @$_SESSION['username']=='')
            {
                session_destroy();
            }
        }

    } catch (Exception $e) {
        header("Location: ./index.php");
    }
}
?>
<!-- Footer -->
<?php
require('footer.php');
?>

