<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fact Stream Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #001f3f;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: #Ead8b1;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .background {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            opacity: 0.8;
        }

        .icon {
            width: 100px;
            height: auto;
            position: absolute;
        }

        .top-left {
            top: 20px;
            left: 20px;
        }

        .bottom-left {
            bottom: 20px;
            left: 20px;
        }

        .top-right {
            top: 20px;
            right: 20px;
        }

        .bottom-right {
            bottom: 20px;
            right: 20px;
        }

        .character {
            width: 150px;
            margin-bottom: 10px;
        }

        .login-box {
            position: relative;
            background-color: #123456;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            font-size: 1em;
            color: #Ead8b1;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            outline: none;
            background-color: #dbe4ff;
            color: #123456;
            font-size: 1em;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #547aff;
            color: #fff;
            font-size: 1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4364bf;
        }

        .signup {
            margin-top: 15px;
            font-size: 0.9em;
        }

        .signup a {
            color: #a7c0ff;
            text-decoration: none;
        }

        .signup a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h1>Fact Stream</h1>
            <form action="logged.php" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Value">
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Value">
                
                <button type="submit">Login</button>
                
                <p class="signup">New to the site? <a href="signup.php">Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>