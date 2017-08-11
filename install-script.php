<?php

global $wpdb;
$add_subject = "CREATE TABLE IF NOT EXISTS `eexamhall_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)AUTO_INCREMENT=3 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$wpdb->query($add_subject);

$add_quiz = "CREATE TABLE IF NOT EXISTS `eexamhall_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) NOT NULL,
  `quiz_name` varchar(255) NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) AUTO_INCREMENT=6 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$wpdb->query($add_quiz);

$add_question = "CREATE TABLE IF NOT EXISTS `eexamhall_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question` text NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  `op1` text NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  `op2` text NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  `op3` text NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  `op4` text NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  `correct_ans` varchar(255) NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
)AUTO_INCREMENT=5 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$wpdb->query($add_question);

$result = "CREATE TABLE IF NOT EXISTS `eexamhall_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COLLATE utf8_unicode_ci NOT NULL,
  `correct` varchar(255) NOT NULL ,
  `zero` varchar(255) NOT NULL,
  `wrong` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)AUTO_INCREMENT=6 ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$wpdb->query($result);
?>