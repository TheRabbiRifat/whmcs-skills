<?php

$client = new Client([
-                 'defaults' => [
-                    'verify' => true,
-                    'exceptions' => true,
-                    'timeout' => 10,
-                ]
+                'verify' => true,
+                'http_errors' => true,
+                'timeout' => 10,
             ]);