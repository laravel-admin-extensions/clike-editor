<?php

namespace Encore\ClikeEditor;

use Encore\Admin\Form\Field;

abstract class Editor extends Field
{
    protected $mode = '';

    /**
     * {@inheritdoc}
     */
    protected $view = 'laravel-admin-code-mirror::editor';

    /**
     * {@inheritdoc}
     */
    protected static $css = [
        'vendor/laravel-admin-ext/code-mirror/codemirror-5.40.0/lib/codemirror.css',
        'vendor/laravel-admin-ext/code-mirror/codemirror-5.40.0/addon/hint/show-hint.css',
    ];

    /**
     * {@inheritdoc}
     */
    protected static $js = [
        'vendor/laravel-admin-ext/code-mirror/codemirror-5.40.0/lib/codemirror.js',
        'vendor/laravel-admin-ext/code-mirror/codemirror-5.40.0/addon/edit/matchbrackets.js',
        'vendor/laravel-admin-ext/code-mirror/codemirror-5.40.0/addon/hint/show-hint.js',
        'vendor/laravel-admin-ext/code-mirror/codemirror-5.40.0/mode/clike/clike.js',
    ];

    /**
     * Set editor height.
     *
     * @param int $height
     * @return $this
     */
    public function height($height = 10)
    {
        return $this->addVariables(compact('height'));
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $options = array_merge(
            [
                'mode' => $this->mode,
                'lineNumbers' => true,
                'matchBrackets' => true,
            ],
            ClikeEditor::config('config', [])
        );

        $options = json_encode($options);

        $this->script = <<<EOT
CodeMirror.fromTextArea(document.getElementById("{$this->id}"), $options);
EOT;

        return parent::render();
    }
}