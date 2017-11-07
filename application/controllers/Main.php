<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller 
{
	function __construct() 
    {
		parent::__construct();
		$this->load->library('pagination_custom_v3');
		$this->load->helper('alert');
		//$this->load->model("member_model");
	}

	public function _remap($method) 
    {
		$this->segs = $this->uri->segment_array();
		if ($this->input->is_ajax_request()) {
            //ajax 이면 헤더 푸터 없음
			if (method_exists($this, $method)) {
				$this -> {"{$method}"}();
			}
		} else if(isset($this->segs[4]) && $this->segs[4] =="excel"){
            //엑셀로 호출 하면
			if (method_exists($this, $method))  $this -> {"{$method}"}();
		} else {
            //ajax가 아니면
			$this->load->view("/common/header");
			if (method_exists($this, $method)) {
				$this->{"{$method}"}();
			}
			$this->load->view("/common/footer");
			//$this->output->enable_profiler(true);
		}
	}

	function index(){
        $data = array();
        $this->load->view("/main/main_v",$data);
        //$this->load->view("/main/index.html",$data);
    }//end index

	function member_list()
	{
		$input = array();
		foreach($this->input->post_get(NULL, TRUE) as $key => $val) $input["{$key}"]  = $val;
		if(!isset($input["page"])) $input["page"] = 1;
		if(!isset($input["pagelist"])) $input["pagelist"] = 30;
        
		$input["table"] = "tb_member";        
		$data = $this->_temp_pagen("member_model","member_list", $input, "get");
		$data['input'] = $input;        
        //print_r($data);
		$this->load->view("/member/member_list_v",$data);
	}
    
    function _temp_pagen($model,$model_func, $input, $method = "get", $linkCnt = 2)
	{
		$this->load->model("{$model}");
		$db_data = $this->{$model}->{$model_func}($input);
		if($linkCnt) {
			$i = 1; $link_url="";
			while($linkCnt >= $i) {
				$link_url = $link_url."/".$this->segs[$i];  
				$i++;
			}
		}
		
		$total_count = $db_data['total_cnt'];
		$data['total_count'] = $total_count;
		
		$config = $this->pagination_custom_v3->pagenation_bootstrap($input["page"], $total_count, $input["pagelist"], $link_url, $linkCnt++, $num_link=3);
		
		
		if($method == "segment") $config['page_query_string'] = false; //쿼리 스트링 on off
		$config['page_query_string'] = true;
		
		
		$this->pagination_custom_v3->initialize($config);
		$data['page_nation'] = $this->pagination_custom_v3->create_links();
		$data['lists'] = $db_data['page_list_m'];
		
		//print_r($data['page_nation']);
		return $data;
	}
}
