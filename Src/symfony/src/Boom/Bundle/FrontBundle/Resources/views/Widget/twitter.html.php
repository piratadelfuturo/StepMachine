<div class="tw-wdgt sb-bloque">
    <h3><span>twitter</span></h3>
    <script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
    <script>
        new TWTR.Widget({
            version: 2,
            type: 'profile',
            rpp: 4,
            interval: 30000,
            width: 'auto',
            height: 390,
            theme: {
                shell: {
                    background: '#ffffff',
                    color: '#000000'
                },
                tweets: {
                    background: '#ffffff',
                    color: '#000000',
                    links: '#eb6a07'
                }
            },
            features: {
                scrollbar: true,
                loop: false,
                live: true,
                behavior: 'all'
            }
        }).render().setUser('7_boom').start();
    </script></div>
