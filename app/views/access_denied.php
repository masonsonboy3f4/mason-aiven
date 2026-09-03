<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied | Student Portal</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background:
                radial-gradient(circle at top left, #1e40af 0%, transparent 35%),
                radial-gradient(circle at bottom right, #312e81 0%, transparent 35%),
                #0f172a;
            padding: 20px;
            color: #f8fafc;
        }

        .container {
            width: 100%;
            max-width: 480px;
            padding: 45px 35px;
            text-align: center;

            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.35),
                inset 0 1px 1px rgba(255, 255, 255, 0.08);
        }

        .icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;
            font-size: 40px;

            background: linear-gradient(
                135deg,
                rgba(59, 130, 246, 0.25),
                rgba(99, 102, 241, 0.15)
            );

            border: 1px solid rgba(96, 165, 250, 0.35);

            box-shadow:
                0 0 30px rgba(59, 130, 246, 0.25);
        }

        h1 {
            font-size: 32px;
            margin-bottom: 12px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .subtitle {
            color: #cbd5e1;
            line-height: 1.7;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .notice {
            text-align: left;
            padding: 18px;
            margin-bottom: 28px;

            background: rgba(15, 23, 42, 0.55);
            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 14px;

            color: #cbd5e1;
            line-height: 1.6;
            font-size: 14px;
        }

        .notice strong {
            display: block;
            color: #93c5fd;
            margin-bottom: 4px;
            font-size: 15px;
        }

        .button {
            display: inline-block;
            padding: 13px 28px;

            background: linear-gradient(
                135deg,
                #2563eb,
                #4f46e5
            );

            color: white;
            text-decoration: none;
            border-radius: 10px;

            font-weight: bold;
            font-size: 14px;

            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);

            transition: 0.3s ease;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.45);
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #64748b;
            letter-spacing: 0.5px;
        }

        @media (max-width: 500px) {
            .container {
                padding: 35px 25px;
            }

            h1 {
                font-size: 27px;
            }

            .icon {
                width: 75px;
                height: 75px;
                font-size: 34px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="icon">
            🔒
        </div>

        <h1>Access Denied</h1>

        <p class="subtitle">
            You currently don't have permission to access
            the Student Profile.
        </p>

        <div class="notice">
            <strong>🔐 Student Profile Restricted</strong>
            Please contact the administrator if you believe
            you should have access to this page.
        </div>

        <a href="<?= site_url('student') ?>" class="button">
            ← Back to Student Page
        </a>

        <div class="footer">
            STUDENT PORTAL • SECURE ACCESS
        </div>

    </div>

</body>
</html>