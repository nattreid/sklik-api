<?php

declare(strict_types=1);

namespace NAttreid\SklikApi\Hooks;

use Nette\SmartObject;

/**
 * Class SklikApiConfig
 *
 * @property int|null $retargetingId
 * @property int|null $registrationId
 * @property int|null $conversionId
 *
 * @author Attreid <attreid@gmail.com>
 */
class SklikApiConfig
{
	use SmartObject;

	/** @var int|null */
	private $retargetingId;

	/** @var int|null */
	private $registrationId;

	/** @var int|null */
	private $conversionId;

	protected function getRetargetingId(): ?int
	{
		return $this->retargetingId;
	}

	protected function setRetargetingId(?int $retargetingId)
	{
		$this->retargetingId = $retargetingId;
	}

	protected function getRegistrationId(): ?int
	{
		return $this->registrationId;
	}

	protected function setRegistrationId(?int $registrationId)
	{
		$this->registrationId = $registrationId;
	}

	protected function getConversionId(): ?int
	{
		return $this->conversionId;
	}

	protected function setConversionId(?int $conversionId)
	{
		$this->conversionId = $conversionId;
	}
}