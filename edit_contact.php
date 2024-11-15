<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=supdevinci', 'root', '');

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Validation de l'ID pour éviter les injections

        // Requête pour récupérer les informations du contact
        $stmt = $db->prepare("SELECT * FROM supdevinci WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $contact = $stmt->fetch();
        if (!$contact) {
            die("Contact introuvable.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom = $_POST['prenom'] ?? '';
            $nom = $_POST['nom'] ?? '';
            $telephone = $_POST['telephone'] ?? '';

            // Validation des données (facultatif, peut être amélioré)
            if ($prenom && $nom && $telephone) {
                // Requête de mise à jour
                $updateStmt = $db->prepare("UPDATE supdevinci SET prenom = :prenom, nom = :nom, telephone = :telephone WHERE id = :id");
                $updateStmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $updateStmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $updateStmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
                $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($updateStmt->execute()) {
                    header("Location: index.php?status=edit_success");
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour.";
                }
            } else {
                echo "Tous les champs sont obligatoires.";
            }
        }
    } else {
        die("ID invalide.");
    }
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<h1>Modifier un contact</h1>
<form method="post">
    <label for="prenom">Prénom:</label>
    <input type="text" name="prenom" value="<?php echo htmlspecialchars($contact['prenom']); ?>" required>
    <br>
    <label for="nom">Nom:</label>
    <input type="text" name="nom" value="<?php echo htmlspecialchars($contact['nom']); ?>" required>
    <br>
    <label for="telephone">Téléphone:</label>
    <input type="text" name="telephone" value="<?php echo htmlspecialchars($contact['telephone']); ?>" required>
    <br>
    <button type="submit">Enregistrer</button>
</form>
