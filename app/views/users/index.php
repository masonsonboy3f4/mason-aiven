<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Management Module</title>
<link rel="stylesheet" href="<?= base_url('public/css/mint-turquoise.css') ?>">

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f8fafc;
    padding:40px 20px;
    color:#1e293b;
}

/* Container */
.container{
    max-width:1100px;
    margin:auto;
}

/* Header */
.header{
    background:linear-gradient(
        135deg,
        #2563eb,
        #7c3aed
    );
    color:white;
    padding:35px;
    border-radius:20px;
    margin-bottom:25px;
    box-shadow:0 15px 30px rgba(0,0,0,.15);
}

.header h1{
    font-size:2rem;
    margin-bottom:8px;
}

.header p{
    opacity:.9;
}

/* Stats Card */
.stats{
    background:white;
    border-radius:18px;
    padding:25px;
    margin-bottom:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.08);
}

.stats-label{
    color:#64748b;
    font-size:14px;
}

.stats-number{
    font-size:2rem;
    color:#2563eb;
    font-weight:bold;
    margin-top:5px;
}

/* Table Card */
.table-card{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
}

thead{
    background:#f1f5f9;
}

th{
    padding:18px;
    text-align:left;
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#64748b;
}

td{
    padding:18px;
    border-top:1px solid #e2e8f0;
}

tbody tr{
    transition:.25s;
}

tbody tr:hover{
    background:#f8fafc;
}

/* ID Badge */
.badge{
    background:#dbeafe;
    color:#2563eb;
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

/* Username */
.username{
    color:#2563eb;
    font-weight:600;
}

/* Empty State */
.empty{
    text-align:center;
    padding:60px;
    color:#64748b;
}

.empty-icon{
    font-size:50px;
    margin-bottom:10px;
}

/* Responsive */
@media(max-width:768px){

    body{
        padding:20px 10px;
    }

    .header{
        padding:25px;
    }

    .header h1{
        font-size:1.5rem;
    }

    .table-card{
        overflow-x:auto;
    }

    table{
        min-width:700px;
    }
}
</style>
</head>
<body class="users-page">

<div class="container">

    <!-- Header -->
    <div class="header">
        <h1>👥 User Management</h1>
        <p>Manage and view registered users in the system.</p>
    </div>

    <!-- Statistics -->
    <div class="stats">
        <div class="stats-label">Registered Users</div>
        <div class="stats-number">
            <?= !empty($users) ? count($users) : 0 ?>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
            </thead>

            <tbody>

                <?php if (!empty($users)) : ?>

                    <?php foreach ($users as $user) : ?>

                        <?php
                        $user_id = is_object($user) ? ($user->id ?? '') : ($user['id'] ?? '');
                        $firstname = is_object($user) ? ($user->firstname ?? '') : ($user['firstname'] ?? '');
                        $lastname = is_object($user) ? ($user->lastname ?? '') : ($user['lastname'] ?? '');
                        $email = is_object($user) ? ($user->email ?? '') : ($user['email'] ?? '');
                        $username = is_object($user) ? ($user->username ?? '') : ($user['username'] ?? '');
                        ?>

                        <tr>

                            <td>
                                <span class="badge">
                                    #<?= htmlspecialchars($user_id) ?>
                                </span>
                            </td>

                            <td>
                                <?= htmlspecialchars($firstname) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($lastname) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($email) ?>
                            </td>

                            <td>
                                <span class="username">
                                    @<?= htmlspecialchars($username) ?>
                                </span>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else : ?>

                    <tr>
                        <td colspan="5" class="empty">

                            <div class="empty-icon">
                                👤
                            </div>

                            <strong>No Users Found</strong>
                            <br>
                            There are currently no registered users.

                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>