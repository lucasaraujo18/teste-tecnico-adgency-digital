$(document).ready(function () {
    showRepositories();
});

async function showRepositories() {
    $.ajax({
        type: "GET",
        url: "github/gitRepos",
        success: function (response) {
            response.map((data) => {
                $('table tbody').append(
                    `<tr>
                        <td>${data.full_name}</td>
                        <td>${data.url}
                        <td class="action-table-buttons">
                            <button class="specific" onClick="connect(${data.full_name}, ${data.url})">Conectar a um site</button>
                        </td>
                    </tr>`
                );
            })
        }
    });
}