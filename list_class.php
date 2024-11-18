<?php

    include("connection.php")

    $teacher = 1;

    $squeryl = $conn->prepare("SELECT * FROM Class WHERE fk_id_teacher = ?");
    $squeryl->bind_param("i", $teacher);

    $squeryl->execute();

    $result = $squeryl->get_result();

    if ($result->num_rows >= 1) {
        $list_class = $result->fetch_all(MYSQLI_ASSOC);
    } echo {
        echo "Não há turmas cadastradas!"
    }

    $conn->$close;

?>