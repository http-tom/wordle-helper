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
    <button role="button" class="btn rounded toggler" data-toggle="help-description"><h3 class="m0 p0">?</h3></button>
    <div id="help-description" class="hidden">
        <h4>A Wordle helper.</h4>
        <p>Enter no characters into the boxes to get a random suggestion (starting word).<br/>Use the boxes to enter a character or group of characters. Use the 'Easy Mode' to specify where the characters are placed in the word.</p>
    </div>
    <form method="post" action="wordle.php" id="frmAjaxHelper">
        <h4>Include Characters</h4>
        <input type="text" name="include[]" maxlength="4" size="5" class="frm-control" autocomplete="off"> <button type="button" id="addInclude" class="btn">+</button>
        <h4>Exclude Characters</h4>
        <input type="text" name="exclude[]" maxlength="24" size="5" class="frm-control" autocomplete="off"> <button type="button" id="addExclude" class="btn">+</button>

        <div class="mt-1">
            <h4>Easy Mode</h4>
            <input type="text" name="template_1" maxlength="1" size="1" class="frm-control" autocomplete="off">
            <input type="text" name="template_2" maxlength="1" size="1" class="frm-control" autocomplete="off">
            <input type="text" name="template_3" maxlength="1" size="1" class="frm-control" autocomplete="off">
            <input type="text" name="template_4" maxlength="1" size="1" class="frm-control" autocomplete="off">
            <input type="text" name="template_5" maxlength="1" size="1" class="frm-control" autocomplete="off">
        </div>

        <div>
            <input type="submit" value="Go" class="btn m1">
        </div>

        <div id="results"></div>
        <div id="suggestions"></div>
    </form>

    <footer>
        View source code on <a href="https://github.com/http-tom/wordle-helper" target="_blank">GitHub</a>
    </footer>
<script type="text/javascript" src="app.js"></script>
</body>
</html>