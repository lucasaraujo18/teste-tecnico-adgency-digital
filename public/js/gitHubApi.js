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
                    </tr>`
                );
            })
        }
    });
}