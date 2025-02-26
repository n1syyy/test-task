'use strict';

$(document).ready(function() {

    // if #lead-form exists then proceed
    if ($("#lead-form").length) {
        const phoneInput = document.querySelector("#phone");
        
        const iti = window.intlTelInput(phoneInput, { // initialize intl-tel-input on the phone input
            initialCountry: "auto", // Determine user country automatically
            separateDialCode: true, // Show country code separately 
            nationalMode: false, // Disables input of full number
            geoIpLookup: function (callback) {
                // Get country code from IP
                fetch("https://ipapi.co/json")
                    .then(res => res.json())
                    .then(data => callback(data.country_code))
                    .catch(() => callback("us")); // default option if ip lookup fails
            },
            loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.0/build/js/utils.js"),
        });

        // custom method to validate 'lettersonly' fields
        $.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-zA-Zа-яА-Я]+$/.test(value);
        }, "Only letters allowed");

        // custom method to validate 'phone' field
        $.validator.addMethod("validPhone", function(value, element) {
            return iti.isValidNumber();
        }, "Enter a valid phone number");

        // lead form initialization
        $("#lead-form").validate({
            // Specify validation rules
            rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            firstname: {
                required: true,
                lettersonly: true,
                minlength: 2
            },
            lastname: {
                required: true,
                lettersonly: true,
                minlength: 2
            },
            email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true
            },
            phone: {
                required: true,
                validPhone: true
            }
            },
            // Specify validation error messages
            messages: {
                firstname: {
                    required: "First name is required",
                    lettersonly: "Only letters allowed"
                },
                lastname: {
                    required: "Last name is required",
                    lettersonly: "Only letters allowed"
                },
                phone: {
                    required: "Phone number is required",
                    validPhone: "Enter a valid phone number"
                },
                email: {
                    required: "Email is required",
                    email: "Enter a valid email address"
                }
            }
            
        });

        // Add lead with AJAX
        $('#submit-btn').on('click', function(e) {
            e.preventDefault(); // Отменяем стандартное поведение формы

            let fullPhoneInput = $("#fullPhone");
            fullPhoneInput.val(iti.getNumber()); // Adding full number (with country code) to the hidden input
            
            if ($("#lead-form").valid()) {
                let responseMessage = $("#responseMessage");

                $.ajax({
                    url: '../api/lead_submit.php',
                    type: 'POST',
                    data: $("#lead-form").serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status) {
                            responseMessage.text("Lead was successfully sent! ID: " + response.id).css("color", "green");
                            $("#lead-form")[0].reset();
                        } else {
                            responseMessage.text("Error: " + response.error).css("color", "red");
                        }
                    },
                    error: function() {
                        responseMessage.text("An unexpected error occurred.").css("color", "red");
                    }
                });
            }
            
        });
    }

    // if #lead-filter exists then proceed
    if ($('#lead-filter').length) {
        
        // Filter leads with AJAX
        $('#filter-submit').on('click', function(e) {
            e.preventDefault(); 

            const dateFrom = $("input[name='date_from']").val();
            const dateTo = $("input[name='date_to']").val();

            $.ajax({
                url: '../api/lead_filter.php',
                type: 'POST',
                data: {
                    date_from: dateFrom,
                    date_to: dateTo
                },
                dataType: 'json',
                success: function(response) {
                    const tbody = $('#leads-table-body');
                    tbody.empty();

                    if (response.status) {
                        response.data.forEach(lead => {
                            tbody.append(`<tr>
                                <td>${lead.id}</td>
                                <td>${lead.email}</td>
                                <td>${lead.status}</td>
                                <td>${lead.ftd}</td>
                            </tr>`);
                        });
                    } else {
                        tbody.append(`<tr><td colspan="4">Error: ${response.error}</td></tr>`);
                    }
                },
                error: function() {
                    alert("An unexpected error occurred.");
                }
            });
        });   
    }

});