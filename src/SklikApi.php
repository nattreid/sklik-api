<?php

declare(strict_types = 1);

namespace NAttreid\SklikApi;

use Nette\Application\UI\Control;

/**
 * Class SklikApi
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApi extends Control
{
	/** @var int */
	private $retargetingId;

	/** @var int */
	private $registrationId;

	/** @var int */
	private $conversionId;

	public function __construct(int $retargetingId, int $registrationId, int $conversionId)
	{
		parent::__construct();
		$this->retargetingId = $retargetingId;
		$this->registrationId = $registrationId;
		$this->conversionId = $conversionId;
	}

	public function render()
	{
		$this->template->retargetingId = $this->retargetingId;
		$this->template->setFile(__DIR__ . '/templates/default.latte');
		$this->template->render();
	}

	public function renderConversion()
	{
		$this->template->conversionId = $this->conversionId;
		$this->template->setFile(__DIR__ . '/templates/conversion.latte');
		$this->template->render();
	}

	public function renderRegistration()
	{
		$this->template->registrationId = $this->registrationId;
		$this->template->setFile(__DIR__ . '/templates/registration.latte');
		$this->template->render();
	}
}

interface ISklikApiFactory
{

	/** @return SklikApi */
	public function create();
}