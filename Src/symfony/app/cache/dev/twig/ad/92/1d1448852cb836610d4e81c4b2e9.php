<?php

/* WebProfilerBundle:Profiler:base_js.html.twig */
class __TwigTemplate_ad921d1448852cb836610d4e81c4b2e9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script type=\"text/javascript\">/*<![CDATA[*/
    Sfjs = (function() {
        \"use strict\";

        var noop = function() {},
            request = function(url, onSuccess, onError, payload, options) {
                var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                options = options || {};
                xhr.open(options.method || 'GET', url, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onreadystatechange = function(state) {
                    if (4 === xhr.readyState && 200 === xhr.status) {
                        (onSuccess || noop)(xhr);
                    } else if (4 === xhr.readyState && xhr.status != 200) {
                        (onError || noop)(xhr);
                    }
                };
                xhr.send(payload || '');
            },
            hasClass = function(el, klass) {
                return el.className.match(new RegExp('\\\\b' + klass + '\\\\b'));
            },
            removeClass = function(el, klass) {
                el.className = el.className.replace(new RegExp('\\\\b' + klass + '\\\\b'), ' ');
            },
            addClass = function(el, klass) {
                if (!hasClass(el, klass)) { el.className += \" \" + klass; }
            };

        return {
            hasClass: hasClass,
            removeClass: removeClass,
            addClass: addClass,
            request: request,
            load: function(selector, url, onSuccess, onError, options) {
                var el = document.getElementById(selector);

                if (el && el.getAttribute('data-sfurl') !== url) {
                    request(
                        url,
                        function(xhr) {
                            el.innerHTML = xhr.responseText;
                            el.setAttribute('data-sfurl', url);
                            removeClass(el, 'loading');
                            (onSuccess || noop)(xhr, el);
                        },
                        function(xhr) { (onError || noop)(xhr, el); },
                        options
                    );
                }

                return this;
            },
            toggle: function(selector, elOn, elOff) {
                var i,
                    style,
                    tmp = elOn.style.display,
                    el = document.getElementById(selector);

                elOn.style.display = elOff.style.display;
                elOff.style.display = tmp;

                if (el) {
                    el.style.display = 'none' === tmp ? 'none' : 'block';
                }

                return this;
            }

        }
    })();
/*]]>*/</script>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:base_js.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  18 => 1,  21 => 3,  761 => 457,  758 => 456,  747 => 454,  743 => 453,  739 => 451,  726 => 450,  700 => 445,  697 => 444,  678 => 442,  661 => 441,  657 => 439,  653 => 438,  649 => 437,  645 => 436,  641 => 435,  637 => 434,  634 => 433,  632 => 432,  615 => 431,  604 => 430,  589 => 425,  584 => 423,  580 => 422,  577 => 421,  563 => 420,  530 => 389,  512 => 386,  495 => 385,  492 => 384,  490 => 383,  485 => 381,  480 => 379,  168 => 80,  162 => 77,  135 => 69,  122 => 63,  47 => 21,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  342 => 147,  340 => 146,  331 => 141,  328 => 140,  325 => 139,  323 => 138,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  299 => 125,  290 => 120,  287 => 119,  285 => 118,  280 => 115,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  256 => 103,  252 => 101,  245 => 97,  238 => 93,  232 => 89,  229 => 88,  219 => 83,  213 => 79,  207 => 77,  200 => 73,  191 => 68,  186 => 66,  172 => 58,  105 => 27,  101 => 25,  95 => 23,  181 => 63,  175 => 59,  165 => 60,  88 => 28,  75 => 24,  54 => 24,  167 => 56,  164 => 58,  80 => 19,  63 => 23,  60 => 27,  350 => 149,  341 => 159,  337 => 145,  334 => 157,  329 => 156,  327 => 155,  314 => 145,  307 => 141,  300 => 137,  293 => 121,  279 => 125,  272 => 121,  250 => 100,  236 => 97,  226 => 87,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 71,  190 => 72,  180 => 60,  156 => 76,  146 => 46,  133 => 68,  126 => 45,  111 => 59,  108 => 39,  84 => 29,  67 => 24,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 90,  270 => 86,  267 => 85,  264 => 84,  262 => 105,  257 => 109,  243 => 96,  239 => 77,  224 => 126,  216 => 73,  209 => 81,  205 => 76,  198 => 66,  188 => 67,  179 => 83,  177 => 60,  171 => 62,  154 => 57,  138 => 70,  97 => 34,  86 => 20,  36 => 17,  140 => 52,  127 => 45,  123 => 47,  115 => 42,  110 => 43,  85 => 28,  65 => 30,  59 => 12,  45 => 8,  103 => 41,  91 => 45,  77 => 18,  74 => 17,  70 => 22,  66 => 19,  25 => 3,  89 => 20,  82 => 38,  19 => 2,  42 => 19,  29 => 4,  26 => 3,  223 => 88,  214 => 72,  210 => 78,  203 => 84,  199 => 83,  194 => 69,  192 => 69,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 59,  152 => 48,  145 => 73,  130 => 47,  125 => 46,  119 => 45,  116 => 61,  112 => 43,  102 => 35,  98 => 49,  76 => 24,  73 => 23,  69 => 20,  32 => 8,  24 => 3,  22 => 3,  56 => 14,  23 => 3,  17 => 1,  68 => 31,  61 => 16,  44 => 12,  20 => 2,  161 => 57,  153 => 75,  150 => 74,  147 => 55,  143 => 72,  137 => 45,  129 => 51,  121 => 35,  118 => 40,  113 => 44,  104 => 37,  99 => 33,  94 => 33,  81 => 28,  78 => 24,  72 => 21,  64 => 19,  53 => 15,  50 => 22,  48 => 10,  41 => 7,  39 => 18,  35 => 7,  33 => 9,  30 => 4,  27 => 4,  182 => 70,  176 => 82,  169 => 57,  163 => 54,  160 => 53,  155 => 60,  151 => 56,  149 => 47,  141 => 43,  136 => 47,  134 => 50,  131 => 43,  128 => 65,  120 => 62,  117 => 45,  114 => 31,  109 => 38,  106 => 42,  100 => 34,  96 => 32,  93 => 31,  90 => 21,  87 => 29,  83 => 24,  79 => 37,  71 => 32,  62 => 17,  58 => 15,  55 => 16,  52 => 12,  49 => 16,  46 => 13,  43 => 13,  40 => 11,  37 => 10,  34 => 9,  31 => 4,  28 => 7,);
    }
}
