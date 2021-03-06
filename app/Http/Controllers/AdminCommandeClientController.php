<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;

class AdminCommandeClientController extends \crocodicstudio\crudbooster\controllers\CBController {

	public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "Societe";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "commandes";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Commercial","name"=>"Commercial","join"=>"cms_users,name"];
			$this->col[] = ["label"=>"Client","name"=>"client","join"=>"clients,Societe"];
			$this->col[] = ["label"=>"Commande","name"=>"ref_Commande"];
			$this->col[] = ["label"=>"Total","name"=>"total"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
            $this->form[] = ['label'=>'Commercial','name'=>'Commercial','type'=>'hidden', 'value'=>CRUDBooster::myId(),'validation'=>'required','width'=>'col-sm-9','datatable'=>'cms_users,name'];
            $this->form[] = ['label'=>'Client','name'=>'client','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'clients,Societe'];
            $this->form[] = ['label'=>'Ref Commande','name'=>'ref_Commande','type'=>'text','validation'=>'required','width'=>'col-sm-10'];
            $columns=[];
            $columns[] = ['label'=>'Produit','name'=>'Produits_id','type'=>'datamodal','datamodal_table'=>'produits','datamodal_columns'=>'Nom,Prix','datamodal_select_to'=>'Prix:Prix','datamodal_where'=>'','datamodal_size'=>'large'];
            $columns[] = ['label'=>'Prix','name'=>'Prix','type'=>'number','required'=>true, readonly=>true];
            $columns[] = ['label'=>'Quantité','name'=>'Quantité','type'=>'number','required'=>true];
            $columns[] = ['label'=>'Promotion','name'=>'Promotion','type'=>'number','required'=>false];
            $columns[] = ['label'=>'SousTotal','name'=>'Soustotal','type'=>'number','formula'=>"[Quantité] * [Prix] - [Promotion]","readonly"=>true,'required'=>true];
            $this->form[] = ['label'=>'Facture','name'=>'factures','type'=>'child','columns'=>$columns,'table'=>'factures','foreign_key'=>'Client_id'];
            $this->form[] = ['label'=>'Total','name'=>'total','type'=>'text','width'=>'col-sm-9',readonly=>true];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ['label'=>'Commercial','name'=>'Commercial','type'=>'hidden', 'value'=>CRUDBooster::myId(),'validation'=>'required','width'=>'col-sm-9','datatable'=>'cms_users,name'];
			//$this->form[] = ['label'=>'Client','name'=>'client','type'=>'select2','validation'=>'required','width'=>'col-sm-10','datatable'=>'clients,Societe'];
			//$this->form[] = ['label'=>'Ref Commande','name'=>'ref_Commande','type'=>'text','validation'=>'required','width'=>'col-sm-10'];
			//$columns=[];
			//$columns[] = ['label'=>'Produit','name'=>'Produits_id','type'=>'datamodal','datamodal_table'=>'produits','datamodal_columns'=>'Nom,Prix','datamodal_select_to'=>'Prix:Prix','datamodal_where'=>'','datamodal_size'=>'large'];
			//$columns[] = ['label'=>'Prix','name'=>'Prix','type'=>'number','required'=>true, readonly=>true];
			//$columns[] = ['label'=>'Quantité','name'=>'Quantité','type'=>'number','required'=>true];
			//$columns[] = ['label'=>'Promotion','name'=>'Promotion','type'=>'number','required'=>false];
			//$columns[] = ['label'=>'SousTotal','name'=>'Soustotal','type'=>'number','formula'=>"[Quantité] * [Prix] - [Promotion]","readonly"=>true,'required'=>true];
			//$this->form[] = ['label'=>'Facture','name'=>'factures','type'=>'child','columns'=>$columns,'table'=>'factures','foreign_key'=>'Client_id'];
			//$this->form[] = ['label'=>'Total','name'=>'total','type'=>'text','width'=>'col-sm-9',readonly=>true];
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
				$(function (){
					setInterval(function(){
						var total=0;
						$('#table-facture tbody .Soustotal').each(function(){
							var amount= parseFloat($(this).text());
							total +=amount;	
						})
						$('#total').val(total);
				},500);
						
					})";

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
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
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
	        $query-> Where('cms_users.email', $_COOKIE['COOKIE']);

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
	        //Your code here

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



	    //By the way, you can still create your own method in here... :) 


	}