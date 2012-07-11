<?php

/* WebProfilerBundle:Profiler:toolbar_style.html.twig */
class __TwigTemplate_55c364094aa70f5dd58fd7efc48cd8a9 extends Twig_Template
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
        echo "<style type=\"text/css\">
    .sf-toolbarreset {
        position: fixed;
        background-color: #f7f7f7;
        left: 0;
        right: 0;
        height: 38px;
        margin: 0;
        padding: 0 40px 0 0;
        z-index: 6000000;
        font: 11px Verdana, Arial, sans-serif;
        text-align: left;
        color: #2f2f2f;

        background-image: -moz-linear-gradient(-90deg, #e4e4e4, #ffffff);
        background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e4e4e4), to(#ffffff));
        bottom: 0;
        border-top: 1px solid #bbb;
    }
    .sf-toolbarreset img {
        width: auto;
        display: inline;
    }

    .sf-toolbarreset .hide-button {
        display: block;
        position: absolute;
        top: 12px;
        right: 10px;
        width: 15px;
        height: 15px;
        cursor: pointer;
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAllBMVEXDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PExMTPz8/Q0NDR0dHT09Pb29vc3Nzf39/h4eHi4uLj4+P6+vr7+/v8/Pz9/f3///+Nh2QuAAAAIXRSTlMABgwPGBswMzk8QktRV4SKjZOWmaKlq7TAxszb3urt+fy1vNEpAAAAiklEQVQIHUXBBxKCQBREwRFzDqjoGh+C2YV//8u5Sll2S0E/dof1tKdKM6GyqCto7PjZRJIS/mbSELgXOSd/BzpKIH1ZefVWpDDTHsi8mZVnwImPi5ndCLbaAZk3M58Bay0h9VbeSvMpjDUAHj4jL55AW1rxN5fU2PLjIgVRzNdxVFOlGzvnJi0Fb1XNGBHA9uQOAAAAAElFTkSuQmCC');
    }

    .sf-toolbar-block {
        white-space: nowrap;
        color: #2f2f2f;
        display: block;
        min-height: 28px;
        border-right: 1px solid #e4e4e4;
        padding: 0;
        float: left;
        cursor: default;
    }

    .sf-toolbar-block span {
        display: inline-block;
    }

    .sf-toolbar-block .sf-toolbar-info-piece {
        padding-bottom: 5px;
    }

    .sf-toolbar-block .sf-toolbar-info-piece:last-child {
        padding-bottom: 0;
    }

    .sf-toolbar-block .sf-toolbar-info-piece b {
        display: inline-block;
        width: 110px;
    }

    .sf-toolbar-block .sf-toolbar-info-with-next-pointer:after {
        content: ' :: ';
        color: #999;
    }

    .sf-toolbar-block .sf-toolbar-info-with-delimiter {
        border-right: 1px solid #999;
        padding-right: 5px;
        margin-right: 5px;
    }

    .sf-toolbar-block .sf-toolbar-info {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 1px solid #bbb;
        padding: 10px 8px;
        margin-left: -1px;

        bottom: 38px;
        border-bottom: 1px solid #fff;
    }

    .sf-toolbar-block .sf-toolbar-info:empty {
        visibility: hidden;
    }

    .sf-toolbar-block .sf-toolbar-status {
        display: inline-block;
        color: #fff;
        background-color: #666;
        padding: 3px 6px;
        border-radius: 3px;
        margin-bottom: 2px;
        vertical-align: middle;
        min-width: 6px;
        min-height: 13px;
    }

    .sf-toolbar-block .sf-toolbar-status-green {
        background-color: #759e1a;
    }

    .sf-toolbar-block .sf-toolbar-status-red {
        background-color: #a33;
    }

    .sf-toolbar-block .sf-toolbar-status-yellow {
        background-color: #ffcc00;
        color: #000;
    }

    .sf-toolbar-block .sf-toolbar-status-black {
        background-color: #000;
    }

    .sf-toolbar-block .sf-toolbar-icon {
        display: block;
    }

    .sf-toolbar-block .sf-toolbar-icon > a,
    .sf-toolbar-block .sf-toolbar-icon > span {
        display: block;
        text-decoration: none;
        margin: 0;
        padding: 5px 8px;
        min-width: 20px;
        text-align: center;
        vertical-align: middle;
    }

    .sf-toolbar-block .sf-toolbar-icon > a,
    .sf-toolbar-block .sf-toolbar-icon > a:link
    .sf-toolbar-block .sf-toolbar-icon > a:hover {
        color: black !important;
    }

    .sf-toolbar-block .sf-toolbar-icon img {
        border-width: 0;
        vertical-align: middle;
    }

    .sf-toolbar-block .sf-toolbar-icon img + span {
        margin-left: 5px;
        margin-top: 2px;
    }

    .sf-toolbar-block .sf-toolbar-icon .sf-toolbar-status {
        border-radius: 12px;
        border-bottom-left-radius: 0px;
        margin-top: 0;
    }

    .sf-toolbar-block .sf-toolbar-info-method {
        border-bottom: 1px dashed #ccc;
        cursor: help;
    }

    .sf-toolbar-block .sf-toolbar-info-method[onclick=\"\"] {
        border-bottom: none;
        cursor: inherit;
    }

    .sf-toolbar-info-php {}
    .sf-toolbar-info-php-ext {}

    .sf-toolbar-info-php-ext .sf-toolbar-status {
        margin-left: 2px;
    }

    .sf-toolbar-info-php-ext .sf-toolbar-status:first-child {
        margin-left: 0;
    }

    .sf-toolbar-block a .sf-toolbar-info-piece-additional,
    .sf-toolbar-block a .sf-toolbar-info-piece-additional-detail {
        display: inline-block;
    }

    .sf-toolbar-block a .sf-toolbar-info-piece-additional:empty,
    .sf-toolbar-block a .sf-toolbar-info-piece-additional-detail:empty {
        display: none;
    }

    .sf-toolbarreset:hover {
        box-shadow: rgba(0, 0, 0, 0.3) 0 0 50px;
    }

    .sf-toolbar-block:hover {
        box-shadow: rgba(0, 0, 0, 0.3) 0 0 5px;
    }

    .sf-toolbar-block:hover .sf-toolbar-icon {
        background-color: #fff;
    }
    .sf-toolbar-block:hover .sf-toolbar-info {
        display: block;
    }

    /***** Override the setting when the toolbar is on the top *****/
    ";
        // line 204
        if (($this->getContext($context, "position") == "top")) {
            // line 205
            echo "        .sf-toolbarreset {
            background-image: -moz-linear-gradient(-90deg, #ffffff, #e4e4e4);
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#e4e4e4));
            top: 0;
            bottom: auto;
            border-bottom: 1px solid #bbb;
        }

        .sf-toolbar-block .sf-toolbar-info {
            top: 38px;
            bottom: auto;
            border-top: 1px solid #fff;
            border-bottom: 1px solid #bbb;
        }
    ";
        }
        // line 220
        echo "
    ";
        // line 221
        if ((!$this->getContext($context, "floatable"))) {
            // line 222
            echo "        .sf-toolbarreset {
            position: static;
            background: #cbcbcb;
            background-image: -moz-linear-gradient(-90deg, #e8e8e8, #cbcbcb) !important;
            background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e8e8e8), to(#cbcbcb)) !important;
        }

        .sf-toolbarreset abbr {
            border-bottom: 1px dotted #000000;
            cursor: help;
        }
    ";
        }
        // line 234
        echo "
    /***** Media query *****/
    @media screen and (max-width: 779px) {
        .sf-toolbar-block .sf-toolbar-icon > * > :first-child ~ * {
            display: none;
        }

        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional,
        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
            display: none !important;
        }
    }

    @media screen and (min-width: 880px) {
        .sf-toolbar-block .sf-toolbar-icon a[href\$=\"config\"] .sf-toolbar-info-piece-additional {
            display: inline-block;
        }
    }

    @media screen and (min-width: 980px) {
        .sf-toolbar-block .sf-toolbar-icon a[href\$=\"security\"] .sf-toolbar-info-piece-additional {
            display: inline-block;
        }
    }

    @media screen and (max-width: 1179px) {
        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional {
            display: none;
        }
    }

    @media screen and (max-width: 1439px) {
        .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
            display: none;
        }
    }
</style>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:toolbar_style.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  260 => 234,  246 => 222,  244 => 221,  241 => 220,  222 => 204,  38 => 8,  51 => 38,  18 => 1,  21 => 3,  761 => 457,  758 => 456,  747 => 454,  743 => 453,  739 => 451,  726 => 450,  700 => 445,  697 => 444,  678 => 442,  661 => 441,  657 => 439,  653 => 438,  649 => 437,  645 => 436,  641 => 435,  637 => 434,  634 => 433,  632 => 432,  615 => 431,  604 => 430,  589 => 425,  584 => 423,  580 => 422,  577 => 421,  563 => 420,  530 => 389,  512 => 386,  495 => 385,  492 => 384,  490 => 383,  485 => 381,  480 => 379,  168 => 80,  162 => 77,  135 => 69,  122 => 63,  47 => 17,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  342 => 147,  340 => 146,  331 => 141,  328 => 140,  325 => 139,  323 => 138,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  299 => 125,  290 => 120,  287 => 119,  285 => 118,  280 => 115,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  256 => 103,  252 => 101,  245 => 97,  238 => 93,  232 => 89,  229 => 88,  219 => 83,  213 => 79,  207 => 77,  200 => 73,  191 => 68,  186 => 66,  172 => 58,  105 => 27,  101 => 25,  95 => 23,  181 => 63,  175 => 59,  165 => 60,  88 => 28,  75 => 18,  54 => 15,  167 => 56,  164 => 58,  80 => 19,  63 => 23,  60 => 25,  350 => 149,  341 => 159,  337 => 145,  334 => 157,  329 => 156,  327 => 155,  314 => 145,  307 => 141,  300 => 137,  293 => 121,  279 => 125,  272 => 121,  250 => 100,  236 => 97,  226 => 87,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 71,  190 => 72,  180 => 60,  156 => 76,  146 => 46,  133 => 68,  126 => 45,  111 => 59,  108 => 39,  84 => 29,  67 => 24,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 90,  270 => 86,  267 => 85,  264 => 84,  262 => 105,  257 => 109,  243 => 96,  239 => 77,  224 => 205,  216 => 73,  209 => 81,  205 => 76,  198 => 66,  188 => 67,  179 => 83,  177 => 60,  171 => 62,  154 => 57,  138 => 70,  97 => 34,  86 => 20,  36 => 6,  140 => 52,  127 => 45,  123 => 47,  115 => 42,  110 => 43,  85 => 28,  65 => 21,  59 => 18,  45 => 8,  103 => 41,  91 => 45,  77 => 18,  74 => 17,  70 => 22,  66 => 19,  25 => 4,  89 => 28,  82 => 27,  19 => 2,  42 => 13,  29 => 6,  26 => 3,  223 => 88,  214 => 72,  210 => 78,  203 => 84,  199 => 83,  194 => 69,  192 => 69,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 59,  152 => 48,  145 => 73,  130 => 47,  125 => 46,  119 => 45,  116 => 61,  112 => 43,  102 => 35,  98 => 49,  76 => 26,  73 => 24,  69 => 23,  32 => 8,  24 => 3,  22 => 2,  56 => 14,  23 => 3,  17 => 1,  68 => 13,  61 => 21,  44 => 12,  20 => 2,  161 => 57,  153 => 75,  150 => 74,  147 => 55,  143 => 72,  137 => 45,  129 => 51,  121 => 35,  118 => 40,  113 => 44,  104 => 37,  99 => 33,  94 => 33,  81 => 28,  78 => 24,  72 => 25,  64 => 19,  53 => 15,  50 => 18,  48 => 18,  41 => 7,  39 => 12,  35 => 7,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 82,  169 => 57,  163 => 54,  160 => 53,  155 => 60,  151 => 56,  149 => 47,  141 => 43,  136 => 47,  134 => 50,  131 => 43,  128 => 65,  120 => 62,  117 => 45,  114 => 31,  109 => 38,  106 => 42,  100 => 34,  96 => 32,  93 => 34,  90 => 21,  87 => 28,  83 => 24,  79 => 37,  71 => 32,  62 => 11,  58 => 15,  55 => 20,  52 => 19,  49 => 37,  46 => 13,  43 => 13,  40 => 8,  37 => 9,  34 => 7,  31 => 6,  28 => 7,);
    }
}
