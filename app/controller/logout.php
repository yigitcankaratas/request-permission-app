<?php
session_start();
session_destroy();
header('Location: /meritdesk/');
exit;