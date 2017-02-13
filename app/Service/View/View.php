<?php
/**
 * One Skeleton.
 *
 * @link      https://github.com/adrosoftware/one-skeleton
 *
 * @copyright Copyright (c) 2017 Adro Rocker
 * @author    Adro Rocker <alejandro.morelos@jarwebdev.com>
 */
namespace App\Service\View;

use \InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Interop\Container\ContainerInterface;

class View
{
    /**
     * @var string
     */
    protected $viewsPath;

    /**
     * @var string
     */
    protected $templatePath;

    /**
     * @var array
     */
    protected $attributes = [];
    /**
     * Constructor.
     *
     * @param string $templatePath
     * @param array $attributes
     */
    public function __construct(ContainerInterface $container)
    {
        $layout = isset($container->get('app.settings')['view']['template']) ? $container->get('app.settings')['view']['template'] : null;
        $this->viewsPath = rtrim($container->get('app.settings')['view']['path'], '/\\') . '/';
        $this->setTemplate($layout);
    }
    /**
     * Render a template
     *
     * $data cannot contain template as a key
     *
     * throws RuntimeException if $viewsPath . $template does not exist
     *
     * @param ResponseInterface $response
     * @param string             $template
     * @param array              $data
     *
     * @return ResponseInterface
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function render($view, ResponseInterface $response, array $data = [], $request = null)
    {
        $output = $this->fetch($view, $data);
        $result = $this->getLayout(['content'=>$output]);
        $response->getBody()->write($result);
        return $response;
    }
    /**
     * Get the attributes for the renderer
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
    /**
     * Set the attributes for the renderer
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }
    /**
     * Add an attribute
     *
     * @param $key
     * @param $value
     */
    public function addAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }
    /**
     * Retrieve an attribute
     *
     * @param $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if (!isset($this->attributes[$key])) {
            return false;
        }
        return $this->attributes[$key];
    }
    /**
     * Get the template path
     *
     * @return string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }
    /**
     * Set the template path
     *
     * @param string $templatePath
     */
    public function setTemplatePath($templatePath)
    {
        $this->templatePath = rtrim($templatePath, '/\\') . '/';
    }
    /**
     * Renders a template and returns the result as a string
     *
     * cannot contain template as a key
     *
     * throws RuntimeException if $templatePath . $template does not exist
     *
     * @param $template
     * @param array $data
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function fetch($template, array $data = [])
    {
        if (isset($data['template'])) {
            throw new \InvalidArgumentException("Duplicate template key found");
        }
        if (!is_file($this->viewsPath . $template.'.phtml')) {
            throw new \RuntimeException("View cannot render `$template` because the template does not exist");
        }

        $data = array_merge($this->attributes, $data);
        try {
            ob_start();
            $this->protectedIncludeScope($this->viewsPath . $template.'.phtml', $data);
            $output = ob_get_clean();
        } catch(\Throwable $e) { // PHP 7+
            ob_end_clean();
            throw $e;
        } catch(\Exception $e) { // PHP < 7
            ob_end_clean();
            throw $e;
        }
        return $output;
    }
    /**
     * @param string $template
     * @param array $data
     */
    protected function protectedIncludeScope ($template, array $data)
    {
        extract($data);
        include $template;
    }

    /**
     * @param string $layout
     */
    public function setTemplate($layout = 'main')
    {
        $this->templatePath = $this->viewsPath . 'layouts' . DIRECTORY_SEPARATOR . $layout . '.phtml';
    }

    protected function getLayout($data = [])
    {
        if (file_exists($this->templatePath)) {
            ob_start();
            $this->protectedIncludeScope($this->templatePath, $data);
            $output = ob_get_clean();
        } else {
            die(var_dump($this->templatePath));
            throw new \RuntimeException("View cannot render `$this->templatePath` because the template does not exist");
        }
        return $output;
    }
}