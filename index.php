<?php

require_once(dirname(__FILE__) . '/inc/truncate.php');
require_once(dirname(__FILE__) . '/inc/data.php');
require_once(dirname(__FILE__) . '/helpers.php');

$main_template = include_template('main.php', ['post_data' => $post_data]);

$layout_template = include_template(
    'layout.php',
    [
        'main_template' => $main_template,
        'user_name' => $user_name,
        'title' => $title,
        'is_auth' => $is_auth
    ]
);

print($layout_template);
