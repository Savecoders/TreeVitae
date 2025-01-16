<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="public/css/styles.css" />
    <link rel="icon" href="public/assets/icons/logo.svg" type="image/svg+xml" />
    <title>Contacto | TreeVitae</title>
    <style>
        body {
            overflow: hidden;
            position: relative;
        }

        .main__container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--background-base);
            width: 100%;
        }

        .login__container {
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 1.5rem;
            width: 100%;
            max-width: 540px;
        }

        .title {
            font-size: 4ch;
            font-weight: 600;
            color: var(--text-900);
            font-family: 'Raleway', sans-serif;
            text-align: center;
        }

        .radial-gradient {
            background-image: radial-gradient(closest-side, #1efa851c, transparent);
            height: 720px;
            width: 720px;
            position: absolute;
            top: -320px;
            right: 10%;
            opacity: 0.5;
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div class="radial-gradient"></div>

    <main class="main__container">
        <div style="width: 80%; max-width: 400px" class="login__container">
            <h1 class="title">Login</h1>
            <form action="#" method="dialog">
                <div class="form__container">
                    <label for="email">Email</label>

                    <input type="email" id="email" name="email" required />
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />

                    <div class="checkbox">
                        <input type="checkbox" id="remember" name="remember" />
                        <label for="remember">Remember me</label>
                    </div>

                    <button style="padding: 0.8rem" type="submit" class="btn primary__with-icon">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>