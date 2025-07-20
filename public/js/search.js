$(document).ready(function () {
    $('#search').on('input', function () {     // Id: search (textbox)
        if ($(this).val() == "") {          // If textbox is empty
            $('#results').html("");                // Id: result, clear this div
            return;
        }
        else {
            console.log("Inputting");
            let query = $(this).val();
            $.ajax({
                url: 'php/search.php',
                type: 'POST',
                data: { query: query },
                success: function (data) {
                    $('#results').html(data);

                    $('.result-item').on('click', function () {
                        const name = $(this).find('h4').text();
                        $('#search').val(name); // Optional: fill in input
                        $('#results').empty();  // Hide after click
                    });
                }
            });
            console.log("Got data");
        }
    });
});