<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Fact Stream</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Bootstrap Ecommerce Template" name="keywords">
        <meta content="Bootstrap Ecommerce Template Free Download" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
        <link href="lib/slick/slick.css" rel="stylesheet">
        <link href="lib/slick/slick-theme.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
            
            
            .cat-news .cn-img img {
    width: 100%;
    height: 200px;
}
.img-fluid {
    max-width: 100%;
    height: 266px;
}


            </style>

    </head>

    <body>
      
<?php
include('header.php'); 
?>
<br></br>

       
        <!-- Top News Start-->
        <!-- <div class="top-news">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 tn-left">
                        <div class="tn-img">
                            <img src="img/top-news-1.jpg"/>
                            <div class="tn-content">
                                <div class="tn-content-inner">
                                    <a class="tn-date" href=""><i class="far fa-clock"></i>05-Feb-2020</a>
                                    <a class="tn-title" href="">Blue whale-sized 110ft asteroid heading towards Earth at a speed of 30,381 km/h, NASA warns</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 tn-right">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="img/top-news-2.jpg" />
                                    <div class="tn-content">
                                        <div class="tn-content-inner">
                                            <a class="tn-date" href=""><i class="far fa-clock"></i>05-Feb-2020</a>
                                            <a class="tn-title" href="">11 Wiered facts about jupiter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="img/top-news-3.jpg" />
                                    <div class="tn-content">
                                        <div class="tn-content-inner">
                                            <a class="tn-date" href=""><i class="far fa-clock"></i>05-Feb-2020</a>
                                            <a class="tn-title" href="">Five important facts about UEFA EURO 2024</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="img/top-news-4.jpg" />
                                    <div class="tn-content">
                                        <div class="tn-content-inner">
                                            <a class="tn-date" href=""><i class="far fa-clock"></i>05-Feb-2020</a>
                                            <a class="tn-title" href="">12 Small Business Statistics: Facts & Numbers for 2024</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="img/top-news-5.jpg"/>
                                    <div class="tn-content">
                                        <div class="tn-content-inner">
                                            <a class="tn-date" href=""><i class="far fa-clock"></i>05-Feb-2020</a>
                                            <a class="tn-title" href="">AI in information technology.Know about the implementation and solution</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
                     <?php
                            include('conn.php');

                            $query2 = "SELECT * FROM submissions Where category='Facts'";
                            $result2 = $conn->query($query2);

                            // Get the current date
                            $currentDate = new DateTime();
                            if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $picture = $row['picture'];
                                $title = $row['title'];
                                $id = $row['id'];
                                $created_at = $row['created_at'];
                              
                                echo '
                                     <div class="col-md-4 mb-4">
                    <div class="cn-img">
                        <img src="' . htmlspecialchars($picture) . '" class="img-fluid"  />
                        <div class="cn-content">
                            <div class="cn-content-inner">
                                <a class="cn-date" href="fact_detail.php?id=' . $id . '">
                                    <i class="far fa-clock"></i>' . htmlspecialchars($created_at) . '
                                </a>
                                <a class="cn-title" href="fact_detail.php?id=' . $id . '">
                                    ' . htmlspecialchars($title) . '
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            ';
                                
                            }
                            } else {
                            echo '<div>No darta found.</div>';
                            }
                            $conn->close();
                        ?>
        </div>
        <!-- Top News End-->


        <!-- Category News Start-->
        <div class="cat-news">
            <div class="container-fluid">
                <div class="row">
                    <!-- sports -->
                    <div class="col-md-6">
                        <h2><i class="fas fa-align-justify"></i>Sports</h2>
                        <div class="row cn-slider">

                        <?php
                            include('conn.php');

                            $query2 = "SELECT * FROM submissions Where category='sports'";
                            $result2 = $conn->query($query2);

                            // Get the current date
                            $currentDate = new DateTime();
                            if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $picture = $row['picture'];
                                $title = $row['title'];
                                $id = $row['id'];
                                $created_at = $row['created_at'];
                              
                                echo '
                                    <div class="col-md-6">
                                        <div class="cn-img">
                                            <img src="' . htmlspecialchars($picture) . '" />
                                            <div class="cn-content">
                                                <div class="cn-content-inner">
                                                    <a class="cn-date" href="fact_detail.php?id=' . $id . '"><i class="far fa-clock"></i>' . htmlspecialchars($created_at) . '</a>
                                                    <a class="cn-title" href="fact_detail.php?id=' . $id . '">' . htmlspecialchars($title) . '</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                
                            }
                            } else {
                            echo '<div>No darta found.</div>';
                            }
                            $conn->close();
                        ?>
                            
                            
                        </div>
                    </div>
                    <!-- Technology -->
                    <div class="col-md-6">
                        <h2><i class="fas fa-align-justify"></i>Technology</h2>
                        <div class="row cn-slider">
                        <?php
                            include('conn.php');

                            $query2 = "SELECT * FROM submissions Where category='Technology'";
                            $result2 = $conn->query($query2);

                            // Get the current date
                            $currentDate = new DateTime();
                            if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $picture = $row['picture'];
                                $title = $row['title'];
                                $id = $row['id'];
                                $created_at = $row['created_at'];
                              
                                echo '
                                    <div class="col-md-6">
                                        <div class="cn-img">
                                            <img src="' . htmlspecialchars($picture) . '" />
                                            <div class="cn-content">
                                                <div class="cn-content-inner">
                                                    <a class="cn-date" href="fact_detail.php?id=' . $id . '"><i class="far fa-clock"></i>' . htmlspecialchars($created_at) . '</a>
                                                    <a class="cn-title" href="fact_detail.php?id=' . $id . '">' . htmlspecialchars($title) . '</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                
                            }
                            } else {
                            echo '<div>No darta found.</div>';
                            }
                            $conn->close();
                        ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <!-- Category News End-->


        <!-- Category News Start-->
        <div class="cat-news">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h2><i class="fas fa-align-justify"></i>Business</h2>
                        <div class="row cn-slider">
                        <?php
                            include('conn.php');

                            $query2 = "SELECT * FROM submissions Where category='Business'";
                            $result2 = $conn->query($query2);

                            // Get the current date
                            $currentDate = new DateTime();
                            if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $picture = $row['picture'];
                                $title = $row['title'];
                                $id = $row['id'];
                                $created_at = $row['created_at'];
                              
                                echo '
                                    <div class="col-md-6">
                                        <div class="cn-img">
                                            <img src="' . htmlspecialchars($picture) . '" />
                                            <div class="cn-content">
                                                <div class="cn-content-inner">
                                                    <a class="cn-date" href="fact_detail.php?id=' . $id . '"><i class="far fa-clock"></i>' . htmlspecialchars($created_at) . '</a>
                                                    <a class="cn-title" href="fact_detail.php?id=' . $id . '">' . htmlspecialchars($title) . '</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                
                            }
                            } else {
                            echo '<div>No darta found.</div>';
                            }
                            $conn->close();
                        ?>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2><i class="fas fa-align-justify"></i>Entertainment</h2>
                        <div class="row cn-slider">
                        <?php
                            include('conn.php');

                            $query2 = "SELECT * FROM submissions Where category='Entertainment'";
                            $result2 = $conn->query($query2);

                            // Get the current date
                            $currentDate = new DateTime();
                            if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $picture = $row['picture'];
                                $title = $row['title'];
                                $id = $row['id'];
                                $created_at = $row['created_at'];
                              
                                echo '
                                    <div class="col-md-6">
                                        <div class="cn-img">
                                            <img src="' . htmlspecialchars($picture) . '" />
                                            <div class="cn-content">
                                                <div class="cn-content-inner">
                                                    <a class="cn-date" href="fact_detail.php?id=' . $id . '"><i class="far fa-clock"></i>' . htmlspecialchars($created_at) . '</a>
                                                    <a class="cn-title" href="fact_detail.php?id=' . $id . '">' . htmlspecialchars($title) . '</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                
                            }
                            } else {
                            echo '<div>No darta found.</div>';
                            }
                            $conn->close();
                        ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category News End-->
        

        <div class="row">
                     <?php
                            include('conn.php');

                            $query2 =  "SELECT * FROM submissions WHERE category != 'Facts'";
                            $result2 = $conn->query($query2);

                            // Get the current date
                            $currentDate = new DateTime();
                            if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                $picture = $row['picture'];
                                $title = $row['title'];
                                $id = $row['id'];
                                $created_at = $row['created_at'];
                              
                                echo '
                                     <div class="col-md-4 mb-4">
                    <div class="cn-img">
                        <img src="' . htmlspecialchars($picture) . '" class="img-fluid"  />
                        <div class="cn-content">
                            <div class="cn-content-inner">
                                <a class="cn-date" href="fact_detail.php?id=' . $id . '">
                                    <i class="far fa-clock"></i>' . htmlspecialchars($created_at) . '
                                </a>
                                <a class="cn-title" href="fact_detail.php?id=' . $id . '">
                                    ' . htmlspecialchars($title) . '
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            ';
                                
                            }
                            } else {
                            echo '<div>No darta found.</div>';
                            }
                            $conn->close();
                        ?>
        </div>
<?php include('footer.php');?>

 




        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

        

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>


        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
