<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "le_planes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cliente_id = $_GET['cliente_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $procedimento = $_POST['procedimento'];
    $valor = $_POST['valor'];
    $horario = $_POST['horario'];

    $sql = "INSERT INTO procedimentos (cliente_id, procedimento, valor, horario) VALUES ('$cliente_id', '$procedimento', '$valor', '$horario')";

    if ($conn->query($sql) === TRUE) {
        header("Location: cliente.php?id=" . $cliente_id);
    } else {
        echo "Erro ao adicionar procedimento: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Procedimento - Salão Lê Planes</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Salão Lê Planes</h1>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="cadastrar.html">Cadastrar Cliente</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Adicionar Procedimento</h2>
        <form method="post" action="">
            <label for="procedimento">Procedimento:</label>
            <input type="text" id="procedimento" name="procedimento" required>
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" step="0.01" required>
            <label for="horario">Horário:</label>
            <input type="time" id="horario" name="horario" required>
            <button type="submit">Adicionar</button>
        </form>
        <a href="cliente.php?id=<?php echo $cliente_id; ?>">Voltar</a>
    </main>
    <footer>
        <p>&copy; 2024 Salão Lê Planes</p>
    </footer>
</body>
</html>
