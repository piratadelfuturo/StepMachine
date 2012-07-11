<?php

/* WebProfilerBundle:Collector:time.html.twig */
class __TwigTemplate_377fc7c9e4770c0d53ae83b7e78c7790 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "WebProfilerBundle:Profiler:layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        if ((!array_key_exists("colors", $context))) {
            // line 4
            $context["colors"] = array("default" => "#aacd4e", "section" => "#666", "event_listener" => "#3dd", "event_listener_loading" => "#add", "template" => "#dd3", "doctrine" => "#d3d", "propel" => "#f4d", "child_sections" => "#eed");
        }
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 16
    public function block_toolbar($context, array $blocks = array())
    {
        // line 17
        echo "    ";
        ob_start();
        // line 18
        echo "        <img width=\"16\" height=\"28\" alt=\"Time\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAcCAYAAABoMT8aAAABqUlEQVR42t2Vv0sCYRyHX9OmEhsMx/YKGlwLQ69DTEUSBJEQEy5J3FRc/BsuiFqEIIcQIRo6ysUhoaBBWhoaGoJwiMJLglRKrs8bXgienmkQdPDAwX2f57j3fhFJkkbiPwTK5bIiFoul3kmPud8MqKMewDXpwuGww+12n9hsNhFnlijYf/Z4PDmO45Yxo+10ZFGTyWRMEItU6AdCx7lczkgd6n7J2Wx2xm63P6jJMk6n80YQBBN1aUDv9XqvlAbbm2LE7/cLODRB0un0VveAeoDC8/waCQQC18MGQqHQOcEKvw8bcLlcL6TfYnVtCrGRAlartUUYhmn1jKg/E3USjUYfhw3E4/F7ks/nz4YNFIvFQ/ogbUYikdefyqlU6gnuOg2YK5XKvs/n+xhUDgaDTVEUt+HO04ABOBA5isViDTU5kUi81Wq1AzhWMEkDGmAEq2C3UCjcYXGauDvfEsuyUjKZbJRKpVvM8IABU9SVX+cxYABmwIE9cFqtVi9xtgvsC2AHbIAFoKey0gdlHEyDObAEWLACFsEsMALdIJ80+dK0bTS95v7+v/AJnis0eO906QwAAAAASUVORK5CYII=\"/>
        <span>";
        // line 19
        echo twig_escape_filter($this->env, sprintf("%.0f", $this->getAttribute($this->getContext($context, "collector"), "totaltime")), "html", null, true);
        echo " ms</span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 21
        echo "    ";
        ob_start();
        // line 22
        echo "        <div class=\"sf-toolbar-info-piece\">
            <b>Total time</b>
            <span>";
        // line 24
        echo twig_escape_filter($this->env, sprintf("%.0f", $this->getAttribute($this->getContext($context, "collector"), "totaltime")), "html", null, true);
        echo " ms</span>
        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 27
        echo "    ";
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => $this->getContext($context, "profiler_url"))));
    }

    // line 30
    public function block_menu($context, array $blocks = array())
    {
        // line 31
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/time.png"), "html", null, true);
        echo "\" alt=\"Timeline\" /></span>
    <strong>Timeline</strong>
</span>
";
    }

    // line 37
    public function block_panel($context, array $blocks = array())
    {
        // line 38
        echo "    <h2>Timeline</h2>

    <form id=\"timeline-control\" action=\"\" method=\"get\">
        <input type=\"hidden\" name=\"panel\" value=\"time\" />
        <table>
            <tr>
                <th style=\"width: 20%\">Total time</th>
                <td>";
        // line 45
        echo twig_escape_filter($this->env, sprintf("%.0f", $this->getAttribute($this->getContext($context, "collector"), "totaltime")), "html", null, true);
        echo " ms</td>
            </tr>
            <tr>
                <th>Initialization time</th>
                <td>";
        // line 49
        echo twig_escape_filter($this->env, sprintf("%.0f", $this->getAttribute($this->getContext($context, "collector"), "inittime")), "html", null, true);
        echo " ms</td>
            </tr>
            <tr>
                <th>Threshold</th>
                <td><input type=\"number\" size=\"3\" name=\"threshold\" value=\"1\" min=\"0\" /> ms</td>
            </tr>
        </table>
    </form>

    <h3>
        ";
        // line 59
        echo (($this->getAttribute($this->getContext($context, "profile"), "parent")) ? ("Request") : ("Main Request"));
        echo "
        <small>
            - ";
        // line 61
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "collector"), "events"), "__section__"), "totaltime"), "html", null, true);
        echo " ms
            ";
        // line 62
        if ($this->getAttribute($this->getContext($context, "profile"), "parent")) {
            // line 63
            echo "                - <a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => $this->getAttribute($this->getAttribute($this->getContext($context, "profile"), "parent"), "token"), "panel" => "time")), "html", null, true);
            echo "\">parent</a>
            ";
        }
        // line 65
        echo "        </small>
    </h3>

    ";
        // line 68
        $context["max"] = $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "collector"), "events"), "__section__"), "endtime");
        // line 69
        echo "
    ";
        // line 70
        echo twig_escape_filter($this->env, $this->getAttribute($this, "display_timeline", array(0 => ("timeline_" . $this->getContext($context, "token")), 1 => $this->getAttribute($this->getContext($context, "collector"), "events"), 2 => $this->getContext($context, "colors")), "method"), "html", null, true);
        echo "

    ";
        // line 72
        if (twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "profile"), "children"))) {
            // line 73
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "profile"), "children"));
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 74
                echo "            ";
                $context["events"] = $this->getAttribute($this->getAttribute($this->getContext($context, "child"), "getcollector", array(0 => "time"), "method"), "events");
                // line 75
                echo "            <h3>
                Sub-request \"<a href=\"";
                // line 76
                echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_profiler", array("token" => $this->getAttribute($this->getContext($context, "child"), "token"), "panel" => "time")), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "child"), "getcollector", array(0 => "request"), "method"), "requestattributes"), "get", array(0 => "_controller"), "method"), "html", null, true);
                echo "</a>\"
                <small> - ";
                // line 77
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "events"), "__section__"), "totaltime"), "html", null, true);
                echo " ms</small>
            </h3>

            ";
                // line 80
                echo twig_escape_filter($this->env, $this->getAttribute($this, "display_timeline", array(0 => ("timeline_" . $this->getAttribute($this->getContext($context, "child"), "token")), 1 => $this->getContext($context, "events"), 2 => $this->getContext($context, "colors")), "method"), "html", null, true);
                echo "
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 82
            echo "    ";
        }
        // line 83
        echo "
    <script type=\"text/javascript\">//<![CDATA[
        /**
         * In-memory key-value cache manager
         */
        var cache = new function() {
            \"use strict\";
            var dict = {};

            this.get = function(key) {
                return dict.hasOwnProperty(key)
                    ? dict[key]
                    : null;
                }

            this.set = function(key, value) {
                dict[key] = value;

                return value;
            }
        };

        /**
         * Query an element with a CSS selector.
         *
         * @param  string selector a CSS-selector-compatible query string.
         *
         * @return DOMElement|null
         */
        function query(selector)
        {
            \"use strict\";
            var key = 'SELECTOR: ' + selector;

            return cache.get(key) || cache.set(key, document.querySelector(selector));
        }

        /**
         * Canvas Manager
         */
        function CanvasManager(requests, maxRequestTime) {
            \"use strict\";

            var _drawingColors  = ";
        // line 126
        echo twig_jsonencode_filter($this->getContext($context, "colors"));
        echo ",
                _storagePrefix  = 'sf2/profiler/timeline',
                _threshold      = 1,
                _requests       = requests,
                _maxRequestTime = maxRequestTime;

            /**
             * Check whether this event is a child event.
             *
             * @return true if it is.
             */
            function isChildEvent(event)
            {
                return '__section__.child' === event.name;
            }

            /**
             * Check whether this event is categorized in 'section'.
             *
             * @return true if it is.
             */
            function isSectionEvent(event)
            {
                return 'section' === event.category;
            }

            /**
             * Get the width of the container.
             */
            function getContainerWidth()
            {
                return query('#collector_content h2').clientWidth;
            }

            /**
             * Draw one canvas.
             *
             * @param request   the request object
             * @param max       <subjected for removal>
             * @param threshold the threshold (lower bound) of the length of the timeline (in miliseconds).
             * @param width     the width of the canvas.
             */
            this.drawOne = function(request, max, threshold, width)
            {
                \"use strict\";
                var text,
                    ms,
                    xc,
                    drawableEvents,
                    mainEvents,
                    elementId    = 'timeline_' + request.id,
                    canvasHeight = 0,
                    gapPerEvent  = 38,
                    colors = _drawingColors,
                    space  = 10.5,
                    ratio  = (width - space * 2) / max,
                    h = space,
                    x = request.left * ratio + space, // position
                    canvas = cache.get(elementId) || cache.set(elementId, document.getElementById(elementId)),
                    ctx    = canvas.getContext(\"2d\");

                // Filter events whose total time is below the threshold.
                drawableEvents = request.events.filter(function(event) {
                    return event.totaltime >= threshold;
                });

                canvasHeight += gapPerEvent * drawableEvents.length;

                canvas.width  = width;
                canvas.height = canvasHeight;

                ctx.textBaseline = \"middle\";
                ctx.lineWidth = 0;

                // For each event, draw a line.
                ctx.strokeStyle = \"#dfdfdf\";

                drawableEvents.forEach(function(event) {
                    event.periods.forEach(function(period) {
                        var timelineHeadPosition = x + period.begin * ratio;

                        if (isChildEvent(event)) {
                            ctx.fillStyle = colors.child_sections;
                            ctx.fillRect(timelineHeadPosition, 0, (period.end - period.begin) * ratio, canvasHeight);
                        } else if (isSectionEvent(event)) {
                            var timelineTailPosition = x + period.end * ratio;

                            ctx.beginPath();
                            ctx.moveTo(timelineHeadPosition, 0);
                            ctx.lineTo(timelineHeadPosition, canvasHeight);
                            ctx.moveTo(timelineTailPosition, 0);
                            ctx.lineTo(timelineTailPosition, canvasHeight);
                            ctx.fill();
                            ctx.closePath();
                            ctx.stroke();
                        }
                    });
                });

                // Filter for main events.
                mainEvents = drawableEvents.filter(function(event) {
                    return ! isChildEvent(event)
                });

                // For each main event, draw the visual presentation of timelines.
                mainEvents.forEach(function(event) {

                    h += 8;

                    // For each sub event, ...
                    event.periods.forEach(function(period) {
                        // Set the drawing style.
                        ctx.fillStyle   = colors['default'];
                        ctx.strokeStyle = colors['default'];

                        if (colors[event.name]) {
                            ctx.fillStyle   = colors[event.name];
                            ctx.strokeStyle = colors[event.name];
                        } else if (colors[event.category]) {
                            ctx.fillStyle   = colors[event.category];
                            ctx.strokeStyle = colors[event.category];
                        }

                        // Draw the timeline
                        var timelineHeadPosition = x + period.begin * ratio;

                        if ( ! isSectionEvent(event)) {
                            ctx.fillRect(timelineHeadPosition, h + 3, 2, 6);
                            ctx.fillRect(timelineHeadPosition, h, (period.end - period.begin) * ratio || 2, 6);
                        } else {
                            var timelineTailPosition = x + period.end * ratio;

                            ctx.beginPath();
                            ctx.moveTo(timelineHeadPosition, h);
                            ctx.lineTo(timelineHeadPosition, h + 11);
                            ctx.lineTo(timelineHeadPosition + 8, h);
                            ctx.lineTo(timelineHeadPosition, h);
                            ctx.fill();
                            ctx.closePath();
                            ctx.stroke();

                            ctx.beginPath();
                            ctx.moveTo(timelineTailPosition, h);
                            ctx.lineTo(timelineTailPosition, h + 11);
                            ctx.lineTo(timelineTailPosition - 8, h);
                            ctx.lineTo(timelineTailPosition, h);
                            ctx.fill();
                            ctx.closePath();
                            ctx.stroke();

                            ctx.beginPath();
                            ctx.moveTo(timelineHeadPosition, h);
                            ctx.lineTo(timelineTailPosition, h);
                            ctx.lineTo(timelineTailPosition, h + 2);
                            ctx.lineTo(timelineHeadPosition, h + 2);
                            ctx.lineTo(timelineHeadPosition, h);
                            ctx.fill();
                            ctx.closePath();
                            ctx.stroke();
                        }
                    });

                    h += 30;

                    ctx.beginPath();
                    ctx.strokeStyle = \"#dfdfdf\";
                    ctx.moveTo(0, h - 10);
                    ctx.lineTo(width, h - 10);
                    ctx.closePath();
                    ctx.stroke();
                });

                h = space;

                // For each event, draw the label.
                mainEvents.forEach(function(event) {

                    ctx.fillStyle = \"#444\";
                    ctx.font = \"12px sans-serif\";
                    text = event.name;
                    ms = \" ~ \" + (event.totaltime < 1 ? event.totaltime : parseInt(event.totaltime, 10)) + \" ms\";
                    if (x + event.starttime * ratio + ctx.measureText(text + ms).width > width) {
                        ctx.textAlign = \"end\";
                        ctx.font = \"10px sans-serif\";
                        xc = x + event.endtime * ratio - 1;
                        ctx.fillText(ms, xc, h);

                        xc -= ctx.measureText(ms).width;
                        ctx.font = \"12px sans-serif\";
                        ctx.fillText(text, xc, h);
                    } else {
                        ctx.textAlign = \"start\";
                        ctx.font = \"12px sans-serif\";
                        xc = x + event.starttime * ratio + 1;
                        ctx.fillText(text, xc, h);

                        xc += ctx.measureText(text).width;
                        ctx.font = \"10px sans-serif\";
                        ctx.fillText(ms, xc, h);
                    }

                    h += gapPerEvent;
                });
            };

            this.drawAll = function(width, threshold)
            {
                \"use strict\";

                width     = width || getContainerWidth();
                threshold = threshold || this.getThreshold();

                var self = this;

                _requests.forEach(function(request) {
                    self.drawOne(request, maxRequestTime, threshold, width);
                });
            };

            this.getThreshold = function() {
                var threshold = localStorage.getItem(_storagePrefix + '/threshold');

                if (threshold === null) {
                    return _threshold;
                }

                _threshold = parseInt(threshold);

                return _threshold;
            };

            this.setThreshold = function(threshold)
            {
                _threshold = threshold;

                localStorage.setItem(_storagePrefix + '/threshold', threshold);

                return this;
            };
        };

        function canvasAutoUpdateOnResizeAndSubmit(e) {
            e.preventDefault();
            canvasManager.drawAll();
        }

        function canvasAutoUpdateOnThresholdChange(e) {
            canvasManager
                .setThreshold(query('input[name=\"threshold\"]').value)
                .drawAll();
        }

        var requests_data = {
            \"max\": ";
        // line 379
        echo twig_escape_filter($this->env, sprintf("%F", $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "collector"), "events"), "__section__"), "endtime")), "html", null, true);
        echo ",
            \"requests\": [
";
        // line 381
        echo twig_escape_filter($this->env, $this->getAttribute($this, "dump_request_data", array(0 => $this->getContext($context, "token"), 1 => $this->getContext($context, "profile"), 2 => $this->getAttribute($this->getContext($context, "collector"), "events"), 3 => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "collector"), "events"), "__section__"), "origin")), "method"), "html", null, true);
        echo "

";
        // line 383
        if (twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "profile"), "children"))) {
            // line 384
            echo "                ,
";
            // line 385
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "profile"), "children"));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                // line 386
                echo twig_escape_filter($this->env, $this->getAttribute($this, "dump_request_data", array(0 => $this->getAttribute($this->getContext($context, "child"), "token"), 1 => $this->getContext($context, "child"), 2 => $this->getAttribute($this->getAttribute($this->getContext($context, "child"), "getcollector", array(0 => "time"), "method"), "events"), 3 => $this->getAttribute($this->getAttribute($this->getAttribute($this->getContext($context, "collector"), "events"), "__section__"), "origin")), "method"), "html", null, true);
                echo (($this->getAttribute($this->getContext($context, "loop"), "last")) ? ("") : (","));
                echo "
";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
        }
        // line 389
        echo "            ]
        };

        var canvasManager = new CanvasManager(requests_data.requests, requests_data.max);

        query('input[name=\"threshold\"]').value = canvasManager.getThreshold();
        canvasManager.drawAll();

        // Update the colors of legends.
        var timelineLegends = document.querySelectorAll('.sf-profiler-timeline > .legends > span[data-color]');

        for (var i = 0; i < timelineLegends.length; ++i) {
            var timelineLegend = timelineLegends[i];

            timelineLegend.style.borderLeftColor = timelineLegend.getAttribute('data-color');
        }

        // Bind event handlers
        var elementTimelineControl  = query('#timeline-control'),
            elementThresholdControl = query('input[name=\"threshold\"]');

        window.onresize                 = canvasAutoUpdateOnResizeAndSubmit;
        elementTimelineControl.onsubmit = canvasAutoUpdateOnResizeAndSubmit;

        elementThresholdControl.onclick  = canvasAutoUpdateOnThresholdChange;
        elementThresholdControl.onchange = canvasAutoUpdateOnThresholdChange;
        elementThresholdControl.onkeyup  = canvasAutoUpdateOnThresholdChange;
        
    //]]></script>
";
    }

    // line 420
    public function getdump_request_data($token = null, $profile = null, $events = null, $origin = null)
    {
        $context = $this->env->mergeGlobals(array(
            "token" => $token,
            "profile" => $profile,
            "events" => $events,
            "origin" => $origin,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 421
            echo "                {
                    \"id\": \"";
            // line 422
            echo twig_escape_filter($this->env, $this->getContext($context, "token"), "html", null, true);
            echo "\",
                    \"left\": ";
            // line 423
            echo twig_escape_filter($this->env, sprintf("%F", ($this->getAttribute($this->getAttribute($this->getContext($context, "events"), "__section__"), "origin") - $this->getContext($context, "origin"))), "html", null, true);
            echo ",
                    \"events\": [
";
            // line 425
            echo twig_escape_filter($this->env, $this->getAttribute($this, "dump_events", array(0 => $this->getContext($context, "events")), "method"), "html", null, true);
            echo "
                    ]
                }
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 430
    public function getdump_events($events = null)
    {
        $context = $this->env->mergeGlobals(array(
            "events" => $events,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 431
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "events"));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["name"] => $context["event"]) {
                // line 432
                if (("__section__" != $this->getContext($context, "name"))) {
                    // line 433
                    echo "                        {
                            \"name\": \"";
                    // line 434
                    echo twig_escape_filter($this->env, $this->getContext($context, "name"), "html", null, true);
                    echo "\",
                            \"category\": \"";
                    // line 435
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "event"), "category"), "html", null, true);
                    echo "\",
                            \"origin\": ";
                    // line 436
                    echo twig_escape_filter($this->env, sprintf("%F", $this->getAttribute($this->getContext($context, "event"), "origin")), "html", null, true);
                    echo ",
                            \"starttime\": ";
                    // line 437
                    echo twig_escape_filter($this->env, sprintf("%F", $this->getAttribute($this->getContext($context, "event"), "starttime")), "html", null, true);
                    echo ",
                            \"endtime\": ";
                    // line 438
                    echo twig_escape_filter($this->env, sprintf("%F", $this->getAttribute($this->getContext($context, "event"), "endtime")), "html", null, true);
                    echo ",
                            \"totaltime\": ";
                    // line 439
                    echo twig_escape_filter($this->env, sprintf("%F", $this->getAttribute($this->getContext($context, "event"), "totaltime")), "html", null, true);
                    echo ",
                            \"periods\": [";
                    // line 441
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getContext($context, "event"), "periods"));
                    $context['loop'] = array(
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    );
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["period"]) {
                        // line 442
                        echo "{\"begin\": ";
                        echo twig_escape_filter($this->env, sprintf("%F", $this->getAttribute($this->getContext($context, "period"), 0)), "html", null, true);
                        echo ", \"end\": ";
                        echo twig_escape_filter($this->env, sprintf("%F", $this->getAttribute($this->getContext($context, "period"), 1)), "html", null, true);
                        echo "}";
                        echo (($this->getAttribute($this->getContext($context, "loop"), "last")) ? ("") : (", "));
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['period'], $context['_parent'], $context['loop']);
                    $context = array_merge($_parent, array_intersect_key($context, $_parent));
                    // line 444
                    echo "]
                        }";
                    // line 445
                    echo (($this->getAttribute($this->getContext($context, "loop"), "last")) ? ("") : (","));
                    echo "
";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['name'], $context['event'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    // line 450
    public function getdisplay_timeline($id = null, $events = null, $colors = null)
    {
        $context = $this->env->mergeGlobals(array(
            "id" => $id,
            "events" => $events,
            "colors" => $colors,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 451
            echo "    <div class=\"sf-profiler-timeline\">
        <div class=\"legends\">
            ";
            // line 453
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getContext($context, "colors"));
            foreach ($context['_seq'] as $context["category"] => $context["color"]) {
                // line 454
                echo "                <span data-color=\"";
                echo twig_escape_filter($this->env, $this->getContext($context, "color"), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getContext($context, "category"), "html", null, true);
                echo "</span>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['category'], $context['color'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 456
            echo "        </div>
        <canvas width=\"680\" height=\"\" id=\"";
            // line 457
            echo twig_escape_filter($this->env, $this->getContext($context, "id"), "html", null, true);
            echo "\" class=\"timeline\"></canvas>
    </div>
";
        } catch(Exception $e) {
            ob_end_clean();

            throw $e;
        }

        return ob_get_clean();
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:time.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  761 => 457,  758 => 456,  747 => 454,  743 => 453,  739 => 451,  726 => 450,  700 => 445,  697 => 444,  678 => 442,  661 => 441,  657 => 439,  653 => 438,  649 => 437,  645 => 436,  641 => 435,  637 => 434,  634 => 433,  632 => 432,  615 => 431,  604 => 430,  589 => 425,  584 => 423,  580 => 422,  577 => 421,  563 => 420,  530 => 389,  512 => 386,  495 => 385,  492 => 384,  490 => 383,  485 => 381,  480 => 379,  168 => 80,  162 => 77,  135 => 69,  122 => 63,  47 => 21,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  342 => 147,  340 => 146,  331 => 141,  328 => 140,  325 => 139,  323 => 138,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  299 => 125,  290 => 120,  287 => 119,  285 => 118,  280 => 115,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  256 => 103,  252 => 101,  245 => 97,  238 => 93,  232 => 89,  229 => 88,  219 => 83,  213 => 79,  207 => 77,  200 => 73,  191 => 68,  186 => 66,  172 => 58,  105 => 27,  101 => 25,  95 => 23,  181 => 63,  175 => 59,  165 => 60,  88 => 28,  75 => 24,  54 => 24,  167 => 56,  164 => 58,  80 => 19,  63 => 23,  60 => 27,  350 => 149,  341 => 159,  337 => 145,  334 => 157,  329 => 156,  327 => 155,  314 => 145,  307 => 141,  300 => 137,  293 => 121,  279 => 125,  272 => 121,  250 => 100,  236 => 97,  226 => 87,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 71,  190 => 72,  180 => 60,  156 => 76,  146 => 46,  133 => 68,  126 => 45,  111 => 59,  108 => 39,  84 => 29,  67 => 24,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 90,  270 => 86,  267 => 85,  264 => 84,  262 => 105,  257 => 109,  243 => 96,  239 => 77,  224 => 126,  216 => 73,  209 => 81,  205 => 76,  198 => 66,  188 => 67,  179 => 83,  177 => 60,  171 => 62,  154 => 57,  138 => 70,  97 => 34,  86 => 20,  36 => 17,  140 => 52,  127 => 45,  123 => 47,  115 => 42,  110 => 43,  85 => 28,  65 => 30,  59 => 12,  45 => 8,  103 => 41,  91 => 45,  77 => 18,  74 => 17,  70 => 22,  66 => 19,  25 => 3,  89 => 20,  82 => 38,  19 => 2,  42 => 19,  29 => 4,  26 => 3,  223 => 88,  214 => 72,  210 => 78,  203 => 84,  199 => 83,  194 => 69,  192 => 69,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 59,  152 => 48,  145 => 73,  130 => 47,  125 => 46,  119 => 45,  116 => 61,  112 => 43,  102 => 35,  98 => 49,  76 => 24,  73 => 23,  69 => 20,  32 => 5,  24 => 3,  22 => 3,  56 => 14,  23 => 3,  17 => 1,  68 => 31,  61 => 16,  44 => 11,  20 => 2,  161 => 57,  153 => 75,  150 => 74,  147 => 55,  143 => 72,  137 => 45,  129 => 51,  121 => 35,  118 => 40,  113 => 44,  104 => 37,  99 => 33,  94 => 33,  81 => 28,  78 => 24,  72 => 21,  64 => 19,  53 => 9,  50 => 22,  48 => 10,  41 => 7,  39 => 18,  35 => 7,  33 => 16,  30 => 4,  27 => 4,  182 => 70,  176 => 82,  169 => 57,  163 => 54,  160 => 53,  155 => 60,  151 => 56,  149 => 47,  141 => 43,  136 => 47,  134 => 50,  131 => 43,  128 => 65,  120 => 62,  117 => 45,  114 => 31,  109 => 38,  106 => 42,  100 => 34,  96 => 32,  93 => 31,  90 => 21,  87 => 29,  83 => 24,  79 => 37,  71 => 32,  62 => 17,  58 => 15,  55 => 16,  52 => 12,  49 => 13,  46 => 13,  43 => 12,  40 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
