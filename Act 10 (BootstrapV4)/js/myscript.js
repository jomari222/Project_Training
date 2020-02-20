/**
 * Created by Jomari Garcia on 12/23/2019.
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

$(document).ready(function()
{
    $('#table_employee').DataTable
    ({
        responsive: true,
        "pageLength": 10,
        "lengthMenu": [[10, 20], [10, 20]],
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
    $('#table_employee_wrapper .dataTables_filter').find('input').each(function ()
    {
        const $this = $(this);
        $this.addClass('form-control-sm');
    });
    $('#table_employee_wrapper .dataTables_filter').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblSearch");
    });
    $('#table_employee_wrapper .dataTables_length').find('label').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "lblShow");
    });
    $('#table_employee_wrapper .dataTables_length').find('select').each(function ()
    {
        const $this = $(this);
        $this.attr("id", "slcEntries");
        $this.addClass('btn btn-info');
    });
} );

function hide_unhide()
{
    var y = document.getElementById("dvchangepassword");
    var x = document.getElementById("dvmainpage");

    if (x.style.display === "none")
    {
        x.style.display = "block";
        y.style.display = "none";
    }
    else
    {
        x.style.display = "none";
        y.style.display = "block";
    }
}

function search()
{
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("txtSearch");
    filter = input.value.toUpperCase();
    table = document.getElementById("table_employee");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++)
    {
        td = tr[i].getElementsByTagName("td")[1];
        if (td)
        {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1)
            {
                tr[i].style.display = "";
            }
            else
            {
                tr[i].style.display = "none";
            }
        }
    }
}

function AvoidSpace(event)
{
    var k = event ? event.which : window.event.keyCode;
    if (k === 32)
    {
        return false;
    }
}


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
function togglePasswordmain()
{
    var passtype = document.getElementById("txtPasswordmain");
    if (passtype.type === "password")
    {
        passtype.type = "text";
    }
    else
    {
        passtype.type = "password";
    }
}
function togglePasswordnew()
{
    var passtype = document.getElementById("txtNewPassword");
    if (passtype.type === "password")
    {
        passtype.type = "text";
    }
    else
    {
        passtype.type = "password";
    }
}



