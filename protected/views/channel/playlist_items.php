<div style="position:relative" style="min-height:120px\">
    <a class="prevb" id="foo5_prev" href="#"><span>prev</span></a>               

    <a class="nextb" id="foo5_next" href="#" style="right:-22px;"><span>next</span></a>               

<?                                                                                                                                                    Yii::app()->clientScript->scriptMap = array(
            'style.css'     => false,
        );
                                                                                                                           
echo '<div class="image_carousel" style=\"min-height:120px;\"><div id="titlecarousel" style=\"min-height:120px;\">';                                                                                                                                                                                                                    
foreach ((array)$model->playlist->Items as $title) {                                                                                                                                                                                                                                            
  $thumb = $title->video->thumbnail_url;

  echo  CHtml::image($thumb, $title->video->title,array("width" => 110, "height" => 150));                                                                                                              }?>                          

</div></div>                 

    <div class="clearfix"></div>                    


    <div class="paginationc" id="foo5_pag"></div>   



<?                           
  // Using custom configuration
  $this->widget('ext.carousel.ECarouFredSel', array(  
						    'id' => 'carousel',        
						    'target' => '#titlecarousel',                           


						    'config' => array(         
								      'circular' => true,        
								      'infinite' => false,       
								      'items' => 5,              
								      "auto"=> false,            
								      "prev"=> array(            
										     "button"=> "#foo5_prev",                
										     "key"=> "left",                         
										     "items"=>1,
										     "easing"=>false,                        
										     "duration"=> 500,                       
																																				),         
								      "next"=> array(                           
										     "button"=> "#foo5_next",   
										     "key"=> "right",           
										     "items"=> 1,               
										     "easing"=> false,          
										     "duration"=> 500,          
																																		  ),                         
								      "pagination"  => array(    
											     "container"=> "#foo5_pag",       
											     "keys"=> true,                   
                   "duration"=>300                 
																																				)   



																																	      ))       
		);







?>
</div>