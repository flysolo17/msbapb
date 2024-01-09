
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Login & Registration System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <header>
        <div class="navbar navbar-dark bg-dark box-shadow">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-item-center">
                    <string>Dashboard</string>
                    <a>
                </div>
             </div>
       </header>
       <?php
       if(isset($_SESSION['username'])){
        ?>
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Welcome, <?php echo $_SESSION['username']?></h1>
                <p class="lead text-muted">There does not appear to be a way to set a tag / ident / program for log entries in the ini file when using error_log=syslog.  When I test locally, "apache2" is used.
However, calling openlog() with an ident parameter early in your script (or using an auto_prepend_file) will make PHP use that value for all subsequent log entries. closelog() will restore the original tag.</p>
                <a href="#" class="btn btn-primary my-2">More Menu</a>
                <a href="logout.php"class="btn btn-secondary my-2">"Logout</a>
                </div>
        </section>
        <?php
       }else{
            header("Location: index.php");
       }

       ?>
</body>
</html>