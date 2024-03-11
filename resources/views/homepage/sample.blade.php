<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Menu Dropdown</title>
    <!-- Add the Material Icons stylesheet link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        /* Add any additional styles here */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .profile-menu {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .profile-menu-content {
            display: none;
            position: absolute;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            min-width: 160px;
            z-index: 1;
        }

        .profile-menu-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .profile-menu:hover .profile-menu-content {
            display: block;
        }
    </style>
</head>
<body>

    <div class="profile-menu">
        <span class="material-icons-outlined">account_circle</span>
        <div class="profile-menu-content">
            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <a href="#">Logout</a>
        </div>
    </div>

</body>
</html>