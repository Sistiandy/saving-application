<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array('per_page' => 10,
                'uri_segment' => 4,
                'use_page_numbers' => FALSE,
                'full_tag_open' => '<ul class="pagination pagination-sm">',
                'full_tag_close' => '</ul>',
                'next_link' => 'Next &rarr;',
                'next_tag_open' => '<li>',
                'num_tag_open' => '<li>',
                'prev_link' => '&larr; Previous',
                'prev_tag_open' => '<li>',
                'first_tag_open' => '<li>',
                'last_tag_open' => '<li>',
                'next_tag_close' => '</li>',
                'num_tag_close' => '</li>',
                'prev_tag_close' => '</li>',
                'first_tag_close' => '</li>',
                'last_tag_close' => '</li>',
                'cur_tag_open' => "<li class='disabled'><li class='active'><a href='#'>",
                'cur_tag_close' => "<span class='sr-only'></span></a></li>"
                );

/* End of file pagination.php */
/* Location: ./application/config/pagination.php */
