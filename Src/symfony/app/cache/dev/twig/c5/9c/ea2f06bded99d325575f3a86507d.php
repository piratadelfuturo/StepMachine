<?php

/* SensioDistributionBundle:Configurator/Step:secret.html.twig */
class __TwigTemplate_c59cea2f06bded99d325575f3a86507d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("SensioDistributionBundle::Configurator/layout.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "SensioDistributionBundle::Configurator/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "Symfony - Configure global Secret";
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "    ";
        echo $this->env->getExtension('form')->setTheme($this->getContext($context, "form"), array(0 => "SensioDistributionBundle::Configurator/form.html.twig"));
        // line 7
        echo "    ";
        $this->env->loadTemplate("SensioDistributionBundle::Configurator/steps.html.twig")->display(array_merge($context, array("index" => $this->getContext($context, "index"), "count" => $this->getContext($context, "count"))));
        // line 8
        echo "
    <h1>Global Secret</h1>
    <p>Configure the global secret for your website (the secret is used for the CSRF protection among other things):</p>

    ";
        // line 12
        echo $this->env->getExtension('form')->renderErrors($this->getContext($context, "form"));
        echo "
    <form action=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_configurator_step", array("index" => $this->getContext($context, "index"))), "html", null, true);
        echo " \" method=\"POST\">
        <div class=\"symfony-form-row\">
            ";
        // line 15
        echo $this->env->getExtension('form')->renderLabel($this->getAttribute($this->getContext($context, "form"), "secret"));
        echo "
            <div class=\"symfony-form-field\">
                ";
        // line 17
        echo $this->env->getExtension('form')->renderWidget($this->getAttribute($this->getContext($context, "form"), "secret"));
        echo "
                <a class=\"symfony-button-grey\" href=\"#\" onclick=\"generateSecret(); return false;\">Generate</a>
                <div class=\"symfony-form-errors\">
                    ";
        // line 20
        echo $this->env->getExtension('form')->renderErrors($this->getAttribute($this->getContext($context, "form"), "secret"));
        echo "
                </div>
            </div>
        </div>

        ";
        // line 25
        echo $this->env->getExtension('form')->renderRest($this->getContext($context, "form"));
        echo "

        <div class=\"symfony-form-footer\">
            <p><input type=\"submit\" value=\"Next Step\" class=\"symfony-button-grey\" /></p>
            <p>* mandatory fields</p>
        </div>

    </form>

    <script type=\"text/javascript\">
        function generateSecret()
        {
            var result = '';
            for (i=0; i < 32; i++) {
                result += Math.round(Math.random()*16).toString(16);
            }
            document.getElementById('distributionbundle_secret_step_secret').value = result;
        }
    </script>
";
    }

    public function getTemplateName()
    {
        return "SensioDistributionBundle:Configurator/Step:secret.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1154 => 329,  1148 => 328,  1142 => 327,  1136 => 326,  1130 => 325,  1124 => 324,  1118 => 323,  1112 => 322,  1106 => 321,  1090 => 315,  1083 => 314,  1081 => 313,  1078 => 312,  1055 => 308,  1030 => 307,  1028 => 306,  1025 => 305,  1013 => 300,  1009 => 299,  1004 => 298,  1002 => 297,  999 => 296,  990 => 290,  984 => 288,  981 => 287,  976 => 286,  974 => 285,  971 => 284,  964 => 279,  957 => 277,  954 => 273,  950 => 272,  947 => 271,  944 => 270,  942 => 269,  939 => 268,  931 => 264,  929 => 263,  926 => 262,  919 => 257,  916 => 256,  907 => 251,  901 => 249,  898 => 248,  894 => 243,  891 => 242,  889 => 241,  886 => 240,  878 => 236,  876 => 235,  873 => 234,  852 => 228,  849 => 227,  846 => 226,  843 => 225,  840 => 224,  837 => 223,  834 => 222,  832 => 221,  829 => 220,  821 => 214,  818 => 213,  816 => 212,  813 => 211,  805 => 207,  802 => 206,  800 => 205,  797 => 204,  789 => 200,  786 => 199,  784 => 198,  781 => 197,  773 => 193,  770 => 192,  768 => 191,  765 => 190,  757 => 186,  754 => 185,  752 => 184,  749 => 183,  741 => 179,  738 => 178,  736 => 177,  733 => 176,  725 => 172,  723 => 171,  720 => 170,  712 => 166,  709 => 165,  707 => 164,  704 => 163,  696 => 159,  693 => 158,  691 => 157,  689 => 156,  686 => 155,  679 => 150,  671 => 149,  666 => 148,  660 => 146,  655 => 144,  652 => 143,  644 => 137,  642 => 133,  631 => 130,  628 => 129,  626 => 128,  623 => 127,  614 => 121,  610 => 120,  606 => 119,  602 => 118,  597 => 117,  591 => 115,  588 => 114,  586 => 113,  583 => 112,  567 => 108,  565 => 107,  562 => 106,  546 => 102,  544 => 101,  541 => 100,  532 => 96,  520 => 94,  516 => 92,  501 => 90,  497 => 89,  489 => 87,  484 => 86,  482 => 85,  479 => 84,  470 => 79,  467 => 78,  464 => 77,  458 => 75,  456 => 74,  451 => 73,  448 => 72,  445 => 71,  439 => 69,  437 => 68,  429 => 67,  427 => 66,  424 => 65,  418 => 61,  410 => 59,  405 => 58,  401 => 57,  396 => 56,  394 => 55,  391 => 54,  382 => 49,  376 => 47,  373 => 46,  371 => 45,  356 => 39,  353 => 38,  345 => 34,  339 => 32,  336 => 31,  319 => 23,  288 => 14,  265 => 4,  258 => 329,  254 => 327,  248 => 324,  242 => 321,  234 => 312,  231 => 311,  221 => 295,  218 => 293,  211 => 268,  208 => 267,  206 => 262,  195 => 255,  193 => 240,  185 => 233,  174 => 217,  159 => 196,  144 => 175,  142 => 170,  139 => 169,  132 => 155,  124 => 142,  107 => 100,  92 => 54,  57 => 15,  260 => 234,  246 => 323,  244 => 322,  241 => 220,  222 => 204,  38 => 11,  51 => 17,  18 => 1,  21 => 3,  761 => 457,  758 => 456,  747 => 454,  743 => 453,  739 => 451,  726 => 450,  700 => 445,  697 => 444,  678 => 442,  661 => 441,  657 => 145,  653 => 438,  649 => 437,  645 => 436,  641 => 435,  637 => 132,  634 => 433,  632 => 432,  615 => 431,  604 => 430,  589 => 425,  584 => 423,  580 => 422,  577 => 421,  563 => 420,  530 => 389,  512 => 386,  495 => 385,  492 => 88,  490 => 383,  485 => 381,  480 => 379,  168 => 80,  162 => 197,  135 => 69,  122 => 127,  47 => 15,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 44,  364 => 155,  360 => 153,  358 => 40,  355 => 151,  352 => 150,  342 => 33,  340 => 146,  331 => 29,  328 => 140,  325 => 139,  323 => 24,  318 => 135,  312 => 21,  309 => 20,  306 => 129,  304 => 128,  299 => 125,  290 => 15,  287 => 119,  285 => 13,  280 => 115,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  256 => 328,  252 => 326,  245 => 97,  238 => 93,  232 => 89,  229 => 305,  219 => 83,  213 => 283,  207 => 77,  200 => 259,  191 => 68,  186 => 66,  172 => 211,  105 => 37,  101 => 25,  95 => 23,  181 => 63,  175 => 59,  165 => 60,  88 => 28,  75 => 21,  54 => 12,  167 => 204,  164 => 203,  80 => 26,  63 => 17,  60 => 14,  350 => 149,  341 => 159,  337 => 145,  334 => 30,  329 => 156,  327 => 155,  314 => 22,  307 => 141,  300 => 137,  293 => 16,  279 => 125,  272 => 121,  250 => 325,  236 => 318,  226 => 304,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 71,  190 => 239,  180 => 220,  156 => 76,  146 => 46,  133 => 68,  126 => 45,  111 => 40,  108 => 38,  84 => 43,  67 => 13,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 8,  270 => 6,  267 => 5,  264 => 84,  262 => 3,  257 => 109,  243 => 96,  239 => 320,  224 => 296,  216 => 284,  209 => 81,  205 => 76,  198 => 256,  188 => 234,  179 => 83,  177 => 219,  171 => 62,  154 => 189,  138 => 70,  97 => 65,  86 => 30,  36 => 6,  140 => 52,  127 => 143,  123 => 47,  115 => 42,  110 => 39,  85 => 33,  65 => 17,  59 => 2,  45 => 9,  103 => 41,  91 => 27,  77 => 29,  74 => 28,  70 => 18,  66 => 19,  25 => 5,  89 => 53,  82 => 38,  19 => 1,  42 => 8,  29 => 6,  26 => 3,  223 => 88,  214 => 72,  210 => 78,  203 => 261,  199 => 83,  194 => 69,  192 => 69,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 190,  152 => 183,  145 => 73,  130 => 47,  125 => 46,  119 => 126,  116 => 61,  112 => 106,  102 => 84,  98 => 36,  76 => 25,  73 => 24,  69 => 19,  32 => 5,  24 => 3,  22 => 2,  56 => 14,  23 => 3,  17 => 1,  68 => 20,  61 => 16,  44 => 12,  20 => 2,  161 => 57,  153 => 75,  150 => 74,  147 => 176,  143 => 72,  137 => 163,  129 => 154,  121 => 35,  118 => 40,  113 => 40,  104 => 99,  99 => 83,  94 => 64,  81 => 24,  78 => 24,  72 => 20,  64 => 12,  53 => 13,  50 => 18,  48 => 12,  41 => 7,  39 => 7,  35 => 7,  33 => 5,  30 => 4,  27 => 3,  182 => 231,  176 => 82,  169 => 210,  163 => 54,  160 => 53,  155 => 60,  151 => 56,  149 => 182,  141 => 43,  136 => 47,  134 => 162,  131 => 43,  128 => 65,  120 => 62,  117 => 112,  114 => 111,  109 => 105,  106 => 42,  100 => 34,  96 => 32,  93 => 28,  90 => 31,  87 => 44,  83 => 24,  79 => 37,  71 => 20,  62 => 17,  58 => 20,  55 => 14,  52 => 13,  49 => 11,  46 => 13,  43 => 8,  40 => 8,  37 => 9,  34 => 5,  31 => 4,  28 => 3,);
    }
}
