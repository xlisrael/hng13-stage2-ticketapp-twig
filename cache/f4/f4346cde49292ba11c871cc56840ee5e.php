<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* layouts/base.twig */
class __TwigTemplate_de0e0169fb5fe49ccf9966c6e5fac6dc extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>TicketApp - Twig Version</title>
    <link rel=\"shortcut icon\" href=\"/assets/images/hng.png\" type=\"image/x-icon\">
    <link rel=\"stylesheet\" href=\"assets/css/styles.css\"> 
</head>
<body>
    ";
        // line 11
        yield from $this->load("components/nav.twig", 11)->unwrap()->yield($context);
        // line 12
        yield "    
    <main>
        ";
        // line 14
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 15
        yield "    </main>

    <script src=\"./assets/js/app.js\"></script>
</body>
</html>";
        yield from [];
    }

    // line 14
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "layouts/base.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  72 => 14,  63 => 15,  61 => 14,  57 => 12,  55 => 11,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>TicketApp - Twig Version</title>
    <link rel=\"shortcut icon\" href=\"/assets/images/hng.png\" type=\"image/x-icon\">
    <link rel=\"stylesheet\" href=\"assets/css/styles.css\"> 
</head>
<body>
    {% include 'components/nav.twig' %}
    
    <main>
        {% block content %}{% endblock %}
    </main>

    <script src=\"./assets/js/app.js\"></script>
</body>
</html>", "layouts/base.twig", "C:\\Users\\DELL\\Desktop\\WorkMe\\HNG\\stage2-ticketapp-twig\\templates\\layouts\\base.twig");
    }
}
