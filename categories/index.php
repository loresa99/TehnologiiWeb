<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="categories.css">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
</head>
<body style="weight: lightgrey;">
<div class="page-wrapper chiller-theme toggled">
	<a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">Navigation</a>
                    <div id="close-sidebar">
                    </div>
                </div>
                <div class="sidebar-header">
                    <div class="user-pic">
                    <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                        alt="User picture">
                    </div>
                    <div class="user-info">
						<?php
							// Get logged user from database
							include "../db_connection.php";
							session_start();
							if (isset($_SESSION['tw_id'])) {
								$connection = mysqli_connect($db_hostname, $db_username, $db_password);
								$userId = $_SESSION['tw_id'];
								$sql = "SELECT * FROM $database.Users WHERE id = '$userId'";
								$retval = mysqli_query( $connection, $sql );
								if(! $retval ) {
									echo "Error accessing table Users: ".mysqli_error($connection);
								}
								while($row = mysqli_fetch_assoc($retval)) {
									$firstName = $row["first_name"];
									$lastName = $row["last_name"];
									$role= $row["role"];
									echo "<span class=\"user-name\">$firstName <strong>$lastName</strong></span>";
									echo "<span class=\"user-role\">$role</span>";
								}
								mysqli_close($connection);
							}
						?>
						
						<span class="user-status">
							<i class="fa fa-circle"></i>
							<span>Online</span>
						</span>
                    </div>
                </div>
                <!-- sidebar-search  -->
                <div class="sidebar-menu">
                    <ul>
						<li class="header-menu">
                            <span>Products</span>
                        </li>

						<li class="sidebar-dropdown">
							<a href="#">
								<i class="fa fa-female"></i>
								<span>FEMEI</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li>
										<a href="#">Accesorii</a>
									</li>
									<li>
										<a href="#">Cosmetice</a>
									</li>
								</ul>
							</div>
						</li>

						<li class="sidebar-dropdown">
							<a href="#">
								<i class="fa fa-male"></i>
								<span>BĂRBAȚI</span>
							</a>
							<div class="sidebar-submenu">
								<ul>
									<li>
										<a href="#">Accesorii</a>
									</li>
									<li>
										<a href="#">Încălțăminte</a>
									</li>
								</ul>
							</div>
						</li>
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
            <!-- sidebar-content  -->
            <div class="sidebar-footer">
                <a href="#">
                    
                </a>
            </div>
        </nav>
        <!-- sidebar-wrapper  -->
	</div>

	<!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="categories.js"></script>
</body>
</html>
