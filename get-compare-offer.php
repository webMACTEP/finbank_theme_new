<?php
session_start(); // Запуск сессии

// Подключение WordPress
require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');

// Проверка наличия post_id в POST-запросе
if (isset($_POST['post_id'])) {
	// Санитизация входных данных
	$post_id = intval($_POST['post_id']);
	$tax = sanitize_text_field($_POST['post_tax'] ?? '');

	// Получение заголовка поста
	$text = get_the_title($post_id);

	// Добавление данных в сессию
	if (!isset($_SESSION['cards'])) {
		$_SESSION['cards'] = [];
	}
	$_SESSION['cards'][] = [
		'post_id' => $post_id,
		'tax' => $tax,
		'title' => $text
	];

	// Безопасный вывод заголовка
	echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
} else {
	echo 'empty';
}
