<?php

namespace SS6\ShopBundle\Model\FileUpload;

class FileForUpload {

	/**
	 * @var string
	 */
	private $cacheFilename;

	/**
	 * @var bool
	 */
	private $isImage;

	/**
	 * @var string
	 */
	private $category;

	/**
	 * @var string|null
	 */
	private $type;

	/**
	 * @var int
	 */
	private $nameConventionType;

	/**
	 * @param string $cacheFilename
	 * @param bool $isImage
	 * @param string $category
	 * @param string|null $category
	 * @param int $nameConventionType
	 */
	public function __construct($cacheFilename, $isImage, $category, $type, $nameConventionType) {
		$this->cacheFilename = $cacheFilename;
		$this->isImage = $isImage;
		$this->category = $category;
		$this->type = $type;
		$this->nameConventionType = $nameConventionType;
	}

	/**
	 * @return string
	 */
	public function getCacheFilename() {
		return $this->cacheFilename;
	}

	/**
	 * @return bool
	 */
	public function isImage() {
		return $this->isImage;
	}

	/**
	 * @return string
	 */
	public function getCategory() {
		return $this->category;
	}

	/**
	 * @return string|null
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @return int
	 */
	public function getNameConventionType() {
		return $this->nameConventionType;
	}

}
