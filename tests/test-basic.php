<?php

// require the class files. you may no need these if you install via composer.
require dirname(__DIR__).'/Okvee/Profiler/ProfilerBase.php';
require dirname(__DIR__).'/Okvee/Profiler/Profiler.php';

$profiler = new \Okvee\Profiler\Profiler();
$profiler->Console->registerLogSections(array('Logs', 'Time Load', 'Memory Usage', 'Files'));

// -----------------------------------------------------------------------------------------------------
// lazy to write same test on every page, use common test functions
// you can change this to other coding style in your real project.
require __DIR__.'/common-test-functions.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Okvee\Profiler test</title>
        
        <link rel="stylesheet" href="reset.css">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <h1>Okvee\Profiler test</h1>
        <p>This page test followings:</p>
        <ul>
            <li>Log</li>
            <li>Time Load</li>
            <li>Memory usage</li>
            <li>Files</li>
        </ul>

        <?php
        okvpBasicLogs($profiler);
        okvpTimeLoadLogs($profiler);
        okvpMemoryUsage($profiler);

        $profiler->gatherAll();

        // just checking.
        echo '<pre class="profiler-data-dump-test">'.htmlspecialchars(print_r($profiler->dumptest(), true)).'</pre>';
        echo "\n\n\n";

        // display profiler window.
        echo $profiler->display();
        ?>
    </body>
</html>