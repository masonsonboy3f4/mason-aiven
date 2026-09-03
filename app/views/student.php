<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zean's Student Space</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            color: #f8fafc;

            background:
                radial-gradient(circle at top left, #1e40af 0%, transparent 30%),
                radial-gradient(circle at bottom right, #312e81 0%, transparent 30%),
                #0f172a;
        }

        /* NAVBAR */
        .navbar {
            width: 100%;
            padding: 18px 8%;

            display: flex;
            align-items: center;
            justify-content: space-between;

            background: rgba(15, 23, 42, 0.75);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);

            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
        }

        .brand {
            font-size: 19px;
            font-weight: bold;
            color: #93c5fd;
            letter-spacing: 0.5px;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .navbar a {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #60a5fa;
        }

        /* HERO */
        .hero {
            position: relative;
            overflow: hidden;

            width: 90%;
            max-width: 850px;

            margin: 80px auto;
            padding: 70px 35px;

            text-align: center;

            background:
                linear-gradient(
                    135deg,
                    rgba(37, 99, 235, 0.30),
                    rgba(79, 70, 229, 0.20)
                );

            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 28px;

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.30);
        }

        .hero::before {
            content: "";
            position: absolute;

            width: 220px;
            height: 220px;

            top: -100px;
            right: -70px;

            background: rgba(96, 165, 250, 0.15);
            border-radius: 50%;
        }

        .hero::after {
            content: "";
            position: absolute;

            width: 180px;
            height: 180px;

            bottom: -90px;
            left: -60px;

            background: rgba(99, 102, 241, 0.12);
            border-radius: 50%;
        }

        /* AVATAR */
        .avatar {
            position: relative;

            width: 105px;
            height: 105px;

            margin: 0 auto 25px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #4f46e5
                );

            color: white;

            font-size: 36px;
            font-weight: bold;

            border: 4px solid rgba(255, 255, 255, 0.12);

            box-shadow:
                0 0 40px rgba(59, 130, 246, 0.40);
        }

        /* TITLE */
        h1 {
            position: relative;

            margin-bottom: 15px;

            color: white;
            font-size: 34px;
            line-height: 1.2;
        }

        .highlight {
            color: #60a5fa;
        }

        /* SUBTITLE */
        .subtitle {
            position: relative;

            max-width: 620px;
            margin: 0 auto;

            color: #cbd5e1;

            font-size: 16px;
            line-height: 1.8;
        }

        /* BUTTON */
        .button {
            position: relative;

            display: inline-block;

            margin-top: 30px;
            padding: 14px 28px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #4f46e5
                );

            color: white;
            text-decoration: none;

            border-radius: 11px;

            font-weight: bold;
            font-size: 14px;

            box-shadow:
                0 10px 25px rgba(37, 99, 235, 0.30);

            transition: 0.3s ease;
        }

        .button:hover {
            transform: translateY(-3px);

            box-shadow:
                0 15px 30px rgba(37, 99, 235, 0.45);
        }

        /* FOOTER */
        .footer {
            text-align: center;

            padding: 25px;

            color: #64748b;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        /* MOBILE */
        @media (max-width: 600px) {

            .navbar {
                padding: 16px 5%;
                flex-direction: column;
                gap: 12px;
            }

            .nav-links {
                gap: 18px;
            }

            .hero {
                width: 94%;
                margin: 55px auto;
                padding: 50px 22px;
            }

            .avatar {
                width: 85px;
                height: 85px;
                font-size: 30px;
            }

            h1 {
                font-size: 27px;
            }

            .subtitle {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<!-- NAVIGATION -->
<div class="navbar">

    <div class="brand">
        STUDENT PORTAL
    </div>

    <div class="nav-links">

        <a href="<?= site_url('student'); ?>">
            Home
        </a>

        <a href="<?= site_url('student/profile'); ?>">
            Student Profile
        </a>

    </div>

</div>

<!-- HERO -->
<div class="hero">

    <div class="avatar">
        SM
    </div>

    <h1>
        Welcome to <span class="highlight">sonboy</span><br>
        Student Space
    </h1>

    <p class="subtitle">
        A personal student information page built with LavaLust.
        Get to know me, my studies, skills, hobbies, and interests.
    </p>

    <a class="button" href="<?= site_url('student/profile'); ?>">
        Explore My Profile →
    </a>

</div>

<!-- FOOTER -->
<div class="footer">
    SONBOY STUDENT SPACE • BUILT WITH LAVALUST
</div>

</body>
</html>