<?php
function addData($prenom, $nom, $telephone)
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=supdevinci', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête préparée pour éviter les injections SQL
        $stmt = $db->prepare("INSERT INTO supdevinci (prenom, nom, telephone) VALUES (:prenom, :nom, :telephone)");
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':telephone', $telephone);

        return $stmt->execute(); // Retourne TRUE si l'ajout a réussi
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}
?>
