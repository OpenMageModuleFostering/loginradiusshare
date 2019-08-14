<?php
 class Loginradius_Sharing_Model_Source_SharingCount
 {
    public function toOptionArray()
    {
		$result = array();
        $result[] = array('value' => 'page', 'label'=>'Page Level <a style="text-decoration:none; margin-right:15px" href="javascript:void(0)" title="Number of times an individual page is shared" >(?)</a>');
	    $result[] = array('value' => 'website', 'label'=>'Website Level <a style="text-decoration:none" href="javascript:void(0)" title="Sum total of all pages. Number of times all the pages of website are shared" >(?)</a>');
	 	return $result;  
  	} 	
 }