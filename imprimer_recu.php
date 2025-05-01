<?php
require 'vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

if (isset($_GET['id'])) {
    $idPaiement = $_GET['id'];
    include('Configuration/config.php');

    $stmt = $pdo->prepare("SELECT p.nom, p.postnom, p.prenom, pa.date_paie, m.lib_Motifpaie, pa.montant, modepaiement.lib_Modepaiement, agent.nom as nom_agent, agent.prenom as prenom_agent
                           FROM paiement pa
                           JOIN patient p ON pa.id_patient = p.id_patient
                           JOIN agent on agent.id_agent = p.id_agent
                           JOIN motifpaiement m ON pa.id_Motifpaie = m.id_Motifpaie
                           JOIN modepaiement on modepaiement.id_Modepaiement = pa.id_Modepaiement
                           WHERE pa.id_paie = ?");
    $stmt->execute([$idPaiement]);
    $paiement = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$paiement) {
        echo "Paiement introuvable.";
        exit;
    }

    $qrData = "Reçu N°$idPaiement | Nom: {$paiement['nom']} | Postnom: {$paiement['postnom']} | Prénom: {$paiement['prenom']} | Date: {$paiement['date_paie']} | Motif: {$paiement['lib_Motifpaie']} | Montant: {$paiement['montant']} $ | Mode: {$paiement['lib_Modepaiement']} | Caissier: {$paiement['prenom_agent']} {$paiement['nom_agent']}";

    $qrCode = QrCode::create($qrData)
        ->setSize(150)
        ->setMargin(5);

    $writer = new PngWriter();
    $result = $writer->write($qrCode);
    $qrImage = base64_encode($result->getString());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de Paiement</title>
    <style>
        @media print {
            @page { size: A5 portrait; margin: 0; }
            body { margin: 0; padding: 10px; font-family: 'Courier New', monospace; }
            .no-print { display: none; }
        }
        .recu-container { background-color: white; padding: 20px; border: 1px solid #ddd; width: 300px; margin: 30px auto; box-shadow: 0 0 8px rgba(0, 0, 0, 0.1); border-radius: 4px; }
        .recu-header { text-align: center; margin-bottom: 10px; }
        .ligne-separatrice { border-top: 1px dashed #000; margin: 5px 0; }
        .recu-detail, .recu-total { font-size: 14px; display: flex; justify-content: space-between; margin-bottom: 8px; }
        .recu-footer { text-align: center; font-size: 12px; color: gray; margin-top: 10px; }
        .qr-code { text-align: center; margin-top: 10px; }
        .btn-imprimer { margin-top: 10px; display: block; background-color: #007bff; color: white; text-align: center; padding: 8px; border: none; cursor: pointer; }
        .btn-imprimer:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="recu-container">
        <div class="recu-header">
            <h1>Hope Médical Center</h1>
            <p>Réf. Reçu : N°<?= htmlspecialchars($idPaiement) ?></p>
            <p>Date : <?= htmlspecialchars($paiement['date_paie']) ?></p>
        </div>
        <div class="ligne-separatrice"></div>
        <div class="recu-detail"><span>Nom :</span><span><?= htmlspecialchars($paiement['nom']) ?></span></div>
        <div class="recu-detail"><span>Postnom :</span><span><?= htmlspecialchars($paiement['postnom']) ?></span></div>
        <div class="recu-detail"><span>Prénom :</span><span><?= htmlspecialchars($paiement['prenom']) ?></span></div>
        <div class="recu-detail"><span>Motif :</span><span><?= htmlspecialchars($paiement['lib_Motifpaie']) ?></span></div>
        <div class="recu-detail"><span>Mode de paiement :</span><span><?= htmlspecialchars($paiement['lib_Modepaiement']) ?></span></div>
        <div class="recu-detail"><span>Caissier :</span><span><?= htmlspecialchars($paiement['prenom_agent']) ?> <?= htmlspecialchars($paiement['nom_agent']) ?></span></div>
        <div class="recu-detail"><span>Signature :</span><span>_ _ _ _ _ _ _ _</span></div>
        <div class="ligne-separatrice"></div>
        <div class="recu-total"><span>Total payé :</span><span><?= htmlspecialchars($paiement['montant']) ?> $</span></div>
        <div class="ligne-separatrice"></div>
        <div class="qr-code">
            <img src="data:image/png;base64,<?= $qrImage ?>" alt="QR Code" />
        </div>
        <div class="recu-footer">
            Merci pour votre visite<br>
            Hope Médical Center <br>
            Contact : +243 812 345 678
        </div>
        <button class="btn-imprimer no-print" onclick="window.print()">Imprimer le reçu</button>
    </div>
</body>
</html>
