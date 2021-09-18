<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\SearchGui\Communication\Form;

use Spryker\Zed\Kernel\Communication\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @method \Spryker\Zed\SearchGui\Communication\SearchGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\SearchGui\SearchGuiConfig getConfig()
 */
class SearchConfigurationForm extends AbstractType
{
    /**
     * @var string
     */
    protected const FIELD_SEARCH_ADAPTER = 'selectedSearchAdapter';

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param mixed[] $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addSearchAdapterField($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addSearchAdapterField(FormBuilderInterface $builder)
    {
        $searchConfigurationTransfer = $builder->getData();

        $allAdapters = [];
        $enabledAdapters = [];
        foreach ($searchConfigurationTransfer->getSearchAdapterConfigurations() as $searchAdapterConfigurationTransfer) {
            if ($searchAdapterConfigurationTransfer->getIsEnabled()) {
                $enabledAdapters[$searchAdapterConfigurationTransfer->getName()] = ['checked' => 'checked'];
            }
            $allAdapters[$searchAdapterConfigurationTransfer->getName()] = $searchAdapterConfigurationTransfer->getName();
        }

        $builder->add(static::FIELD_SEARCH_ADAPTER, ChoiceType::class, [
            'label' => 'Search Adapter',
            'required' => true,
            'choices' => $allAdapters,
            'choice_attr' => function ($key) use ($enabledAdapters) {
                return $enabledAdapters[$key] ?? [];
            },
            'multiple' => false,
            'expanded' => true,
            'constraints' => [
                new NotBlank(),
            ],
        ]);

        return $this;
    }
}
