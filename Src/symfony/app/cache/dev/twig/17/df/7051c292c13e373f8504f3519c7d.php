<?php

/* WebProfilerBundle:Router:panel.html.twig */
class __TwigTemplate_17df7051c292c13e373f8504f3519c7d extends Twig_Template
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
        echo "<h2>Routing for \"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "request"), "pathinfo"), "html", null, true);
        echo "\"</h2>

<ul>
    <li>
        <strong>Route:&nbsp;</strong>
        ";
        // line 6
        if ($this->getAttribute($this->getContext($context, "request"), "route")) {
            // line 7
            echo "            ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "request"), "route"), "html", null, true);
            echo "
        ";
        } else {
            // line 9
            echo "            <em>No matching route</em>
        ";
        }
        // line 11
        echo "    </li>
    <li>
        <strong>Route parameters:&nbsp;</strong>
        ";
        // line 14
        if (twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "request"), "routeParams"))) {
            // line 15
            echo "            ";
            $this->env->loadTemplate("WebProfilerBundle:Profiler:table.html.twig")->display(array("data" => $this->getAttribute($this->getContext($context, "request"), "routeParams"), "class" => "inline"));
            // line 16
            echo "        ";
        } else {
            // line 17
            echo "            <em>No parameters</em>
        ";
        }
        // line 19
        echo "    </li>
    ";
        // line 20
        if ($this->getAttribute($this->getContext($context, "router"), "redirect")) {
            // line 21
            echo "    <li>
        <strong>Redirecting to:&nbsp;</strong> \"";
            // line 22
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "router"), "targetUrl"), "html", null, true);
            echo "\" ";
            if ($this->getAttribute($this->getContext($context, "router"), "targetRoute")) {
                echo "(route: \"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "router"), "targetRoute"), "html", null, true);
                echo "\")";
            }
            // line 23
            echo "    <li>
    ";
        }
        // line 25
        echo "    <li>
        <strong>Route matching logs</strong>
        <table class=\"routing inline\">
            <tr>
                <th>Route name</th>
                <th>Pattern</th>
                <th>Log</th>
            </tr>
            ";
        // line 33
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "traces"));
        foreach ($context['_seq'] as $context["_key"] => $context["trace"]) {
            // line 34
            echo "                <tr class=\"";
            echo (((1 == $this->getAttribute($this->getContext($context, "trace"), "level"))) ? ("almost") : ((((2 == $this->getAttribute($this->getContext($context, "trace"), "level"))) ? ("matches") : (""))));
            echo "\">
                    <td>";
            // line 35
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "name"), "html", null, true);
            echo "</td>
                    <td>";
            // line 36
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "pattern"), "html", null, true);
            echo "</td>
                    <td>";
            // line 37
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "trace"), "log"), "html", null, true);
            echo "</td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trace'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 40
        echo "        </table>
        <em><small>Note: The above matching is based on the configuration for the current router which might differ from
        the configuration used while routing this request.</small></em>
    </li>
</ul>
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Router:panel.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  260 => 234,  246 => 222,  244 => 221,  241 => 220,  222 => 204,  38 => 11,  51 => 17,  18 => 1,  21 => 3,  761 => 457,  758 => 456,  747 => 454,  743 => 453,  739 => 451,  726 => 450,  700 => 445,  697 => 444,  678 => 442,  661 => 441,  657 => 439,  653 => 438,  649 => 437,  645 => 436,  641 => 435,  637 => 434,  634 => 433,  632 => 432,  615 => 431,  604 => 430,  589 => 425,  584 => 423,  580 => 422,  577 => 421,  563 => 420,  530 => 389,  512 => 386,  495 => 385,  492 => 384,  490 => 383,  485 => 381,  480 => 379,  168 => 80,  162 => 77,  135 => 69,  122 => 63,  47 => 17,  386 => 160,  383 => 159,  377 => 158,  375 => 157,  368 => 156,  364 => 155,  360 => 153,  358 => 152,  355 => 151,  352 => 150,  342 => 147,  340 => 146,  331 => 141,  328 => 140,  325 => 139,  323 => 138,  318 => 135,  312 => 131,  309 => 130,  306 => 129,  304 => 128,  299 => 125,  290 => 120,  287 => 119,  285 => 118,  280 => 115,  278 => 114,  273 => 111,  271 => 110,  266 => 107,  256 => 103,  252 => 101,  245 => 97,  238 => 93,  232 => 89,  229 => 88,  219 => 83,  213 => 79,  207 => 77,  200 => 73,  191 => 68,  186 => 66,  172 => 58,  105 => 27,  101 => 25,  95 => 23,  181 => 63,  175 => 59,  165 => 60,  88 => 28,  75 => 25,  54 => 15,  167 => 56,  164 => 58,  80 => 19,  63 => 22,  60 => 21,  350 => 149,  341 => 159,  337 => 145,  334 => 157,  329 => 156,  327 => 155,  314 => 145,  307 => 141,  300 => 137,  293 => 121,  279 => 125,  272 => 121,  250 => 100,  236 => 97,  226 => 87,  215 => 83,  212 => 82,  204 => 78,  201 => 77,  196 => 71,  190 => 72,  180 => 60,  156 => 76,  146 => 46,  133 => 68,  126 => 45,  111 => 40,  108 => 39,  84 => 29,  67 => 24,  295 => 100,  289 => 96,  286 => 129,  283 => 94,  281 => 93,  276 => 90,  270 => 86,  267 => 85,  264 => 84,  262 => 105,  257 => 109,  243 => 96,  239 => 77,  224 => 205,  216 => 73,  209 => 81,  205 => 76,  198 => 66,  188 => 67,  179 => 83,  177 => 60,  171 => 62,  154 => 57,  138 => 70,  97 => 34,  86 => 20,  36 => 6,  140 => 52,  127 => 45,  123 => 47,  115 => 42,  110 => 43,  85 => 33,  65 => 21,  59 => 18,  45 => 15,  103 => 41,  91 => 45,  77 => 18,  74 => 17,  70 => 22,  66 => 19,  25 => 4,  89 => 34,  82 => 27,  19 => 2,  42 => 13,  29 => 6,  26 => 6,  223 => 88,  214 => 72,  210 => 78,  203 => 84,  199 => 83,  194 => 69,  192 => 69,  189 => 78,  187 => 77,  184 => 76,  178 => 72,  170 => 64,  157 => 59,  152 => 48,  145 => 73,  130 => 47,  125 => 46,  119 => 45,  116 => 61,  112 => 43,  102 => 37,  98 => 36,  76 => 26,  73 => 24,  69 => 23,  32 => 8,  24 => 3,  22 => 2,  56 => 14,  23 => 3,  17 => 1,  68 => 13,  61 => 21,  44 => 12,  20 => 2,  161 => 57,  153 => 75,  150 => 74,  147 => 55,  143 => 72,  137 => 45,  129 => 51,  121 => 35,  118 => 40,  113 => 44,  104 => 37,  99 => 33,  94 => 35,  81 => 28,  78 => 24,  72 => 25,  64 => 19,  53 => 15,  50 => 18,  48 => 16,  41 => 7,  39 => 12,  35 => 7,  33 => 5,  30 => 4,  27 => 3,  182 => 70,  176 => 82,  169 => 57,  163 => 54,  160 => 53,  155 => 60,  151 => 56,  149 => 47,  141 => 43,  136 => 47,  134 => 50,  131 => 43,  128 => 65,  120 => 62,  117 => 45,  114 => 31,  109 => 38,  106 => 42,  100 => 34,  96 => 32,  93 => 34,  90 => 21,  87 => 28,  83 => 24,  79 => 37,  71 => 23,  62 => 11,  58 => 20,  55 => 19,  52 => 19,  49 => 37,  46 => 13,  43 => 14,  40 => 8,  37 => 9,  34 => 9,  31 => 6,  28 => 7,);
    }
}
