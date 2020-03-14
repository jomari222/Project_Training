/**
 * Created by Jomari Garcia on 1/25/2020.
 */
// Disable form submissions if there are invalid fields
(function()
{
    'use strict';
    window.addEventListener('load', function()
    {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form)
        {
            form.addEventListener('submit', function(event)
            {
                if (form.checkValidity() === false)
                {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
//Show Product
function showProduct(product_id)
{
    if (product_id == "")
    {
        document.getElementById("txtAmount").value = "";
        return;
    }
    else
    {
        if (window.XMLHttpRequest)
        {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else
        {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("txt_Amount").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","./includes/get_product.php?product_id="+product_id,true);
        xmlhttp.send();
    }
}
//Inventory Table
$(document).ready(function()
{
    $('#table_Inventory').DataTable
    ({
        responsive: true,
        "pageLength": 5,
        "lengthMenu": [[5, 10], [5, 10]],
        "sPaginationType": "full_numbers",
        language: {
            paginate: {
                next: '<i class="fa fa-step-forward" data-toggle="tooltip" data-placement="right" title="Next"></i>',
                previous: '<i class="fa fa-step-backward" data-toggle="tooltip" data-placement="left" title="Previous"></i>',
                first: '<i class="fa fa-fast-backward" data-toggle="tooltip" data-placement="left" title="Start"></i>',
                last: '<i class="fa fa-fast-forward" data-toggle="tooltip" data-placement="right" title="End"></i>'
            }
        }
    } );
    $('#table_Inventory_wrapper .dataTables_filter').find('input').each(function ()
    {
        const $this = $(this);
        $this.addClass('form-control-sm');
    });
    $('#table_Inventory_wrapper .dataTables_filter').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblSearch");
    });
    $('#table_Inventory_wrapper .dataTables_length').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblShow");
    });
    $('#table_Inventory_wrapper .dataTables_length').find('select').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "slcEntries");
        $this.addClass('btn btn-dark');
    });
} );
//Orders Table
$(document).ready(function()
{
    $('#table_orders').DataTable
    ({
        responsive: true,
        "pageLength": 5,
        "lengthMenu": [[5, 10], [5, 10]],
        "sPaginationType": "full_numbers",
        language: {
            paginate: {
                next: '<i class="fa fa-step-forward" data-toggle="tooltip" data-placement="right" title="Next"></i>',
                previous: '<i class="fa fa-step-backward" data-toggle="tooltip" data-placement="left" title="Previous"></i>',
                first: '<i class="fa fa-fast-backward" data-toggle="tooltip" data-placement="left" title="Start"></i>',
                last: '<i class="fa fa-fast-forward" data-toggle="tooltip" data-placement="right" title="End"></i>'
            }
        }
    } );
    $('#table_orders_wrapper .dataTables_filter').find('input').each(function ()
    {
        const $this = $(this);
        $this.addClass('form-control-sm');
    });
    $('#table_orders_wrapper .dataTables_filter').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblSearch_orders");
    });
    $('#table_orders_wrapper .dataTables_length').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblShow_orders");
    });
    $('#table_orders_wrapper .dataTables_length').find('select').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "slcEntries_orders");
        $this.addClass('btn btn-dark');
    });
} );

//Transactions Table
$(document).ready(function()
{
    $('#table_Transactions').DataTable
    ({
        responsive: true,
        "pageLength": 5,
        "lengthMenu": [[5, 10], [5, 10]],
        "sPaginationType": "full_numbers",
        language: {
            paginate: {
                next: '<i class="fa fa-step-forward" data-toggle="tooltip" data-placement="right" title="Next"></i>',
                previous: '<i class="fa fa-step-backward" data-toggle="tooltip" data-placement="left" title="Previous"></i>',
                first: '<i class="fa fa-fast-backward" data-toggle="tooltip" data-placement="left" title="Start"></i>',
                last: '<i class="fa fa-fast-forward" data-toggle="tooltip" data-placement="right" title="End"></i>'
            }
        }
    } );
    $('#table_Transactions_wrapper .dataTables_filter').find('input').each(function ()
    {
        const $this = $(this);
        $this.addClass('form-control-sm');
    });
    $('#table_Transactions_wrapper .dataTables_filter').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblSearch_Transactions");
    });
    $('#table_Transactions_wrapper .dataTables_length').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblShow_Transactions");
    });
    $('#table_Transactions_wrapper .dataTables_length').find('select').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "slcEntries_Transactions");
        $this.addClass('btn btn-dark');
    });
} );
////////////////////////////////////////
$(document).ready(function()
{
    $('#table_Address').DataTable
    ({
        responsive: true,
        "pageLength": 5,
        "lengthMenu": [[5, 10], [5, 10]],
        "sPaginationType": "full_numbers",
        language: {
            paginate: {
                next: '<i class="fa fa-step-forward" data-toggle="tooltip" data-placement="right" title="Next"></i>',
                previous: '<i class="fa fa-step-backward" data-toggle="tooltip" data-placement="left" title="Previous"></i>',
                first: '<i class="fa fa-fast-backward" data-toggle="tooltip" data-placement="left" title="Start"></i>',
                last: '<i class="fa fa-fast-forward" data-toggle="tooltip" data-placement="right" title="End"></i>'
            }
        }
    } );
    $('#table_Address_wrapper .dataTables_filter').find('input').each(function ()
    {
        const $this = $(this);
        $this.addClass('form-control-sm');
    });
    $('#table_Address_wrapper .dataTables_filter').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblSearch_Address");
    });
    $('#table_Address_wrapper .dataTables_length').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblShow_Address");
    });
    $('#table_Address_wrapper .dataTables_length').find('select').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "slcEntries_Address");
        $this.addClass('btn btn-info');
    });
} );
//Expenses Table
$(document).ready(function()
{
    $('#table_Expenses').DataTable
    ({
        responsive: true,
        "pageLength": 5,
        "lengthMenu": [[5, 10], [5, 10]],
        "sPaginationType": "full_numbers",
        language: {
            paginate: {
                next: '<i class="fa fa-step-forward" data-toggle="tooltip" data-placement="right" title="Next"></i>',
                previous: '<i class="fa fa-step-backward" data-toggle="tooltip" data-placement="left" title="Previous"></i>',
                first: '<i class="fa fa-fast-backward" data-toggle="tooltip" data-placement="left" title="Start"></i>',
                last: '<i class="fa fa-fast-forward" data-toggle="tooltip" data-placement="right" title="End"></i>'
            }
        }
    } );
    $('#table_Expenses_wrapper .dataTables_filter').find('input').each(function ()
    {
        const $this = $(this);
        $this.addClass('form-control-sm');
    });
    $('#table_Expenses_wrapper .dataTables_filter').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblSearch_Expenses");
    });
    $('#table_Expenses_wrapper .dataTables_length').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblShow_Expenses");
    });
    $('#table_Expenses_wrapper .dataTables_length').find('select').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "slcEntries_Expenses");
        $this.addClass('btn btn-dark');
    });
} );
function AvoidSpace(event)
{
    var k = event ? event.which : window.event.keyCode;
    if (k === 32)
    {
        return false;
    }
    table_Transactions
}

$(document).ready(function()
{
    var regionOptions = '';
    var provinceOptions = '';
    var citymunOptions = '';
    var brgyOptions = '';
    var addressOption = '';

    //Region
    $.getJSON('js/refregion.json', function(data)
    {
        regionOptions = '<option value="">Select Region</option>';
        provinceOptions = '<option value="">Select Province</option>';
        citymunOptions = '<option value="">Select Municipality</option>';
        brgyOptions = '<option value="">Select Barangay</option>';
        addressOption = '';
        $.each(data, function(key, region)
        {
            regionOptions += '<option value="'+region.regCode+'">'+region.regDesc+'</option>';
        });
        $('#slc_region').html(regionOptions);
        $('#slc_province').html(provinceOptions);
        $('#slc_citymun').html(citymunOptions);
        $('#slc_brgy').html(brgyOptions);
        document.getElementById("txtAddress").disabled = true;
        document.getElementById("txtAddress").value = "";
    });
    //Province
    $(document).on('change', '#slc_region', function()
    {
        var region_id = $(this).val();
        if(region_id != '')
        {
            $.getJSON('js/refprovince.json', function(data)
            {
                provinceOptions = '<option value="">Select Province</option>';
                $.each(data, function(key, province)
                {
                    if(region_id == province.regCode)
                    {
                        document.getElementById("slc_province").disabled = false;
                        document.getElementById("txtAddress").value = "";
                        provinceOptions += '<option value="'+province.provCode+'">'+province.provDesc+'</option>';
                    }
                });
                $('#slc_province').html(provinceOptions);
            });
        }
        if(region_id == 'Select Region')
        {
            $('#slc_citymun').html('<option value="">Select Municipality</option>');
            $('#slc_brgy').html('<option value="">Select Barangay</option>');
            document.getElementById("txtAddress").value = "";
            document.getElementById("txtAddress").disabled = true;
            document.getElementById("slc_citymun").disabled = true;
            document.getElementById("slc_brgy").disabled = true;
        }
        else
        {
            $('#slc_province').html('<option value="">Select Province</option>');
            $('#slc_citymun').html('<option value="">Select Municipality</option>');
            $('#slc_brgy').html('<option value="">Select Barangay</option>');
            document.getElementById("txtAddress").disabled = true;
            document.getElementById("slc_province").disabled = true;
            document.getElementById("slc_citymun").disabled = true;
            document.getElementById("slc_brgy").disabled = true;
            document.getElementById("txtAddress").value = "";
        }
    });
    //City/Municipality
    $(document).on('change', '#slc_province', function()
    {
        var province_id = $(this).val();
        if(province_id != '')
        {
            $.getJSON('js/refcitymun.json', function(data)
            {
                citymunOptions = '<option value="">Select Municipality</option>';
                $.each(data, function(key, citymun)
                {
                    if(province_id == citymun.provCode)
                    {
                        document.getElementById("slc_citymun").disabled = false;
                        document.getElementById("txtAddress").value = "";
                        citymunOptions += '<option value="'+citymun.citymunCode+'">'+citymun.citymunDesc+'</option>';
                    }
                });
                $('#slc_citymun').html(citymunOptions);
            });
        }
        if(province_id == 'Select Province')
        {
            $('#slc_brgy').html('<option value="">Select Barangay</option>');
            document.getElementById("txtAddress").value = "";
            document.getElementById("slc_brgy").disabled = true;
            document.getElementById("txtAddress").disabled = true;
        }
        else
        {
            document.getElementById("slc_citymun").disabled = true;
            document.getElementById("slc_brgy").disabled = true;
            document.getElementById("txtAddress").disabled = true;
            $('#slc_citymun').html('<option value="">Select Municipality</option>');
            $('#slc_brgy').html('<option value="">Select Barangay</option>');
            document.getElementById("txtAddress").value = "";
        }
    });
    //Barangay
    $(document).on('change', '#slc_citymun', function()
    {
        var citymun_id = $(this).val();
        if(citymun_id != '')
        {
            $.getJSON('js/refbrgy.json', function(data)
            {
                brgyOptions = '<option value="">Select Barangay</option>';
                $.each(data, function(key, brgy)
                {
                    if(citymun_id == brgy.citymunCode)
                    {
                        document.getElementById("txtAddress").value = "";
                        document.getElementById("slc_brgy").disabled = false;
                        brgyOptions += '<option value="'+brgy.brgyCode+'">'+brgy.brgyDesc+'</option>';
                    }
                });
                $('#slc_brgy').html(brgyOptions);
            });
        }
        if(citymun_id == 'Select Municipality')
        {
            document.getElementById("txtAddress").value = "";
            document.getElementById("txtAddress").disabled = true;
        }
        else
        {
            document.getElementById("slc_brgy").disabled = true;
            document.getElementById("txtAddress").disabled = true;
            $('#slc_brgy').html('<option value="">Select Barangay</option>');
            document.getElementById("txtAddress").value = "";
        }
    });
    //Address
    $(document).on('change', '#slc_brgy', function()
    {
        var brgy_id = $(this).val();
        if(brgy_id != '')
        {
            document.getElementById("txtAddress").disabled = false;
            document.getElementById("txtAddress").value = "";
        }
        else
        {
            document.getElementById("txtAddress").value = "";
            document.getElementById("txtAddress").disabled = true;
        }
    });
});
$(document).ready(function()
{
    $(document).on('change', '#slc_product', function ()
    {
        var txtAmount = $(this).val();
        if (txtAmount == "")
        {
            document.getElementById("txtQty").disabled = true;
            document.getElementById("txtQty").value = "";
            document.getElementById("txtTotalAmount").value = "";
        }
        else
        {
            document.getElementById("txtQty").disabled = false;
            document.getElementById("txtQty").value = "0";
            document.getElementById("txtTotalAmount").value = "0";
        }
    });
});

$(document).ready(function()
{
    $(document).on('change', '#slc_product_inventory', function ()
    {
        var slcProduct = $(this).val();
        if (slcProduct == "")
        {
            document.getElementById("txtNewPrice").disabled = true;
            document.getElementById("txtAdd_Stock").disabled = true;
            document.getElementById("btnAdd_Stock").disabled = true;
            document.getElementById("btnMinus_Stock").disabled = true;
            document.getElementById("btnChangePrice").disabled = true;
            document.getElementById("txtPrice").value = "";
        }
        else
        {
            document.getElementById("txtNewPrice").disabled = false;
            document.getElementById("txtAdd_Stock").disabled = false;
            document.getElementById("btnAdd_Stock").disabled = false;
            document.getElementById("btnMinus_Stock").disabled = false;
            document.getElementById("btnChangePrice").disabled = false;
        }
    });
});

$(document).ready(function()
{
    $(document).on('change', '#slc_product_inventory_change_price', function ()
    {
        var slcProduct = $(this).val();
        if (slcProduct == "")
        {
            document.getElementById("txtNewPrice").disabled = true;
            document.getElementById("btnChangePrice").disabled = true;
        }
        else
        {
            document.getElementById("txtNewPrice").disabled = false;
            document.getElementById("btnChangePrice").disabled = false;
        }
    });
});

$(document).ready(function()
{
    $(document).on('change', '#slc_product_inventory_add_or_remove_stock', function ()
    {
        var slcProduct = $(this).val();
        if (slcProduct == "")
        {
            document.getElementById("txtAdd_Stock").disabled = true;
            document.getElementById("btnAdd_Stock").disabled = true;
            document.getElementById("btnMinus_Stock").disabled = true;
        }
        else
        {
            document.getElementById("txtAdd_Stock").disabled = false;
            document.getElementById("btnAdd_Stock").disabled = false;
            document.getElementById("btnMinus_Stock").disabled = false;
        }
    });
});


function multiply_qty_amount()
{
    var amount = document.getElementById("txtAmount").value;
    var quantity = document.getElementById("txtQty").value;
    var total = "";

    if(amount == "")
    {
        document.getElementById("txtTotalAmount").value = "";
    }
    else
    {
        total = amount * quantity;
        document.getElementById("txtTotalAmount").value = total;
    }
}

function preventNumberInput(e){
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode > 47 && keyCode < 58){
        e.preventDefault();
    }
}

$(document).ready(function(){
    $('#txtFirst_name').keypress(function(e) {
        preventNumberInput(e);
        /*return (event.charCode > 64 &&
         event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)*/
    });
    $('#txtLast_name').keypress(function(e) {
        preventNumberInput(e);
        /*return (event.charCode > 64 &&
            event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)*/
    });
});

function togglePassword()
{
    var passtype = document.getElementById("txtPassword");
    if (passtype.type === "password")
    {
        passtype.type = "text";
    }
    else
    {
        passtype.type = "password";
    }
}