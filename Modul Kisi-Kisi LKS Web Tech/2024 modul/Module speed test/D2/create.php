<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    include "./test_php_doc.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $desc = nl2br($_POST['description']);

        $htmlContent = "<h1>$title</h1><p>$desc</p>";

        $htd = new HTML_TO_DOC();

        $htd->createDoc($htmlContent, "$title.doc", true);
    }
    ?>
</body>

</html>