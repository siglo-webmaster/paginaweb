<?php
	class structHTML{
		public $header;
		public $body;
		public $footer;
		public $stylesheets;
		public $scripts;
		
		function __construct($data=false){
			
			if($data!=false){
				if(isset($data['stylesheets'])){
					$this->stylesheets=$data['stylesheets'];
				}else{
					$this->stylesheets='';
				}
				if(isset($data['scripts'])){
					$this->scripts=$data['scripts'];
				}else{
					$this->scripts='';
				}
				
				if(isset($data['body'])){
					$this->body=$data['body'];
				}else{
					$this->body='';
				}
			}
                        
                        $this->setHeader();
			$this->setFooter();
			
		}
		function renderHTML(){
			return $this->header.$this->body.$this->footer;
		}
		
		function setHeader(){
                    
                                        
			$this->header = "<html>
			<head>
                        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=EmulateIE8\">
			<LINK REL=StyleSheet HREF=\"css/style_sh.css\" TYPE=\"text/css\" MEDIA=all>".
                        ' <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
                        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
                        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>'.
			"<script src=\"lib/shscripts.js\"></script>
                        <script src=\"lib/shDespachos.js\"></script>
			".$this->stylesheets."
			".$this->scripts."
                        
			</head>
			<body><div id=\"dialog\"  style='display:none;'></div>
                         <div id='headerBar' style='width:600px; height:53px;'></div>
                        ";
			return;
		}
		function setFooter(){
			$this->footer= "</body>
			</html>";
			return;
		}
		
		
	}
?>