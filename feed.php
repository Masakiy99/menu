<?php
require_once './include/course_mng.php';

if(isset($_POST["func"])) {
	// コース設定
	if($_POST["func"] == "course_setting") {
		echo json_encode(CourseMng::getCourse());
		exit();
	// コースのメニュー設定
	} else if($_POST["func"] == "menu_setting") {
		$course_id = intval($_POST["course_id"]);
		
		echo json_encode(CourseMng::getCourse($course_id));
		exit();				
	// コースのメニュー設定
	} else if($_POST["func"] == "menu_select") {
		$course_id = intval($_POST["course_id"]);
		$menu_kind = strval($_POST["menu_kind"]);
		$type = strval($_POST["type"]);
		
		echo json_encode(CourseMng::getMenu($course_id,$type,$menu_kind));
		exit();
	} else if($_POST["func"] == "change_menu") {
		$course_id = intval($_POST["course_id"]);
		$current_menu = $_POST["current_menu"];
	
		$result = CourseMng::calcTotalPrice($course_id,$current_menu);
		
		echo json_encode($result);
		exit();
	}
}