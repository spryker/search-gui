<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SearchGui\Dependency\Facade;

use Generated\Shared\Transfer\SearchConfigurationCriteriaTransfer;
use Generated\Shared\Transfer\SearchConfigurationResponseTransfer;
use Generated\Shared\Transfer\SearchConfigurationTransfer;

class SearchGuiToSearchFacadeBridge implements SearchGuiToSearchFacadeInterface
{
    /**
     * @var \Spryker\Zed\Search\Business\SearchFacadeInterface
     */
    protected $searchFacade;

    /**
     * @param \Spryker\Zed\Search\Business\SearchFacadeInterface $searchFacade
     */
    public function __construct($searchFacade)
    {
        $this->searchFacade = $searchFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\SearchConfigurationCriteriaTransfer $searchConfigurationCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\SearchConfigurationTransfer
     */
    public function getSearchConfiguration(SearchConfigurationCriteriaTransfer $searchConfigurationCriteriaTransfer): SearchConfigurationTransfer
    {
        return $this->searchFacade->getSearchConfiguration($searchConfigurationCriteriaTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\SearchConfigurationTransfer $searchConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\SearchConfigurationResponseTransfer
     */
    public function saveSearchConfiguration(SearchConfigurationTransfer $searchConfigurationTransfer): SearchConfigurationResponseTransfer
    {
        return $this->searchFacade->saveSearchConfiguration($searchConfigurationTransfer);
    }
}
