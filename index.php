﻿<!DOCTYPE html>
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

    <style>
        .hide {
            display: none;
        }
    </style>
</head>

<body>

    <br>
    <a href="map.php" class="buttonweiss">Google Map</a><br><br><br>

    <div class="container">
        <br />
        <div class="table-responsive">
            <h3 align="center">Adressen für Zimmersuchende ;-)</h3>
            <h4 align="center">Hier bitte die Adresse hinzufügen, aktualisieren oder löschen.</h4><br>
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
        inserting: true,
        editing: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 20,
        pageButtonCount: 5,
        insertedRowLocation: 'top',
        deleteConfirm: "Willst du die Adresse wirklich löschen?",

        /* pagerFormat: "Seiten: {first} {prev} {pages} {next} {last}       {pageIndex} of {pageCount}",
        pagePrevText: "zurück",
        pageNextText: "nächste",
        pageFirstText: "erste",
        pageLastText: "letzte",
        pageNavigatorNextText: "...",
        pageNavigatorPrevText: "...", */

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
                            { Name: "Privat", Id: 'Privat' }
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