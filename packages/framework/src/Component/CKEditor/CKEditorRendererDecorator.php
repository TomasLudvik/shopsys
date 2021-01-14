<?php

declare(strict_types=1);

namespace Shopsys\FrameworkBundle\Component\CKEditor;

use FOS\CKEditorBundle\Renderer\CKEditorRendererInterface;

class CKEditorRendererDecorator implements CKEditorRendererInterface
{
    /**
     * @var \FOS\CKEditorBundle\Renderer\CKEditorRendererInterface
     */
    protected CKEditorRendererInterface $baseCKEditorRenderer;

    /**
     * @param \FOS\CKEditorBundle\Renderer\CKEditorRendererInterface $baseCKEditorRenderer
     */
    public function __construct(CKEditorRendererInterface $baseCKEditorRenderer)
    {
        $this->baseCKEditorRenderer = $baseCKEditorRenderer;
    }

    /**
     * @param string $basePath
     * @return string
     */
    public function renderBasePath(string $basePath): string
    {
        return $this->baseCKEditorRenderer->renderBasePath($basePath);
    }

    /**
     * @param string $jsPath
     * @return string
     */
    public function renderJsPath(string $jsPath): string
    {
        return $this->baseCKEditorRenderer->renderJsPath($jsPath);
    }

    /**
     * @param string $id
     * @param array $config
     * @param array $options
     * @return string
     */
    public function renderWidget(string $id, array $config, array $options = []): string
    {
        return sprintf(
            '$("#%s-preview").click(function() {
                %s
                %s
            });',
            $id,
            $this->baseCKEditorRenderer->renderWidget($id, $config, $options),
            $this->renderJSValidation($id)
        );
    }

    /**
     * @param string $id
     * @return string
     */
    protected function renderJSValidation(string $id): string
    {
        return sprintf(
            'CKEDITOR.instances["%1$s"].on("change", function () {
                $("#%1$s").jsFormValidator("validate");
            });',
            $id
        );
    }

    /**
     * @param string $id
     * @return string
     */
    public function renderDestroy(string $id): string
    {
        return $this->baseCKEditorRenderer->renderDestroy($id);
    }

    /**
     * @param string $name
     * @param array $plugin
     * @return string
     */
    public function renderPlugin(string $name, array $plugin): string
    {
        return $this->baseCKEditorRenderer->renderPlugin($name, $plugin);
    }

    /**
     * @param string $name
     * @param array $stylesSet
     * @return string
     */
    public function renderStylesSet(string $name, array $stylesSet): string
    {
        return $this->baseCKEditorRenderer->renderStylesSet($name, $stylesSet);
    }

    /**
     * @param string $name
     * @param array $template
     * @return string
     */
    public function renderTemplate(string $name, array $template): string
    {
        return $this->baseCKEditorRenderer->renderTemplate($name, $template);
    }
}
