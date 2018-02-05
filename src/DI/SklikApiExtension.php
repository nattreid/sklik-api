<?php

declare(strict_types=1);

namespace NAttreid\SklikApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\DI\ExtensionTranslatorTrait;
use NAttreid\SklikApi\Hooks\SklikApiConfig;
use NAttreid\SklikApi\Hooks\SklikApiHook;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\Statement;

if (trait_exists('NAttreid\Cms\DI\ExtensionTranslatorTrait')) {
	class SklikApiExtension extends AbstractSklikApiExtension
	{
		use ExtensionTranslatorTrait;

		protected function prepareHook(array $config)
		{
			$builder = $this->getContainerBuilder();
			$hook = $builder->getByType(HookService::class);
			if ($hook) {
				$builder->addDefinition($this->prefix('sklikApiHook'))
					->setType(SklikApiHook::class);

				$this->setTranslation(__DIR__ . '/../lang/', [
					'webManager'
				]);

				return new Statement('?->sklikApi \?: new ' . SklikApiConfig::class, ['@' . Configurator::class]);
			} else {
				return parent::prepareHook($config);
			}
		}
	}
} else {
	class SklikApiExtension extends AbstractSklikApiExtension
	{
	}
}