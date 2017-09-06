<?php
/**
 * web测试入口
 * */
echo '开始测试...<br/>';
echo exec('phpunit --coverage-html ./xdebug AllTests.php');
echo ("<br/>测试完成!&nbsp;<a href='./xdebug/index.html'>查看测试结果</a>");
