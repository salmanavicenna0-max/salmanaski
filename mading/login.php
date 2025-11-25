<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Mading</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("https://majalahsunday.com/wp-content/uploads/2025/07/Article-Web-24.jpg");
            background-size: cover;     
            background-repeat: no-repeat; 
            background-position: center;  
            margin: 0;
            height: 100vh;
            display: flex;
        }
        .gambar {
            position: relative;
            left: 125px;
            width: 100px;
            background-size: cover;     
            background-repeat: no-repeat; 
            background-position: center;  
        }

        
        .login-box {
            width: 350px;
            height: 100vh; 
            background: #ffffff; 
            padding: 40px 30px;
            box-shadow: 3px 0 15px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            justify-content: center; 
        }

        h1 {
            font-family: poppins bold;
            text-align: center;
            font-weight: bold;
            font-size:70px;
            margin: auto;
            padding: center;
            text-shadow: 5px 5px 4px rgba(0, 0, 0, 0.5);
            color: #F5F5E9;
            text-shadow:
    -1px -1px 0 black, /* Top-left shadow */
     1px -1px 0 black, /* Top-right shadow */
    -1px  1px 0 black, /* Bottom-left shadow */
     1px  1px 0 black;
            position: relative;
            top: -120px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #999;
            border-radius: 6px;
            outline: none;
            transition: 0.25s;
        }

        .input-group input:focus {
            border-color: #2e7dff;
            box-shadow: 0 0 5px rgba(46,125,255,0.5);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #2e7dff;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover {
            background: #1f5ed5;
            transform: scale(1.05);
        }

        .error {
            margin-top: 15px;
            text-align: center;
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    
    <div class="login-box">
    <img class="gambar" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTjx37zJNKt1fduCFd9p6NIuiKKn_6w4815MA&s">
        <h2>Login</h2>

        <?php if ($message != ""): ?>
            <div class="error"><?= $message ?></div>
        <?php endif; ?>

        <form action="Dashboard.php" method="POST">
            <div class="input-group">
                <label>👤 Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label>🔒 Password</label>
                <input type="password" name="password" required>
            </div>
            
            <button type="submit" name="login">Login</button>
        </form>
    </div>
    <h1>E-Mading BN666</h1>
    

</body>
</html>
