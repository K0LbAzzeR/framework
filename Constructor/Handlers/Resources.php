<?php

declare(strict_types=1);

/*
 * Loading the assigned resources at the bottom of the <body>...</body> block.
 *
 * Загрузка назначенных ресурсов в нижней части блока <body>...</body>.
 */

namespace Hleb\Constructor\Handlers;

use Hleb\Scheme\Home\Constructor\Handlers\ResourceStandard;

class Resources extends ResourceStandard
{
    protected $bottomScripts = [];

    protected $bottomStyles = [];

    protected $bottomScriptsOnce = false;

    protected $bottomStylesOnce = false;

    /**
     * Adds loading JS script.
     * @param string $url - the address of the loaded resource.
     * @param string $charset - encoding.
     *//**
     * Добавляет загрузку скрипта JS.
     * @param string $url - адрес подгружаемого ресурса.
     * @param string $charset - кодировка.
     */
    function addBottomScript(string $url, string $charset = 'utf-8') {
        $this->bottomScripts[$url] = ['url' => $url, 'charset' => $charset];
    }

    /**
     * Outputting blocks previously assigned via Request::getResources()->addBottomScript(...).
     * You need to place this output via `print getRequestResources()->getBottomScripts()` at the bottom of the <body> ... </body> block.
     * @param int $indents - number of spaces before inserted blocks.
     * @return string
     *//**
     * Вывод блоков, ранее назначенных через Request::getResources()->addBottomScript(...).
     * Необходимо разместить данный вывод через `print getRequestResources()->getBottomScripts()` в нижней части блока <body>...</body>.
     * @param int $indents - количество пробелов перед вставляемыми блоками.
     * @return string
     */
    function getBottomScripts(int $indents = 2) {
        $result = PHP_EOL;
        $this->bottomScriptsOnce = true;
        foreach ($this->bottomScripts as $script) {
            $script = $this->convertPrivateTagsInArray($script);
            $result .= str_repeat(' ', $indents) . '<script src="' . $script["url"] . '" charset="' . $script["charset"] . '"></script>' . PHP_EOL;
        }
        return $result;
    }

    /**
     * Displays the blocks previously assigned via Request::getResources()->addBottomScript(...).
     * You need to place this output via `print getRequestResources()->getBottomScriptsOnce()` at the bottom of the <body> ... </body> block.
     * @param int $indents - number of spaces before inserted blocks.
     * @return string|null
     *//**
     * Единоразово выводит блоки, ранее назначенные через Request::getResources()->addBottomScript(...).
     * Необходимо разместить данный вывод через `print getRequestResources()->getBottomScriptsOnce()` в нижней части блока <body>...</body>.
     * @param int $indents - количество пробелов перед вставляемыми блоками.
     * @return string|null
     */
    function getBottomScriptsOnce(int $indents = 2) {
        if ($this->bottomScriptsOnce) return null;
        $this->bottomScriptsOnce = true;
        return self::getBottomScripts($indents);
    }

    /**
     * Adds loading CSS styles.
     * @param string $url - the address of the loaded resource.
     *//**
     * Добавляет загрузку CSS-стилей.
     * @param string $url - адрес подгружаемого ресурса.
     */
    function addBottomStyles(string $url) {
        $this->bottomStyles[$url] = $url;
    }

    /**
     * Outputting blocks previously assigned via Request::getResources()->addBottomStyles(...).
     * You need to place this output via `print getRequestResources()->getBottomStyles()` at the bottom of the <body> ... </body> block.
     * @param int $indents - number of spaces before inserted blocks.
     * @return string
     *//**
     * Вывод блоков, ранее назначенных через Request::getResources()->addBottomStyles(...).
     * Необходимо разместить данный вывод через `print getRequestResources()->getBottomStyles()` в нижней части блока <body>...</body>.
     * @param int $indents - количество пробелов перед вставляемыми блоками.
     * @return string
     */
    function getBottomStyles(int $indents = 2) {
        $result = PHP_EOL;
        foreach ($this->bottomStyles as $style) {
            $result .= str_repeat(' ', $indents) . '<link rel="stylesheet" href="' . $this->convertPrivateTags($style) . '" type="text/css" media="screen">' . PHP_EOL;
        }
        return $result;
    }

    /**
     * Displays the blocks previously assigned via Request::getResources()->addBottomStyles(...).
     * You need to place this output via `print getRequestResources()->getBottomStylesOnce()` at the bottom of the <body> ... </body> block.
     * @param int $indents - number of spaces before inserted blocks.
     * @return string|null
     *//**
     * Единоразово выводит блоки, ранее назначенные через Request::getResources()->addBottomStyles(...).
     * Необходимо разместить данный вывод через `print getRequestResources()->getBottomStylesOnce()` в нижней части блока <body>...</body>.
     * @param int $indents - количество пробелов перед вставляемыми блоками.
     * @return string|null
     */
    function getBottomStylesOnce(int $indents = 2) {
        if ($this->bottomStylesOnce) return null;
        $this->bottomStylesOnce = true;
        return self::getBottomStyles($indents);
    }
}

