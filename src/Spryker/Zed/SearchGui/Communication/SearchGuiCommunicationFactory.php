<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SearchGui\Communication;

use Generated\Shared\Transfer\SearchConfigurationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\SearchGui\Communication\Form\SearchConfigurationForm;
use Spryker\Zed\SearchGui\Dependency\Facade\SearchGuiToSearchFacadeInterface;
use Spryker\Zed\SearchGui\SearchGuiDependencyProvider;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Spryker\Zed\SearchGui\SearchGuiConfig getConfig()
 */
class SearchGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @param \Generated\Shared\Transfer\SearchConfigurationTransfer $searchConfigurationTransfer
     *
     * @return mixed[]|\Symfony\Component\Form\FormInterface
     */
    public function createSearchConfigurationForm(SearchConfigurationTransfer $searchConfigurationTransfer): FormInterface
    {
        return $this->getFormFactory()->create(SearchConfigurationForm::class, $searchConfigurationTransfer);
    }

    /**
     * @return \Spryker\Zed\SearchGui\Dependency\Facade\SearchGuiToSearchFacadeInterface
     */
    public function getSearchFacade(): SearchGuiToSearchFacadeInterface
    {
        return $this->getProvidedDependency(SearchGuiDependencyProvider::FACADE_SEARCH);
    }
}
