<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fact Stream - Signup</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Background and container styling */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #001f3f;
            color: #ead8b1;
        }

        .container {
            width: 400px;
            padding: 40px;
            background: #123456;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Header styling */
        .logo {
            font-size: 2em;
            font-weight: bold;
            color: #EAD8B1;
            margin-bottom: 20px;
        }

        .logo img {
            width: 60px;
            height: auto;
            margin-bottom: 10px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #7C83FD;
            border-radius: 5px;
            background: #e8f0fc;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        /* Button styling */
        button {
            width: 90%;
            padding: 10px;
            background-color: #3A86FF;
            border: none;
            border-radius: 5px;
            color: #E0E1DD;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Link styling */
        .link {
            margin-top: 20px;
            font-size: 0.9em;
        }

        .link a {
            color: #a7c0ff;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <p>Fact Stream</p>
        </div>
        <form action="signed.php" method="post">
            <input type="email" name="email_id" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" style="color: #E0E1DD;">Remember me</label>
            </div>
            <button type="submit" name="submit">Register</button>
        </form>
        <div class="link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

</body>
</html>
