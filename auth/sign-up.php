<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignUp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="js/validation.js" defer></script>
</head>

<body>
    <div style="display: flex; justify-content: center">
        <div>
            <h1>SignUp</h1>
            <form action="auth/process-signup.php" method="post" id="signup" novalidate>
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" />
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" />
                </div>
                <div>
                    <label for="password_confirmation">Repeat Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" />
                </div>
                <button>SignUp</button>
            </form>
            <div>
                <p>
                    <a href="auth/login.php">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>