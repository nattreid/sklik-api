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

		if (!$this->configurator->sklikApi) {
			$this->configurator->sklikApi = new SklikApiConfig;
		}
	}

	/** @return Component */
	public function create(): Component
	{
		$form = $this->formFactory->create();
		$form->setAjaxRequest();

		$form->addInteger('retargetingId', 'webManager.web.hooks.sklikApi.retargetingId')
			->setDefaultValue($this->configurator->sklikApi->retargetingId);

		$form->addInteger('registrationId', 'webManager.web.hooks.sklikApi.registrationId')
			->setDefaultValue($this->configurator->sklikApi->registrationId);

		$form->addInteger('conversionId', 'webManager.web.hooks.sklikApi.conversionId')
			->setDefaultValue($this->configurator->sklikApi->conversionId);

		$form->addSubmit('save', 'form.save');

		$form->onSuccess[] = [$this, 'sklikApiFormSucceeded'];

		return $form;
	}

	public function sklikApiFormSucceeded(Form $form, ArrayHash $values): void
	{
		$config = $this->configurator->sklikApi;

		$config->retargetingId = $values->retargetingId ?: null;
		$config->registrationId = $values->registrationId ?: null;
		$config->conversionId = $values->conversionId ?: null;

		$this->configurator->sklikApi = $config;

		$this->flashNotifier->success('default.dataSaved');
	}
}