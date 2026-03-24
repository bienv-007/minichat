<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6e8efb;
            --secondary-color: #a777e3;
            --text-color: #333;
            --glass-bg: rgba(255, 255, 255, 0.9);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f0f0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        .container {
            background: var(--glass-bg);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(10px);
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 0.9rem;
            margin-bottom: 8px;
            color: #666;
            font-weight: 400;
        }

        input, select {
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
            font-size: 1rem;
            background: #f9f9f9;
        }

        input:focus, select:focus {
            border-color: var(--primary-color);
            background: #fff;
            box-shadow: 0 0 8px rgba(110, 142, 251, 0.3);
        }

        button {
            width: 100%;
            padding: 15px;
            background: black;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(167, 119, 227, 0.4);
        }

        button:active {
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Inscription</h2>
    <form action="sign_in_traitement.php" method="post">
        
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" placeholder="Ex: JeanDupont" required>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="exemple@mail.com" required>
        </div>

        <div class="form-group">
            <label for="date_de_naissance">Date de naissance</label>
            <input type="date" id="date_de_naissance" name="date_de_naissance" required>
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <select id="genre" name="genre" required>
                <option value="" disabled selected>Choisir...</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nationalite">Nationalité</label>
            <input type="text" id="nationalite" name="nationalite" placeholder="Française" required>
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" placeholder="06 00 00 00 00" required>
        </div>

        <button type="submit">Creer le compte</button><br>
        <p class="footer-text">Vous avez déjà un compte ? <a href="login.php" style="color: #38bdf8; text-decoration:none;">Connectez-vous</a></p>
    </form>
</div>

</body>
</html>