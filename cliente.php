<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "le_planes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $cliente = $result->fetch_assoc();
} else {
    echo "Cliente não encontrado.";
    exit;
}

$sql = "SELECT * FROM procedimentos WHERE cliente_id = $id";
$result_procedimentos = $conn->query($sql);

$procedimentos = [];
if ($result_procedimentos->num_rows > 0) {
    while ($row = $result_procedimentos->fetch_assoc()) {
        $procedimentos[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Cliente - Salão Lê Planes</title>
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
        <h2>Detalhes do Cliente</h2>
        <p><strong>Nome:</strong> <?php echo $cliente['nome']; ?></p>
        <p><strong>Telefone:</strong> <?php echo $cliente['telefone']; ?></p>
        <p><strong>Data Marcada:</strong> <?php echo $cliente['data_marcada']; ?></p>
        <h3>Procedimentos</h3>
        <table>
            <tr>
                <th>Procedimento</th>
                <th>Valor</th>
                <th>Horário</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($procedimentos as $procedimento) { ?>
                <tr>
                    <td><?php echo $procedimento['procedimento']; ?></td>
                    <td><?php echo $procedimento['valor']; ?></td>
                    <td><?php echo $procedimento['horario']; ?></td>
                    <td>
                        <a href="editar_procedimento.php?id=<?php echo $procedimento['id']; ?>">Editar</a>
                        <a href="remover_procedimento.php?id=<?php echo $procedimento['id']; ?>">Remover</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <a href="adicionar_procedimento.php?cliente_id=<?php echo $cliente['id']; ?>">Adicionar Procedimento</a>
        <a href="editar_cliente.php?id=<?php echo $cliente['id']; ?>">Editar Dados do Cliente</a>
        <a href="index.html">Voltar</a>
    </main>
    <footer>
        <p>&copy; 2024 Salão Lê Planes</p>
    </footer>
</body>
</html>
