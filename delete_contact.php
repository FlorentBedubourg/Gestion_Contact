<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=supdevinci', 'root', '');

    if (isset($_POST['id'])) {
        $id = intval($_POST['id']); // Assurez la sécurité avec intval()

        // Préparez et exécutez la requête DELETE
        $stmt = $db->prepare("DELETE FROM supdevinci WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php?status=delete_success");
        } else {
            header("Location: index.php?status=delete_error");
        }
        exit();
    } else {
        header("Location: index.php?status=delete_error");
        exit();
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
