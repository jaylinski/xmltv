<?php

namespace XmlTv;

use DOMDocument;
use DOMElement;
use DOMNode;
use XmlTv\Exceptions\ValidationException;
use XMLWriter;

class XmlTv
{
    private const DTD = __DIR__ . '/../spec/xmltv.dtd';

    /**
     * Contains element names that are empty according to the DTD.
     */
    private const EMPTY_ELEMENTS = ['new'];

    /**
     * Generates an XMLTV file.
     *
     * @param Tv   $tv        The Tv object.
     * @param bool $validate  Include the XMLTV DTD (inline) an validate against it.
     * @return string
     * @throws ValidationException
     */
    public static function generate(Tv $tv, bool $validate = true)
    {
        libxml_use_internal_errors(true);

        $domDocument = $validate ? self::getDocumentWithDtd() : new DOMDocument();
        $domDocument->formatOutput = true;

        self::buildDocument($domDocument, $tv->xmlSerialize());

        if (!$validate || $domDocument->validate()) {
            return $domDocument->saveXML();
        } else {
            throw new ValidationException('DTD validation failed: ' . libxml_get_last_error()->message);
        }
    }

    /**
     * Render the serialized XML (recursively).
     *
     * @param DOMNode     $domNode
     * @param XmlElement  $xmlElement
     */
    private static function buildDocument(DOMNode &$domNode, XmlElement $xmlElement)
    {
        if (self::isEmptyElement($xmlElement)) {
            return;
        }

        $element = new DOMElement($xmlElement->getName());
        $node = $domNode->appendChild($element);

        if ($node instanceof DOMElement) {
            foreach ($xmlElement->getAttributes() as $attribute => $value) {
                $node->setAttribute($attribute, $value);
            }
        }

        if ($xmlElement->hasChildren()) {
            foreach ($xmlElement->getChildren() as $child) {
                self::buildDocument($node, $child);
            }
        } else {
            if (!is_null($xmlElement->getValue())) {
                $node->textContent = $xmlElement->getValue();
            }
        }
    }

    /**
     * Returns a DOMDocument with an internal XMLTV DTD subset.
     *
     * This function uses the XMLWriter extension because it can write internal subsets.
     *
     * @return DOMDocument
     */
    private static function getDocumentWithDtd(): DOMDocument
    {
        $xmlWriter = new XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->startDocument();
        $xmlWriter->writeDTD('tv', null, null, file_get_contents(XmlTv::DTD));
        $xmlWriter->writeElement('x'); // DOMDocument::loadXML() will only load the DTD if a root element is present.
        $xmlWriter->endDocument();

        $domDocument = new DOMDocument();
        $domDocument->loadXML($xmlWriter->outputMemory());
        $domDocument->removeChild($domDocument->documentElement); // Remove the temporary root element.

        return $domDocument;
    }

    /**
     * Returns `true` if the passed element is empty.
     *
     * @param XmlElement $xmlElement
     * @return bool
     */
    private static function isEmptyElement(XmlElement $xmlElement): bool
    {
        return
            is_null($xmlElement->getValue()) &&
            !$xmlElement->hasChildren() &&
            !$xmlElement->hasAttributes() &&
            !in_array($xmlElement->getName(), self::EMPTY_ELEMENTS);
    }
}
