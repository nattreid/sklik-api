<?php

declare(strict_types=1);

namespace NAttreid\SklikApi\DI;

use NAttreid\Cms\Configurator\Configurator;
use NAttreid\Cms\DI\ExtensionTranslatorTrait;
use NAttreid\SklikApi\Hooks\SklikApiConfig;
use NAttreid\SklikApi\Hooks\SklikApiHook;
use NAttreid\SklikApi\ISklikApiFactory;
use NAttreid\SklikApi\SklikApi;
use NAttreid\WebManager\Services\Hooks\HookService;
use Nette\DI\CompilerExtension;
use Nette\DI\Statement;

/**
 * Class AbstractSklikApiExtension
 *
 * @author Attreid <attreid@gmail.com>
 */
abstract class AbstractSklikApiExtension extends CompilerExtension
{
	private $defaults = [
		'retargetingId' => null,
		'registrationId' => null,
		'conversionId' => null
	];

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults, $this->getConfig());

		$sklikApi = $this->prepareConfig($config);

		$builder->addDefinition($this->prefix('factory'))
			->setImplement(ISklikApiFactory::class)
			->setFactory(SklikApi::class)
			->setArguments([$sklikApi]);
	}

	protected function prepareConfig(array $config)
	{
		$builder = $this->getContainerBuilder();
		return $builder->addDefinition($this->prefix('config'))
			->setFactory(SklikApiConfig::class)
			->addSetup('$retargetingId', [$config['retargetingId']])
			->addSetup('$registrationId', [$config['registrationId']])
			->addSetup('$conversionId', [$config['conversionId']]);
	}
}