<script type="text/javascript">
    const movieService = function () {
        const initRedirectMovie = function () {
            $('a.redirect-movie').on('click', function (e) {
                e.preventDefault();

                const form = $(this).parents('form');
                form.submit();
            });
        };

        return {
            init: function () {
                initRedirectMovie();
            }
        }
    }();

    $(document).ready(function () {
        console.log('vao day ');
        movieService.init();
    });
</script>
