<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "le_planes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$data_marcada = $_POST['data_marcada'];

$sql = "SELECT * FROM clientes WHERE telefone = '$telefone'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Cliente com este telefone já cadastrado.";
    while ($row = $result->fetch_assoc()) {
        echo "<div>Nome: " . $row['nome'] . " | Telefone: " . $row['telefone'] . " | Data Marcada: " . $row['data_marcada'] . "</div>";
    }
} else {
    $sql = "INSERT INTO clientes (nome, telefone, data_marcada) VALUES ('$nome', '$telefone', '$data_marcada')";

    if ($conn->query($sql) === TRUE) {
        $cliente_id = $conn->insert_id;

        foreach ($_POST['procedimento'] as $index => $procedimento) {
            $valor = $_POST['valor'][$index];
            $horario = $_POST['horario'][$index];

            $sql = "INSERT INTO procedimentos (cliente_id, procedimento, valor, horario) VALUES ('$cliente_id', '$procedimento', '$valor', '$horario')";

            if ($conn->query($sql) !== TRUE) {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        }
        echo "Cliente cadastrado com sucesso.";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
