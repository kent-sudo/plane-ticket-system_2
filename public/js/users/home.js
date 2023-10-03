$(document).ready(function() {
    // 获取 CSRF token
    var token = $('meta[name="csrf-token"]').attr('content');

    // 设置全局的 AJAX 请求头部
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    // 处理转让按钮点击事件
    $('.transfer-button').click(function() {
        var ticketUrl = $(this).data('ticket-url');
    
        // 显示 SweetAlert 确认对话框
        Swal.fire({
            title: '確定要轉讓嗎？',
            text: '轉讓操作無法撤銷。',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '確定',
            cancelButtonText: '取消'
        }).then((result) => {
            // 如果用户确认转让，发送 AJAX 请求
            if (result.isConfirmed) {
                // 发送 POST 请求
                $.ajax({
                    url: ticketUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        // 如果有其他需要传递的参数，可以在这里添加
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            Swal.fire(data.title, data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(data.title, data.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('错误', '发生了一个错误', 'error');
                    }
                });
            }
        });
    });
});