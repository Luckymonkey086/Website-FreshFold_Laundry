<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
                @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Poppins:wght@500&display=swap');

        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Oswald', sans-serif;
    font-family: 'Poppins', sans-serif;
}

.container{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;  
    min-height: 100vh;
    background-color: chocolate;
}

.container-form-login{
    background-color: white;
    border-radius: 20px;
    padding: 120px;
}

.form-group {
    margin-bottom: 50px;
}

form input{
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h1{
    text-align: center;
    margin-bottom: 10px;
}

/* p{
    margin-top: 90px;
    margin-left: 200px;
} */

form input{
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
form select{
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 20px;
}
.logo-container{
    padding-right: 120px;
    padding-top: 160px;
    padding-bottom: 160px;
    padding-left: 160px;
    background-color: whitesmoke;
    display: flex;
    align-items: center;
    border-radius: 20px 0 0 20px;

}

.logo{
    /* background-color: chocolate; */
    padding: 20px;
    text-transform: capitalize;
}

.logo-container img{
            width: 95px;
            height: 95px;
            border-radius: 30%;
            background-color: chocolate;
        }

        .text-color{
            color: coral;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container">
        <img src="images/logo.png" alt="">
        <h1 class="logo"><span class="text-color">FreshFold</span> laundry</h1>
        </div>
        <div class="container-form-login">
        <form action="proses_login_dekripsi.php" method="post">
            <h1>Login</h1>
            <div class="form-group">
            <label for="">Username</label>
                 <input type="text" name="username"  autocomplete="off" id="" required>
            </div>
            <div class="form-group">
            <label for="">Password  </label>
                 <input type="password" name="password"  autocomplete="off" id="" required>
            </div>
          <input type="submit" value="Login" class="btn">
        </form>
        </div>
    </div>
</body>
</body>
</html>