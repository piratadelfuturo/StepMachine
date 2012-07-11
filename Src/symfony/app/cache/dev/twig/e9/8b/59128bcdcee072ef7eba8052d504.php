<?php

/* WebProfilerBundle:Collector:exception.html.twig */
class __TwigTemplate_e98b59128bcdcee072ef7eba8052d504 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'head' => array($this, 'block_head'),
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
    public function block_head($context, array $blocks = array())
    {
        // line 4
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/css/exception.css"), "html", null, true);
        echo "\" />
    ";
        // line 5
        $this->displayParentBlock("head", $context, $blocks);
        echo "
";
    }

    // line 8
    public function block_menu($context, array $blocks = array())
    {
        // line 9
        echo "<span class=\"label\">
    <span class=\"icon\"><img src=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/webprofiler/images/profiler/exception.png"), "html", null, true);
        echo "\" alt=\"Exception\" /></span>
    <strong>Exception</strong>
    <span class=\"count\">
        ";
        // line 13
        if ($this->getAttribute($this->getContext($context, "collector"), "hasexception")) {
            // line 14
            echo "            <span>1</span>
        ";
        }
        // line 16
        echo "    </span>
</span>
";
    }

    // line 20
    public function block_panel($context, array $blocks = array())
    {
        // line 21
        echo "    <h2>Exception</h2>

    ";
        // line 23
        if ((!$this->getAttribute($this->getContext($context, "collector"), "hasexception"))) {
            // line 24
            echo "        <p>
            <em>No exception was thrown and uncaught during the request.</em>
        </p>
    ";
        } else {
            // line 28
            echo "        ";
            echo $this->env->getExtension('actions')->renderAction("WebProfilerBundle:Exception:show", array("exception" => $this->getAttribute($this->getContext($context, "collector"), "exception"), "format" => "html"), array());
            // line 29
            echo "    ";
        }
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:exception.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 24,  54 => 13,  167 => 59,  164 => 58,  80 => 28,  63 => 23,  60 => 16,  350 => 162,  341 => 159,  337 => 158,  334 => 157,  329 => 156,  327 => 155,  314 => 145,  307 => 141,  300 => 137,  293 => 133,  279 => 125,  272 => 121,  250 => 105,  236 => 97,  226 => 89,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 74,  190 => 72,  180 => 60,  156 => 56,  146 => 52,  133 => 47,  126 => 45,  111 => 40,  108 => 39,  84 => 29,  67 => 24,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 90,  270 => 86,  267 => 85,  264 => 84,  262 => 83,  257 => 109,  243 => 101,  239 => 77,  224 => 75,  216 => 73,  209 => 81,  205 => 69,  198 => 66,  188 => 62,  179 => 61,  177 => 60,  171 => 58,  154 => 57,  138 => 49,  97 => 34,  86 => 31,  36 => 5,  140 => 52,  127 => 45,  123 => 47,  115 => 42,  110 => 43,  85 => 28,  65 => 19,  59 => 16,  45 => 9,  103 => 41,  91 => 31,  77 => 17,  74 => 16,  70 => 22,  66 => 20,  25 => 4,  89 => 20,  82 => 27,  19 => 2,  42 => 8,  29 => 5,  26 => 3,  223 => 88,  214 => 72,  210 => 88,  203 => 84,  199 => 83,  194 => 80,  192 => 63,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 61,  152 => 54,  145 => 52,  130 => 48,  125 => 46,  119 => 45,  116 => 44,  112 => 43,  102 => 36,  98 => 40,  76 => 24,  73 => 23,  69 => 21,  32 => 6,  24 => 3,  22 => 3,  56 => 14,  23 => 3,  17 => 1,  68 => 20,  61 => 24,  44 => 11,  20 => 2,  161 => 57,  153 => 50,  150 => 56,  147 => 55,  143 => 53,  137 => 45,  129 => 51,  121 => 49,  118 => 40,  113 => 39,  104 => 37,  99 => 33,  94 => 33,  81 => 28,  78 => 24,  72 => 16,  64 => 19,  53 => 15,  50 => 15,  48 => 10,  41 => 7,  39 => 7,  35 => 7,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 62,  163 => 60,  160 => 57,  155 => 60,  151 => 56,  149 => 53,  141 => 54,  136 => 47,  134 => 50,  131 => 43,  128 => 47,  120 => 37,  117 => 43,  114 => 44,  109 => 38,  106 => 42,  100 => 35,  96 => 39,  93 => 33,  90 => 29,  87 => 29,  83 => 24,  79 => 25,  71 => 25,  62 => 17,  58 => 16,  55 => 14,  52 => 13,  49 => 12,  46 => 13,  43 => 12,  40 => 8,  37 => 9,  34 => 5,  31 => 4,  28 => 3,);
    }
}
