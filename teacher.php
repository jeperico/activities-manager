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
        <form method="POST" action="">
            <button type="submit" name="logout" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Sair</button>
        </form>
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
            <a href="./register_class.php" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cadastrar Turma</a>
        </div>
        <div class="bg-white p-8 rounded shadow w-full">
            <h2 class="text-xl mb-4 text-center font-bold">Listagem de Turmas</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2">Número</th>
                        <th class="py-2">Nome da Turma</th>
                        <th class="py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include './db/dbconnect.php';
                        $query = "SELECT * FROM Class";
                        $result = mysqli_query($conn, $query);
                        $count = 1;

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td class='py-2 text-center'>{$count}</td>";
                            echo "<td class='py-2 text-center'>{$row['name_class']}</td>";
                            echo "<td class='py-2 text-center flex justify-center gap-2'>
                                <a href='activities.php?id={$row['id_class']}' class='bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600'>Visualizar</a> ";
                                echo "<form method='POST' onsubmit='return confirm(\"Tem certeza que deseja excluir esta turma?\")'>";
                                    echo "<input type='hidden' name='delete_id' value='{$row['id_class']}'>";
                                    echo "<button type='submit' class='bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600'>Excluir</button>";
                                echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                            $count++;
                        }
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
                            $delete_id = $_POST['delete_id'];
                            $check_query = "SELECT have_activities FROM Class WHERE id_class = $delete_id";
                            $check_result = mysqli_query($conn, $check_query);
                            $check_row = mysqli_fetch_assoc($check_result);

                            if ($check_row['have_activities']) {
                                echo "<script>alert('Você não pode excluir turmas com atividades.');</script>";
                            } else {
                                $delete_query = "DELETE FROM Class WHERE id_class = $delete_id";
                                mysqli_query($conn, $delete_query);
                                echo "<script>window.location.href=window.location.href;</script>";
                            }
                        }

                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>