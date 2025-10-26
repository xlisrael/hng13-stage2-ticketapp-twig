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

/* components/nav.twig */
class __TwigTemplate_6d626673a54889875a1ba52f696906c2 extends Template
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
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<header class=\"site-nav\" role=\"navigation\" aria-label=\"main\">
    <div class=\"container nav-inner\">
        <div class=\"brand\">
            <a href=\"/\" class=\"brand-link\">TicketApp</a>
        </div>

        <nav class=\"links\" aria-label=\"main navigation\">
            <a href=\"/\" class=\"";
        // line 8
        yield (((($context["path"] ?? null) == "/")) ? ("active") : (""));
        yield "\">Home</a>
            <a href=\"/dashboard\" class=\"";
        // line 9
        yield (((($context["path"] ?? null) == "/dashboard")) ? ("active") : (""));
        yield "\">Dashboard</a>
            <a href=\"/tickets\" class=\"";
        // line 10
        yield (((($context["path"] ?? null) == "/tickets")) ? ("active") : (""));
        yield "\">Tickets</a>
        </nav>

        <div class=\"actions\">
            <a href=\"/auth/login\" class=\"btn-outline\">Login</a>
        </div>
    </div>
</header>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "components/nav.twig";
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
        return array (  59 => 10,  55 => 9,  51 => 8,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<header class=\"site-nav\" role=\"navigation\" aria-label=\"main\">
    <div class=\"container nav-inner\">
        <div class=\"brand\">
            <a href=\"/\" class=\"brand-link\">TicketApp</a>
        </div>

        <nav class=\"links\" aria-label=\"main navigation\">
            <a href=\"/\" class=\"{{ path == '/' ? 'active' }}\">Home</a>
            <a href=\"/dashboard\" class=\"{{ path == '/dashboard' ? 'active' }}\">Dashboard</a>
            <a href=\"/tickets\" class=\"{{ path == '/tickets' ? 'active' }}\">Tickets</a>
        </nav>

        <div class=\"actions\">
            <a href=\"/auth/login\" class=\"btn-outline\">Login</a>
        </div>
    </div>
</header>", "components/nav.twig", "C:\\Users\\DELL\\Desktop\\WorkMe\\HNG\\stage2-ticketapp-twig\\templates\\components\\nav.twig");
    }
}
