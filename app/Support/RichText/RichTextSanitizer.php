<?php

namespace App\Support\RichText;

use DOMDocument;
use DOMElement;
use DOMNode;

class RichTextSanitizer
{
    /**
     * @var array<string>
     */
    private array $allowedTags = [
        'a',
        'blockquote',
        'br',
        'code',
        'figcaption',
        'figure',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'hr',
        'img',
        'li',
        'ol',
        'p',
        'pre',
        'strong',
        'em',
        's',
        'u',
        'ul',
    ];

    /**
     * @var array<string, array<string>>
     */
    private array $allowedAttributes = [
        'a' => ['href', 'target', 'rel'],
        'img' => ['src', 'alt'],
    ];

    public function sanitize(?string $html): ?string
    {
        if ($html === null) {
            return null;
        }

        if (trim($html) === '') {
            return '';
        }

        $document = new DOMDocument('1.0', 'UTF-8');
        $internalErrors = libxml_use_internal_errors(true);
        $wrappedHtml = '<div>' . mb_encode_numericentity($html, [0x80, 0x10FFFF, 0, 0x10FFFF], 'UTF-8') . '</div>';

        $document->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($internalErrors);

        $root = $document->documentElement;

        if (! $root instanceof DOMElement) {
            return '';
        }

        $this->sanitizeNode($root);

        return trim($this->innerHtml($root));
    }

    private function sanitizeNode(DOMNode $node): void
    {
        for ($i = $node->childNodes->length - 1; $i >= 0; $i--) {
            $child = $node->childNodes->item($i);

            if (! $child instanceof DOMNode) {
                continue;
            }

            if ($child instanceof DOMElement) {
                $tag = strtolower($child->tagName);

                if (! in_array($tag, $this->allowedTags, true)) {
                    $this->unwrapNode($child);

                    continue;
                }

                $this->sanitizeAttributes($child, $tag);
            }

            $this->sanitizeNode($child);
        }
    }

    private function sanitizeAttributes(DOMElement $element, string $tag): void
    {
        $allowedAttributes = $this->allowedAttributes[$tag] ?? [];

        for ($i = $element->attributes->length - 1; $i >= 0; $i--) {
            $attribute = $element->attributes->item($i);

            if ($attribute === null) {
                continue;
            }

            $name = strtolower($attribute->name);
            $value = trim($attribute->value);

            if (str_starts_with($name, 'on') || ! in_array($name, $allowedAttributes, true)) {
                $element->removeAttributeNode($attribute);

                continue;
            }

            if (in_array($name, ['href', 'src'], true) && ! $this->isSafeUrl($value, $tag, $name)) {
                $element->removeAttributeNode($attribute);
            }
        }

        if ($tag === 'a' && $element->hasAttribute('target')) {
            $element->setAttribute('rel', 'noopener noreferrer');
        }
    }

    private function unwrapNode(DOMElement $element): void
    {
        $parent = $element->parentNode;

        if (! $parent instanceof DOMNode) {
            return;
        }

        while ($element->firstChild instanceof DOMNode) {
            $parent->insertBefore($element->firstChild, $element);
        }

        $parent->removeChild($element);
    }

    private function innerHtml(DOMElement $element): string
    {
        $html = '';

        foreach ($element->childNodes as $child) {
            $html .= $element->ownerDocument?->saveHTML($child) ?? '';
        }

        return $html;
    }

    private function isSafeUrl(string $value, string $tag, string $attribute): bool
    {
        if ($value === '') {
            return false;
        }

        if ($tag === 'img' && $attribute === 'src' && str_starts_with($value, 'data:image/')) {
            return true;
        }

        if (str_starts_with($value, '#') || str_starts_with($value, '/')) {
            return true;
        }

        return preg_match('/^(https?:|mailto:|tel:)/i', $value) === 1;
    }
}
