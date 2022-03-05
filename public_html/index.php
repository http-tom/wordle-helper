<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordleHelper</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>WordleHelper</h1>
    <form method="post" action="wordle.php" id="frmAjaxHelper">
        <h4>Include Characters</h4>
        <input type="text" class="frm-control" name="include[]" maxlength="4" size="5"> <button type="button" id="addInclude" class="btn">+</button>
        <h4>Exclude Characters</h4>
        <input type="text" class="frm-control" name="exclude[]" maxlength="24" size="5"> <button type="button" id="addExclude" class="btn">+</button>
        <div>
            <input type="submit" value="Go" class="btn m1">
        </div>

        <div id="results"></div>
        <div id="suggestions"></div>
    </form>
<script type="text/javascript" src="app.js"></script>
</body>
</html>