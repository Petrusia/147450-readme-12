<?php
require_once(dirname(__FILE__) . '/inc/truncate.php');

require_once(dirname(__FILE__) . '/inc/data.php');
require_once(dirname(__FILE__) . '/helpers.php');

/** @var TYPE_NAME $main_template */
/** @var TYPE_NAME $post_data */
$main_template = include_template('main.php', ['post_data' => $post_data]);

/** @var TYPE_NAME $user_name */
/** @var TYPE_NAME $title */
/** @var TYPE_NAME $is_auth */
$layout_template = include_template('layout.php', [
    'main_template' => $main_template,
    'user_name' => $user_name,
    'title' => $title,
    'is_auth' => $is_auth
]);

print($layout_template);
