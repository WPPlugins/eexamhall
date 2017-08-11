<?php
/*
Plugin Name: eexamhall
Plugin URI: http://singhalrohitashv.com/
Description: This plugin is basically designed to create the online exams, here admin can create the online exam in three simple steps and can share the url with the users to use them
Author: rohitashv
Version: 3.9
Author URI: http://singhalrohitashv.com/
*/

register_activation_hook( __FILE__, 'eexamhall_InstallScript' );
function eexamhall_InstallScript()
{
	include('install-script.php');
}
add_action('admin_menu','eexamhall_menu');
function eexamhall_menu()
{
	add_menu_page('eExamhall','eExamhall','administrator','eExamhall-main');
	add_submenu_page( 'eExamhall-main', 'eExamhall', ' Add Subject', 'administrator', 'eExamhall-main', 'display_main_page' );
	add_submenu_page( 'eExamhall-main', 'eExamhall', 'Add Quiz', 'administrator', 'eExamhall-quiz', 'remove_page' );
	add_submenu_page( 'eExamhall-main', 'eExamhall', 'Add Questions', 'administrator', 'eExamhall-question', 'add_questions' );
	add_submenu_page( 'eExamhall-main', 'eExamhall', 'Questions List', 'administrator', 'eExamhall-question-view', 'view_questions' );
	add_submenu_page( 'eExamhall-main', 'eExamhall', 'Results', 'administrator', 'eExamhall-result', 'results' );
	add_submenu_page( 'eExamhall-main', 'eExamhall', 'Settings', 'administrator', 'eExamhall-settings', 'settings' );
	add_submenu_page( 'eExamhall-main', 'eExamhall', 'Un-Install', 'administrator', 'eExamhall-uninstall', 'uninstall' );
	add_submenu_page( 'eExamhall-main', 'eExamhall', 'Help & Support', 'administrator', 'eExamhall-help', 'help_n_sup' );
}
function display_main_page()
{
	include('menu-pages/add_subject.php');
}
function remove_page()
{
	include('menu-pages/add_quiz.php');
}
function add_questions()
{
	include('menu-pages/add_question.php');
}
function view_questions()
{
	include('menu-pages/view_question.php');
}
function help_n_sup()
{
	include('menu-pages/help_n_sup.php');
}
function results()
{
	include('menu-pages/results.php');
}
function uninstall()
{
	include("menu-pages/uninstall.php");
}
function settings()
{
	include('menu-pages/setting.php');
}
function shortcode_function( $atts ) {
	include('menu-pages/view_quiz.php');
}
add_shortcode( 'eExamHall', 'shortcode_function' );
?>