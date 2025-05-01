<!DOCTYPE html>
<html lang="fr">
<?php 
session_start();
    include 'Header/head.php';
    
    // Connexion à la base de données et récupération des données de l'agent
    
    include('Configuration/config.php');
    
    if (!isset($_SESSION['id_agent'])) {
        header("Location: login.php");
        exit;
    }
    
    $id_agent = $_SESSION['id_agent'];
    
    try {
        $sql = "SELECT a.*, f.lib_fonction, s.lib_specialite 
                FROM agent a
                LEFT JOIN fonction f ON a.id_fonction = f.id_fonction
                LEFT JOIN specialite s ON a.id_specialite = s.id_specialite
                WHERE a.id_agent = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_agent]);
        $agent = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$agent) {
            throw new Exception("Agent non trouvé");
        }
    } catch (Exception $e) {
        die("Erreur: " . $e->getMessage());
    }
?>
<body>
<?php 
    include 'Header/header.php';
?>

<section class="dashboard">
    <div class="top">
        <h2>Mon Profil</h2>
        <div class="icon_top">
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <i class="uil uil-user-circle"></i>
        </div>
    </div>

    <div class="conteneur">
        <div class="form-container">
            <div class="profile-header">
                <div class="avatar">
                    <?= strtoupper(substr($agent['prenom'], 0, 1) . substr($agent['nom'], 0, 1)) ?>
                </div>
                <div class="profile-title">
                    <h2><?= htmlspecialchars($agent['prenom'] . ' ' . $agent['nom'] . ' ' . ($agent['postnom'] ?? '')) ?></h2>
                    <span class="status-badge <?= $agent['status'] === 'actif' ? 'active' : 'inactive' ?>">
                        <?= ucfirst($agent['status']) ?>
                    </span>
                </div>
            </div>

            <form action="TRAITEMENT/update_profil.php" method="POST" class="formulaire">
                <div class="colonne">
                    <!-- <div class="input-box">
                        <label>Identifiant</label>
                        <input type="text" value="<?= htmlspecialchars($agent['id_agent']) ?>" readonly>
                    </div> -->
                    <div class="input-box">
                        <label>Fonction</label>
                        <input type="text" value="<?= htmlspecialchars($agent['lib_fonction']) ?>" readonly>
                    </div>
                </div>

                <div class="colonne">
                    <div class="input-box">
                        <label>Prénom</label>
                        <input type="text" name="prenom" value="<?= htmlspecialchars($agent['prenom']) ?>" required>
                    </div>
                    <div class="input-box">
                        <label>Nom</label>
                        <input type="text" name="nom" value="<?= htmlspecialchars($agent['nom']) ?>" required>
                    </div>
                </div>

                <div class="colonne">
                    <div class="input-box">
                        <label>Postnom</label>
                        <input type="text" name="postnom" value="<?= htmlspecialchars($agent['postnom'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label>Sexe</label>
                        <select name="sexe" required>
                            <option value="Masculin" <?= ($agent['sexe'] ?? '') === 'Masculin' ? 'selected' : '' ?>>Masculin</option>
                            <option value="Féminin" <?= ($agent['sexe'] ?? '') === 'Féminin' ? 'selected' : '' ?>>Féminin</option>
                        </select>
                    </div>
                </div>

                <div class="colonne">
                    <div class="input-box">
                        <label>Téléphone</label>
                        <input type="tel" name="telephone" value="<?= htmlspecialchars($agent['telephone'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label>Email</label>
                        <input type="email" name="AdresseMail" value="<?= htmlspecialchars($agent['AdresseMail'] ?? '') ?>">
                    </div>
                </div>

                <div class="colonne">
                    <div class="input-box">
                        <label>Adresse</label>
                        <input type="text" name="adresse" value="<?= htmlspecialchars($agent['adresse'] ?? '') ?>">
                    </div>
                    <div class="input-box">
                        <label>Spécialité</label>
                        <input type="text" value="<?= htmlspecialchars($agent['lib_specialite'] ?? 'Non spécifiée') ?>" readonly>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Mettre à jour</button>
            </form>
        </div>
    </div>
</section>

<script src="JS/script.js"></script>
<style>
    .profile-header {
        display: flex;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
    }
    
    .avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #1976D2;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: bold;
        margin-right: 1.5rem;
    }
    
    .profile-title h2 {
        margin: 0;
        color: #333;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }
    
    .status-badge.active {
        background-color: #E8F5E9;
        color: #4CAF50;
    }
    
    .status-badge.inactive {
        background-color: #FFEBEE;
        color: #F44336;
    }
    
    input[readonly] {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }
</style>
</body>
</html>