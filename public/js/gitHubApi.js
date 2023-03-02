$(document).ready(function () {
    showRepositories();
});

async function showRepositories() {
    const options = {
        method: 'GET'
    };

    await fetch('github/gitRepos', options)
        .then(response => response.json())
        .then(gitRepositories => {
            gitRepositories.map((gitRepository) => {
                $('table tbody').append(
                    `<tr>
                        <td>${gitRepository.fullname}</td>
                        <td>${gitRepository.url}
                    </tr>`
                );
            })
        })
}