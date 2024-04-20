document.addEventListener('DOMContentLoaded', function() {
    setupPaginationListener();

    function setupPaginationListener() {
        const pagination = document.querySelector('.pagination');
        if (pagination) {
            pagination.addEventListener('click', function(e) {
                e.preventDefault();

                if (e.target.tagName === 'A' && !e.target.parentElement.classList.contains('disabled')) {
                    const url = e.target.getAttribute('href');
                    fetchUsers(url);
                }
            });
        }
    }

    function fetchUsers(url) {
        axios.get(url)
            .then(response => {
                const parser = new DOMParser();
                const newDocument = parser.parseFromString(response.data, 'text/html');
                const userList = newDocument.getElementById('user-list');
                document.getElementById('user-list').innerHTML = userList.innerHTML;

                // Scroll to the top of the user list
                document.getElementById('user-list').scrollIntoView({ behavior: 'smooth' });
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    }
});
