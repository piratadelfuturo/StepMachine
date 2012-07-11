<?php

/* WebProfilerBundle:Collector:router.html.twig */
class __TwigTemplate_30c944fb535374458390add5b81f4340 extends Twig_Template
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
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
    }

    // line 6
    public function block_menu($context, array $blocks = array())
    {
        // line 7
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/routing.png"), "html", null, true);
        echo "\" alt=\"Routing\" /></span>
    <strong>Routing</strong>
</span>
";
    }

    // line 13
    public function block_panel($context, array $blocks = array())
    {
        // line 14
        echo "    ";
        echo $this->env->getExtension('actions')->renderAction("WebProfilerBundle:Router:panel", array("token" => $this->getContext($context, "token")), array());
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 13,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  342 => 147,  340 => 146,  331 => 141,  328 => 140,  325 => 139,  323 => 138,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  299 => 125,  290 => 120,  287 => 119,  285 => 118,  280 => 115,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  256 => 103,  252 => 101,  245 => 97,  238 => 93,  232 => 89,  229 => 88,  219 => 83,  213 => 79,  207 => 77,  200 => 73,  191 => 68,  186 => 66,  172 => 58,  105 => 27,  101 => 25,  95 => 23,  181 => 63,  175 => 59,  165 => 60,  88 => 28,  75 => 24,  54 => 13,  167 => 56,  164 => 58,  80 => 19,  63 => 23,  60 => 16,  350 => 149,  341 => 159,  337 => 145,  334 => 157,  329 => 156,  327 => 155,  314 => 145,  307 => 141,  300 => 137,  293 => 121,  279 => 125,  272 => 121,  250 => 100,  236 => 97,  226 => 87,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 71,  190 => 72,  180 => 60,  156 => 56,  146 => 46,  133 => 47,  126 => 45,  111 => 40,  108 => 39,  84 => 29,  67 => 24,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 90,  270 => 86,  267 => 85,  264 => 84,  262 => 105,  257 => 109,  243 => 96,  239 => 77,  224 => 86,  216 => 73,  209 => 81,  205 => 76,  198 => 66,  188 => 67,  179 => 61,  177 => 60,  171 => 62,  154 => 57,  138 => 42,  97 => 34,  86 => 20,  36 => 7,  140 => 52,  127 => 45,  123 => 47,  115 => 42,  110 => 43,  85 => 28,  65 => 14,  59 => 12,  45 => 8,  103 => 41,  91 => 31,  77 => 18,  74 => 17,  70 => 22,  66 => 19,  25 => 4,  89 => 20,  82 => 25,  19 => 2,  42 => 10,  29 => 4,  26 => 3,  223 => 88,  214 => 72,  210 => 78,  203 => 84,  199 => 83,  194 => 69,  192 => 69,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 59,  152 => 48,  145 => 52,  130 => 47,  125 => 46,  119 => 45,  116 => 44,  112 => 43,  102 => 35,  98 => 24,  76 => 24,  73 => 23,  69 => 20,  32 => 5,  24 => 3,  22 => 3,  56 => 14,  23 => 3,  17 => 1,  68 => 15,  61 => 16,  44 => 11,  20 => 2,  161 => 57,  153 => 50,  150 => 56,  147 => 55,  143 => 57,  137 => 45,  129 => 51,  121 => 35,  118 => 40,  113 => 44,  104 => 37,  99 => 33,  94 => 33,  81 => 28,  78 => 24,  72 => 21,  64 => 19,  53 => 9,  50 => 14,  48 => 10,  41 => 7,  39 => 8,  35 => 7,  33 => 6,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 57,  163 => 54,  160 => 53,  155 => 60,  151 => 56,  149 => 47,  141 => 43,  136 => 47,  134 => 50,  131 => 43,  128 => 39,  120 => 37,  117 => 45,  114 => 31,  109 => 38,  106 => 42,  100 => 34,  96 => 32,  93 => 31,  90 => 21,  87 => 29,  83 => 24,  79 => 24,  71 => 16,  62 => 17,  58 => 15,  55 => 16,  52 => 12,  49 => 13,  46 => 13,  43 => 12,  40 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
