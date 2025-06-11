<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Ticket System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .welcome-box {
            max-width: 500px;
            margin: 10% auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            text-align: center;
        }
        .welcome-box h1 {
            margin-bottom: 20px;
            color: #343a40;
        }
        .btn-custom {
            width: 100%;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="welcome-box">
        <h1>Welcome to Support Desk</h1>
        <p class="text-muted mb-4">Please choose an option below to get started.</p>
        <a href="/admin/login" class="btn btn-primary btn-custom">Admin Login</a>
        <a href="/ticket/create" class="btn btn-success btn-custom">Create a Support Ticket</a>
    </div>
</div>

</body>
</html>
