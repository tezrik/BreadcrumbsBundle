<?php

namespace Huluti\BreadcrumbsBundle\Templating\Helper;

use Huluti\BreadcrumbsBundle\Model\Breadcrumbs;
use Twig\Environment;

class BreadcrumbsHelper
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var Breadcrumbs
     */
    protected $breadcrumbs;

    /**
     * @var array The default options load from config file
     */
    protected $options = [];

    /**
     * @param array $options The default options load from config file
     */
    public function __construct(Environment $twig, Breadcrumbs $breadcrumbs, array $options)
    {
        $this->twig = $twig;
        $this->breadcrumbs = $breadcrumbs;
        $this->options = array_merge($options, [
            'namespace' => Breadcrumbs::DEFAULT_NAMESPACE, // inject default namespace to options
        ]);
    }

    /**
     * Returns the HTML for the namespace breadcrumbs.
     *
     * @param array $options The user-supplied options from the view
     *
     * @return string A HTML string
     */
    public function breadcrumbs(array $options = [])
    {
        $options = $this->resolveOptions($options);

        // Assign namespace breadcrumbs
        $options['breadcrumbs'] = $this->breadcrumbs->getNamespaceBreadcrumbs($options['namespace']);

        return $this->twig->render(
            $options['viewTemplate'],
            $options
        );
    }

    /**
     * @codeCoverageIgnore
     */
    public function getName()
    {
        return 'breadcrumbs';
    }

    /**
     * Merges user-supplied options from the view
     * with base config values.
     *
     * @param array $options The user-supplied options from the view
     *
     * @return array
     */
    private function resolveOptions(array $options = [])
    {
        return array_merge($this->options, $options);
    }
}
