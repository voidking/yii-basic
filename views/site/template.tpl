<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>Template</title>
</head>
<body>
    <h1>模板</h1>
    <p>{$data}</p>
    <p>{$dataObj->name}</p>
    <p>{$dataObj->age}</p>
    <p>
        {foreach from=$dataArr key=mykey item=$value}
            {$value.name}&nbsp;{$value.age}
        {/foreach}
    </p>
</body>
</html>