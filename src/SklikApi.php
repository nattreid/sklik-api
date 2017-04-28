<?php

declare(strict_types=1);

namespace NAttreid\SklikApi;

use NAttreid\SklikApi\Hooks\SklikApiConfig;
use Nette\Application\UI\Control;

/**
 * Class SklikApi
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApi extends Control
{
	/** @var SklikApiConfig */
	private $config;

	public function __construct(SklikApiConfig $config)
	{
		parent::__construct();
		$this->config = $config;
	}

	public function render(): void
	{
		$this->template->retargetingId = $this->config->retargetingId;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}

	public function renderConversion(): void
	{
		$this->template->conversionId = $this->config->conversionId;
		$this->template->setFile(__DIR__ . '/templates/conversion.latte');
		$this->template->render();
	}

	public function renderRegistration(): void
	{
		$this->template->registrationId = $this->config->registrationId;
		$this->template->setFile(__DIR__ . '/templates/registration.latte');
		$this->template->render();
	}
}

interface ISklikApiFactory
{

	/** @return SklikApi */
	public function create();
}