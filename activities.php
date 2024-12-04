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
    <main class="w-main m-auto max-w-mainmx py-10">
        <div class="flex justify-end mb-4">
            <a href="./register_activity.php?id=<?php echo $_GET['id']; ?>" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cadastrar Atividades</a>
        </div>
        <div class="bg-white p-8 rounded shadow w-full">
            <div class="flex items-end mb-4">
                <h2 class="text-xl font-bold mr-2">Turma:</h2>
            <?php
                if (isset($_GET['id'])) {
                    $class_id = $_GET['id'];
                    include './db/dbconnect.php';

                    $query = "SELECT name_class FROM Class WHERE id_class = $class_id";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    echo "<p>{$row['name_class']}.</p>";
                } else {
                    echo "<p>Classe não encontrada</p>";
                }
            ?>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">Número</th>
                        <th class="py-2">Nome da Atividade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include './db/dbconnect.php';
                        $query = "SELECT description_activity FROM Activity WHERE fk_id_class = $class_id";
                        $result = mysqli_query($conn, $query);
                        $count = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='py-2 text-center'>{$count}</td>";
                            echo "<td class='py-2 text-center'>{$row['description_activity']}</td>";
                            echo "</tr>";
                            $count++;
                        }

                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
