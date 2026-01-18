<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if (empty($_SESSION['admin_user_id'])) {
    admin_redirect('/admin/login.php');
}
