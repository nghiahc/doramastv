<script type="text/javascript">

    const divPlayer = $('#player');
    const vbWidth   = divPlayer.width();
    const vbHeight  = vbWidth / 16 * 9;
    const vastOrder = 'post';
    const vastTag   = $('input[name="vast-tag"]').val();

    const generateHtmlService = function () {
        const initServerList = function (videoSources) {
            const boxServerList = $('.server-list');

            let serverList = '';
            for (const i in videoSources) {
                if (videoSources.hasOwnProperty(i))
                    serverList += `<button class="video-server-btn" id="video-server-${i}" data-id="${i}">Servidor ${parseInt(i) + 1}</button>`;
            }

            boxServerList.html(serverList);
        };

        return {
            init: function (videoSources) {
                initServerList(videoSources);
            }
        }
    }();

    const socialAction = function () {
        const initSocialAction = function () {
            $('.social-share-buttons span img').on('click', function (e) {
                const urlButton = $(this).next('li').find('a');
                if (urlButton) {
                    urlButton.click();
                }
            })
        };

        return {
            init: function () {
                initSocialAction();
            }
        }
    }();

    const playerService = function () {
        const boxPlayerElName = 'player';

        const initPlayer = function (videoSource, videoName, videoDownloadUrl, index) {
            $('.video-server-btn').removeClass('active');
            $('#video-server-' + index).addClass('active');

            const playerSource = buildPlayerSource(videoSource, index);
            const player       = jwplayer(boxPlayerElName).setup({
                sources  : playerSource,
                primary  : 'html5',
                title    : videoName,
                height   : vbHeight,
                width    : vbWidth,
                autostart: true,
                cast     : {},
                // advertising: {
                //     client    : "vast",
                //     skipoffset: 5,
                //     schedule  : {
                //         preroll: { offset: vastOrder, tag: vastTag },
                //         midroll: { offset: "00:00:01:000", tag: vastTag }
                //     }
                // },
            });

            if (videoDownloadUrl) {
                player.addButton('/img/frontend/download.png', `Download ${videoName}`, function () {
                    window.location.href = videoDownloadUrl;
                }, 'download');
            }

            player.on("adError", function () {
                console.log("adError");
            });

            player.on("adPlay", function () {
                $("#vb_adplayer").hide();
            });

            player.on("adSkipped", function () {
                // vb_adValid();
            });

            player.on("adComplete", function () {
                // vb_adValid();
            });

            $(window).resize(function () {
                const vbWidth  = $('.left-content-player').width();
                const vbHeight = vbWidth / 16 * 9;
                player.resize(vbWidth, vbHeight);
            });

            // player.on("time", function (e) {
            //     vb_jw_error     = 3;
            //     vb_jw_mp4_error = 0;
            //     if (typeof (Storage) !== "undefined") {
            //         sessionStorage.setItem(vb_storage_key, Math.floor(e.position) + ":" + player.getDuration());
            //     }
            // });

            player.on("complete", function () {
                console.log("Play completed!");
            });

            player.on('error', function () {
                $('#box-player').html('');
            });
        };

        const changePlayerSource = function (videoSources, videoName, videoDownloadUrl) {
            $('.video-server-btn').on('click', function () {
                const index = $(this).attr('data-id');

                initPlayer(videoSources, videoName, videoDownloadUrl, index);
            });
        };

        return {
            init: function (videoSources, videoName, videoDownloadUrl, index) {
                initPlayer(videoSources, videoName, videoDownloadUrl, index);
                changePlayerSource(videoSources, videoName, videoDownloadUrl);
            }
        }
    }();

    $(document).ready(function () {
        let videoSources = document.querySelector('input[name="video-sources"]').value;
        let videoName    = document.querySelector('input[name="video-name"]').value;
        if (videoSources !== '') {
            videoSources = JSON.parse(window.atob(videoSources));

            generateHtmlService.init(videoSources);
            playerService.init(videoSources, videoName + '.mp4', null, 0);
            socialAction.init();
        }
    });

    // PRIVATE FUNCTION

    function buildPlayerSource(videoSource, index) {
        const source = videoSource[index];
        if (source === undefined) {
            return [{}];
        }

        return [source];
    }

</script>
