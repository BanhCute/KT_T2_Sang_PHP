<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        .header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
        }

        .content {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .box {
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 48%;
        }
    </style>
</head>

<body>
    <div class="header">Welcome to My Website</div>
    <div class="container">
        <div class="content">
            <div class="box">
                <?php require_once "lienketwebsite.php"; ?>
            </div>
            <div class="box">
                <?php require_once "tinxemnhieu.php"; ?>
            </div>
        </div>
    </div>
</body>

</html>