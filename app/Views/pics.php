<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1">
        <thead>
            <tr>
                <th>foto</th>
                <th>status_tanaman</th>
                <th>tomat</th>
                <th>bunga</th>
                <th>created_at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $d) : ?>
                <tr>
                    <td><img src="/foto/<?= $d['file_name']; ?>" alt="" width="50%"></td>
                    <td><?= $d['status_tanaman'] ?></td>
                    <td><?= $d['tomat'] ?></td>
                    <td><?= $d['bunga'] ?></td>
                    <td><?= $d['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>