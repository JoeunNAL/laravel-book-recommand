$(document).ready(function () {
    const log_btn_html = $('.active-log-search-btn');
    const log_table_body_html = $('#log-table');

    log_btn_html.on('click', getLogList);

    function getLogList(event) {
        const url = event.target.dataset.route;
        const xhr = new XMLHttpRequest();

        xhr.open('GET', url, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const status = xhr.status;
                // Mozilla Firefox에서는 status === 0가 성공한 상태
                if (status === 0 || (status >= 200 && status < 400)) {
                    let response = xhr.response;

                    if (
                        xhr.getResponseHeader('Content-Type') ===
                        'application/json'
                    ) {
                        response = JSON.parse(response);
                    }

                    log_table_body_html.empty();
                    response.logs.forEach(appendRowHtml);
                }
            }
        };
        xhr.setRequestHeader('Content-type', 'application/json');
        xhr.send();
    }

    function appendRowHtml(log) {
        const row_html = `<tr>
                            <td scope='row'>${log.created_at}</td>
                            <td>${log.history}</td>
                        </tr>`;
        log_table_body_html.append(row_html);
    }
});
