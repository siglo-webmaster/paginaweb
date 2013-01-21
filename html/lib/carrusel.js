stepcarousel.setup({
	galleryid: 'mygallery', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	autostep: {enable:true, moveby:1, pause:1000},
	panelbehavior: {speed:5000, wraparound:true, wrapbehavior:'slide', persist:false},
	defaultbuttons: {enable: false},
	contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
})