<?php

declare(strict_types=1);

namespace NAttreid\SklikApi;

use NAttreid\SklikApi\Hooks\SklikApiConfig;
use Nette\Application\UI\Control;
use Nette\Utils\ArrayHash;

/**
 * Class SklikApi
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApi extends Control
{
	/** @var SklikApiConfig */
	private $config;

	/** @var ArrayHash[] */
	private $conversions = [];

	public function __construct(SklikApiConfig $config)
	{
		parent::__construct();
		$this->config = $config;
	}

	/**
	 * @param float|null $value
	 * @return static
	 */
	public function conversion(float $value = null): self
	{
		$obj = new ArrayHash;
		$obj->id = $this->config->conversionId;
		$obj->value = $value;
		$this->conversions[] = $obj;

		return $this;
	}

	/**
	 * @param float|null $value
	 * @return static
	 */
	public function registration(float $value = null): self
	{
		$obj = new ArrayHash;
		$obj->id = $this->config->registrationId;
		$obj->value = $value;
		$this->conversions[] = $obj;

		return $this;
	}

	public function render(): void
	{
		$this->template->retargetingId = $this->config->retargetingId;
		$this->template->conversions = $this->conversions;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}
}

interface ISklikApiFactory
{
	public function create(): SklikApi;
}