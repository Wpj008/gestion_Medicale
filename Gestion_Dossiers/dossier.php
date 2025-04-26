<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dossier Médical - Gestion des Patients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="CSS/dossier.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
        // Inclure la configuration de la base de données
        include('Configuration/config.php');
        
        // Vérifier si l'ID du patient est passé en paramètre
        $id_patient = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id_patient <= 0) {
            die("ID patient invalide");
        }
        
        try {
            // Récupérer les informations du patient
            $sql_patient = "SELECT p.*, c.lib_categ
                           FROM patient p
                           LEFT JOIN categorie c ON p.id_categorie = c.id_categorie
                           WHERE p.id_patient = ?";
            $stmt_patient = $pdo->prepare($sql_patient);
            $stmt_patient->execute([$id_patient]);
            $patient = $stmt_patient->fetch(PDO::FETCH_ASSOC);
            
            if (!$patient) {
                die("Patient non trouvé");
            }
            
            // Récupérer les consultations
            $sql_consultations = "SELECT c.*, a.nom as agent_nom, a.prenom as agent_prenom
                                 FROM consultation c
                                 JOIN agent a ON c.id_agent = a.id_agent
                                 JOIN prelevement p ON c.id_pre = p.id_pre
                                 WHERE p.id_patient = ?
                                 ORDER BY c.date_et_heure_consultation DESC";
            $stmt_consultations = $pdo->prepare($sql_consultations);
            $stmt_consultations->execute([$id_patient]);
            $consultations = $stmt_consultations->fetchAll(PDO::FETCH_ASSOC);
            
            // Récupérer les hospitalisations
            $sql_hospitalisations = "SELECT h.*, a.nom as agent_nom, a.prenom as agent_prenom
                                   FROM hospitalisation h
                                   JOIN agent a ON h.id_agent = a.id_agent
                                   WHERE h.id_patient = ?
                                   ORDER BY h.date_admission DESC";
            $stmt_hospitalisations = $pdo->prepare($sql_hospitalisations);
            $stmt_hospitalisations->execute([$id_patient]);
            $hospitalisations = $stmt_hospitalisations->fetchAll(PDO::FETCH_ASSOC);
            
            // Récupérer les soins administrés
            $sql_soins = "SELECT a.*, ag.nom as agent_nom, ag.prenom as agent_prenom
                          FROM administrationsoin a
                          JOIN agent ag ON a.id_agent = ag.id_agent
                          WHERE a.id_patient = ?
                          ORDER BY a.dateheure_soin DESC";
            $stmt_soins = $pdo->prepare($sql_soins);
            $stmt_soins->execute([$id_patient]);
            $soins = $stmt_soins->fetchAll(PDO::FETCH_ASSOC);
            
            // Récupérer les paiements
            $sql_paiements = "SELECT pa.*, m.lib_Motifpaie, mp.lib_Modepaiement, a.nom as agent_nom, a.prenom as agent_prenom
                            FROM paiement pa
                            LEFT JOIN motifpaiement m ON pa.id_Motifpaie = m.id_Motifpaie
                            LEFT JOIN modepaiement mp ON pa.id_Modepaiement = mp.id_Modepaiement
                            LEFT JOIN agent a ON pa.id_agent = a.id_agent
                            WHERE pa.id_patient = ?
                            ORDER BY pa.date_paie DESC";
            $stmt_paiements = $pdo->prepare($sql_paiements);
            $stmt_paiements->execute([$id_patient]);
            $paiements = $stmt_paiements->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            die("Erreur de base de données: " . $e->getMessage());
        }
        ?>
        
        <!-- En-tête du dossier -->
        <div class="dossier-header">
            <div class="patient-identity">
                <div class="patient-avatar">
                    <?= strtoupper(substr($patient['prenom'], 0, 1) . substr($patient['nom'], 0, 1)) ?>
                </div>
                <div class="patient-info">
                    <h2><?= htmlspecialchars($patient['prenom'] . ' ' . $patient['nom'] . ' ' . ($patient['postnom'] ?? '')) ?></h2>
                    <div class="patient-meta">
                        <span class="meta-item"><i class="fas fa-id-card"></i> ID: <?= $patient['id_patient'] ?></span>
                        <span class="meta-item"><i class="fas fa-venus-mars"></i> <?= htmlspecialchars($patient['sexe']) ?></span>
                        <span class="meta-item"><i class="fas fa-birthday-cake"></i> <?= date('d/m/Y', strtotime($patient['Datenaiss'])) ?> (<?= calculateAge($patient['Datenaiss']) ?> ans)</span>
                        <span class="meta-item"><i class="fas fa-tag"></i> <?= htmlspecialchars($patient['lib_categorie']) ?></span>
                    </div>
                </div>
            </div>
            <div class="dossier-actions">
                <button class="btn btn-outline"><i class="fas fa-print"></i> Imprimer</button>
                <!-- <button class="btn btn-primary"><i class="fas fa-edit"></i> Modifier</button> -->
            </div>
        </div>
        
        <!-- Contenu principal du dossier -->
        <div class="dossier-content">
            <!-- Sidebar avec informations fixes -->
            <div class="dossier-sidebar">
                <div class="sidebar-section">
                    <h3><i class="fas fa-info-circle"></i> Informations Personnelles</h3>
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label">Téléphone:</span>
                            <span class="info-value"><?= htmlspecialchars($patient['telephone']) ?></span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Email:</span>
                            <span class="info-value"><?= htmlspecialchars($patient['AdresseMail']) ?></span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Adresse:</span>
                            <span class="info-value"><?= htmlspecialchars($patient['adresse']) ?></span>
                        </li>
                    </ul>
                </div>
                
                <div class="sidebar-section">
                    <h3><i class="fas fa-heartbeat"></i> Statut Médical</h3>
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label">Dernière consultation:</span>
                            <span class="info-value">
                                <?= count($consultations) > 0 ? date('d/m/Y H:i', strtotime($consultations[0]['date_et_heure_consultation'])) : 'Aucune' ?>
                            </span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Hospitalisation:</span>
                            <span class="info-value">
                                <?= count($hospitalisations) > 0 ? 
                                    '<span class="badge badge-warning">En cours</span>' : 
                                    '<span class="badge badge-success">Aucune</span>' ?>
                            </span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Dernier soin:</span>
                            <span class="info-value">
                                <?= count($soins) > 0 ? date('d/m/Y H:i', strtotime($soins[0]['dateheure_soin'])) . ' (' . htmlspecialchars($soins[0]['type_soin']) . ')' : 'Aucun' ?>
                            </span>
                        </li>
                    </ul>
                </div>
                
                <div class="sidebar-section">
                    <h3><i class="fas fa-file-invoice-dollar"></i> Historique Financier</h3>
                    <ul class="info-list">
                        <li class="info-item">
                            <span class="info-label">Dernier paiement:</span>
                            <span class="info-value">
                                <?= count($paiements) > 0 ? 
                                    date('d/m/Y', strtotime($paiements[0]['date_paie'])) . ' - ' . 
                                    htmlspecialchars($paiements[0]['lib_Motifpaie']) . ' (' . 
                                    number_format($paiements[0]['montant'], 2) . ' $)' : 
                                    'Aucun' ?>
                            </span>
                        </li>
                        <li class="info-item">
                            <span class="info-label">Total payé:</span>
                            <span class="info-value">
                                <?php
                                $total = 0;
                                foreach ($paiements as $paiement) {
                                    if ($paiement['montant'] !== null) {
                                        $total += $paiement['montant'];
                                    }
                                }
                                echo number_format($total, 2) . ' $';
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Contenu principal -->
            <div class="dossier-main">
                <!-- Section Consultations -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-stethoscope"></i> Historique des Consultations</h3>
                    </div>
                    <div class="card-body">
                        <?php if (count($consultations) > 0): ?>
                            <div class="timeline">
                                <?php foreach ($consultations as $consultation): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-date">
                                            <?= date('d/m/Y H:i', strtotime($consultation['date_et_heure_consultation'])) ?>
                                            <span style="margin-left: 10px; color: var(--light-text);">
                                                Par <?= htmlspecialchars($consultation['agent_prenom'] . ' ' . $consultation['agent_nom']) ?>
                                            </span>
                                        </div>
                                        <div class="timeline-content">
                                            <h4 class="timeline-title"><?= htmlspecialchars($consultation['motif_consultation']) ?></h4>
                                            <div class="consultation-details">
                                                <div>
                                                    <div class="detail-item">
                                                        <div class="detail-label">Diagnostic:</div>
                                                        <div class="detail-value"><?= htmlspecialchars($consultation['Diagnose_medicale']) ?></div>
                                                    </div>
                                                    <div class="detail-item">
                                                        <div class="detail-label">Traitement:</div>
                                                        <div class="detail-value"><?= htmlspecialchars($consultation['Traitement_medical']) ?></div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="detail-item">
                                                        <div class="detail-label">Médicaments:</div>
                                                        <div class="detail-value"><?= htmlspecialchars($consultation['medicament_pris']) ?></div>
                                                    </div>
                                                    <div class="detail-item">
                                                        <div class="detail-label">Symptômes:</div>
                                                        <div class="detail-value"><?= htmlspecialchars($consultation['symptome_actuel']) ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-clipboard-list"></i>
                                <p>Aucune consultation enregistrée pour ce patient</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Section Hospitalisations -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-procedures"></i> Hospitalisations</h3>
                    </div>
                    <div class="card-body">
                        <?php if (count($hospitalisations) > 0): ?>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Date Admission</th>
                                            <th>Date Sortie Prévue</th>
                                            <th>État</th>
                                            <th>Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($hospitalisations as $hospitalisation): ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($hospitalisation['date_admission'])) ?></td>
                                                <td><?= date('d/m/Y', strtotime($hospitalisation['date_sortie_prevue'])) ?></td>
                                                <td>
                                                    <span class="badge <?= $hospitalisation['etat_patient'] === 'CRITIQUE' ? 'badge-warning' : 'badge-primary' ?>">
                                                        <?= htmlspecialchars($hospitalisation['etat_patient']) ?>
                                                    </span>
                                                </td>
                                                <td><?= htmlspecialchars($hospitalisation['agent_prenom'] . ' ' . $hospitalisation['agent_nom']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-bed"></i>
                                <p>Aucune hospitalisation enregistrée pour ce patient</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Section Soins Administrés -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-syringe"></i> Soins Administrés</h3>
                    </div>
                    <div class="card-body">
                        <?php if (count($soins) > 0): ?>
                            <div class="timeline">
                                <?php foreach ($soins as $soin): ?>
                                    <div class="timeline-item">
                                        <div class="timeline-date">
                                            <?= date('d/m/Y H:i', strtotime($soin['dateheure_soin'])) ?>
                                            <span style="margin-left: 10px; color: var(--light-text);">
                                                Par <?= htmlspecialchars($soin['agent_prenom'] . ' ' . $soin['agent_nom']) ?>
                                            </span>
                                        </div>
                                        <div class="timeline-content">
                                            <h4 class="timeline-title"><?= htmlspecialchars($soin['type_soin']) ?> (Durée: <?= htmlspecialchars($soin['dure_soin']) ?> min)</h4>
                                            <div class="detail-item">
                                                <div class="detail-label">Description:</div>
                                                <div class="detail-value"><?= htmlspecialchars($soin['description_detailler']) ?></div>
                                            </div>
                                            <div class="detail-item">
                                                <div class="detail-label">Observations:</div>
                                                <div class="detail-value"><?= htmlspecialchars($soin['observation']) ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-syringe"></i>
                                <p>Aucun soin administré enregistré pour ce patient</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Section Paiements -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-money-bill-wave"></i> Historique des Paiements</h3>
                    </div>
                    <div class="card-body">
                        <?php if (count($paiements) > 0): ?>
                            <div class="table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Motif</th>
                                            <th>Montant</th>
                                            <th>Mode</th>
                                            <th>Responsable</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($paiements as $paiement): ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($paiement['date_paie'])) ?></td>
                                                <td><?= htmlspecialchars($paiement['lib_Motifpaie']) ?></td>
                                                <td><?= $paiement['montant'] !== null ? number_format($paiement['montant'], 2) . ' $' : 'N/A' ?></td>
                                                <td><?= htmlspecialchars($paiement['lib_Modepaiement'] ?? 'N/A') ?></td>
                                                <td><?= htmlspecialchars($paiement['agent_prenom'] . ' ' . $paiement['agent_nom']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="empty-state">
                                <i class="fas fa-money-bill-wave"></i>
                                <p>Aucun paiement enregistré pour ce patient</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Fonction pour calculer l'âge à partir de la date de naissance
    function calculateAge($birthdate) {
        $birthDate = new DateTime($birthdate);
        $today = new DateTime();
        $age = $today->diff($birthDate);
        return $age->y;
    }
    ?>
</body>
</html>