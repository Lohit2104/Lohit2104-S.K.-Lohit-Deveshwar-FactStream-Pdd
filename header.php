  <!-- Top Header Start -->
  <div class="top-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4">
                        <div class="logo">
                            <a href="home.php">
                                <img src="img/logo.png" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-4">
                    <div class="search">
                        <form method="GET" action="search.php">
                            <input type="text" id="searchInput" name="searchQuery" placeholder="Search by category or title">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="results" id="results">
                    <ul id="resultsList"></ul>
                    </div>


                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="social">
                          
                            <a href="profile.php"><i class="fas fa-user"></i>Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Header End -->

         <!-- Header Start -->
         <?php
        include("conn.php");
        // Fetch categories from the database
        $sql = "SELECT DISTINCT categoryName FROM add_cat";
        $result = $conn->query($sql);
        $categories = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row['categoryName'];
            }
        }
        $conn->close();
        ?>
        <div class="header">
            <div class="container">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">MENU</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav m-auto">
                            <a href="home.php" class="nav-item nav-link">Home</a>
                            <a href="adduploads.php" class="nav-item nav-link">Uploads</a>
                            <a href="bookmarks.php" class="nav-item nav-link">Bookmarks</a>
                            <a href="chat.php" class="nav-item nav-link">Chat</a>
                            <div class="nav-item dropdown">
    <a href="category_page.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
    <div class="dropdown-menu">
        <?php foreach ($categories as $category): ?>
            <a href="category_page.php?category=<?php echo urlencode($category); ?>" class="dropdown-item"><?php echo htmlspecialchars($category); ?></a>
        <?php endforeach; ?>
    </div>
</div>
                            <a href="add_cat.php" class="nav-item nav-link">Add Category</a>
                            <a href="aboutus.php" class="nav-item nav-link">About Us</a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header End -->

