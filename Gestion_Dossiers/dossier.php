<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dossier Médical - Gestion des Patients</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #1976D2;
            --secondary-color: #f5f7fa;
            --accent-color: #FF5722;
            --text-color: #333;
            --light-text: #777;
            --border-color: #e0e0e0;
            --success-color: #4CAF50;
            --warning-color: #FFC107;
            --danger-color: #F44336;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: var(--text-color);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .dossier-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }

        .patient-identity {
            display: flex;
            align-items: center;
        }

        .patient-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            margin-right: 20px;
        }

        .patient-info h2 {
            font-size: 1.8rem;
            margin-bottom: 5px;
            color: var(--primary-color);
        }

        .patient-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            color: var(--light-text);
            font-size: 0.9rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
        }

        .meta-item i {
            margin-right: 5px;
        }

        .dossier-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--white);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: var(--white);
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .dossier-content {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
        }

        .dossier-sidebar {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow);
            padding: 20px;
            height: fit-content;
        }

        .sidebar-section {
            margin-bottom: 25px;
        }

        .sidebar-section h3 {
            font-size: 1.1rem;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
            color: var(--primary-color);
        }

        .info-list {
            list-style: none;
        }

        .info-item {
            margin-bottom: 12px;
            display: flex;
        }

        .info-label {
            font-weight: 500;
            min-width: 120px;
            color: var(--light-text);
        }

        .info-value {
            flex: 1;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-primary {
            background-color: #E3F2FD;
            color: var(--primary-color);
        }

        .badge-success {
            background-color: #E8F5E9;
            color: var(--success-color);
        }

        .badge-warning {
            background-color: #FFF8E1;
            color: var(--warning-color);
        }

        .dossier-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            padding: 15px 20px;
            background-color: var(--secondary-color);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            font-size: 1.2rem;
            color: var(--primary-color);
        }

        .card-body {
            padding: 20px;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: var(--border-color);
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -30px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: var(--primary-color);
            border: 2px solid var(--white);
            z-index: 1;
        }

        .timeline-date {
            font-size: 0.85rem;
            color: var(--light-text);
            margin-bottom: 5px;
        }

        .timeline-content {
            background-color: var(--secondary-color);
            padding: 15px;
            border-radius: 6px;
            border-left: 3px solid var(--primary-color);
        }

        .timeline-title {
            font-weight: 600;
            margin-bottom: 8px;
        }

        .consultation-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 10px;
        }

        .detail-item {
            margin-bottom: 8px;
        }

        .detail-label {
            font-weight: 500;
            color: var(--light-text);
            font-size: 0.9rem;
        }

        .detail-value {
            margin-top: 3px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--secondary-color);
            font-weight: 600;
            color: var(--primary-color);
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }

        .status-active {
            background-color: var(--success-color);
        }

        .status-inactive {
            background-color: var(--danger-color);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--light-text);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--border-color);
        }

        @media (max-width: 992px) {
            .dossier-content {
                grid-template-columns: 1fr;
            }
            
            .consultation-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
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