<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin xem nhiều</title>
    <style>
        #tinxemnhieu {
            width: 300px;
            margin: 20px auto;
            border: 1px solid #ccc;
        }

        #tinxemnhieu h2 {
            background-color: rgb(44, 97, 97);
            color: white;
            margin: 0;
            padding: 10px;
            text-align: center;
        }

        #tinxemnhieu p {
            margin: 0;
            padding: 8px 15px;
        }

        #tinxemnhieu a {
            text-decoration: none;
            color: blue;
        }

        #tinxemnhieu a:hover {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    $listtin = [
        ['https://longnv.name.vn/featured/su-dung-sse-trong-php', 'Sử dụng SSE trong PHP'],
        ['https://longnv.name.vn/featured/phalcon-la-gi', 'Phalcon là gì'],
        ['http://songdep.xitrum.net/trenon/547.html', 'Bên có bao nhiêu người bạn?'],
        ['http://songdep.xitrum.net/nghethuatsong/876.html', 'Bài học từ loài ngỗng'],
        ['http://songdep.xitrum.net/nghethuatsong/872.html', 'Đừng hãm xuyên qua trái tim'],
        ['http://songdep.xitrum.net/ngungon/673.html', 'Tham ăn']
    ];
    ?>
    <div id="tinxemnhieu">
        <h2>Tin xem nhiều</h2>
        <?php
        $i = 0;
        while ($i < count($listtin)) { // Dùng { thay vì (
            $tin = $listtin[$i];
        ?>
            <p><a href="<?= $tin[0]; ?>"><?= $tin[1]; ?></a></p>
        <?php
            $i++;
        }
        ?>
    </div>

</body>

</html>