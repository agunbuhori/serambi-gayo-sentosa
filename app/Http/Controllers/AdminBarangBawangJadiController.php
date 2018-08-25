<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminBarangBawangJadiController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon_text";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = true;
			$this->button_export = true;
			$this->table = "barang_gudang";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Nama Barang","name"=>"barang_id","join"=>"barang,nama_barang"];
			$this->col[] = ["label"=>"Kategori","name"=>"kategori_id","join"=>"kategori,nama_kategori"];
			$this->col[] = ["label"=>"Keterangan","name"=>"keterangan"];
			$this->col[] = ["label"=>"Ditambahkan","name"=>"created_at"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Nama Barang','name'=>'barang_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'barang,nama_barang','datatable_ajax'=>'true'];
			$this->form[] = ['label'=>'Kategori','name'=>'kategori_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'kategori,nama_kategori'];
			$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Nama Barang','name'=>'barang_id','type'=>'select2','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'barang,nama_barang'];
			//$this->form[] = ['label'=>'Kategori','name'=>'kategori_id','type'=>'select2','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'kategori,nama_kategori'];
			//$this->form[] = ['label'=>'Keterangan','name'=>'keterangan','type'=>'textarea','validation'=>'required|string|min:5|max:5000','width'=>'col-sm-10'];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = "
	        var active_barang = ".(request()->anak_barang ? request()->anak_barang : "1").";
	        var full_url = '".request()->fullUrl()."';
	        	$(function() {
			    	$('#barang_id').select2();
			    	$('#barang_anak_id').html('');
			    	$.ajax({
			  			type:'get',
			  			url: '".asset('api/v1/anak_barang/')."/'+$('#barang_id').val(),
			  			success: function (response) {

			  				for (var i = 0; i < response.length; i++) {
			  					if (active_barang == response[i].id)
			  						var opt = '<option selected value='+response[i].id+'>'+response[i].value+'</option>';
			  					else
			  						var opt = '<option value='+response[i].id+'>'+response[i].value+'</option>';
			  					$('#barang_anak_id').append(opt)	
			  				}

			  				$('#barang_anak_id').select2();
			  				
			  			}
			  		});
			  	});

			  	function getChild(that) {
			  		$('#barang_anak_id').html('');
			  		$.ajax({
			  			type:'get',
			  			url: '".asset('api/v1/anak_barang/')."/'+$(that).val(),
			  			success: function (response) {

			  				for (var i = 0; i < response.length; i++) {
			  					if (active_barang == response[i].id)
			  						var opt = '<option selected value='+response[i].id+'>'+response[i].value+'</option>';
			  					else
			  						var opt = '<option value='+response[i].id+'>'+response[i].value+'</option>';

			  					$('#barang_anak_id').append(opt)	
			  				}

			  				$('#barang_anak_id').select2().trigger('change');
			  				
			  			}
			  		});
			  	}

			  	function getChild2(that) {
			  		var active_barang = '".request()->anak_barang."';
			  		$('#kategori_id').html('');
			  		$.ajax({
			  			type:'get',
			  			url: '".asset('api/v1/kategori/')."/'+$(that).val(),
			  			success: function (response) {
			  				for (var i = 0; i < response.length; i++) {
			  					if (active_barang == response[i].id)
			  						var opt = '<option selected value='+response[i].id+'>'+response[i].value+'</option>';
			  					else
			  						var opt = '<option value='+response[i].id+'>'+response[i].value+'</option>';
			  					
			  					$('#kategori_id').append(opt)	
			  				}

			  				$('#kategori_id').select2();
			  				
			  			}
			  		});

			  		$.ajax({
			  			type:'get',
			  			url: '".asset('api/v1/satuan/')."/'+$(that).val(),
			  			success: function (response) {
			  				$('#satuan').html('');
			  				for (var i = 0; i < response.length; i++) {
			  					$('#satuan').append(`
			  						<hr/>
			  						<div class='well'>
			  						<h5>Satuan `+response[i].value+`</h5>
			  						<div class='row'>
			  						  <div class='col-sm-4'>
			  						    <label>Masuk</label>
			  						    <input class='form-control' value='0' type='number' name='masuk[`+response[i].value+`]'>
			  						  </div>

			  						  <div class='col-sm-4'>
			  						    <label>Keluar</label>
			  						    <input class='form-control' value='0' type='number' name='keluar[`+response[i].value+`]'>
			  						  </div>

			  						  <div class='col-sm-4'>
			  						    <label>Saldo</label>
			  						    <input class='form-control' value='0' type='number' name='total[`+response[i].value+`]'>
			  						  </div>
			  						</div>
			  						</div>
			  					`);
			  				}
			  			}
			  		});
			  	}

			  	function getDataByChild(that) {
			  		window.location.href = '".request()->url()."?induk_barang='+$('#barang_id').val()+'&anak_barang='+$(that).val()
			  	}

			  	function changeYear(that) {
			  		full_url = full_url.replace(/year=[0-9]{4}/, 'year='+$(that).val());

			  		window.location.href = full_url;
			  	}

			  	function changeMonth(that) {
			  		full_url = full_url.replace(/month=[0-9]{1,2}/, 'month='+$(that).val());

			  		window.location.href = full_url;
			  	}
	        ";


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();

	        $this->load_js[] = asset('js/select2.full.min.js');
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = "
	        	.select2-container--default .select2-selection--single {
	        	           border-radius: 0px !important
	        	       }

	        	       .select2-container .select2-selection--single {
	        	           height: 35px !important;
	        	       }

	        	       .select2-container--default .select2-selection--multiple .select2-selection__choice {
	        	           background-color: #3c8dbc !important;
	        	           border-color: #367fa9 !important;
	        	           color: #fff !important;
	        	       }

	        	       .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
	        	           color: #fff !important;
	        	       }
	        ";
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        $this->load_css[] = asset('css/select2.min.css');
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	    	$check = DB::table('angka_satuan_barang')->where('barang_gudang_id', $id);
	    	if ($check->count()) 
		        $check->delete();

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }

	    public function getIndex() {
	      //First, Add an auth
	       if(!CRUDBooster::isView()) CRUDBooster::denyAccess();

	       $year = request()->has('year') ? request()->year : date('Y');
	       $month = request()->has('month') ? request()->month : date('m');
	       //Create your own query 

	       if (! request()->has('month') && ! request()->has('year'))
	       		return redirect(request()->fullUrlWithQuery([
	       			'year' => $year, 
	       			'month' => $month
	       		]));


	       $data = [];
	       $data['page_title'] = 'Products Data';
	       $data['result'] = DB::table('barang')
	       							->where('id', request()->anak_barang)
							       ->first();

	       $data['induk_barangs'] = DB::table('barang')->whereNull('parent_id')->where('jenis', 'biasa')->get();
	       $data['barang_gudangs'] = DB::table('barang_gudang')->where('barang_id', $data['result']->id) 
		       								->whereYear('tanggal', $year)
		       								->whereMonth('tanggal', $month)
	      								 ->get();

	       if (! request()->has('induk_barang'))
	       		return redirect(request()->fullUrlWithQuery([
	       			'induk_barang' => $data['induk_barangs'][0]->id,
	       			'year' => $year, 
	       			'month' => $month
	       		]));
	        
	       //Create a view. Please use `cbView` method instead of view method from laravel.
	       $this->cbView('barang_bawang_jadi/custom_index',$data);
	    }



	    //By the way, you can still create your own method in here... :) 

	    public function getAdd() {
	      //Create an Auth
	      if (! CRUDBooster::isCreate() && $this->global_privilege==FALSE || $this->button_add==FALSE) {    
	        CRUDBooster::redirect(CRUDBooster::adminPath(),trans("crudbooster.denied_access"));
	      }
	      
	      $data = [];
	      $data['page_title'] = 'Add Barang Bawang Jadi';

	      $data['barangs'] = DB::table('barang')->whereNull('parent_id')->where('jenis', 'biasa')->get();
	      $data['gudangs'] = DB::table('gudang')->get(); 
	      //Please use cbView method instead view method from laravel
	      $this->cbView('barang_bawang_jadi/custom_add',$data);
	    }

	    public function store()
	    {
	    	$insert = \App\BarangGudang::insert([
	    		'barang_id' => Request::input('barang_id'),
	    		'kategori_id' => 1,
	    		'gudang_id' => Request::input('gudang_id'),
				'keterangan' => Request::input('keterangan'),
				'jenis' => 'barang_bawang_jadi',
				'tanggal' => today(),
				'masuk' => json_encode(array_values(Request::input('masuk'))),
				'keluar' => json_encode(array_values(Request::input('keluar'))),
				'total' => json_encode(array_values(Request::input('total'))),
	    	]);


	    	return redirect('admin/barang-bawang-jadi');
	    }


	}