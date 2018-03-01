<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page - QualityHats</title>


    <link rel="stylesheet" href="../lib/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../css/site.css" />
    <link rel="stylesheet" href="../lib/libcss/font-awesome.css" />

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="../index.php">
                            <img style="width:40px;height:40px" src="../images/Logo.png" alt="Quality Hats" />
                        </a>
                    </li>
                    <li><a href="../index.php" class="navbar-brand">QualityHats</a> </li>
                </ul>
            </div>
            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav">
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./about.php">About</a></li>
                    <li><a href="./contact.php">Contact</a></li>

                    <?php
                    if (@$_SESSION['role'] == '1') {
                        ?>
                        <li><a href="../Products/index.php">Products</a></li>
                        <li>
                            <ul class="menu nav navbar-nav ">
                                <li>
                                    <a >
                                        Administrator
                                    </a>
                                    <b class="sl-icon"></b>
                                    <ul class="sub-menu">
                                        <li><a href="../Supplier/index.php">Suppliers</a></li>
                                        <li><a href="../Category/index.php">Category</a></li>
                                        <li><a href="../Orders/index.php">Order</a></li>
                                        <li><a href="../Account/index.php">Accounts</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <?php
                    } else{
                        echo " <li><a href='../MemberProducts/index.php'>Products</a></li>";
                    }
                    ?>

                </ul>
                <?php
                if (isset($_SESSION['loginflag']) && @$_SESSION['loginflag'] == '1')
                {
                    echo "<ul class='nav navbar-nav navbar-right'>
                               <li><a href='../userdetail.php'>Hello  ". @$_SESSION[username] ."! </a></li>
                               <li><a href='../logoff.php'>Log off</a></li>
                               </ul>
                              ";
                }else{
                    echo "<ul class=\"nav navbar-nav navbar-right\">
                              <li><a href='../register.php'>Register</a></li>
                              <li><a href='../login.php'>Log in</a></li>
                              </ul>
                              ";
                }
                ?>
            </div>
        </div>
    </div>

</head>
<!-- Body -->
<body>
