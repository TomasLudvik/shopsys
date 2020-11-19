<?php

namespace Shopsys\FrameworkBundle\Model\Advert;

use Shopsys\FrameworkBundle\Model\Advert\Exception\AdvertPositionNotKnownException;

class AdvertPositionRegistry
{
    /**
     * @return string[]
     */
    public function getAllLabelsIndexedByNames(): array
    {
        return [
            'header' => t('under heading'),
            'footer' => t('above footer'),
            'productList' => t('in category (above the category name)'),
        ];
    }

    /**
     * @param string $positionName
     */
    public function assertPositionNameIsKnown(string $positionName): void
    {
        $knownPositionsNames = array_keys($this->getAllLabelsIndexedByNames());

        if (!in_array($positionName, $knownPositionsNames, true)) {
            throw new AdvertPositionNotKnownException(
                $positionName,
                $knownPositionsNames
            );
        }
    }
}
