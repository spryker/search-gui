<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SearchGui\Communication\Controller;

use Generated\Shared\Transfer\SearchConfigurationCriteriaTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\SearchGui\Communication\SearchGuiCommunicationFactory getFactory()
 */
class SearchConfigurationController extends AbstractController
{
    /**
     * @var string
     */
    protected const SEARCH_OVERVIEW_URL = '/search-gui/index';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return mixed[]|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request)
    {
        $searchConfigurationTransfer = $this->getFactory()->getSearchFacade()->getSearchConfiguration(
            new SearchConfigurationCriteriaTransfer()
        );

        $form = $this->getFactory()->createSearchConfigurationForm(
            $searchConfigurationTransfer
        )->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchConfigurationResponseTransfer = $this->getFactory()->getSearchFacade()->saveSearchConfiguration($form->getData());

            if ($searchConfigurationResponseTransfer->getIsSuccesful()) {
                return $this->redirectResponse(Url::generate(static::SEARCH_OVERVIEW_URL));
            }

            foreach ($searchConfigurationResponseTransfer->getMessages() as $messageTransfer) {
                $form->addError(new FormError((string)$messageTransfer->getMessage()));
            }
        }

        return $this->viewResponse([
            'form' => $form->createView(),
        ]);
    }
}
