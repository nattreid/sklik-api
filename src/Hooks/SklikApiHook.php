<?php

namespace NAttreid\SklikApi\Hooks;

use NAttreid\Form\Form;
use NAttreid\WebManager\Services\Hooks\HookFactory;

/**
 * Class SklikApiHook
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApiHook extends HookFactory
{
	/** @var IConfigurator */
	protected $configurator;

	public function init()
	{
		$this->latte = __DIR__ . '/sklikApiHook.latte';
	}

	/** @return Form */
	public function create()
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

	public function googleApiFormSucceeded(Form $form, $values)
	{
		$this->configurator->sklikRetargetingId = $values->retargetingId;
		$this->configurator->sklikRegistrationId = $values->registrationId;
		$this->configurator->sklikConversionId = $values->conversionId;

		$this->flashNotifier->success('default.dataSaved');
	}
}