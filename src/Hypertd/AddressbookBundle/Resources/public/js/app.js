$(document).ready(function(){
	webix.markup.namespace = "ui";
	webix.markup.dataTag = "item";
	webix.markup.init(); 

	var grid = $$('contactTable');

	$('#myfilter').keyup(function(){
		console.log(this.value);
		var text = this.value;

        if (!text) return grid.filter();
 
        grid.filter(function(obj){  //grid is a dataTable instance
          	if (typeof obj.id != 'undefined'){
        		if(obj.id.toString().indexOf(text) !== -1) return true
        	};
        	
        	if (typeof obj.firstname != 'undefined'){
        		if(obj.firstname.toString().indexOf(text) !== -1) return true
        	};
        	
        	if (typeof obj.lastname != 'undefined'){
        		if(obj.lastname.toString().indexOf(text) !== -1) return true
        	};
        	
        	if (typeof obj.address_1 != 'undefined'){
        		if(obj.address_1.toString().indexOf(text) !== -1) return true
        	};
        	
        	if (typeof obj.address_2 != 'undefined'){
        		if(obj.address_2.toString().indexOf(text) !== -1) return true
        	};
        	
        	if (typeof obj.city != 'undefined'){
        		if(obj.city.toString().indexOf(text) !== -1) return true
        	};
        	
        	if (typeof obj.tel_home != 'undefined'){
        		if(obj.tel_home.toString().indexOf(text) !== -1) return true
        	};
        	
        	if (typeof obj.tel_mobile != 'undefined'){
        		if(obj.tel_mobile.toString().indexOf(text) !== -1) return true
        	};
        	
        	return false;
        })
	});

	$$('addBtn').attachEvent("onItemClick",function(){
    	var add_window = webix.ui({
				view:"window",
				id:"add_win",
				height:380,
			    width:340,
			    left:450, top:50,
			    padding:10,
			    modal:true,
			    head:{
					view:"toolbar", cols:[
						{ view:"label"},
						{ view:"button", label: 'Close', width: 100, align: 'right', click:"$$('add_win').close();"}
						]
				}
				,
				body:{
					view:"form", 
					id:"add_form",
					elements:[
				        { name:"firstname", view:"text", label:"First Name"},
				        { name:"lastname", view:"text", label:"Last Name"},
				        { name:"address_1", view:"text", label:"Address 1"},
				        { name:"address_2", view:"text", label:"Address 2"},
				        { name:"city", view:"text", label:"City"},
				        { name:"postal", view:"text", label:"Postal"},
				        { name:"tel_home", view:"text", label:"Home #"},
				        { name:"tel_mobile", view:"text", label:"Mobile #"},
				        { margin:5, cols:[
		                    { view:"button", value:"Add" , type:"form", click: function(){       	
		                    	var values = $$('add_form').getValues();
		                    	values.id = parseInt(grid.getLastId()) + 1;

		                    	webix.ajax().post("/addressbook/contact/create", values, function(){
		                    		grid.load("/addressbook/contact");
		                    	});
		                    	//grid.add(values);
		                    	$$('add_win').close();
		                    }},
		                    { view:"button", value:"Cancel", click:"$$('add_win').close();"}
                    	]}
       			    ]
				}
		}).show();
	});


	$$('editBtn').attachEvent("onItemClick",function(){

		var sel = grid.getSelectedId();
		var row = grid.getItem(sel.row);

		var edit_window = webix.ui({
				view:"window",
				id:"edit_win",
				height:380,
			    width:340,
			    left:450, top:50,
			    padding:10,
			    modal:true,
			    head:{
					view:"toolbar", cols:[
						{ view:"label"},
						{ view:"button", label: 'Close', width: 100, align: 'right', click:"$$('edit_win').close();"}
						]
				}
				,
				body:{
					view:"form", 
					id:"edit_form",
					elements:[
				        { name:"firstname", view:"text", label:"First Name", value: row.firstname},
				        { name:"lastname", view:"text", label:"Last Name", value: row.lastname},
				        { name:"address_1", view:"text", label:"Address 1", value: row.address_1},
				        { name:"address_2", view:"text", label:"Address 2", value: row.address_2},
				        { name:"city", view:"text", label:"City", value: row.city},
				        { name:"postal", view:"text", label:"Postal", value: row.postal},
				        { name:"tel_home", view:"text", label:"Home #", value: row.tel_home},
				        { name:"tel_mobile", view:"text", label:"Mobile #", value: row.tel_mobile},
				        { margin:5, cols:[
		                    { view:"button", value:"Update" , type:"form", click: function(){       	
		                    	var values = $$('edit_form').getValues();
		                    	values.id = sel.id;

		      					webix.ajax().post("/addressbook/contact/update", values, function(){
		                    		grid.load("/addressbook/contact");
		                    	});

		                    	$$('edit_win').close();
		                    }},
		                    { view:"button", value:"Cancel", click:"$$('edit_win').close();" }
                    	]}
       			    ]
				}
		}).show();
	});

	$$('deleteBtn').attachEvent("onItemClick",function(){
		var sel = grid.getSelectedId();

		var values = {}
		values.id = sel.id;

		$.ajax({
		  type: "POST",
		  url: "/addressbook/contact/delete",
		  data: values
		})
		.done(function( msg ) {
			grid.remove(sel);
		    grid.load("/addressbook/contact");
		    
		});
	});
});