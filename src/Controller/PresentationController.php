<?php

/*
 * Copyright 2015  Daniel Berthereau
 * Copyright 2016  BibLibre
 *
 * This software is governed by the CeCILL license under French law and abiding
 * by the rules of distribution of free software.  You can use, modify and/or
 * redistribute the software under the terms of the CeCILL license as circulated
 * by CEA, CNRS and INRIA at the following URL "http://www.cecill.info".
 *
 * As a counterpart to the access to the source code and rights to copy, modify
 * and redistribute granted by the license, users are provided only with a
 * limited warranty and the software's author, the holder of the economic
 * rights, and the successive licensors have only limited liability.
 *
 * In this respect, the user's attention is drawn to the risks associated with
 * loading, using, modifying and/or developing or reproducing the software by
 * the user in light of its specific status of free software, that may mean that
 * it is complicated to manipulate, and that also therefore means that it is
 * reserved for developers and experienced professionals having in-depth
 * computer knowledge. Users are therefore encouraged to load and test the
 * software's suitability as regards their requirements in conditions enabling
 * the security of their systems and/or data to be ensured and, more generally,
 * to use and operate it in the same conditions as regards security.
 *
 * The fact that you are presently reading this means that you have had
 * knowledge of the CeCILL license and that you accept its terms.
 */

namespace UniversalViewer\Controller;

use Omeka\Mvc\Exception\NotFoundException;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PresentationController extends AbstractActionController
{
    public function manifestAction()
    {
        $id = $this->params('id');
        if (empty($id)) {
            throw new NotFoundException;
        }

        $recordtype = $this->params('recordtype');
        $response = $this->api()->read($recordtype, $id);
        $resource = $response->getContent();
        if (empty($resource)) {
            throw new NotFoundException;
        }

        $iiifManifest = $this->viewHelpers()->get('iiifManifest');
        $manifest = $iiifManifest($resource, false);

        return $this->jsonLd($manifest);
    }
}
