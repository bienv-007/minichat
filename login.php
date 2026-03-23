<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Espace Membre</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0f172a;
            --card-bg: #1e293b;
            --accent-color: #38bdf8;
            --text-main: #f8fafc;
            --input-bg: #334155;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f0f0;
            /* color: var(--text-main); */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-weight: 600;
            font-size: 1.75rem;
            text-align: center;
            /* background: linear-gradient(to right, #38bdf8, #818cf8); */
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: #94a3b8;
        }

        input {
            width: 100%;
            padding: 0.75rem 1rem;
            /* background: var(--input-bg); */
            border: 1px solid #475569;
            border-radius: 0.75rem;
            color: white;
            font-size: 1rem;
            transition: all 0.2s ease;
            box-sizing: border-box; /* Important pour que le padding ne dépasse pas */
        }

        input:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }

        button {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            background-color: black;
            color: #0f172a;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            color: white;
        }

        button:hover {
            background-color: #7dd3fc;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Connexion</h2>
        <form action="login_traitement.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Votre pseudo" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>

</body>
</html>