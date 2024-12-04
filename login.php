<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciar Tarefas</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="./assets/tailwind-config.js"></script>
        <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">
        <style>
            body {
                background-image: url('./assets/background-login.jpg');
                background-size: cover;
                background-position: center;
            }
        </style>
    </head>
    <body>
        <main class="w-main m-auto max-w-mainmx h-screen py-10 flex items-center justify-center">
            <div class="bg-white p-8 rounded shadow w-full max-w-sm">
                <h1 class="text-4xl mb-4 text-center font-semibold text-blue">Bem Vindo</h1>
                <img src="./assets/logo-login.png" alt="h-10">
                <form method="POST">
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Usuário</label>
                        <input type="text" id="username" name="username" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Entrar</button>
                </form>
            </div>
        </main>
        <?php
            session_start();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include './db/dbconnect.php';

            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $query = "SELECT * FROM Teacher WHERE name_teacher = '$username' AND password_teacher = '$password'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['username'] = $username;
                $_SESSION['id_teacher'] = $row['id_teacher'];
                header("Location: teacher.php");
            } else {
                echo "<p class='text-red-500 text-center'>Usuário ou senha inválidos</p>";
            }

            mysqli_close($conn);
            }
        ?>
    </body>
</html>