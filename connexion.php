<?php
session_start();
include 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    $sql = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $sql->execute([$email]);
    $user = $sql->fetch();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];

        header("Location: index.php");
        exit();
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>Connexion</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #000;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header-logo{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .header-logo-image {
            max-height: 75px;
            width: auto;
        }

        .header-logo-texte {
            font-size: 2em;
            font-weight: 700;
        }

        .box {
            background: #141414;
            padding: 30px;
            border-radius: 20px;
            width: 350px;
        }

        input {
            width: 300px;
            margin: 6px 0;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
        }

        button {
            font-family: 'Inter', sans-serif;
            margin-top: 30px;
            width: 300px;
            padding: 12px 0;
            background: #62A65D;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
        }

        .message {
            color: red;
        }

        a {
            color: #62A65D;
        }
    </style>
</head>
<body>

<div class="header-logo">
    <img src="logo.webp" class="header-logo-image">
    <p class="header-logo-texte">Vive</p>
</div>

<div class="box">
    <h1>Connexion</h1>

    <?php if($message != "") { ?>
        <p class="message"><?= $message ?></p>
    <?php } ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore de compte ? <a href="inscription.php">S'inscrire</a></p>
</div>

</body>
</html>