<?php

namespace Ups\Entity;

use DOMDocument;
use DOMElement;
use Ups\NodeInterface;

class ShipmentWeight implements NodeInterface
{
    private $unitOfMeasurement;
    private $weight;

    public function __construct($response = null)
    {
        $this->setUnitOfMeasurement(new UnitOfMeasurement());

        if (null !== $response) {
            if (isset($response->UnitOfMeasurement)) {
                $this->setUnitOfMeasurement(new UnitOfMeasurement($response->UnitOfMeasurement));
            }
            if (isset($response->Weight)) {
                $this->setWeight($response->Weight);
            }
        }
    }

    /**
     * @param null|DOMDocument $document
     * @return DOMElement
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $node = $document->createElement('ShipmentWeight');
        $node->appendChild($document->createElement('Weight', $this->getWeight()));
        $node->appendChild($this->getUnitOfMeasurement()->toNode($document));

        return $node;
    }

    /**
     * @param $weight
     * @return ShipmentWeight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param UnitOfMeasurement $unitOfMeasurement
     * @return ShipmentWeight
     */
    public function setUnitOfMeasurement(UnitOfMeasurement $unitOfMeasurement)
    {
        $this->unitOfMeasurement = $unitOfMeasurement;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitOfMeasurement()
    {
        return $this->unitOfMeasurement;
    }
}
