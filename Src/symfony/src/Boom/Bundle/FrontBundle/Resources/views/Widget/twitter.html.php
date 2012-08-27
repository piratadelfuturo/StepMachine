<div class="tw-wdgt sb-bloque">
    <h3><span>twitter</span></h3>
    <script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
    <script>
        new TWTR.Widget({
            version: 2,
            type: 'profile',
            rpp: 4,
            interval: 30000,
            width: 250,
            height: 300,
            theme: {
                shell: {
                    background: '#333333',
                    color: '#ffffff'
                },
                tweets: {
                    background: '#000000',
                    color: '#ffffff',
                    links: '#4aed05'
                }
            },
            features: {
                scrollbar: false,
                loop: true,
                live: true,
                behavior: 'default'
            }
        }).render().setUser('7_boom').start();
    </script>
</div>
