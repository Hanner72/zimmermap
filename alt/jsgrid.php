<!DOCTYPE html>
    <html>
    <head>
        <title>Navigation Grid</title>          
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="jsgrid/jsgrid.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="jsgrid/jsgrid-theme.min.css" />
        <script src="jsgrid/jsgrid.min.js" type="text/javascript"></script>

        <style>
            .hide
            {
                display:none;
            }
            </style>
                </head>  
                <body>  
                    <div class="container">  
            <br />
            <div class="table-responsive">  
                <h3 align="center">Inline Table Insert Update Delete in PHP using jsGrid</h3><br />
                <div id="grid_table"></div>
            </div>  
            </div>
                </body>  
            </html>  
            <script>
            
                $('#grid_table').jsGrid({

                width: "100%",
                height: "870px",

                filtering: true,
                inserting:true,
                editing: true,
                sorting: true,
                paging: true,
                autoload: true,
                pageSize: 20,
                pageButtonCount: 5,
                deleteConfirm: "Willst du die Adresse wirklich löschen?",

                pagerFormat: "Seiten: {first} {prev} {pages} {next} {last}       {pageIndex} of {pageCount}",
                pagePrevText: "zurück",
                pageNextText: "nächste",
                pageFirstText: "erste",
                pageLastText: "letzte",
                pageNavigatorNextText: "...",
                pageNavigatorPrevText: "...",

                controller: {
                loadData: function(filter){
                return $.ajax({
                    type: "GET",
                    url: "fetch_data.php",
                    data: filter
                });
                },
                insertItem: function(item){
                return $.ajax({
                    type: "POST",
                    url: "fetch_data.php",
                    data:item
                });
                },
                updateItem: function(item){
                return $.ajax({
                    type: "PUT",
                    url: "fetch_data.php",
                    data: item
                });
                },
                deleteItem: function(item){
                return $.ajax({
                    type: "DELETE",
                    url: "fetch_data.php",
                    data: item
                });
                },
                },

                fields: [
                {
                name: "id",
                type: "hidden",
                css: 'hide'
                },
                {
                name: "first_name", 
                type: "text", 
                width: 150, 
                validate: "required"
                },
                {
                name: "last_name", 
                type: "text", 
                width: 150, 
                validate: "required"
                },
                {
                name: "age", 
                type: "text", 
                width: 50, 
                validate: function(value)
                {
                if(value > 0)
                {
                return true;
                }
                }
                },
                {
                name: "gender", 
                type: "select", 
                items: [
                { Name: "", Id: '' },
                { Name: "Male", Id: 'male' },
                { Name: "Female", Id: 'female' }
                ], 
                valueField: "Id", 
                textField: "Name", 
                validate: "required"
                },
                {
                type: "control"
                }
                ]

                });

            </script>