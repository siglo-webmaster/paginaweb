<?php
	class classshCalendar{

		public $data;
                public $scripts;
                
		function __construct($data=false){
			if($data!=false){
				$this->data = $data;
			}
                        $this->scripts="<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"lib/calendar/jsDatePick_ltr.min.css\" />
                                    <script type=\"text/javascript\" src=\"lib/calendar/jsDatePick.min.1.3.js\"></script>";
                        $this->setScript();
                        $this->renderCalendar();
		}
		
		function setScript(){
                    $params='';
                    foreach($this->data as $key=>$value){
                        $params.=$key.":'".$value."',";
                    }
                    $params= rtrim($params,',');
			$this->scripts.= "<script type=\"text/javascript\">
				window.onload = function(){
					g_globalObject = new JsDatePick({
						".$params."
						
					});
				};
			</script>";
                        return true;
		}
                
                function renderCalendar(){
                    $this->data = "<input type=\"text\" size=\"12\" id=\"".$this->data['target']."\" />";
                    return true;
                }
	}
?>