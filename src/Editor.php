<?php

namespace Encore\ClikeEditor;

use Encore\Admin\Form\Field;
use Jxlwqq\CodeMirror\CodeMirror;

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
        CodeMirror::ASSETS_PATH.'lib/codemirror.css',
        CodeMirror::ASSETS_PATH.'addon/hint/show-hint.css',
    ];

    /**
     * {@inheritdoc}
     */
    protected static $js = [
        CodeMirror::ASSETS_PATH.'lib/codemirror.js',
        CodeMirror::ASSETS_PATH.'addon/edit/matchbrackets.js',
        CodeMirror::ASSETS_PATH.'addon/hint/show-hint.js',
        CodeMirror::ASSETS_PATH.'mode/clike/clike.js',
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