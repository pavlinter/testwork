Yii 2 Advanced Application Template
===================================

REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

DUMP
------------

<a href="https://github.com/pavlinter/testwork/blob/master/dump.sql">File</a>

Entry point
------------
frontend/web/index.php

Db Config
------------
frontend/config/main.php
<pre>
'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=Название моей базы',
        'username' => 'root',
        'password' => '123456',
        'charset' => 'utf8',
],
</pre>

