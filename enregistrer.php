<?php
// Sécurité minimale
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Accès refusé");
}

// Récupération des données
$nom = $_POST['nom'] ?? '';
$prenom = $_POST['prenom'] ?? '';
$region = $_POST['region'] ?? '';
$telephone = $_POST['telephone'] ?? '';
$cartJson = $_POST['cart'] ?? '[]';
$total = $_POST['total'] ?? 0;

$cart = json_decode($cartJson, true);

// Préparation du message
$message = "🛍️ Nouvelle commande reçue :\n\n";
$message .= "👤 Client : $prenom $nom\n";
$message .= "📍 Région : $region\n";
$message .= "📞 Téléphone : $telephone\n";
$message .= "💰 Total : $total FCFA\n\n";
$message .= "🛒 Produits commandés :\n";

foreach ($cart as $item) {
    $message .= "- " . $item['name'] . " | Taille: " . $item['size'] . " | Couleur: " . $item['color'] . " | Qté: " . $item['quantity'] . " | Prix: " . $item['price'] . " FCFA\n";
}

// Paramètres de l'e-mail
$to = "evasangare05@gmail.com"; // Mets ici ton email
$subject = "🛍️ Nouvelle commande depuis ton site";
$headers = "From: MK_Store <no-reply@mkstore.com>\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

// Envoi de l'e-mail
if (mail($to, $subject, $message, $headers)) {
    echo "OK";
} else {
    echo "Erreur lors de l'envoi de la commande. Vérifiez les paramètres de l'hébergeur.";
}
?>
