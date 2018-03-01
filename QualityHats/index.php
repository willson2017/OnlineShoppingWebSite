<!-- Header -->
<?php
require('header.php');
?>

<!-- Slide Picture -->
<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="6000">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="./images/Cover2/hat1.jpg" alt="Quality Hats" class="img-responsive" />
                <div class="carousel-caption" role="option">
                    <p>
                        <a class="btn btn-default" href="./MemberProducts/index.php"">
                            Shop Now
                        </a>

                    </p>
                </div>
            </div>
            <div class="item">
                <img src="./images/Cover2/hat2.jpg" alt="Quality Hats" class="img-responsive" />
                <div class="carousel-caption" role="option">
                    <p>
                        <a class="btn btn-default" href="./MemberProducts/index.php"">
                        Shop Now
                        </a>
                    </p>
                </div>
            </div>
            <div class="item">
                <img src="./images/Cover2/hat3.jpg" alt="Quality Hats" class="img-responsive" />
                <div class="carousel-caption" role="option">
                    <p>
                        <a class="btn btn-default" href="./MemberProducts/index.php"">
                        Shop Now
                        </a>
                    </p>
                </div>
            </div>
            <div class="item">
                <img src="./images/Cover2/hat4.jpg" alt="Quality Hats" class="img-responsive" />
                <div class="carousel-caption" role="option">
                    <p>
                        <a class="btn btn-default" href="./MemberProducts/index.php"">
                        Shop Now
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4" >
            <h2>Products Info</h2>
            <div class="alert alert-success">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tristique commodo lacus, at varius arcu euismod vel. In elementum diam nec turpis facilisis, sit amet varius justo vestibulum. Aliquam sit amet aliquet neque. Curabitur eu turpis fringilla, rutrum nisi sed, rutrum dui.</p>
                <br />
                <a class="btn btn-default col-lg-offset-3" href="./MemberProducts/index.php">Products</a>
            </div>
        </div>
        <div class="col-md-4">
            <h2>Contact US</h2>
            <div class="alert alert-success">
                <p>Morbi eu sodales nisl. Vivamus in pellentesque est, sed feugiat orci. Duis eu augue non turpis vulputate molestie ac nec urna. Praesent a nisi tellus. Aenean elementum elit viverra sodales placerat. Suspendisse lorem nisi, dignissim nec mauris sit amet, fringilla tincidunt ipsum.</p>
                <br />
                <a class="btn btn-default col-lg-offset-3" href="./contact.php">Contact US</a>
            </div>
        </div>
        <div class="col-md-4">
            <h2>Membership</h2>
            <div class="alert alert-success">
                <p>Praesent ligula sapien, lacinia eget erat sed, ullamcorper elementum nisl. Mauris condimentum tempor lorem quis tempor. Quisque sit amet ornare lacus. In vulputate nunc eu nisl dictum dapibus. Duis tincidunt tempor imperdiet. Curabitur bibendum nibh ipsum.</p>
                <br />
                <a class="btn btn-default col-lg-offset-3" href="./register.php">Join US</a>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php
require ('footer.php');
?>
