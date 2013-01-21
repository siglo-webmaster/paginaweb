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
			<LINK REL=StyleSheet HREF=\"css/style_sh.css\" TYPE=\"text/css\" MEDIA=all>
			<script src=\"lib/prettyPhoto_3.1.3/js/jquery-1.6.1.min.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
                        <link rel=\"stylesheet\" href=\"lib/prettyPhoto_3.1.3/css/prettyPhoto.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\" />
                        <script src=\"lib/prettyPhoto_3.1.3/js/jquery.prettyPhoto.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
                        <script src=\"lib/jquery.endless-scroll.js\" type=\"text/javascript\" charset=\"utf-8\"></script>
                        
			".$this->stylesheets."
			".$this->scripts.
                         '<script type="text/javascript" charset="utf-8">

                                // using default options
                                $(document).endlessScroll();
                                // using some custom options
                                $(document).endlessScroll({
                                        pagesToKeep: null,
                                        inflowPixels: 0,
                                        fireOnce: false,
                                        fireDelay: false,
                                        insertBefore: "#list div:first",
                                        insertAfter: "#list div:last",
                                        loader: \'Cargando ...\',
                                        intervalFrequency : 0,
                                        ceaseFireOnEmpty:false,
                                        callback:function(fireSequence,pageSequence,scrollDirection){
                                        // alert("fireSequence = "+fireSequence);
                                        // alert("pageSequence = " + pageSequence);
                                        // alert("scrollDirection = " +scrollDirection);
                                        // var $offset =($(\'#list\').attr(\'alt\') * 1) + 10 ;
                                            $.ajax({type: "GET", url: "load.php?page="+pageSequence, cache: false, dataType: "text",success: function($data) {
                                                    if($data!=\'false\'){
                                                        $(\'#list\').append($data);
                                                    // $(\'#list\').attr(\'alt\',((1*$offset)));
                                                    // return $data;
                                                }


                                            }});

                                        }
                                });

                            </script>'."
			</head>
			<body>";
			return;
		}
		function setFooter(){
			$this->footer= "
			</body>
			</html>";
			return;
		}
		
		
	}
?>