<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pagination Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Pagination
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/pagination.html
 */
class Pagination_custom_v3 {

	/**
	 * Base URL
	 *
	 * The page that we're linking to
	 *
	 * @var	string
	 */
	protected $base_url		= '';

	/**
	 * Prefix
	 *
	 * @var	string
	 */
	protected $prefix = '';

	/**
	 * Suffix
	 *
	 * @var	string
	 */
	protected $suffix = '';

	/**
	 * Total number of items
	 *
	 * @var	int
	 */
	protected $total_rows = 0;

	/**
	 * Number of links to show
	 *
	 * Relates to "digit" type links shown before/after
	 * the currently viewed page.
	 *
	 * @var	int
	 */
	protected $num_links = 2;

	/**
	 * Items per page
	 *
	 * @var	int
	 */
	public $per_page = 10;

	/**
	 * Current page
	 *
	 * @var	int
	 */
	public $cur_page = 0;

	/**
	 * Use page numbers flag
	 *
	 * Whether to use actual page numbers instead of an offset
	 *
	 * @var	bool
	 */
	protected $use_page_numbers = FALSE;

	/**
	 * First link
	 *
	 * @var	string
	 */
	protected $first_link = '&lsaquo; First';

	/**
	 * Next link
	 *
	 * @var	string
	 */
	protected $next_link = '&gt;';

	/**
	 * Previous link
	 *
	 * @var	string
	 */
	protected $prev_link = '&lt;';

	/**
	 * Last link
	 *
	 * @var	string
	 */
	protected $last_link = 'Last &rsaquo;';

	/**
	 * URI Segment
	 *
	 * @var	int
	 */
	protected $uri_segment = 0;

	/**
	 * Full tag open
	 *
	 * @var	string
	 */
	protected $full_tag_open = '';

	/**
	 * Full tag close
	 *
	 * @var	string
	 */
	protected $full_tag_close = '';

	/**
	 * First tag open
	 *
	 * @var	string
	 */
	protected $first_tag_open = '';

	/**
	 * First tag close
	 *
	 * @var	string
	 */
	protected $first_tag_close = '';

	/**
	 * Last tag open
	 *
	 * @var	string
	 */
	protected $last_tag_open = '';

	/**
	 * Last tag close
	 *
	 * @var	string
	 */
	protected $last_tag_close = '';

	/**
	 * First URL
	 *
	 * An alternative URL for the first page
	 *
	 * @var	string
	 */
	protected $first_url = '';

	/**
	 * Current tag open
	 *
	 * @var	string
	 */
	protected $cur_tag_open = '<strong>';

	/**
	 * Current tag close
	 *
	 * @var	string
	 */
	protected $cur_tag_close = '</strong>';

	/**
	 * Next tag open
	 *
	 * @var	string
	 */
	protected $next_tag_open = '';

	/**
	 * Next tag close
	 *
	 * @var	string
	 */
	protected $next_tag_close = '';

	/**
	 * Previous tag open
	 *
	 * @var	string
	 */
	protected $prev_tag_open = '';

	/**
	 * Previous tag close
	 *
	 * @var	string
	 */
	protected $prev_tag_close = '';

	/**
	 * Number tag open
	 *
	 * @var	string
	 */
	protected $num_tag_open = '';

	/**
	 * Number tag close
	 *
	 * @var	string
	 */
	protected $num_tag_close = '';

	/**
	 * Page query string flag
	 *
	 * @var	bool
	 */
	protected $page_query_string = FALSE;

	/**
	 * Query string segment
	 *
	 * @var	string
	 */
	protected $query_string_segment = 'page';

	/**
	 * Display pages flag
	 *
	 * @var	bool
	 */
	protected $display_pages = TRUE;

	/**
	 * Attributes
	 *
	 * @var	string
	 */
	protected $_attributes = '';

	/**
	 * Link types
	 *
	 * "rel" attribute
	 *
	 * @see	CI_Pagination::_attr_rel()
	 * @var	array
	 */
	protected $_link_types = array();

	/**
	 * Reuse query string flag
	 *
	 * @var	bool
	 */
	protected $reuse_query_string = FALSE;

	/**
	 * Use global URL suffix flag
	 *
	 * @var	bool
	 */
	protected $use_global_url_suffix = FALSE;

	/**
	 * Data page attribute
	 *
	 * @var	string
	 */
	protected $data_page_attr = 'data-ci-pagination-page';

	/**
	 * CI Singleton
	 *
	 * @var	object
	 */
	protected $CI;

	// --------------------------------------------------------------------

	protected $display_always		= FALSE; // Display pagination even it has one page only.
	protected $use_fixed_page		= FALSE; // Use a fixed number of pages.
	protected $fixed_page_num		= 5; // A fixed number of pages on the pagination.
	protected $disable_first_link	= FALSE; // Disable the first link when the current page is the first page.
	protected $disable_last_link	= FALSE; // Disable the last link when the current page is the last page.
	protected $disable_prev_link	= FALSE; // Disable the previous link when the current page is the first page.
	protected $disable_next_link	= FALSE; // Disable the next link when the current page is the last page.
	protected $display_first_always	= TRUE; // Always display the first link even the current page is the first page.
	protected $display_last_always	= TRUE; // Always display the last link even the current page is the last page.
	protected $display_prev_always	= FALSE; // Always display the previous link even the current page is the first page.
	protected $display_next_always	= FALSE; // Always display the next link even the current page is the last page.

	protected $disabled_first_tag_open	= '';
	protected $disabled_first_tag_close	= '&nbsp;';
	protected $disabled_last_tag_open	= '&nbsp;';
	protected $disabled_last_tag_close	= '';
	protected $disabled_prev_tag_open	= '&nbsp;';
	protected $disabled_prev_tag_close	= '';
	protected $disabled_next_tag_open	= '&nbsp;';
	protected $disabled_next_tag_close	= '&nbsp;';


	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @param	array	$params	Initialization parameters
	 * @return	void
	 */
	public function __construct($params = array())
	{
		$this->CI =& get_instance();
		$this->CI->load->language('pagination');
		foreach (array('first_link', 'next_link', 'prev_link', 'last_link') as $key)
		{
			if (($val = $this->CI->lang->line('pagination_'.$key)) !== FALSE)
			{
				$this->$key = $val;
			}
		}

		$this->initialize($params);
		log_message('info', 'Pagination Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Initialize Preferences
	 *
	 * @param	array	$params	Initialization parameters
	 * @return	CI_Pagination
	 */
	public function initialize(array $params = array())
	{
		if (isset($params['attributes']) && is_array($params['attributes']))
		{
			$this->_parse_attributes($params['attributes']);
			unset($params['attributes']);
		}

		// Deprecated legacy support for the anchor_class option
		// Should be removed in CI 3.1+
		if (isset($params['anchor_class']))
		{
			empty($params['anchor_class']) OR $attributes['class'] = $params['anchor_class'];
			unset($params['anchor_class']);
		}

		foreach ($params as $key => $val)
		{
			if (property_exists($this, $key))
			{
				$this->$key = $val;
			}
		}

		if ($this->CI->config->item('enable_query_strings') === TRUE)
		{
			$this->page_query_string = TRUE;
		}

		if ($this->use_global_url_suffix === TRUE)
		{
			$this->suffix = $this->CI->config->item('url_suffix');
		}

		return $this;
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the pagination links
	 *
	 * @return	string
	 */
	public function create_links()
	{
		// If our item count or per-page total is zero there is no need to continue.
		// Note: DO NOT change the operator to === here!
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			return '';
		}

		// Calculate the total number of pages
		$num_pages = (int) ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($this->display_always === FALSE AND $num_pages === 1)
		{
			return '';
		}

		// Check the user defined number of links.
		$this->num_links = (int) $this->num_links;

		if ($this->num_links < 0)
		{
			show_error('Your number of links must be a non-negative number.');
		}

		// Keep any existing query string items.
		// Note: Has nothing to do with any other query string option.
		if ($this->reuse_query_string === TRUE)
		{
			$get = $this->CI->input->get();

			// Unset the controll, method, old-school routing options
			unset($get['c'], $get['m'], $get[$this->query_string_segment]);
		}
		else
		{
			$get = array();
		}

		// Put together our base and first URLs.
		// Note: DO NOT append to the properties as that would break successive calls
		$base_url = trim($this->base_url);
		$first_url = $this->first_url;

		$query_string = '';
		$query_string_sep = (strpos($base_url, '?') === FALSE) ? '?' : '&amp;';

		//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br>==============".$this->page_query_string; 

		// Are we using query strings?
		if ($this->page_query_string === TRUE)
		{
			// If a custom first_url hasn't been specified, we'll create one from
			// the base_url, but without the page item.
			if ($first_url === '')
			{
				$first_url = $base_url;

				// If we saved any GET items earlier, make sure they're appended.
				if ( ! empty($get))
				{
					$first_url .= $query_string_sep.http_build_query($get);
				}
			}

			// Add the page segment to the end of the query string, where the
			// page number will be appended.
			$base_url .= $query_string_sep.http_build_query(array_merge($get, array($this->query_string_segment => '')));
		}
		else
		{
			// Standard segment mode.
			// Generate our saved query string to append later after the page number.
			if ( ! empty($get))
			{
				$query_string = $query_string_sep.http_build_query($get);
				$this->suffix .= $query_string;
			}

			// Does the base_url have the query string in it?
			// If we're supposed to save it, remove it so we can append it later.
			if ($this->reuse_query_string === TRUE && ($base_query_pos = strpos($base_url, '?')) !== FALSE)
			{
				$base_url = substr($base_url, 0, $base_query_pos);
			}

			if ($first_url === '')
			{
				$first_url = $base_url.$query_string;
			}

			$base_url = rtrim($base_url, '/').'/';
		}

		// Determine the current page number.
		$base_page = ($this->use_page_numbers) ? 1 : 0;

		// Are we using query strings?
		if ($this->page_query_string === TRUE)
		{
			$this->cur_page = $this->CI->input->get($this->query_string_segment);
		}
		else
		{
			// Default to the last segment number if one hasn't been defined.
			if ($this->uri_segment === 0)
			{
				$this->uri_segment = count($this->CI->uri->segment_array());
			}

			$this->cur_page = $this->CI->uri->segment($this->uri_segment);

			// Remove any specified prefix/suffix from the segment.
			if ($this->prefix !== '' OR $this->suffix !== '')
			{
				$this->cur_page = str_replace(array($this->prefix, $this->suffix), '', $this->cur_page);
			}
		}

		// If something isn't quite right, back to the default base page.
		if ( ! ctype_digit($this->cur_page) OR ($this->use_page_numbers && (int) $this->cur_page === 0))
		{
			$this->cur_page = $base_page;
		}
		else
		{
			// Make sure we're using integers for comparisons later.
			$this->cur_page = (int) $this->cur_page;
		}

		// Is the page number beyond the result range?
		// If so, we show the last page.
		if ($this->use_page_numbers)
		{
			if ($this->cur_page > $num_pages)
			{
				$this->cur_page = $num_pages;
			}
		}
		elseif ($this->cur_page > $this->total_rows)
		{
			$this->cur_page = ($num_pages - 1) * $this->per_page;
		}

		$uri_page_number = $this->cur_page;

		// If we're using offset instead of page numbers, convert it
		// to a page number, so we can generate the surrounding number links.
		if ( ! $this->use_page_numbers)
		{
			$this->cur_page = (int) floor(($this->cur_page/$this->per_page) + 1);
		}

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with.
		if ($this->use_fixed_page)
		{
			$start = (ceil($this->cur_page / $this->fixed_page_num) - 1) * $this->fixed_page_num + 1 + 1; // Last plus one is for loop statement starts $start - 1
			$end   = (ceil($this->cur_page / $this->fixed_page_num) == ceil($num_pages / $this->fixed_page_num)) ? $num_pages : ceil($this->cur_page / $this->fixed_page_num) * $this->fixed_page_num;
		}
		else
		{
			$start	= (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
			$end	= (($this->cur_page + $this->num_links) < $num_pages) ? ($this->cur_page <= $this->num_links ? $this->num_links * 2 : $this->cur_page + $this->num_links - 1) : $num_pages;
			$start = $end - $start < $this->num_links * 2 ? ($end - $this->num_links * 2) + 1 : $start;
		}


		// And here we go...
		$output = '';

		// Render the "First" link.
		if ($this->first_link !== FALSE)
		{
			if ($this->display_first_always === TRUE AND $this->disable_first_link === TRUE AND $this->cur_page == 1)
			{
				$output .= $this->disabled_first_tag_open.$this->first_link.$this->disabled_first_tag_close;
			}
			else if ($this->display_first_always === TRUE OR $this->cur_page != 1)
			{
				// Take the general parameters, and squeeze this pagination-page attr in for JS frameworks.
				$attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, 1);

				$output .= $this->first_tag_open.'<a href="javascript:;"'.$attributes.$this->_attr_rel('start').' data-num=1>'.$this->first_link.'</a>'.$this->first_tag_close;
			}
		}

		// Render the "Previous" link.
		if ($this->prev_link !== FALSE)
		{
			if ($this->display_prev_always === TRUE AND $this->disable_prev_link === TRUE AND $this->cur_page == 1)
			{
				$output .= $this->disabled_prev_tag_open.$this->prev_link.$this->disabled_prev_tag_close;
			}
			else if ($this->display_prev_always === TRUE OR $this->cur_page != 1)
			{
				$i = ($this->use_page_numbers AND $first_url !== '' AND $uri_page_number == 1) ? 1 : (($this->use_page_numbers) ? $uri_page_number - 1 : $uri_page_number - $this->per_page);

				$attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, (int) $i);

				if ($i === $base_page)
				{
					// First page
					$output .= $this->prev_tag_open.'<a href="javascript:;"'.$attributes.$this->_attr_rel('prev').' data-num='.$i.'>'
						.$this->prev_link.'</a>'.$this->prev_tag_close;
				}
				else
				{
					$append = $this->prefix.$i.$this->suffix;
					$output .= $this->prev_tag_open.'<a href="javascript:;"'.$attributes.$this->_attr_rel('prev').' data-num='.$i.'>'
						.$this->prev_link.'</a>'.$this->prev_tag_close;
				}
			}
		}

		// Render the pages
		if ($this->display_pages !== FALSE)
		{
			// Write the digit links
			for ($loop = $start -1; $loop <= $end; $loop++)
			{
				$i = ($this->use_page_numbers) ? $loop : ($loop * $this->per_page) - $this->per_page;

				$attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, (int) $i);

				if ($i >= $base_page)
				{
					if ($this->cur_page == $loop)
					{
						// Current page
						$output .= $this->cur_tag_open.$loop.$this->cur_tag_close;
					}
					elseif ($i == $base_page)
					{
						// First page
						$output .= $this->num_tag_open.'<a href="javascript:;"'.$attributes.$this->_attr_rel('start').' data-num='.$i.'>'
							.$loop.'</a>'.$this->num_tag_close;
					}
					else
					{
						$append = $this->prefix.$i.$this->suffix;
						$output .= $this->num_tag_open.'<a href="javascript:;"'.$attributes.$this->_attr_rel('start').' data-num='.$i.'>'
							.$loop.'</a>'.$this->num_tag_close;
					}
				}
			}
		}

		// Render the "next" link
		if ($this->next_link !== FALSE)
		{
			if ($this->display_next_always === TRUE AND $this->disable_next_link === TRUE AND $this->cur_page == $num_pages)
			{
				$output .= $this->disabled_next_tag_open.$this->next_link.$this->disabled_next_tag_close;
			}
			else if ($this->display_next_always === TRUE OR $this->cur_page != $num_pages)
			{
				$i = ($this->use_page_numbers) ? (($this->cur_page == $num_pages)? $num_pages : $this->cur_page + 1) : $this->cur_page * $this->per_page;

				$attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, (int) $i);

				$output .= $this->next_tag_open.'<a href="javascript:;"'.$attributes
					.$this->_attr_rel('next').' data-num='.$i.'>'.$this->next_link.'</a>'.$this->next_tag_close;
			}
		}

		// Render the "Last" link
		if ($this->last_link !== FALSE)
		{
			if ($this->display_last_always === TRUE AND $this->disable_last_link === TRUE AND $this->cur_page == $num_pages)
			{
				$output .= $this->disabled_last_tag_open.$this->last_link.$this->disabled_last_tag_close;
			}
			else if ($this->display_last_always === TRUE OR $this->cur_page != $num_pages)
			{
				$i = ($this->use_page_numbers) ? $num_pages : ($num_pages * $this->per_page) - $this->per_page;

				$attributes = sprintf('%s %s="%d"', $this->_attributes, $this->data_page_attr, (int) $i);

				$output .= $this->last_tag_open.'<a href="javascript:;"'.$attributes.' data-num='.$i.'>'.$this->last_link.'</a>'.$this->last_tag_close;
			}
		}

		// Kill double slashes. Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace('#([^:])//+#', '\\1/', $output);

		// Add the wrapper HTML if exists
		return $this->full_tag_open.$output.$this->full_tag_close;
	}

	// --------------------------------------------------------------------

	/**
	 * Parse attributes
	 *
	 * @param	array	$attributes
	 * @return	void
	 */
	protected function _parse_attributes($attributes)
	{
		isset($attributes['rel']) OR $attributes['rel'] = TRUE;
		$this->_link_types = ($attributes['rel'])
			? array('start' => 'start', 'prev' => 'prev', 'next' => 'next')
			: array();
		unset($attributes['rel']);

		$this->_attributes = '';
		foreach ($attributes as $key => $value)
		{
			$this->_attributes .= ' '.$key.'="'.$value.'"';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Add "rel" attribute
	 *
	 * @link	http://www.w3.org/TR/html5/links.html#linkTypes
	 * @param	string	$type
	 * @return	string
	 */
	protected function _attr_rel($type)
	{
		if (isset($this->_link_types[$type]))
		{
			unset($this->_link_types[$type]);
			return ' rel="'.$type.'"';
		}

		return '';
	}

	function pagenation_bootstrap($page='',$totalcount='',$listsize=0,$link_url='',$segment='',$num_link='',$cate_id=0)
	{
		$total_page = ceil($totalcount/$listsize);
		$config['total_rows'] = $total_page;
		$config['per_page'] = 1; //나타낼 게시물 갯수

		$config['uri_segment'] = $segment; //page 세그먼트 위치
		$config['num_links'] = $num_link;
		$config['base_url'] = base_url().$link_url;




		//$config['reuse_query_string'] = true;
		$config['page_query_string'] = true; //쿼리 스트링


		//실제 페이지를 보여준다면
		$config['use_page_numbers'] = TRUE;

		//처음 끝으로
		$config['first_link'] = '처음';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';


		$config['last_link'] = '맨끝';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		 // 이전 다음
		 $config['next_link'] = '다음';
		 $config['next_tag_open'] = '<li>';
		 $config['next_tag_close'] = '</li>';

		 $config['prev_link'] = '이전';
		 $config['prev_tag_open'] = '<li>';
		 $config['prev_tag_close'] = '</li>';
		 // 현재 페이지
		 $config['cur_tag_open'] = " <li class='disabled'><a href='javascript:;'>";
		 $config['cur_tag_close'] = "</a></li>";

		 // 링크숫자
		 $config['num_tag_open'] = '<li item="">';
		 $config['num_tag_close'] = '</li>';

		return $config;
	}

	function pagenation($page='',$totalcount='',$listsize=0,$link_url='',$segment='',$num_link='')
	{
		$total_page = ceil($totalcount/$listsize);
		$config['total_rows'] = $total_page;
		$config['per_page'] = 1; //나타낼 게시물 갯수

		$config['uri_segment'] = $segment; //페이지 넘버  0 일 경우 나타나지 않음
		$config['num_links'] = $num_link;
		$config['base_url'] = base_url().$link_url;


		//$config['page_query_string'] = TRUE; //쿼리 스트링

		//실제 페이지를 보여준다면
		$config['use_page_numbers'] = TRUE;

		//처음 끝으로
		$config['first_link'] = '처음';
		$config['first_tag_open'] = '&nbsp;&nbsp;';
		$config['first_tag_close'] = '&nbsp;&nbsp;';


		$config['last_link'] = '맨끝';
		$config['last_tag_open'] = '&nbsp;&nbsp;';
		$config['last_tag_close'] = '&nbsp;&nbsp;';

		 // 이전 다음
		 $config['next_link'] = '다음';
		 $config['next_tag_open'] = '&nbsp;&nbsp;';
		 $config['next_tag_close'] = '&nbsp;&nbsp;';

		 $config['prev_link'] = '이전';
		 $config['prev_tag_open'] = '&nbsp;&nbsp;';
		 $config['prev_tag_close'] = '&nbsp;&nbsp;';
		 // 현재 페이지
		 $config['cur_tag_open'] = " <a href='javascript:;'>";
		 $config['cur_tag_close'] = "</a>";

		 // 링크숫자
		 $config['num_tag_open'] = '&nbsp;&nbsp;';
		 $config['num_tag_close'] = '&nbsp;&nbsp;';

		return $config;
	}

}
