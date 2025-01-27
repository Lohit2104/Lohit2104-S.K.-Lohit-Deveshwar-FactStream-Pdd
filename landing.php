<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <style>
        /* Resetting default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Full viewport height for body */
        body, html {
            height: 100%;
            background-color: #0E2433;
            color: #E0E1DD;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Main container styling */
        .container {
            text-align: center;
            padding: 200px;
        }

        /* Logo styling */
        .logo {
            max-width: 100%;
            max-height: 60px;
            margin-bottom:20px;
        }

        /* Heading and description styles */
        h1 {
            font-size: 3rem;
            color: #ead8b1;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2rem;
            color: #ead8b1;
            margin-bottom: 30px;
        }

        /* Get Started button styles */
        .get-started-btn {
            background-color: #6A98B0;
            color: #FFFFFF;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Button hover effect */
        .get-started-btn:hover {
            background-color: #45A049;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="logo.png" alt="Fact Stream Logo" class="logo">
        <h1>Welcome to Fact Stream</h1>
        <p>Your daily source of interesting facts and insights</p>
        <button onclick="location.href='login.php'" class="get-started-btn">Get Started</button>
    </div>
</body>
</html>
