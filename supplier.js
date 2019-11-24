$(document).ready(function () {
    $("#add_product").hide();
    
    $("#add_product_button").click(function () {
        $("#add_product").toggle();
    });


  var url = "products_example.xml";    // CHANGE
  // ***** does NOT work with Chrome since it is from file system, not web server
  // Microsoft Edge is fine

  /* Chrome error message:
    jqxdata.js:8 Access to XMLHttpRequest at 'file:///C:/Users/Alex/Documents/GitHub/CraftLink/products_example.xml?filterscount=0&groupscount=0&pagenum=0&pagesize=10&recordstartindex=0&recordendindex=10&_=1571023167018'
    from origin 'null' has been blocked by CORS policy: Cross origin requests are only supported for protocol schemes: http, data, chrome, chrome-extension, https.
  */

  // prepare the data
  // var source =
  // {
  //     datatype: "xml",          // JSON or XML ???
  //     datafields: [
  //         { name: 'ProductName', type: 'string' },
  //         { name: 'QuantityPerUnit', type: 'int' },
  //         { name: 'UnitPrice', type: 'float' },
  //         { name: 'UnitsInStock', type: 'float' },
  //         { name: 'Discontinued', type: 'bool' }
  //     ],
  //     root: "Products",
  //     record: "Product",
  //     id: 'ProductID',
  //     url: url
  // };
  //
  // var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
  //     if (value < 20) {
  //         return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
  //     }
  //     else {
  //         return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
  //     }
  // }
  //
  // var dataAdapter = new $.jqx.dataAdapter(source, {
  //     downloadComplete: function (data, status, xhr) { },
  //     loadComplete: function (data) { },
  //     loadError: function (xhr, status, error) { }
  // });
  //
  // // initialize jqxGrid
  // $("#grid").jqxGrid(
  // {
  //     width: getWidth('Grid'),
  //     source: dataAdapter,
  //     pageable: true,
  //     autoheight: true,
  //     sortable: true,
  //     altrows: true,
  //     enabletooltips: true,
  //     editable: true,
  //     selectionmode: 'multiplecellsadvanced',
  //     columns: [
  //       { text: 'Product Name', columngroup: 'ProductDetails', datafield: 'ProductName', width: 250 },
  //       { text: 'Quantity per Unit', columngroup: 'ProductDetails', datafield: 'QuantityPerUnit', cellsalign: 'right', align: 'right', width: 200 },
  //       { text: 'Unit Price', columngroup: 'ProductDetails', datafield: 'UnitPrice', align: 'right', cellsalign: 'right', cellsformat: 'c2', width: 200 },
  //       { text: 'Units In Stock', datafield: 'UnitsInStock', cellsalign: 'right', cellsrenderer: cellsrenderer, width: 100 },
  //       { text: 'Discontinued', columntype: 'checkbox', datafield: 'Discontinued' }
  //     ],
  //     columngroups: [
  //         { text: 'Product Details', align: 'center', name: 'ProductDetails' }
  //     ]
  // });
});
