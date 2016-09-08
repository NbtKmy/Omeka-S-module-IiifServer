<?php

namespace UniversalViewer\Service\ViewHelper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use UniversalViewer\View\Helper\IiifInfo;

/**
 * Service factory for the api view helper.
 */
class IiifInfoFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $services, $requestedName, array $options = null)
    {
        return new IiifInfo($services->get('Omeka\File\Manager'));
    }
}
