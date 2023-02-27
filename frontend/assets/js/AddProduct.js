$(document).ready(function(e)
{
    /*  Flash Inputs Placeholder of AddProduct Form when focus */
    $('[placeholder]').focus(function (){
        $(this).attr('data-text', $(this).attr('placeholder'));
        $(this).attr('placeholder', '');
    }).blur(function (){
        $(this).attr('placeholder', $(this).attr('data-text'));
    });

    /*  Show the selected Product type only */
    $('#productType').change(function (){
        $("div .type").hide();
        $('div .type :input').removeAttr('required');
        var id = $(this).children(":selected").attr('id');
        //Set all product attributes opacity to 1.
        $('.attribute').fadeTo('', 1);
        $("div #"+id+" :input").attr("required", 'required');
        $("div #" + id).fadeIn(500).find('.attribute').fadeTo(3000, 0.5);
    });

    /*
        Start Input Validation Process using regex
        ------------------------------------
        - First get all the input in our document
        - Second we define our input fields regex, based on I don't know on what -_-
        - Define our simple validate function
        - Iterate over all the form input fields, and on input change we apply our validation function.
          User may enter invalid data, so we will disable the form submission after that, but if you notice at line 106 I have enabled the form submission.
          I have done that because, if the user came back to correct the input data, we need to enable the button again at that point.
     */
    const inputs = document.querySelectorAll('input');
    const patterns = {
        // sku, name allow letters and digits only, no special characters, and no character length limit
        sku: /^[a-z\d]+$/i,
        name: /^[a-z\d]+$/i,
        // price, size, width, height, length, weight allow digits only, no special characters, and no digit length limit
        price: /^\d+$/,
        size: /^\d+$/,
        width: /^\d+$/,
        height: /^\d+$/,
        length: /^\d+$/,
        weight: /^\d+$/,
    };

    //Validation function
    function validateInputs(field, regex) {
        if (field.attributes.name.value === "sku") {
            $.ajax({
                type: "POST",
                url: '/checkSku',
                data: {val: field.value},
                success: function (response) {
                    if (response !== 'exist' && regex.test(field.value)) {
                        field.className = 'valid form-control ';
                    } else {
                        //if not passed, Add to the input tag invalid class
                        field.className = 'invalid form-control';
                    }
                },
            });
        } else {
            if (regex.test(field.value)) {
                //if passed, Add to the input tag valid class
                field.className = 'valid form-control ';
            } else {
                //if not passed, Add to the input tag invalid class
                field.className = 'invalid form-control';
            }
        }
    }

    inputs.forEach((input) => {
        input.addEventListener("change", (e) => {
            validateInputs(e.target, patterns[e.target.attributes.name.value]);
            if($(input).attr('class').startsWith('valid')){
                $('button').attr('disabled', false);
            }
        });
    });


    //Here we disable the form submission if inputs is invalid
    $('button').on('click', function (e){
        var a = document.forms["Form"]["sku"].value;
        var b = document.forms["Form"]["name"].value;
        var c = document.forms["Form"]["price"].value;
        var d = document.forms["Form"]["type"].value;
        var error = '';
        if (a == null || a === "") {
            error += 'Please Fill Product Sku\n'
        } if (b == null || b === "") {
            error += 'Please Fill Product Name\n'
        } if (c == null || c === "") {
            error += 'Please Fill Product Price\n'
        } if (d == null || d === "") {
            error += 'Please Fill Product Type\n'
        }
        if (error) {
            alert(error);
        }
        $("form").find('input').each(function() {
            if($(this).attr('class').startsWith('invalid')){
                $('button').attr('disabled', true);
                e.preventDefault();
            }
        });
    });

    $(".alert").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert").slideUp(500);
    });
});