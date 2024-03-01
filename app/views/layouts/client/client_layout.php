<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo __WEB_ROOT ?>public/assets/client/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script></head>

<body>
    <div class="container-fluid" style="height:100%">
            <div class="row" style="height:100%">
                <?php 
                    $this->render('layouts/blocks/client_Header');
                    $this->render($content,$sub_content);
                    $this->render('layouts/blocks/client_Footer');
                ?>
            </div>
        </div>
    
</body>
</html>