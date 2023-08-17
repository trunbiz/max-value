
<script>
    $(document).ready(function () {
        $("#siteSelect").on("change", function() {
            // Lấy giá trị đã chọn trong select đầu tiên
            var selectedSiteId = $(this).val();
            $.ajax({
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                data: {
                    site_id: selectedSiteId,
                },
                url: "{{route('administrator.zone.list')}}",
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    // Xử lý dữ liệu trả về từ yêu cầu Ajax (giả sử dữ liệu trả về là một mảng các tùy chọn)
                    var options = "";
                    response.forEach(function(zone) {
                        options += '<option value="' + zone.id + '">' + zone.name + '</option>';
                    });

                    // Cập nhật select thứ hai với các tùy chọn mới
                    $("#zoneSelect").html(options);
                    hideLoading()
                },
                error: function (err) {
                    hideLoading()
                    Swal.fire(
                        {
                            icon: 'error',
                            title: err.responseText,
                        }
                    );
                    console.log(err)
                },
            });
        });
        });
</script>
