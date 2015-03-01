<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">SynergySpace</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="mailbox.html">Messages</a>
                    </li>
                    <li>
                        <a href="#">Settings</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#login">Login/Register</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
    <!-- Login form -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Login/Register</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                    <div>
                        <input type="text" class="form-control" id="username" placeholder="Username">
                        <br />
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Login</button>
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#register">Register</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Registration form -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="register" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                <h4 class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <form method="post">
                    <div>
                        <input type="text" class="form-control" id="name" placeholder="Full name">
                        <br />
                        <input type="text" class="form-control" id="company" placeholder="Company">
                        <br />
                        <input type="text" class="form-control" id="username" placeholder="Username">
                        <br />
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </div>
    
<div id="wrapper">
