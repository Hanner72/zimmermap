<!DOCTYPE html>
<html>

<head>
    <title>Navigation Grid</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script> -->
    <script type="text/javascript" src="js/jsgrid.js"></script>

    <link type="text/css" href="inc/styles.css" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <style>
            .hide
            {
                display:none;
            }
            .jsgrid, .jsgrid *, .jsgrid :after, .jsgrid :before {
                box-sizing: border-box;
                text-decoration: none !important;
            }
            .jsgrid-pager-nav-button {
                padding: .2em .6em;
                box-sizing: border-box;
                border-style: solid;
                border-width: thin;
                text-decoration: none !important;
            }
            .jsgrid-pager-current-page {
                font-weight: 700;
                color: white;
                background-color: red;
                border-style: solid;
                border-width: thin;
                border-color: black;
            }
            div#grid_table {
                margin-top: 30px;
            }
            </style>
</head>

<body>  
    
<div class="container">  
    <br />
    <div class="table-responsive">
        <h3 align="center" class="ueberschrift">Adressen für Zimmersuchende ;-)</h3>
        <h4 align="center" class="buttonadmin">Hier bitte die Adresse hinzufügen, aktualisieren oder löschen.</h4><br>
        <br><br>
        <div id="grid_table"></div>
    </div>  
    </div>
    <br>
    <a href="map.php" class="buttonweiss">Google Map</a><br><br><br>

</body>

</html>
<script>

    $('#grid_table').jsGrid({

        width: "100%",
        height: "750px",

        filtering: true,
        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 15,
        pageButtonCount: 5,
        insertedRowLocation: "top",
        deleteConfirm: "Willst du die Adresse wirklich löschen?",

        pagerFormat: "Seiten: {first} {prev} {pages} {next} {last}       {pageIndex} of {pageCount}",
        pagePrevText: "zurück",
        pageNextText: "nächste",
        pageFirstText: "erste",
        pageLastText: "letzte",
        pageNavigatorNextText: "...",
        pageNavigatorPrevText: "...",

        controller: {
            loadData: function (filter) {
                        var d = $.Deferred();
                        $.ajax({
                            type: "GET",
                            url: "fetch_data.php",
                            data: filter
                        }).done(function (response) {
                            console.log(response);
                            d.resolve(response);
                            return;
                        });
                        return d.promise();
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
                        name: "voller_name", 
                        type: "text", 
                        width: 60, 
                        validate: "required"
                    },
                    {
                        name: "addresse", 
                        type: "text", 
                        width: 80, 
                        validate: "required"
                    },
                    {
                        name: "mobil", 
                        type: "text", 
                        width: 30
                    },
                    {
                        name: "tel", 
                        type: "text", 
                        width: 30
                    },
                    {
                        name: "mail", 
                        type: "text", 
                        width: 60
                    },
                    {
                        name: "www", 
                        type: "text", 
                        width: 60
                    },
                    {
                        name: "lat", 
                        type: "text", 
                        width: 20
                    },
                    {
                        name: "lng", 
                        type: "text", 
                        width: 20
                    },
                    /* {
                        name: "kategorie", 
                        type: "text", 
                        width: 30
                    }, */
                    /* {
                        name: "mobil", 
                        type: "text", 
                        width: 50, 
                        validate: function(value)
                            {
                                if(value > 0)
                            {
                                return true;
                            }
                        }
                    }, */
                    {
                        name: "kategorie", 
                        type: "select",
                        width: 25,
                        items: [
                            { Name: "", Id: '' },
                            { Name: "Hotel", Id: 'Hotel' },
                            { Name: "Gasthaus", Id: 'Gasthaus' },
                            { Name: "Pension", Id: 'Pension' }
                        ], 
                        valueField: "Id", 
                        textField: "Name"
                    },
                    {
                        type: "control"
                    }
                ]

                });

            </script>