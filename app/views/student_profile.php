<?php
declare(strict_types=1);

$student_id = $student_id ?? '';
$name = $name ?? '';
$course = $course ?? '';
$year = $year ?? '';
$section = $section ?? '';
$email = $email ?? '';
$contact = $contact ?? '';
$address = $address ?? '';
$skills = $skills ?? '';
$hobbies = $hobbies ?? '';
$description = $description ?? '';
$facebook = $facebook ?? '';
$github = $github ?? '';

function e(string|int|float|null $value): string
{
    return htmlspecialchars(
        (string)($value ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= e($name ?: 'Student') ?> | Student Profile</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background:
                radial-gradient(circle at top left, #1e40af 0%, transparent 30%),
                radial-gradient(circle at bottom right, #312e81 0%, transparent 30%),
                #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            padding-bottom: 50px;
        }

        .navbar {
            width: 100%;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 23, 42, 0.75);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
        }

        .brand {
            font-size: 19px;
            font-weight: bold;
            color: #93c5fd;
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

        .profile {
            width: 90%;
            max-width: 850px;
            margin: 45px auto;
        }

        .header-card {
            position: relative;
            overflow: hidden;
            padding: 50px 30px;
            text-align: center;

            background:
                linear-gradient(
                    135deg,
                    rgba(37, 99, 235, 0.35),
                    rgba(79, 70, 229, 0.25)
                );

            border: 1px solid rgba(147, 197, 253, 0.15);
            border-radius: 25px;
            backdrop-filter: blur(15px);

            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.25);
        }

        .header-card::before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            background: rgba(96, 165, 250, 0.15);
            border-radius: 50%;
            top: -80px;
            right: -50px;
        }

        .avatar {
            position: relative;
            width: 100px;
            height: 100px;
            margin: auto;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #2563eb,
                #4f46e5
            );

            color: white;
            font-size: 34px;
            font-weight: bold;

            border: 4px solid rgba(255, 255, 255, 0.15);

            box-shadow:
                0 0 35px rgba(59, 130, 246, 0.35);
        }

        h1 {
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 30px;
            color: white;
        }

        .card {
            margin-top: 22px;
            padding: 28px;

            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 20px;

            backdrop-filter: blur(15px);

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.18);

            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            border-color: rgba(96, 165, 250, 0.25);
        }

        .card h2 {
            margin-bottom: 20px;
            font-size: 19px;
            color: #93c5fd;

            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card h2::before {
            content: "";
            width: 4px;
            height: 20px;
            background: #3b82f6;
            border-radius: 5px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            gap: 20px;

            padding: 14px 0;

            border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        }

        .info:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: bold;
            color: #cbd5e1;
            font-size: 14px;
        }

        .value {
            text-align: right;
            color: #94a3b8;
            font-size: 14px;
            max-width: 60%;
            word-break: break-word;
        }

        .about {
            line-height: 1.8;
            color: #94a3b8;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .social-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .social-links a {
            padding: 12px 20px;

            background: rgba(59, 130, 246, 0.12);
            border: 1px solid rgba(96, 165, 250, 0.15);

            color: #93c5fd;
            text-decoration: none;

            border-radius: 10px;
            font-weight: bold;
            font-size: 14px;

            transition: 0.3s;
        }

        .social-links a:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        .back-button {
            display: block;
            width: fit-content;

            margin: 30px auto 0;
            padding: 13px 25px;

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

            transition: 0.3s;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(37, 99, 235, 0.45);
        }

        @media (max-width: 600px) {

            .navbar {
                padding: 16px 5%;
                flex-direction: column;
                gap: 12px;
            }

            .nav-links {
                gap: 18px;
            }

            .profile {
                width: 94%;
                margin-top: 30px;
            }

            .header-card {
                padding: 40px 20px;
            }

            h1 {
                font-size: 25px;
            }

            .card {
                padding: 22px;
            }

            .info {
                flex-direction: column;
                gap: 5px;
            }

            .value {
                text-align: left;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="navbar">

    <div class="brand">
        STUDENT PORTAL
    </div>

    <div class="nav-links">
        <a href="<?= site_url('student'); ?>">
            Home
        </a>

        <a href="<?= site_url('student/profile'); ?>">
            Profile
        </a>
    </div>

</div>

<div class="profile">

    <!-- PROFILE HEADER -->
    <div class="header-card">

        <div class="avatar">
            SM
        </div>

        <h1>
            <?= e($name ?: 'Student Name') ?>
        </h1>

    </div>

    <!-- PERSONAL INFORMATION -->
    <div class="card">

        <h2>Personal Information</h2>

        <div class="info">
            <span class="label">Student ID</span>
            <span class="value"><?= e($student_id) ?></span>
        </div>

        <div class="info">
            <span class="label">Student Name</span>
            <span class="value"><?= e($name) ?></span>
        </div>

        <div class="info">
            <span class="label">Course</span>
            <span class="value"><?= e($course) ?></span>
        </div>

        <div class="info">
            <span class="label">Year Level</span>
            <span class="value"><?= e($year) ?></span>
        </div>

        <div class="info">
            <span class="label">Section</span>
            <span class="value"><?= e($section) ?></span>
        </div>

        <div class="info">
            <span class="label">Email</span>
            <span class="value"><?= e($email) ?></span>
        </div>

        <div class="info">
            <span class="label">Contact Number</span>
            <span class="value"><?= e($contact) ?></span>
        </div>

        <div class="info">
            <span class="label">Address</span>
            <span class="value"><?= e($address) ?></span>
        </div>

    </div>

    <!-- ABOUT ME -->
    <div class="card">

        <h2>About Me</h2>

        <p class="about">
            <?= e($description) ?>
        </p>

        <div class="info">
            <span class="label">Skills</span>
            <span class="value"><?= e($skills) ?></span>
        </div>

        <div class="info">
            <span class="label">Hobbies</span>
            <span class="value"><?= e($hobbies) ?></span>
        </div>

    </div>

    <!-- SOCIAL MEDIA -->
    <div class="card">

        <h2>Social Media</h2>

        <div class="social-links">

            <?php if (!empty($facebook)): ?>
                <a href="<?= e($facebook) ?>" target="_blank" rel="noopener noreferrer">
                    Facebook
                </a>
            <?php endif; ?>

            <?php if (!empty($github)): ?>
                <a href="<?= e($github) ?>" target="_blank" rel="noopener noreferrer">
                    GitHub
                </a>
            <?php endif; ?>

        </div>

    </div>

    <!-- BACK BUTTON -->
    <a class="back-button" href="<?= site_url('student'); ?>">
        ← Back to Student Hub
    </a>

</div>

</body>
</html>