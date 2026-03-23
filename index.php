<?php
session_start();
include("connect_db.php");

// Redirection si non connecté
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$user_nom = $_SESSION["user_nom"];

// --- TRAITEMENT : ENVOI D'UN MESSAGE ---
if (isset($_POST['post_message']) && !empty(trim($_POST['message_text']))) {
    $msg = htmlspecialchars($_POST['message_text']);
    $ins = $connexion->prepare("INSERT INTO messages (user_id, contenu, date_creation) VALUES (?, ?, NOW())");
    $ins->execute([$user_id, $msg]);
    header("Location: index.php"); // Rafraîchir pour éviter le renvoi du formulaire
    exit();
}

// --- TRAITEMENT : ENVOI D'UN COMMENTAIRE ---
if (isset($_POST['post_comment']) && !empty(trim($_POST['comment_text']))) {
    $comm = htmlspecialchars($_POST['comment_text']);
    $msg_id = intval($_POST['message_id']);
    $ins = $connexion->prepare("INSERT INTO commentaires (message_id, user_id, contenu, date_creation) VALUES (?, ?, ?, NOW())");
    $ins->execute([$msg_id, $user_id, $comm]);
    header("Location: index.php");
    exit();
}

// --- RÉCUPÉRATION DES MESSAGES ---
$msgs = $connexion->query("SELECT m.*, u.nom_user FROM messages m JOIN t_utilisateurs u ON m.user_id = u.id ORDER BY m.date_creation DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum | Accueil</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; margin: 0; padding: 20px; color: #1c1e21; }
        .container { max-width: 700px; margin: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 25px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        
        /* Formulaire de publication */
        .post-card, .message-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        textarea { width: 100%; border: 1px solid #ddd; border-radius: 8px; padding: 10px; resize: none; font-size: 1rem; box-sizing: border-box; }
        button { background: #1877f2; color: white; border: none; padding: 10px 20px; border-radius: 6px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        button:hover { background: #166fe5; }

        /* Style des messages */
        .author { font-weight: bold; color: #1877f2; }
        .date { font-size: 0.8rem; color: #65676b; }
        .content { margin: 15px 0; font-size: 1.1rem; line-height: 1.4; }

        /* Commentaires */
        .comments-section { border-top: 1px solid #eee; padding-top: 15px; margin-top: 15px; }
        .comment { background: #f0f2f5; padding: 10px; border-radius: 12px; margin-bottom: 8px; font-size: 0.9rem; }
        .comment-form { display: flex; gap: 10px; margin-top: 10px; }
        .comment-input { padding: 8px; border-radius: 20px; flex-grow: 1; border: 1px solid #ddd; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Minichat</h2>
        <span>👤 <?php echo htmlspecialchars($user_nom); ?> | <a href="deconnexion.php" style="color:red; text-decoration:none;">Quitter</a></span>
    </div>

    <div class="post-card">
        <form method="POST">
            <textarea name="message_text" rows="3" placeholder="Quoi de neuf, <?php echo htmlspecialchars($user_nom); ?> ?" required></textarea>
            <button type="submit" name="post_message">Publier</button>
        </form>
    </div>

    <?php while($m = $msgs->fetch()): ?>
        <div class="message-card">
            <span class="author"><?php echo htmlspecialchars($m['nom_user']); ?></span>
            <div class="date">le <?php echo date('d/m à H:i', strtotime($m['date_creation'])); ?></div>
            <div class="content"><?php echo nl2br(htmlspecialchars($m['contenu'])); ?></div>

            <div class="comments-section">
                <?php
                // Récupérer les commentaires du message
                $com_req = $connexion->prepare("SELECT c.*, u.nom_user FROM commentaires c JOIN t_utilisateurs u ON c.user_id = u.id WHERE c.message_id = ? ORDER BY c.date_creation ASC");
                $com_req->execute([$m['id']]);
                while($c = $com_req->fetch()):
                ?>
                    <div class="comment">
                        <strong><?php echo htmlspecialchars($c['nom_user']); ?> :</strong> 
                        <?php echo htmlspecialchars($c['contenu']); ?>
                    </div>
                <?php endwhile; ?>

                <form class="comment-form" method="POST">
                    <input type="hidden" name="message_id" value="<?php echo $m['id']; ?>">
                    <input type="text" name="comment_text" class="comment-input" placeholder="Écrire un commentaire..." required>
                    <button type="submit" name="post_comment" style="margin:0; padding:5px 15px;">Commenter</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>