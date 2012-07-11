<?php

/* WebProfilerBundle:Collector:memory.html.twig */
class __TwigTemplate_b4d52e2b4782457fb7a3b82637421f99 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("WebProfilerBundle:Profiler:layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
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
        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        <span>
            <img width=\"13\" height=\"28\" alt=\"Memory Usage\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAcBAMAAABITyhxAAAAJ1BMVEXNzc3///////////////////////8/Pz////////////+NjY0/Pz9lMO+OAAAADHRSTlMAABAgMDhAWXCvv9e8JUuyAAAAQ0lEQVQI12MQBAMBBmLpMwoMDAw6BxjOOABpHyCdAKRzsNDp5eXl1KBh5oHBAYY9YHoDQ+cqIFjZwGCaBgSpBrjcCwCZgkUHKKvX+wAAAABJRU5ErkJggg==\"/>
            <span>";
        // line 7
        echo twig_escape_filter($this->env, sprintf("%.1f", (($this->getAttribute($this->getContext($context, "collector"), "memory") / 1024) / 1024)), "html", null, true);
        echo " MB</span>
        </span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 10
        echo "    ";
        ob_start();
        // line 11
        echo "        <div class=\"sf-toolbar-info-piece\">
            <b>Memory usage</b>
            <span>";
        // line 13
        echo twig_escape_filter($this->env, sprintf("%.1f", (($this->getAttribute($this->getContext($context, "collector"), "memory") / 1024) / 1024)), "html", null, true);
        echo " MB</span>
        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 16
        echo "    ";
        $this->env->loadTemplate("WebProfilerBundle:Profiler:toolbar_item.html.twig")->display(array_merge($context, array("link" => false)));
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Collector:memory.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  181 => 67,  175 => 64,  165 => 60,  88 => 28,  75 => 24,  54 => 13,  167 => 59,  164 => 58,  80 => 28,  63 => 23,  60 => 16,  350 => 162,  341 => 159,  337 => 158,  334 => 157,  329 => 156,  327 => 155,  314 => 145,  307 => 141,  300 => 137,  293 => 133,  279 => 125,  272 => 121,  250 => 105,  236 => 97,  226 => 89,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 71,  190 => 72,  180 => 60,  156 => 56,  146 => 58,  133 => 47,  126 => 45,  111 => 40,  108 => 39,  84 => 29,  67 => 24,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 90,  270 => 86,  267 => 85,  264 => 84,  262 => 83,  257 => 109,  243 => 101,  239 => 77,  224 => 75,  216 => 73,  209 => 81,  205 => 69,  198 => 66,  188 => 62,  179 => 61,  177 => 60,  171 => 62,  154 => 57,  138 => 49,  97 => 34,  86 => 31,  36 => 7,  140 => 52,  127 => 45,  123 => 47,  115 => 42,  110 => 43,  85 => 28,  65 => 19,  59 => 16,  45 => 11,  103 => 41,  91 => 31,  77 => 23,  74 => 16,  70 => 22,  66 => 19,  25 => 4,  89 => 20,  82 => 25,  19 => 2,  42 => 10,  29 => 4,  26 => 3,  223 => 88,  214 => 72,  210 => 88,  203 => 84,  199 => 83,  194 => 80,  192 => 69,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 59,  152 => 54,  145 => 52,  130 => 47,  125 => 46,  119 => 45,  116 => 44,  112 => 43,  102 => 35,  98 => 40,  76 => 24,  73 => 23,  69 => 20,  32 => 5,  24 => 3,  22 => 3,  56 => 14,  23 => 3,  17 => 1,  68 => 20,  61 => 16,  44 => 11,  20 => 2,  161 => 57,  153 => 50,  150 => 56,  147 => 55,  143 => 57,  137 => 45,  129 => 51,  121 => 49,  118 => 40,  113 => 44,  104 => 37,  99 => 33,  94 => 33,  81 => 28,  78 => 24,  72 => 21,  64 => 19,  53 => 15,  50 => 15,  48 => 10,  41 => 7,  39 => 7,  35 => 7,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 71,  169 => 61,  163 => 60,  160 => 57,  155 => 60,  151 => 56,  149 => 53,  141 => 56,  136 => 47,  134 => 50,  131 => 43,  128 => 47,  120 => 37,  117 => 45,  114 => 44,  109 => 38,  106 => 42,  100 => 34,  96 => 32,  93 => 31,  90 => 29,  87 => 29,  83 => 24,  79 => 24,  71 => 25,  62 => 17,  58 => 15,  55 => 16,  52 => 12,  49 => 13,  46 => 13,  43 => 12,  40 => 7,  37 => 6,  34 => 5,  31 => 4,  28 => 3,);
    }
}
