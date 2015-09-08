<script>
    $(function () {

        $('body').on('click', '.submit-form-edit', function () {

            var action = $(this).data('action');
            var $form_edit = $(this).closest('.form-edit').find(':input:not(.not-edit)');
            var form_data = $form_edit.serialize();

            var req = $.post(action, form_data, function (data) {

                if (data.error_code) {

                    alert(data.message);
                } else {

                    location.reload(true);
                }

            }, 'json');

            req.error(function (xhr, status, error) {

                alert("An AJAX error occured: " + status + "\nError: " + error + "\nError detail: " + xhr.responseText);
            });

            return false;
        });

        $('body').on('click', '.remove', function () {

            var $self = $(this).closest('tr');
            var $tbody = $(this).closest('tbody');
            var page = <?php echo!empty($this->params['named']['page']) ? $this->params['named']['page'] : 1 ?>;

            var choose = confirm('<?php echo __('confirm_before_delete') ?>');
            if (!choose) {

                return false;
            }
            var request = $(this).attr('href');
            $self.hide();
            var req = $.post(request, {}, function (data) {

                if (data.error_code) {

                    alert(data.message);
                    $self.show();
                } else {

                    if ($tbody.find('tr:visible').length <= 0) {

                        // thực hiện điều hướng tới trang page trước đó
                        if (page > 1) {

                            var redirect = location.href;
                            redirect = redirect.replace('page:' + page, 'page:' + (page - 1));
                            location.replace(redirect);
                        } else {

                            location.reload(true);
                        }
                    }
                }

            }, 'json');

            req.error(function (xhr, status, error) {

                alert("An AJAX error occured: " + status + "\nError: " + error + "\nError detail: " + xhr.responseText);
                $self.show();
            });

            return false;
        });

        $('.check-all').on('change', function () {

            if ($(this).prop('checked')) {

                $(this).closest('table').find('.check').prop('checked', true);
            }
            else {

                $(this).closest('table').find('.check').prop('checked', false);
            }
        });

        $('form.update-many').on('submit', function () {

            if ($('.check:checked').length <= 0) {

                return false;
            }

            var object_id = [];
            $('.check:checked').each(function () {

                object_id.push($(this).val());
            });

            $(this).find('.object_id').val(JSON.stringify(object_id));
        });
    });
</script>