<?php
include("conn.php");

// Fetch all categories
$sqlCategories = "SELECT DISTINCT categoryName FROM add_cat";
$resultCategories = $conn->query($sqlCategories);
$categories = [];
if ($resultCategories->num_rows > 0) {
    while ($row = $resultCategories->fetch_assoc()) {
        $categories[] = $row['categoryName'];
    }
}

// Fetch submissions based on selected category
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : null;
$sqlSubmissions = "SELECT id, category, picture, title, created_at FROM submissions";
if ($selectedCategory) {
    $sqlSubmissions .= " WHERE category = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($sqlSubmissions);
    $stmt->bind_param("s", $selectedCategory);
} else {
    $sqlSubmissions .= " ORDER BY created_at DESC";
    $stmt = $conn->prepare($sqlSubmissions);
}

$stmt->execute();
$resultSubmissions = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Fact Stream - Submissions</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Fact Stream Submissions" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php include("header.php");?>

    <div class="container mt-4">
        <div class="row">
            <?php if ($resultSubmissions->num_rows > 0): ?>
                <?php while ($row = $resultSubmissions->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="fact-item">
                            <div class="fact-image">
                                <img src="<?php echo htmlspecialchars($row['picture']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="img-fluid" style="width:100%;height:200px;">
                            </div>
                            <div class="fact-title text-center">
                                <a href="fact_detail.php?id=<?php echo $row['id']; ?>" class="fact-link">
                                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                                </a>
                                <p class="text-muted"><?php echo date("F d, Y", strtotime($row['created_at'])); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">No submissions found for the selected category.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include('footer.php');?>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
