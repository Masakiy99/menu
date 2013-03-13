var CourceMng = function(course_id) {
    //オプションなどの設定をオブジェクトにしておきます。デフォルト値も同時に記述しておきます。
    this.settings = {
    	course_id: course_id,
    	base_menu : null,
    	current_menu : null,
    	price : null,
    	name : null,
    };
    
	//init処理を開始します。
    this.init();
}

CourceMng.prototype = {
    //init関数
    init: function() {
    	// サーバからメニューの情報を取得する
    	this.setBaseMenu(this);
    },
    
    // サーバから指定したコースのメニュー一覧を取得する
    setBaseMenu : function (obj) {   	
    	//　コース情報を取得する
    	$.ajax({
    		type: "POST",
    		url: "feed.php",
    		async: false,
    		data: {'func' : 'menu_setting', 'course_id' : this.settings.course_id},
    		success: function(data, dataType) {
    			var cource_info = $.parseJSON( data );
    			
    			obj.settings.price			= cource_info.price;
    			obj.settings.name 			= cource_info.name;
    			obj.settings.base_menu 		= cource_info.menu;
    			obj.settings.current_menu 	= obj.settings.base_menu;
    			
    			console.log(obj);
    		},
    		error: function(XMLHttpRequest, textStatus, errorThrown) {
    			// エラーの表示
    			alert('Error : ' + errorThrown);
    		}
    	});
    },
    
    changeMenuList: function(kind,val) {
    	// メニューを変更する
    	this.settings.current_menu[kind] = val;
    	
    	// メニューを変更した結果を計算する
    	this.changeMenu(this);
    },
    
    changeMenu : function (obj) {
    	//　コース情報を取得する
    	$.ajax({
    		type: "POST",
    		url: "feed.php",
    		async: false,
    		data: {'func' : 'change_menu', 'course_id' : obj.settings.course_id , 'current_menu' : obj.settings.current_menu},
    		success: function(data, dataType) {
    			//console.log(data);
    			var cource_info = $.parseJSON( data );
    			
    			//　費用の更新
    			obj.settings.price			= cource_info.price;
    		},
    		error: function(XMLHttpRequest, textStatus, errorThrown) {
    			// エラーの表示
    			alert('Error : ' + errorThrown);
    		}
    	});
    }
};

// コースのセレクトボックスの要素を設定する
function setCourseSelecter(setting) {
	var select_course = $('#select-course');
	course_setting = $.parseJSON( setting );
	
	var elm = $("<option>").html('コースを選択してください').attr({ value: '-----' });
	select_course.append(elm);
	
	$.each ( course_setting, function ( id, course_info ) {
		var elm = $("<option>").html(course_info['name']).attr({ value: id });
		select_course.append(elm);
	});
	
	select_course.val('-----').trigger('change');
}

// コースを選択したときの処理
function selectCourse( course_id ) {
	// 管理用オブジェクト作成
	course_mng = new CourceMng(course_id);

	// 表示設定
	setCourse();
	
	// コースの設定    	
	$('#course_name').html(course_mng.settings.name);
	$('#course_price').html("￥" + course_mng.settings.price);
}

// 選択されたコースのメニュー要素を設定する
function setCourse() {
	var menu_area = $('#menu');

	// 一度非表示
	$('#menu_area').hide();
	
	// メニューを設定
	$.each ( course_mng.settings.current_menu, function ( kind, name ) {
		var text_area 		= $('p#'+kind);
		var　add_button_area = $('#add-'+kind);
		var select_area 	= $('#select-'+kind+'-area');
		var select 			= $('#select-'+kind);
		
		//　メニューの名称を設定
		$('#'+ kind).html(name);
		
		if(kind != 'Dolce') {
			// 初期化
			text_area.show();
			add_button_area.hide();
			select_area.hide();
			
			// メニュー変更用ロジック
			if(name != "") {
				$("#"+ kind).click(function () {
					setChangeMenuSelecter(kind,'change');
					});
			// 追加メニュー用ロジック
			} else {
				$("#add-"+ kind).show();
				$("#add-submit-"+ kind).click(function () {
					setChangeMenuSelecter(kind,'add');
					});			
			}
			
			// メニュー変更時のロジック
			$("#submit-" + kind).click(function () {
				changeMenu(kind);
				});	
		}
	});

	// メニューの描画
	$('#menu_area').show();
}

// メニュー変更用のセレクトボックスを表示する
function setChangeMenuSelecter( kind ,type ){	
	var text_area 		= $('p#'+kind);
	var　add_button_area = $('#add-'+kind);
	var select_area 	= $('#select-'+kind+'-area');
	var select 			= $('#select-'+kind);
	
	// 初期化
	select.children().remove();
	course_id = $('#select-course').val();
	
//	console.log(kind);
//	console.log(course_id);
//	console.log(type);
	
	// メニューの読み込み・設定
	$.ajax({
		type: "POST",
		url: "feed.php",
		async: false,
		data: {'func' : 'menu_select','menu_kind' : kind, 'course_id' : course_id, type : type },
		success: function(data, dataType) {
			var menu_select = $.parseJSON( data );
//			console.log(menu_select);
			
			if(type == 'add') {
				var elm = $("<option>").html('メニューを選択してください').attr({ value: '-----' });
				select.append(elm);
			}
			
			$.each ( menu_select, function ( val, item ) {
				var name = item.name;
				if(item.cost != 0){
					name = name + '　　　　　　＋￥'　+　item.cost;		
				}
				
				var elm = $("<option>").html(name).attr({ value: item.name });
				select.append(elm);
			});	
			
			if(type == 'change') {
				select.val(course_mng.settings.current_menu[kind]).trigger('change');
			}
			
			add_button_area.hide();
			text_area.hide();
			select_area.show();
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			// エラーの表示
			alert('Error : ' + errorThrown);
		}
	});
}

// メニューを変更したときの処理
function changeMenu(kind) {
	var text_area	= $('p#'+kind);
	var select_area = $('#select-'+kind+'-area');
	var select 		= $('#select-'+kind);
	
	var menu_id = select.val();
	
	// メニュー更新処理
	course_mng.changeMenuList(kind,menu_id);
	
	// メニュー表示更新
	text_area.html(course_mng.settings.current_menu[kind]);
	
	// 料金更新
	$('#course_price').html("￥" + course_mng.settings.price);
	
	// メニューの選択領域をオフ、メニュー名称表示
	select_area.hide();
	text_area.show();
}

//
// logic
//
var course_setting;
var course_mng;


$(document).ready(function(){
	// コース情報読み込み
	$.ajax({
		type: "POST",
		url: "feed.php",
		async: false,
		data: {'func' : 'course_setting'},
		success: function(data, dataType) {
			//console.log(data);
			setCourseSelecter(data);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			// エラーの表示
			alert('Error : ' + errorThrown);
		}
	});
	
	// コースを選択したときの処理
	$('#select-course').change(function() {
	    if($(this).val() != '-----') {
	    	// コース内容の設定
	    	selectCourse($(this).val());
	    } else {
	    	$('#menu_area').hide();
	    }    
	});
});