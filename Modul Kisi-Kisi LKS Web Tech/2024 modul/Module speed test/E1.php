<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Answer Comparison</title>
  <style>
    table {
      width: 50%;
      border-collapse: collapse;
      margin: 20px 0;
    }

    th,
    td {
      border: 1px solid black;
      padding: 8px;
      text-align: center;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>

  <h2>Comparison Table</h2>

  <?php
  // Baca file CSV
  $actualFile = __DIR__ . '/E1 csv/actualAnswers.csv';
  $submittedFile = __DIR__ . '/E1 csv/submittedAnswers.csv';


  $actualAnswers = [];
  $submittedAnswers = [];

  // Baca actual answers
  if (($handle = fopen($actualFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if (!empty($data[0])) { // Pastikan tidak ada baris kosong
        $actualAnswers[] = trim($data[0]); // Simpan setiap jawaban
      }
    }
    fclose($handle);
  }

  // Baca submitted answers
  if (($handle = fopen($submittedFile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      if (!empty($data[0])) {
        $submittedAnswers[] = trim($data[0]);
      }
    }
    fclose($handle);
  }

  // Hitung skor
  $totalQuestions = count($actualAnswers);
  $correctAnswers = 0;

  echo "<table>";
  echo "<tr><th>Question No</th><th>Actual Answer</th><th>Submitted Answer</th></tr>";

  foreach ($actualAnswers as $questionNo => $answer) {
    $submittedAnswer = $submittedAnswers[$questionNo] ?? '-'; // Cek jika jawaban ada
    $isCorrect = ($answer === $submittedAnswer);

    // Hitung skor
    if ($isCorrect) {
      $correctAnswers++;
    }

    echo "<tr>";
    echo "<td>$questionNo</td>";
    echo "<td>$answer</td>";
    echo "<td " . ($isCorrect ? "style='color:green;'" : "style='color:red;'") . ">$submittedAnswer</td>";
    echo "</tr>";
  }

  echo "</table>";

  // Tampilkan skor
  echo "<h3>Score: $correctAnswers / $totalQuestions</h3>";
  ?>

</body>

</html>