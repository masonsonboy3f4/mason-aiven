<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Log in</title>
    <link rel="stylesheet" href="<?= base_url('public/css/mint-turquoise.css') ?>">

    <style>
        :root {
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: #f5f5f5;
            color: #262626;
        }

        main {
            width: min(100% - 2rem, 420px);
            padding: 2rem;
            background: #fff;
            border: 1px solid #dedede;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
            box-sizing: border-box;
        }

        h1 {
            margin: 0 0 .5rem;
        }

        p {
            color: #737373;
        }

        label {
            display: block;
            margin: 1.25rem 0 .4rem;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: .8rem;
            box-sizing: border-box;
            border: 1px solid #cfcfcf;
            border-radius: 6px;
            background: #fff;
            color: #262626;
        }

        input:focus {
            outline: none;
            border-color: #262626;
        }

        button {
            width: 100%;
            margin-top: 1.5rem;
            padding: .8rem;
            border: 0;
            border-radius: 6px;
            background: #262626;
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }

        .errors {
            margin-bottom: 1rem;
            padding: .8rem 1rem;
            border: 1px solid #bdbdbd;
            border-radius: 6px;
            color: #4a4a4a;
            background: #f0f0f0;
        }

        .errors div {
            margin: .2rem 0;
        }
    </style>
</head>

<body class="login-page">

<main>

    <h1>Log in</h1>

    <?php if (!empty($errors)) : ?>

        <div class="errors" role="alert">

            <?php foreach ($errors as $error) : ?>

                <div>
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <!-- Send login form to UserController::authenticate() -->
    <form method="post" action="<?= site_url('login') ?>">

        <label for="username">
            Username
        </label>

        <input
            id="username"
            name="username"
            type="text"
            value="<?= htmlspecialchars($username ?? '', ENT_QUOTES, 'UTF-8') ?>"
            autocomplete="username"
            required
        >

        <label for="password">
            Password
        </label>

        <input
            id="password"
            name="password"
            type="password"
            autocomplete="current-password"
            required
        >

        <button type="submit">
            Log in
        </button>

    </form>

</main>

</body>
</html>
