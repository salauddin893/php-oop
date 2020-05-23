<?php include("includes/header.php"); ?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->

            <?php include_once("includes/top_nav.php"); ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include_once("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users
                        <small>Subheading</small>
                    </h1>


<?php

    // $sql = "SELECT * FROM users WHERE id = 1";
    // $result = $database->query($sql);
    // $user_found = mysqli_fetch_array($result);

    // echo $user_found['username'];

    // $all_usres = User::find_all_users();

    // while($row = mysqli_fetch_array($all_usres)) {
    //     echo $row['username'] . '<br>';
    // }


    // $user_info = User::find_user_by_id(2);
    
    // $user = User::instantion($user_info);

    // // $user = new User();

    // echo $user->id;

    // $user = new User();

    // $users = User::find_all_users();

    // foreach($users as $user) {
    //     echo $user->username . "<br>";
    // }

    // $user = new User();

    // $user_id_fund = User::find_all_users();

    // echo $user->username;

    $users = User::find_all_users();

    foreach($users as $user) {
        echo $user->username . "</br>";
    }

?>


                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>