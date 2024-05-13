<?php

var_dump($finaldata);
$prettyData = json_encode($finaldata, JSON_PRETTY_PRINT);

// Output the formatted JSON
echo '<pre>' . $prettyData . '</pre>';

// Assuming $data is your multidimensional array


echo '<table border="1">';
foreach ($finaldata as $key => $value) {
    echo '<tr>';
    echo '<td>' . $key . '</td>';
    echo '<td>';
    if (is_array($value)) {
        echo '<table border="1">';
        foreach ($value as $subKey => $subValue) {
            echo '<tr>';
            echo '<td>' . $subKey . '</td>';
            echo '<td>';
            if (is_array($subValue)) {
                echo '<pre>' . print_r($subValue, true) . '</pre>';
            } else {
                echo $subValue;
            }
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo $value;
    }
    echo '</td>';
    echo '</tr>';
}
echo '</table>';



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<br>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">wind speed</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">wind detail</h6>

        <p class="card-text"><?php echo $finaldata['wind']['speed']; ?></p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

