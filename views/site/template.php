<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>Template</title>
</head>
<body>
    <h1>模板</h1>
    <p><?php echo $data; ?></p>
    <p><?php echo $dataObj->name; ?></p>
    <p><?php echo $dataObj->age; ?></p>
    <p>
        <?php 
            foreach ($dataArr as $value) {
                echo $value['name'];
                echo $value['age'];
            }
        ?>
    </p>
</body>
</html>