<?php

namespace Repack\Texy\Modules;

use Repack\Texy;

/**
 * Table cell TD / TH.
 */
class TableCellElement extends Texy\HtmlElement
{
    /** @var int */
    public $colSpan = 1;

    /** @var int */
    public $rowSpan = 1;

    /** @var string */
    public $text;
}
