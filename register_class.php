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
    </head>
    <body>
        <header class="bg-blue text-white p-4 flex justify-between items-center">
            <h1 class="text-xl"><?php echo $_SESSION['username']; ?></h1>
            <div>
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
                <h1 class="text-xl mb-4 text-center font-bold">Registrar Turma</h1>
                <form method="POST">
                    <div class="mb-4">
                        <label for="classname" class="block text-sm font-medium text-gray-700" required>Nome da Classe</label>
                        <input type="text" id="classname" name="classname" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                    </div>
                    <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Registrar</button>
                </form>
            </div>
        </main>
        <?php
            if (isset($_SESSION['id_teacher'])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id_teacher = $_SESSION['id_teacher'];

                    include './db/dbconnect.php';

                    $classname = mysqli_real_escape_string($conn, $_POST['classname']);

                    $check_teacher_query = "SELECT id_teacher FROM teacher WHERE id_teacher = '$id_teacher'";
                    $result = mysqli_query($conn, $check_teacher_query);

                    if (mysqli_num_rows($result) > 0) {
                        $query = "INSERT INTO Class (name_class, fk_id_teacher) VALUES ('$classname', '$id_teacher')";
                        if (mysqli_query($conn, $query)) {
                            echo "<p class='text-green-500 text-center'>Classe registrada com sucesso</p>";
                        } else {
                            echo "<p class='text-red-500 text-center'>Erro ao registrar a classe</p>";
                        }
                    } else {
                        echo "<p class='text-red-500 text-center'>Erro: Professor não encontrado</p>";
                    }
                }
            } else {
                echo "<p class='text-red-500 text-center'>Erro: Professor não identificado</p>";
            }
        ?>
    </body>
</html>
