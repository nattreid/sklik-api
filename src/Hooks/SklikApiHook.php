<?php

declare(strict_types=1);

namespace NAttreid\SklikApi\Hooks;

use NAttreid\Form\Form;
use NAttreid\WebManager\Services\Hooks\HookFactory;
use Nette\ComponentModel\Component;
use Nette\Utils\ArrayHash;

/**
 * Class SklikApiHook
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApiHook extends HookFactory
{
	/** @var IConfigurator */
	protected $configurator;

	public function init(): void
	{
		$this->latte = __DIR__ . '/sklikApiHook.latte';
	}

	/** @return Component */
	public function create(): Component
	{
		$form = $this->formFactory->create();
		$form->setAjaxRequest();

		$form->addText('retargetingId', 'webManager.web.hooks.sklikApi.retargetingId')
			->setDefaultValue($this->configurator->sklikRetargetingId);

		$form->addText('registrationId', 'webManager.web.hooks.sklikApi.registrationId')
			->setDefaultValue($this->configurator->sklikRegistrationId);

		$form->addText('conversionId', 'webManager.web.hooks.sklikApi.conversionId')
			->setDefaultValue($this->configurator->sklikConversionId);

		$form->addSubmit('save', 'form.save');

		$form->onSuccess[] = [$this, 'googleApiFormSucceeded'];

		return $form;
	}

	public function googleApiFormSucceeded(Form $form, ArrayHash $values): void
	{
		$this->configurator->sklikRetargetingId = $values->retargetingId;
		$this->configurator->sklikRegistrationId = $values->registrationId;
		$this->configurator->sklikConversionId = $values->conversionId;

		$this->flashNotifier->success('default.dataSaved');
	}
}