$(document).ready(function () {
    const email_input_html = $('#email');
    const email_confirm_btn_html = $('#email-check-btn');
    const email_alert_html = $('#match-email-result');

    $(function () {
        email_confirm_btn_html.on('click', emailCheck);
    });

    function emailCheck() {
        const xhr = new XMLHttpRequest();
        const email_value = email_input_html.val();
        const body = { email: email_value };

        xhr.open('POST', '/signup/email');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const status = xhr.status;
                // Mozilla Firefox에서는 status === 0가 성공한 상태
                if (status === 0 || (status >= 200 && status < 400)) {
                    let response = xhr.response;
                    let alert_text = `${email_value} 는 사용 할 수 없습니다.`;

                    if (
                        xhr.getResponseHeader('Content-Type') ===
                        'application/json'
                    ) {
                        response = JSON.parse(response);
                    }

                    if (
                        response.possible &&
                        checkValidationEmail(email_value)
                    ) {
                        alert_text = `${email_value} 는 사용 가능한 아이디입니다.`;
                    }

                    email_alert_html.text(alert_text);
                }
            }
        };

        xhr.setRequestHeader(
            'X-CSRF-TOKEN',
            $('meta[name="csrf-token"]').attr('content')
        );
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send(JSON.stringify(body));
    }

    function checkValidationEmail(email_value) {
        const regexp = /^[a-zA-Z0-9+-\_.]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/g;
        if (email_value.match(regexp)) {
            return true;
        }

        return false;
    }
});
