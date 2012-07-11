<?php

/* TwigBundle:Exception:error.html.twig */
class __TwigTemplate_e394de26bcdebf68d7c7f71e9e183b4c extends Twig_Template
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
        echo "<!doctype html>
<html lang=\"en\">
<head>
  <meta charset=\"utf-8\">
  <title>An Error Occurred: ";
        // line 5
        echo twig_escape_filter($this->env, $this->getContext($context, "status_text"), "html", null, true);
        echo "</title>
  <style>
    ::-moz-selection { background: #fe57a1; color: #fff; text-shadow: none; }
    ::selection { background: #fe57a1; color: #fff; text-shadow: none; }
    html { padding: 30px 10px; font-size: 20px; line-height: 1.4; color: #737373; background: #f0f0f0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    html, input { font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif; }
    body { max-width: 500px; _width: 500px; padding: 30px 20px 50px; border: 1px solid #b3b3b3; border-radius: 4px; margin: 0 auto; box-shadow: 0 1px 10px #a7a7a7, inset 0 1px 0 #fff; background: #fcfcfc; }
    h1 { margin: 0 10px; font-size: 50px; text-align: center; }
    h1 span { color: #bbb; }
    h3 { margin: 1.5em 0 0.5em; }
    p { margin: 1em 0; }
    ul { padding: 0 0 0 40px; margin: 1em 0; }
    .container { max-width: 380px; _width: 380px; margin: 0 auto; }
    /* google search */
    #goog-fixurl ul { list-style: none; padding: 0; margin: 0; }
    #goog-fixurl form { margin: 0; }
    #goog-wm-qt, #goog-wm-sb { border: 1px solid #bbb; font-size: 16px; line-height: normal; vertical-align: top; color: #444; border-radius: 2px; }
    #goog-wm-qt { width: 220px; height: 20px; padding: 5px; margin: 5px 10px 0 0; box-shadow: inset 0 1px 1px #ccc; }
    #goog-wm-sb { display: inline-block; height: 32px; padding: 0 10px; margin: 5px 0 0; white-space: nowrap; cursor: pointer; background-color: #f5f5f5; background-image: -webkit-linear-gradient(rgba(255,255,255,0), #f1f1f1); background-image: -moz-linear-gradient(rgba(255,255,255,0), #f1f1f1); background-image: -ms-linear-gradient(rgba(255,255,255,0), #f1f1f1); background-image: -o-linear-gradient(rgba(255,255,255,0), #f1f1f1); -webkit-appearance: none; -moz-appearance: none; appearance: none; *overflow: visible; *display: inline; *zoom: 1; }
    #goog-wm-sb:hover, #goog-wm-sb:focus { border-color: #aaa; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1); background-color: #f8f8f8; }
    #goog-wm-qt:focus, #goog-wm-sb:focus { border-color: #105cb6; outline: 0; color: #222; }
    input::-moz-focus-inner { padding: 0; border: 0; }
  </style>
</head>
<body>
  <div class=\"container\">
    <h1>Not found <span>:(</span></h1>
    <p>Sorry, but the page you were trying to view does not exist.</p>
    <p>It looks like this was the result of either:</p>
    <ul>
      <li>The server returned a \"";
        // line 35
        echo twig_escape_filter($this->env, $this->getContext($context, "status_code"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getContext($context, "status_text"), "html", null, true);
        echo "\".</li>
    </ul>
    <script>
      var GOOG_FIXURL_LANG = (navigator.language || '').slice(0,2),GOOG_FIXURL_SITE = location.host;
    </script>
    <script src=\"http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js\"></script>
  </div>

";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 35,  23 => 5,  17 => 1,  68 => 14,  61 => 9,  44 => 14,  20 => 2,  161 => 32,  153 => 50,  150 => 49,  147 => 48,  143 => 46,  137 => 45,  129 => 42,  121 => 41,  118 => 40,  113 => 39,  104 => 36,  99 => 33,  94 => 31,  81 => 25,  78 => 24,  72 => 22,  64 => 20,  53 => 16,  50 => 15,  48 => 14,  41 => 9,  39 => 8,  35 => 8,  33 => 5,  30 => 4,  27 => 6,  182 => 70,  176 => 66,  169 => 62,  163 => 58,  160 => 57,  155 => 56,  151 => 54,  149 => 53,  141 => 48,  136 => 45,  134 => 44,  131 => 43,  128 => 42,  120 => 37,  117 => 36,  114 => 35,  109 => 38,  106 => 37,  100 => 30,  96 => 32,  93 => 28,  90 => 29,  87 => 26,  83 => 24,  79 => 22,  71 => 19,  62 => 19,  58 => 8,  55 => 12,  52 => 6,  49 => 10,  46 => 15,  43 => 8,  40 => 12,  37 => 11,  34 => 5,  31 => 7,  28 => 3,);
    }
}
