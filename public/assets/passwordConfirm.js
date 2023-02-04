$(document).ready(function () {
    const password_confime_html = $('#password_confirmation');
    const password_html = $('#password');
    const password_alert_html = $('#match-password-result');

    $(function () {
        password_html.on('change', confirmPassword);
        password_confime_html.on('change', confirmPassword);
    });

    function confirmPassword() {
        if (password_confime_html.val() !== password_html.val()) {
            password_alert_html.text('비밀번호가 일치하지 않습니다.');
        } else {
            password_alert_html.text('');
        }
    }
});
