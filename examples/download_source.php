<?php
echo '<pre>';
$contents = file_get_contents(str_replace('examples/', '', $_GET['example']));
echo str_replace('<?php', '', $contents);
echo '</pre>';