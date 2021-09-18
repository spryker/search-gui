<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SearchGui\Communication\Controller;

use Generated\Shared\Transfer\SearchConfigurationCriteriaTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\SearchGui\Communication\SearchGuiCommunicationFactory getFactory()
 */
class IndexController extends AbstractController
{
    /**
     * @var string
     */
    protected const SEARCH_CONFIGURATION_URL = '/search-gui/search-configuration';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return mixed[]
     */
    public function indexAction(Request $request): array
    {
        $searchConfigurationTransfer = $this->getFactory()->getSearchFacade()->getSearchConfiguration(
            new SearchConfigurationCriteriaTransfer()
        );

        return $this->viewResponse([
            'searchConfiguration' => $searchConfigurationTransfer,
            'searchConfigurationUrl' => Url::generate(static::SEARCH_CONFIGURATION_URL),
        ]);
    }
}
