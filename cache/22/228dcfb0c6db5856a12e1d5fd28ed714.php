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

/* pages/auth.twig */
class __TwigTemplate_a519f2db70f6157e8f0833008064d060 extends Template
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
        yield "<main class=\"auth-page container\">
    <h1>";
        // line 5
        yield (((($context["mode"] ?? null) == "login")) ? ("Login") : ("Create an account"));
        yield "</h1>
    
    <form class=\"auth-form\" method=\"POST\" action=\"/auth/process/";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["mode"] ?? null), "html", null, true);
        yield "\" novalidate>
        ";
        // line 8
        if ((($context["mode"] ?? null) != "login")) {
            // line 9
            yield "        <label>
            <span>Full name</span>
            <input name=\"name\" value=\"";
            // line 11
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 11), "request", [], "any", false, false, false, 11), "get", ["name"], "method", false, false, false, 11), "html", null, true);
            yield "\" aria-describedby=\"err-name\" />
            <div class=\"error\" id=\"err-name\"></div>
        </label>
        ";
        }
        // line 15
        yield "
        <label>
            <span>Email</span>
            <input name=\"email\" type=\"email\" value=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, false, 18), "request", [], "any", false, false, false, 18), "get", ["email"], "method", false, false, false, 18), "html", null, true);
        yield "\" aria-describedby=\"err-email\" />
            <div class=\"error\" id=\"err-email\"></div>
        </label>

        <label>
            <span>Password</span>
            <input name=\"password\" type=\"password\" aria-describedby=\"err-pass\" />
            <div class=\"error\" id=\"err-pass\"></div>
        </label>

        ";
        // line 28
        if ((($tmp = ($context["error"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 29
            yield "            <div class=\"error\" role=\"alert\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</div>
        ";
        }
        // line 31
        yield "
        <div class=\"auth-actions\">
            <button class=\"btn\" type=\"submit\">";
        // line 33
        yield (((($context["mode"] ?? null) == "login")) ? ("Login") : ("Sign up"));
        yield "</button>
        </div>
    </form>
</main>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "pages/auth.twig";
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
        return array (  113 => 33,  109 => 31,  103 => 29,  101 => 28,  88 => 18,  83 => 15,  76 => 11,  72 => 9,  70 => 8,  66 => 7,  61 => 5,  58 => 4,  51 => 3,  40 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends \"layouts/base.twig\" %}

{% block content %}
<main class=\"auth-page container\">
    <h1>{{ mode == 'login' ? 'Login' : 'Create an account' }}</h1>
    
    <form class=\"auth-form\" method=\"POST\" action=\"/auth/process/{{ mode }}\" novalidate>
        {% if mode != 'login' %}
        <label>
            <span>Full name</span>
            <input name=\"name\" value=\"{{ app.request.request.get('name') }}\" aria-describedby=\"err-name\" />
            <div class=\"error\" id=\"err-name\"></div>
        </label>
        {% endif %}

        <label>
            <span>Email</span>
            <input name=\"email\" type=\"email\" value=\"{{ app.request.request.get('email') }}\" aria-describedby=\"err-email\" />
            <div class=\"error\" id=\"err-email\"></div>
        </label>

        <label>
            <span>Password</span>
            <input name=\"password\" type=\"password\" aria-describedby=\"err-pass\" />
            <div class=\"error\" id=\"err-pass\"></div>
        </label>

        {% if error %}
            <div class=\"error\" role=\"alert\">{{ error }}</div>
        {% endif %}

        <div class=\"auth-actions\">
            <button class=\"btn\" type=\"submit\">{{ mode == 'login' ? 'Login' : 'Sign up' }}</button>
        </div>
    </form>
</main>
{% endblock %}", "pages/auth.twig", "C:\\Users\\DELL\\Desktop\\WorkMe\\HNG\\stage2-ticketapp-twig\\templates\\pages\\auth.twig");
    }
}
