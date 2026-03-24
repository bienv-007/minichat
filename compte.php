<?php
session_start();
require 'connect_db.php';

// Redirection si l'utilisateur n'est pas connecté
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$message = ""; 

// --- LOGIQUE : MODIFICATION DU COMPTE ---
if (isset($_POST['update_account'])) {
    $nouveau_nom = htmlspecialchars($_POST['nom']);
    $nouvel_email = htmlspecialchars($_POST['email']);
    $nouvelle_date = $_POST['date_n'];

    $upd = $connexion->prepare("UPDATE t_utilisateurs SET nom_user = ?, email = ?, date_de_naissance = ? WHERE id = ?");
    if ($upd->execute([$nouveau_nom, $nouvel_email, $nouvelle_date, $user_id])) {
        $_SESSION["user_nom"] = $nouveau_nom;
        $message = "<div class='alert success'>✨ Informations mises à jour avec succès !</div>";
    } else {
        $message = "<div class='alert error'>❌ Erreur lors de la mise à jour.</div>";
    }
}

// --- LOGIQUE : SUPPRESSION DU COMPTE ---
if (isset($_POST['delete_account'])) {
    $del = $connexion->prepare("DELETE FROM t_utilisateurs WHERE id = ?");
    if ($del->execute([$user_id])) {
        session_destroy();
        header("Location: login.php?msg=compte_supprime");
        exit();
    }
}

$req = $connexion->prepare("SELECT * FROM t_utilisateurs WHERE id = ?");
$req->execute([$user_id]);
$user = $req->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres | Mon Compte</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --danger: #ef4444;
            --success: #10b981;
            --border: #e2e8f0;
        }

        body { 
            font-family: 'Inter', sans-serif; 
            background: var(--bg-body); 
            margin: 0; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh;
            color: var(--text-main);
        }

        .container { 
            width: 100%; 
            max-width: 500px; 
            padding: 20px;
        }

        .card { 
            background: var(--bg-card); 
            padding: 40px; 
            border-radius: 16px; 
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); 
        }

        h2 { margin-top: 0; font-size: 1.5rem; font-weight: 700; color: #0f172a; }
        p.subtitle { color: var(--text-muted); font-size: 0.9rem; margin-bottom: 25px; }

        /* Alertes */
        .alert { padding: 12px; border-radius: 8px; font-size: 0.9rem; margin-bottom: 20px; font-weight: 500; }
        .success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* Formulaire */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 6px; font-size: 0.85rem; font-weight: 600; color: #475569; }
        
        input { 
            width: 100%; 
            padding: 12px; 
            border: 1px solid var(--border); 
            border-radius: 10px; 
            box-sizing: border-box; 
            font-size: 0.95rem;
            transition: all 0.2s;
            background: #fdfdfd;
        }

        input:focus { 
            outline: none; 
            border-color: var(--primary); 
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1); 
            background: #fff;
        }

        /* Boutons */
        .btn { 
            width: 100%; 
            padding: 12px; 
            border: none; 
            border-radius: 10px; 
            font-size: 0.95rem; 
            font-weight: 600; 
            cursor: pointer; 
            transition: all 0.2s; 
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }

        .btn-update { background: var(--primary); color: white; margin-top: 10px; }
        .btn-update:hover { background: var(--primary-hover); transform: translateY(-1px); }

        .btn-delete { background: white; color: var(--danger); border: 1px solid var(--danger); margin-top: 15px; }
        .btn-delete:hover { background: #fef2f2; }

        /* Zone de danger */
        .danger-zone { 
            margin-top: 35px; 
            padding-top: 25px; 
            border-top: 1px solid var(--border); 
        }
        .danger-zone h3 { font-size: 1.1rem; color: var(--danger); margin-top: 0; }

        .back-link { 
            display: block; 
            text-align: center; 
            margin-top: 25px; 
            color: var(--text-muted); 
            text-decoration: none; 
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--primary); }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>Paramètres du compte</h2>
        <p class="subtitle">Gérez vos informations personnelles et la sécurité de votre compte.</p>
        
        <?php echo $message; ?>

        <?php if($user): ?>
            <form method="POST">
                <div class="form-group">
                    <label>Nom d'utilisateur</label>
                    <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom_user']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Adresse e-mail</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>

                <div class="form-group">
                    <label>Date de naissance</label>
                    <input type="date" name="date_n" value="<?php echo $user['date_de_naissance']; ?>">
                </div>

                <button type="submit" name="update_account" class="btn btn-update">Enregistrer les changements</button>
            </form>

            <div class="danger-zone">
                <h3>Zone sensible</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 15px;">
                    Une fois votre compte supprimé, il n'y a pas de retour en arrière. Soyez certain de votre choix.
                </p>
                <form method="POST" onsubmit="return confirm('❗ Attention : Cette action est irréversible. Voulez-vous vraiment supprimer votre compte ?');">
                    <button type="submit" name="delete_account" class="btn btn-delete">Supprimer mon compte</button>
                </form>
            </div>
        <?php else: ?>
            <div class="alert error">Utilisateur introuvable.</div>
        <?php endif; ?>

        <a href="index.php" class="back-link">← Retour à l'accueil</a>
    </div>
</div>

</body>
</html>