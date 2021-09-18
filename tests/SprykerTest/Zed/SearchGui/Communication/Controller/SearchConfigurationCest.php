<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\SearchGui\Communication\Controller;

use SprykerTest\Zed\SearchGui\SearchGuiCommunicationTester;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group SearchGui
 * @group Communication
 * @group Controller
 * @group SearchConfigurationCest
 * Add your own group annotations below this line
 */
class SearchConfigurationCest
{
    /**
     * @var string
     */
    protected const SEARCH_OVERVIEW_URL = '/search-gui/index';

    /**
     * @var string
     */
    protected const SEARCH_CONFIGURATION_URL = '/search-gui/search-configuration';

    /**
     * @param \SprykerTest\Zed\SearchGui\SearchGuiCommunicationTester $i
     *
     * @return void
     */
    public function testSubmitSearchConfigurationRedirectsToSearchConfigurationOverviewPageWhenConfigurationIsSaved(
        SearchGuiCommunicationTester $i
    ): void {
        $i->wantTo('Be redirected to search overview page after submit button');

        $i->amOnPage(static::SEARCH_CONFIGURATION_URL);
        $i->seeBreadcrumbNavigation('Administration / Search / Search Configuration / Edit Search Configuration');

        $i->selectOption('#search_configuration_form_selectedSearchAdapter_0', 'Elasticsearch');
        $i->click('Save');

        $i->amOnPage(static::SEARCH_OVERVIEW_URL);
    }

    /**
     * @param \SprykerTest\Zed\SearchGui\SearchGuiCommunicationTester $i
     *
     * @return void
     */
    public function testSubmitSearchConfigurationNotRedirectsToSearchConfigurationPageWhenConfigurationIsNotSaved(
        SearchGuiCommunicationTester $i
    ): void {
        $i->wantTo('Stay at the same page if submit is not possible');

        $i->amOnPage(static::SEARCH_CONFIGURATION_URL);
        $i->seeBreadcrumbNavigation('Administration / Search / Search Configuration / Edit Search Configuration');

        $i->submitForm(['name' => 'search_configuration_form'], [], 'submitButton');

        $i->amOnPage(static::SEARCH_CONFIGURATION_URL);
    }
}
