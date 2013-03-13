<?php

require_once './include/setting.php';

class CourseMng {
	// メニューの種類
	private $_menu_kind = array("Antipasto","Antipasto2","Pesce","Pasta","Pasta2","Carne","Dolce");
	
	// コースマスタ読み込み
	static private function _readCourseMst(){
		static $_mst_course = null;
		
		if(is_null($_mst_course)) {
			// 仮なんで別設定ファイルのグローバル変数を読み込む
			global $course;
			$_mst_course = $course;
		}
		
		return $_mst_course;
	}
	
	// メニューマスタ読み込み
	static private function _readMenuMst(){
		static $_mst_menu = null;
		
		if(is_null($_mst_menu)) {
			// 仮なんで別設定ファイルのグローバル変数を読み込む
			global $menu;
			
			foreach ($menu as $item) {
				$_mst_menu[$item["kind"]][] =  $item;				
			}
		}
		
		return $_mst_menu;
	}
	
	//　提供しているコース情報を取得
	static public function getCourse($course_id=null){
		$_mst_course = self::_readCourseMst();
		
		if(!is_null($course_id)) return $_mst_course[$course_id];
		return $_mst_course;
	}
	
	// 指定された種類のメニューリストを取得する
	static public function getMenu($course_id=null,$type='add',$kind){
		global $rankup,$addmenu;
		
		$_mst_menu = self::_readMenuMst();
		
		// 2皿目のあるものの変換
		if($kind == "Antipasto2") $kind = "Antipasto";
		if($kind == "Pasta2") $kind = "Pasta";
		
		// 費用算出
		$menu_list = array();
		foreach ($_mst_menu[$kind] as $item) { 
			if($type == 'add') {
				if(isset($addmenu[$course_id][$item["name"]])){
					$item["cost"] = $addmenu[$course_id][$item["name"]];
					$menu_list[$item["name"]] = $item;
				}
			} elseif($type == 'change') {
				if(isset($rankup[$course_id][$item["name"]])){
					$item["cost"] = $rankup[$course_id][$item["name"]];
					$menu_list[$item["name"]] = $item;
				}
			}			
		}
		return $menu_list;
	}
	
	// メニュー変更後の費用を計算する
	static public function calcTotalPrice($course_id,$current_menu){
		$course_info = self::getCourse($course_id);
		$price = $course_info["price"];
		
		foreach ($current_menu as $kind => $name) {
			if($name != "") {
				$type = "change";
				if($kind == "Dolce") continue;
				if($course_id != COURSE_C && ($kind == "Antipasto2" || $kind == "Pasta2")) $type = "add";
				
				$menu = self::getMenu($course_id,$type,$kind);
				if(isset($menu[$name])) {
					$price += $menu[$name]["cost"];
				}
			}
		}
		
		$course_info["price"] = $price;
		$course_info["menu"] = $current_menu;
		
		return $course_info;
	}
	
	
}