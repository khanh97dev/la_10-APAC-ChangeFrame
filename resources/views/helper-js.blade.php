<script>
    function toKebabCase(str) {
        return str.replace(/([a-z])([A-Z])/g, '$1-$2').toLowerCase();
    }

    function getCurrentURL() {
        return new URL(window.location.href);
    }

    function updatePagination(pagination) {
        let url = new URL(window.location.href);
        let params = new URLSearchParams(url.search);

        for(key in pagination) {
            const keyQuery = toKebabCase(key);
            const inRequestTable = @json(IN_REQUEST_TABLE);
            if (inRequestTable.includes(keyQuery)) {
                params.set(toKebabCase(keyQuery), pagination[key]);
            }
        }

        url.search = params.toString();
        window.history.replaceState({}, '', url.href);
    }
</script>
