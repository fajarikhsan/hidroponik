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
                <th>Suhu</th>
                <th>Jarak Air</th>
                <th>Lampu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="suhu_cont"></td>
                <td id="jarak_cont"></td>
                <td id="lampu_cont"></td>
            </tr>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function get_data() {
            $.ajax({
                url: '<?= base_url('public/home/get_data'); ?>',
                dataType: 'json',
                success: function(data) {
                    $('#suhu_cont').text(data.suhu);
                    $('#jarak_cont').text(data.jarak_air);
                    $('#lampu_cont').text(data.lampu);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            get_data();
            setInterval(function() {
                get_data();
            }, 1000);
        });
    </script>
</body>

</html>