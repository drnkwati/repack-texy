<?php

/**
 * Texy parser base class.
 */

namespace Repack\Texy;

class Parser extends Strict
{
    /** @var array */
    public $patterns;

    /** @var Texy */
    protected $texy;

    /** @var HtmlElement */
    protected $element;

    /**
     * @return Texy
     */
    public function getTexy()
    {
        return $this->texy;
    }
}
