<script>


    function handleDelete(event) {
        const target = event.target;
        if (confirm(target.getAttribute('data-message-to-delete'))) {
            fetch(target.getAttribute('data-href'), {
                    method: 'DELETE',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": '{{ csrf_token() }}'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status) {
                        location.reload();
                    }
                });
        }
    }
</script>
