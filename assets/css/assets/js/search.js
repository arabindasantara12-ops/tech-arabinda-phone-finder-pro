jQuery(document).ready(function ($) {

    $("#tapf-search").on("keyup", function () {

        let keyword = $(this).val();

        if (keyword.length < 2) {
            $("#tapf-result").html("");
            return;
        }

        $("#tapf-result").html("<p>Searching...</p>");

        $.ajax({
            url: tapf.ajax,
            type: "POST",
            data: {
                action: "tapf_search",
                q: keyword
            },
            success: function (response) {

                let html = "";

                if (response.length === 0) {
                    html = "<p>No smartphone found.</p>";
                } else {

                    response.forEach(function (phone) {

                        html += `
                        <div class="tapf-card">
                            <h3>${phone.brand} ${phone.model}</h3>
                            <p><strong>Processor:</strong> ${phone.processor}</p>
                            <p><strong>RAM:</strong> ${phone.ram}</p>
                            <p><strong>Storage:</strong> ${phone.storage}</p>
                            <p><strong>Battery:</strong> ${phone.battery}</p>
                            <p><strong>Price:</strong> ${phone.price}</p>
                            <a href="#" class="tapf-btn">
                                View Details
                            </a>
                        </div>
                        `;
                    });

                }

                $("#tapf-result").html(html);

            }
        });

    });

});
