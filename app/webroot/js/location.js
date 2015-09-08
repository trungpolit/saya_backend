$(function () {
        $(".select-ajax").select2({
                tag: true,
                ajax: {
                        type: 'POST',
                        dataType: 'json',
                        delay: 0,
                        data: function (params) {
                                return {
                                        name: params.term,
                                        country: $("#Country").val(),
                                        region: $("#Region").val(),
                                        location: $("#Location").val()
                                };
                        },
                        processResults: function (data) {
                                // check input region, but doesnt input contry, return false
                                if (data.type == 'Region') {
                                        if (!$("#Country").val()) {
                                                return false;
                                        }
                                        $('#Location').find('option').remove();
                                }
                                if (data.type == 'Country') {
                                        $('#Region').find('option').remove();
                                }

                                // return data
                                return {
                                        results: data.items
                                };
                        }
                },
                escapeMarkup: function (markup) {
                        return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo, // omitted for brevity, see the source of this page
                templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        function formatRepo(repo) {
                if (repo.loading) {
                        return repo.text;
                }
                if (repo.name != $("#select2-Country-container").text()) {
                        var markup = '<div class="clearfix">' +
                                '<div clas="col-sm-12">' + repo.name + '</div>';
                        markup += '</div>';
                        return markup;
                }
        }

        function formatRepoSelection(repo) {
                return repo.name;
        }
        $('.select2-selection__rendered').each(function (index) {
                $(this).text($(this).attr('title'));
        });
});

function addRoom() {
        $.ajax({
                url: ROOT_URL + 'Hotels/addRoom',
                success: function (data) {
                        $('#rooms').append(data);
                }
        });
}

function addPrice() {
        $.ajax({
                url: ROOT_URL + 'Prices/addRoom',
                success: function (data) {
                        $('#rooms').append(data);
                }
        });
}

function addStream() {
        $.ajax({
                url: ROOT_URL + 'Streamings/addStream',
                success: function (data) {
                        $('#rooms').append(data);
                }
        });
}

function addTime() {
        $.ajax({
                url: ROOT_URL + 'Restaurants/addTime',
                success: function (data) {
                        $('#times').append(data);
                }
        });
}

$(document).ready(function () {
//        $('.dataTable').dataTable();
});