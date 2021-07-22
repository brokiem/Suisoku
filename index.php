<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Suisoku</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/sweetalert2.js"></script>

    <script>
        function clickEvent(question, answer) {
            if (question === answer) {
                clearInterval(interval);
                if (timeout != null) {
                    clearTimeout(timeout);
                }
                Swal.fire(
                    'Good job!',
                    'You are right!',
                    'success'
                ).then(() => {
                    window.location.reload();
                })
            } else {
                Swal.fire(
                    'Try again!',
                    'You are wrong!',
                    'error'
                )
            }
        }
    </script>
</head>

<body>
<?php
$array = ['+', '-', '*', '/'];
$math = $array[array_rand($array)];

$nom1 = mt_rand(0, 1000);
$nom2 = mt_rand(1, mt_rand(10, 40));

if ($math === "*") {
    $nom1 = mt_rand(0, 100);
    $nom2 = mt_rand(1, 10);
} elseif ($math === "/") {
    $nom2 = mt_rand(1, 5);
}
?>
<br><br><br><br>
<div class="container">
    <div class="progress">
        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="0"
             aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div id="question" class="shadow p-3 mb-5 card mb-3 card-bg-dark text-center">
        <div class="card-body rounded">
            <h3 class="card-title"><?php echo $nom1 . " $math " . $nom2 ?></h3>
        </div>
    </div>
    <br><br><br>
    <div id="answers" class="text-center">
        <?php
        $question = match ($math) {
            "+" => $nom1 + $nom2,
            "-" => $nom1 - $nom2,
            "*" => $nom1 * $nom2,
            "/" => (int)$nom1 / $nom2
        };

        $answers = [];
        $answers[0] = $question;
        $answers[1] = $nom1 + mt_rand(1, 10) + $nom2;
        $answers[2] = $nom1 + mt_rand(5, 8) + $nom2 + mt_rand(0, 2);
        $answers[3] = $nom1 + $nom2 - mt_rand(1, 15);

        shuffle($answers);

        echo '<div class="card shadow p-3 mb-5 card mb-3 card-bg-dark text-center rounded d-grid gap-2 mx-auto">';
        foreach ($answers as $key => $answer) {
            echo '<button id="' . $key . '" onclick="clickEvent(' . $question . ', ' . $answer . ')" type="button" class="btn btn-lg btn-primary" style="margin-left: 2em; margin-right: 2em;">' . $answer . '</button>';
        }
        echo '</div>';
        ?>
    </div>
</div>

<script>
    let i = 0;
    let timeout = null;
    const interval = setInterval(function () {
        document.getElementById('progress-bar').style.width = i + '%';
        i += 10;

        if (i === 110) {
            timeout = setTimeout(function () {
                Swal.fire(
                    "Time's up!",
                    'You\'re out of time!',
                    'error'
                ).then(() => {
                    window.location.reload();
                })
            }, 300);
        }

        if (i > 100) {
            clearInterval(interval);
        }
    }, 1000);
</script>
</body>

</html>