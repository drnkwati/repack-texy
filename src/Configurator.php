<?php

/**
 * Texy basic configurators.
 *
 * <code>
 * $texy = new Texy();
 * Configurator::safeMode($texy);
 * </code>
 */

namespace Repack\Texy;

class Configurator extends Strict
{
    public static $safeTags = array(
        'a' => array('href', 'title'),
        'acronym' => array('title'),
        'b' => array(),
        'br' => array(),
        'cite' => array(),
        'code' => array(),
        'em' => array(),
        'i' => array(),
        'strong' => array(),
        'sub' => array(),
        'sup' => array(),
        'q' => array(),
        'small' => array(),
    );

    /**
     * static class.
     */
    final public function __construct()
    {
        throw new \LogicException('Cannot instantiate static class ' . get_class($this));
    }

    /**
     * Configure Texy! for web comments and other usages, where input text may insert attacker.
     * @return void
     */
    public static function safeMode(Texy $texy)
    {
        $texy->allowedClasses = $texy::NONE; // no class or ID are allowed
        $texy->allowedStyles = $texy::NONE; // style modifiers are disabled
        $texy->allowedTags = self::$safeTags; // only some "safe" HTML tags and attributes are allowed
        $texy->urlSchemeFilters[$texy::FILTER_ANCHOR] = '#https?:|ftp:|mailto:#A';
        $texy->urlSchemeFilters[$texy::FILTER_IMAGE] = '#https?:#A';
        $texy->allowed['image'] = false; // disable images
        $texy->allowed['link/definition'] = false; // disable [ref]: URL reference definitions
        $texy->allowed['html/comment'] = false; // disable HTML comments
        $texy->linkModule->forceNoFollow = true; // force rel="nofollow"
    }

    /**
     * Disable all links.
     * @return void
     */
    public static function disableLinks(Texy $texy)
    {
        $texy->allowed['link/reference'] = false;
        $texy->allowed['link/email'] = false;
        $texy->allowed['link/url'] = false;
        $texy->allowed['link/definition'] = false;
        $texy->phraseModule->linksAllowed = false;

        if (is_array($texy->allowedTags)) {
            unset($texy->allowedTags['a']);
        } // TODO: else...
    }

    /**
     * Disable all images.
     * @return void
     */
    public static function disableImages(Texy $texy)
    {
        $texy->allowed['image'] = false;
        $texy->allowed['figure'] = false;
        $texy->allowed['image/definition'] = false;

        if (is_array($texy->allowedTags)) {
            unset($texy->allowedTags['img'], $texy->allowedTags['object'], $texy->allowedTags['embed'], $texy->allowedTags['applet']);
        } // TODO: else...
    }
}
