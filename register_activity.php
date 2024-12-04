<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Tarefas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./assets/tailwind-config.js"></script>
    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">
</head>
<body class="bg-gray-200">
    <header class="bg-blue text-white p-4 grid grid-cols-header items-center">
        <h1 class="text-xl"><?php echo $_SESSION['username']; ?></h1>
        <a href="teacher.php" class="justify-self-center">
            <img src="./assets/logo.png" alt="Logo Sesi" class="h-16">
        </a>
        <div class="justify-self-end">
        <a href="activities.php?id=<?php echo $_GET['id'] ?>" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Voltar para a Atividade</a>
        <a href="teacher.php" class="bg-green-500 px-4 py-2 rounded mx-2 hover:bg-green-600">Voltar para a Página Inicial</a>
        <form method="POST" action="" class="inline">
            <button type="submit" name="logout" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Sair</button>
        </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
            session_destroy();
            header("Location: login.php");
            exit();
        }
        ?>
    </header>
    <main class="w-main m-auto max-w-mainmx py-10 flex items-center justify-center h-[84vh]">
        <div class="bg-white p-8 rounded shadow w-full max-w-sm">
            <h1 class="text-xl mb-4 text-center font-bold">Cadastrar Atividade</h1>
            <form method="POST">
                <div class="mb-4">
                    <label for="activityname" class="block text-sm font-medium text-gray-700" required>Nome da Atividade</label>
                    <input type="text" id="activityname" name="activityname" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Registrar</button>
            </form>
        </div>
    </main>
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            include './db/dbconnect.php';

            $id_class = $_GET['id'];
            $activity_name = mysqli_real_escape_string($conn, $_POST['activityname']);

            $query = "INSERT INTO Activity (description_activity, fk_id_class) VALUES ('$activity_name', '$id_class')";

            if (mysqli_query($conn, $query)) {
                echo "<p class='text-green-500 text-center'>Classe registrada com sucesso</p>";
            } else {
                echo "<p class='text-red-500 text-center'>Erro ao registrar a classe</p>";
            }
        }
    ?>
</body>
</html>
