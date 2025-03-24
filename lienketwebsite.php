<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên kết website</title>
    <style>
        #lienketwebsite {
            width: 300px;
            margin: 20px auto;
            border: 1px solid #ccc;
        }

        #lienketwebsite h2 {
            background-color: rgb(44, 97, 97);
            color: white;
            margin: 0;
            padding: 10px;
            text-align: center;
        }

        #lienketwebsite select {
            width: 90%;
            margin: 10px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    $links = [
        ['http://google.com', 'Google'],
        ['http://w3schools.com', 'W3Schools'],
        ['https://longnv.name.vn', 'Thuy Long Web'],
        ['http://vnexpress.net', 'VnExpress'],
        ['http://tuoitre.vn', 'Tuổi Trẻ'],
        ['http://thanhnien.vn', 'Thanh Niên']
    ];
    ?>

    <div id="lienketwebsite">
        <h2>Liên kết website</h2>
        <select onchange="window.open(this.value)">
            <?php foreach ($links as $link) { ?>
                <option value="<?= $link[0]; ?>" <?= $link[1] == 'W3Schools' ? 'selected' : ''; ?>>
                    <?= $link[1]; ?>
                </option>
            <?php } ?>
        </select>
    </div>

</body>

</html>