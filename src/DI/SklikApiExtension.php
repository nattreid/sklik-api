<?php

declare(strict_types = 1);

namespace NAttreid\SklikApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\ExtensionTranslatorTrait;
use NAttreid\SklikApi\Hooks\SklikApiHook;
use NAttreid\SklikApi\ISklikApiFactory;
use NAttreid\SklikApi\SklikApi;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\CompilerExtension;
use Nette\DI\Statement;

/**
 * Class SklikApiExtension
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApiExtension extends CompilerExtension
{
	use ExtensionTranslatorTrait;

	private $defaults = [
		'retargetingId' => null,
		'registrationId' => null,
		'conversionId' => null
	];

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());

		$hook = $builder->getByType(HookService::class);
		if ($hook) {
			$builder->addDefinition($this->prefix('sklikApiHook'))
				->setClass(SklikApiHook::class);

			$this->setTranslation(__DIR__ . '/../lang/', [
				'webManager'
			]);

			$config['retargetingId'] = new Statement('?->sklikRetargetingId', ['@' . Configurator::class]);
			$config['registrationId'] = new Statement('?->sklikRegistrationId', ['@' . Configurator::class]);
			$config['conversionId'] = new Statement('?->sklikConversionId', ['@' . Configurator::class]);
		}

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(ISklikApiFactory::class)
			->setFactory(SklikApi::class)
			->setArguments([$config['retargetingId'], $config['registrationId'], $config['conversionId']]);
	}
}