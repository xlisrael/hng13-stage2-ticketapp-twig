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

/* pages/landing.twig */
class __TwigTemplate_6aa46de95ccb4be5b2e3c83e0c8c85e1 extends Template
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

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "layouts/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->load("layouts/base.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 4
        yield "<main class=\"hero-container\">
    <div class=\"hero-inner container\">
        <div class=\"hero-left\">
            <h1>TicketApp — Manage issues, fast.</h1>
            <p class=\"lead\">
                A simple multi-framework ticket management app (Twig version).
                Create, track and close tickets — with a consistent layout.
            </p>

            <div class=\"cta-row\">
                <a href=\"/auth/signup\" class=\"btn\">Get Started</a>
                <a href=\"/auth/login\" class=\"btn-outline\">Login</a>
            </div>
        </div>

        <div class=\"hero-right\" aria-hidden=\"true\">
            <img src=\"/assets/images/circle.svg\" alt=\"\" class=\"decor-circle decor-1\"/>
            <div class=\"demo-box\">Feature box - quick stats</div>
        </div>
    </div>

    <div class=\"hero-wave\" aria-hidden=\"true\"></div>

    <footer class=\"site-footer\">
        <div class=\"container\">
            <p>© ";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " TicketApp — Built for HNG Stage 2</p>
        </div>
    </footer>
</main>

<style>
.hero-wave {
    background-image: url('/assets/images/wave.svg');
    width: 100%;
    height: 300px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pages/landing.twig";
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
        return array (  85 => 29,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layouts/base.twig\" %}

{% block content %}
<main class=\"hero-container\">
    <div class=\"hero-inner container\">
        <div class=\"hero-left\">
            <h1>TicketApp — Manage issues, fast.</h1>
            <p class=\"lead\">
                A simple multi-framework ticket management app (Twig version).
                Create, track and close tickets — with a consistent layout.
            </p>

            <div class=\"cta-row\">
                <a href=\"/auth/signup\" class=\"btn\">Get Started</a>
                <a href=\"/auth/login\" class=\"btn-outline\">Login</a>
            </div>
        </div>

        <div class=\"hero-right\" aria-hidden=\"true\">
            <img src=\"/assets/images/circle.svg\" alt=\"\" class=\"decor-circle decor-1\"/>
            <div class=\"demo-box\">Feature box - quick stats</div>
        </div>
    </div>

    <div class=\"hero-wave\" aria-hidden=\"true\"></div>

    <footer class=\"site-footer\">
        <div class=\"container\">
            <p>© {{ \"now\"|date(\"Y\") }} TicketApp — Built for HNG Stage 2</p>
        </div>
    </footer>
</main>

<style>
.hero-wave {
    background-image: url('/assets/images/wave.svg');
    width: 100%;
    height: 300px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
</style>
{% endblock %}", "pages/landing.twig", "C:\\Users\\DELL\\Desktop\\WorkMe\\HNG\\stage2-ticketapp-twig\\templates\\pages\\landing.twig");
    }
}
