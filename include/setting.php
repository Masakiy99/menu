<?php
// コースの種類
define("COURSE_A",1);
define("COURSE_B",2);
define("COURSE_C",3);

// コース設定
$course[COURSE_A] = array("name"=>"コースA",
					"price"=>13000,
					"menu" => array(
							"Antipasto" 	=> "Faraona",
							"Antipasto2" 	=> "",
							"Pesce" 		=> "S. Acciughe",
							"Pasta" 		=> "P.C.Agnello",
							"Pasta2"		=> "",
							"Carne"			=> "Anatra",
							"Dolce" 		=> "Dolce",
				));
$course[COURSE_B] = array("name"=>"コースB",
					"price"=>15000,
					"menu" => array(
							"Antipasto" 	=> "Granchio",
							"Antipasto2" 	=> "",
							"Pesce" 		=> "S. Barsamico",
							"Pasta" 		=> "Tagl. Ragu Pesc",
							"Pasta2"		=> "",
							"Carne"			=> "Vitella",
							"Dolce" 		=> "Dolce",
					));
$course[COURSE_C] = array("name"=>"コースC",
					"price"=>18000,
					"menu" => array(
							"Antipasto" 	=> "Astice",
							"Antipasto2" 	=> "Fegato Grasso",
							"Pesce" 		=> "Con Porcini",
							"Pasta" 		=> "Tagl.Guanciale",
							"Pasta2"		=> "Gn.al Tartufo",
							"Carne"			=> "Capriolo",
							"Dolce" 		=> "Dolce",
					));
// メニュー設定
$menu[] = array("kind"=>"Antipasto","name" => "Faraona",);
$menu[] = array("kind"=>"Antipasto","name" => "Granchio",);
$menu[] = array("kind"=>"Antipasto","name" => "Astice",	);
$menu[] = array("kind"=>"Antipasto","name" => "Fegato Grasso",);

$menu[] = array("kind"=>"Pesce","name" => "S. Acciughe",);
$menu[] = array("kind"=>"Pesce","name" => "S. Barsamico",);
$menu[] = array("kind"=>"Pesce","name" => "Con Porcini",);

$menu[] = array("kind"=>"Pasta","name" => "P.C.Agnello",);
$menu[] = array("kind"=>"Pasta","name" => "Tagl. Ragu Pesc",);
$menu[] = array("kind"=>"Pasta","name" => "Tagl.Guanciale",);
$menu[] = array("kind"=>"Pasta","name" => "Gn.al Tartufo",);

$menu[] = array("kind"=>"Carne","name" => "Anatra",);
$menu[] = array("kind"=>"Carne","name" => "Vitella",);
$menu[] = array("kind"=>"Carne","name" => "Capriolo",);

// ランクアップ費用テーブル
$rankup[COURSE_A]["Faraona"] 		= 0;
$rankup[COURSE_A]["Granchio"] 		= 1000;
$rankup[COURSE_A]["Astice"] 		= 1500;
//$rankup[COURSE_A]["Fegato Grasso"] 	= false;
$rankup[COURSE_A]["S. Acciughe"] 	= 0;
$rankup[COURSE_A]["S. Barsamico"] 	= 1000;
$rankup[COURSE_A]["Con Porcini"] 	= 1500;
$rankup[COURSE_A]["P.C.Agnello"] 	= 0;
$rankup[COURSE_A]["Tagl. Ragu Pesc"]= 1000;
$rankup[COURSE_A]["Tagl.Guanciale"]	= 1500;
//$rankup[COURSE_A]["Gn.al Tartufo"]	= 1500;
$rankup[COURSE_A]["Anatra"] 		= 0;
$rankup[COURSE_A]["Vitella"]		= 1000;
$rankup[COURSE_A]["Capriolo"]		= 1500;

$rankup[COURSE_B]["Faraona"] 		= 0;
$rankup[COURSE_B]["Granchio"] 		= 0;
$rankup[COURSE_B]["Astice"] 		= 1000;
//$rankup[COURSE_B]["Fegato Grasso"] 	= false;
$rankup[COURSE_B]["S. Acciughe"] 	= 0;
$rankup[COURSE_B]["S. Barsamico"] 	= 0;
$rankup[COURSE_B]["Con Porcini"] 	= 1000;
$rankup[COURSE_B]["P.C.Agnello"] 	= 0;
$rankup[COURSE_B]["Tagl. Ragu Pesc"]= 0;
$rankup[COURSE_B]["Tagl.Guanciale"]	= 1000;
//$rankup[COURSE_B]["Gn.al Tartufo"]	= 1500;
$rankup[COURSE_B]["Anatra"] 		= 0;
$rankup[COURSE_B]["Vitella"]		= 0;
$rankup[COURSE_B]["Capriolo"]		= 1000;

$rankup[COURSE_C]["Faraona"] 		= 0;
$rankup[COURSE_C]["Granchio"] 		= 0;
$rankup[COURSE_C]["Astice"] 		= 0;
//$rankup[COURSE_C]["Fegato Grasso"] 	= false;
$rankup[COURSE_C]["S. Acciughe"] 	= 0;
$rankup[COURSE_C]["S. Barsamico"] 	= 0;
$rankup[COURSE_C]["Con Porcini"] 	= 0;
$rankup[COURSE_C]["P.C.Agnello"] 	= 0;
$rankup[COURSE_C]["Tagl. Ragu Pesc"]= 0;
$rankup[COURSE_C]["Tagl.Guanciale"]	= 0;
//$rankup[COURSE_B]["Gn.al Tartufo"]	= 1500;
$rankup[COURSE_C]["Anatra"] 		= 0;
$rankup[COURSE_C]["Vitella"]		= 0;
$rankup[COURSE_C]["Capriolo"]		= 0;

// 追加の費用テーブル
//$addmenu[COURSE_A]["Faraona"] 		= 0;
$addmenu[COURSE_A]["Granchio"] 		= 1500;
$addmenu[COURSE_A]["Astice"] 		= 2000;
$addmenu[COURSE_A]["Fegato Grasso"] = 1500;
//$rankup[COURSE_A]["P.C.Agnello"] 	= 0;
$addmenu[COURSE_A]["Tagl. Ragu Pesc"]= 1500;
$addmenu[COURSE_A]["Tagl.Guanciale"]	= 2000;
$addmenu[COURSE_A]["Gn.al Tartufo"]	= 1500;

$addmenu[COURSE_B]["Faraona"] 		= 0;
//$addmenu[COURSE_B]["Granchio"] 	= 1500;
$addmenu[COURSE_B]["Astice"] 		= 1500;
$addmenu[COURSE_B]["Fegato Grasso"] = 1500;
$addmenu[COURSE_B]["P.C.Agnello"] 	= 0;
//$addmenu[COURSE_A]["Tagl. Ragu Pesc"]= 0;
$addmenu[COURSE_B]["Tagl.Guanciale"]	= 1500;
$addmenu[COURSE_B]["Gn.al Tartufo"]	= 1500;

$addmenu[COURSE_C] = null;