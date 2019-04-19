<script type="text/javascript">

    const keywordEl = document.getElementById('keyword');

    const searchService = function () {
        const initSearch = function () {

            const searchForm = $('#form-search');
            searchForm.on('submit', function (e) {
                e.preventDefault();

                const keyword = keywordEl.value;
                if (keyword !== '') {
                    const url = searchForm.attr('action') + '?' + searchForm.serialize();
                    window.location.replace(url);
                } else {
                    alert('Please enter keyword...');
                }
            })
        };

        const initSearchBtn = function () {
            const searchBtn = $('.search-icon');

            searchBtn.on('click', function () {
                $(this).parents('form').submit();
            });
        };

        return {
            init: function () {
                initSearch();
                initSearchBtn();
            }
        }
    }();

    $(document).ready(function () {
        searchService.init();
    });

</script>
