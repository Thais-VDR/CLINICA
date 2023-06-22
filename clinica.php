<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

header('Access-Control-Allow-Headers: Content-Type');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    exit;
}

include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $stmt = $conn->prepare("SELECT * FROM agendamento");
    $stmt->execute();
    $clinica = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($clinica);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nome_paciente = $_POST['nome_paciente'];
    $medico = $_POST['medico'];
    $dia = $_POST['dia'];
    $hora = $_POST['hora'];
  
    $stmt = $conn->prepare("INSERT INTO Agendamento (nome_paciente, medico, dia, hora) VALUES(:nome_paciente, :medico, :dia, :hora)");
    $stmt->bindParam(':nome_paciente', $nome_paciente);
    $stmt->bindParam(':medico', $medico);
    $stmt->bindParam(':dia', $dia);
    $stmt->bindParam(':hora', $hora);

    if($stmt->execute()){
        echo "agendamento criado com sucesso!!!";
    } else {
        echo"Erro ao criar agendamento!!!";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM Agendamento WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "agendamento excluido com sucesso!!!";
    }else{
        echo"Erro ao excluir agendamento";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])){
    parse_str(file_get_contents("php://input"), $_PUT);

    $id = $_GET['id'];
    $novoPaciente = $_PUT['nome_paciente'];
    $novoMedico = $_PUT['medico'];
    $novoDia = $_PUT['dia'];
    $novoHora = $_PUT['hora'];

    $stmt = $conn->prepare("UPDATE Agendamento SET nome_paciente = :nome_paciente, medico = :medico, dia = :dia, hora = :hora WHERE id = :id");
    $stmt->bindParam(':nome_paciente', $novoPaciente);
    $stmt->bindParam(':medico', $novoMedico);
    $stmt->bindParam(':dia', $novoDia);
    $stmt->bindParam(':hora', $novoHora);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "agendamento atualizado!!!";
    } else {
        echo "Erro ao att agendamento";
    }

}