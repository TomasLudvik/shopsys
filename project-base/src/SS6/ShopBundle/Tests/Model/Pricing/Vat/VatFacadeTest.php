<?php

namespace SS6\ShopBundle\Tests\Model\Pricing\Vat;

use Doctrine\ORM\EntityManager;
use PHPUnit_Framework_TestCase;
use SS6\ShopBundle\Model\Payment\PaymentEditFacade;
use SS6\ShopBundle\Model\Pricing\Vat\Vat;
use SS6\ShopBundle\Model\Pricing\Vat\VatFacade;
use SS6\ShopBundle\Model\Pricing\Vat\VatRepository;
use SS6\ShopBundle\Model\Pricing\Vat\VatService;
use SS6\ShopBundle\Model\Product\Pricing\ProductPriceRecalculationScheduler;
use SS6\ShopBundle\Model\Product\ProductEditFacade;
use SS6\ShopBundle\Model\Product\ProductService;
use SS6\ShopBundle\Model\Setting\Setting;
use SS6\ShopBundle\Model\Setting\SettingValue;
use SS6\ShopBundle\Model\Transport\TransportEditFacade;
use stdClass;

class VatFacadeTest extends PHPUnit_Framework_TestCase {

	public function testGetDefaultVat() {
		$expected = new stdClass();
		$emMock = $this->getMock(EntityManager::class, [], [], '', false);
		$vatServiceMock = $this->getMock(VatService::class, [], [], '', false);
		$paymentEditFacadeMock = $this->getMock(PaymentEditFacade::class, [], [], '', false);
		$productEditFacadeMock = $this->getMock(ProductEditFacade::class, [], [], '', false);
		$transportEditFacadeMock = $this->getMock(TransportEditFacade::class, [], [], '', false);

		$settingMock = $this->getMockBuilder(Setting::class)
			->setMethods(['get', '__construct'])
			->disableOriginalConstructor()
			->getMock();
		$settingMock
			->expects($this->once())
			->method('get')
			->with($this->equalTo(Vat::SETTING_DEFAULT_VAT), $this->equalTo(SettingValue::DOMAIN_ID_COMMON))
			->will($this->returnValue(1));

		$vatRepositoryMock = $this->getMockBuilder(VatRepository::class)
			->setMethods(['findById', '__construct'])
			->disableOriginalConstructor()
			->getMock();
		$vatRepositoryMock
			->expects($this->once())
			->method('findById')
			->with($this->equalTo(1))
			->will($this->returnValue($expected));

		$productServiceMock = $this->getMock(ProductService::class, [], [], '', false);

		$productPriceRecalculationSchedulerMock =  $this->getMockBuilder(ProductPriceRecalculationScheduler::class)
			->disableOriginalConstructor()
			->getMock();

		$vatFacade = new VatFacade(
			$emMock,
			$vatRepositoryMock,
			$vatServiceMock,
			$settingMock,
			$paymentEditFacadeMock,
			$productEditFacadeMock,
			$transportEditFacadeMock,
			$productServiceMock,
			$productPriceRecalculationSchedulerMock
		);

		$this->assertEquals($expected, $vatFacade->getDefaultVat());
	}

	public function testSetDefaultVat() {
		$emMock = $this->getMock(EntityManager::class, [], [], '', false);
		$vatServiceMock = $this->getMock(VatService::class, [], [], '', false);
		$vatRepositoryMock = $this->getMock(VatRepository::class, [], [], '', false);
		$paymentEditFacadeMock = $this->getMock(PaymentEditFacade::class, [], [], '', false);
		$productEditFacadeMock = $this->getMock(ProductEditFacade::class, [], [], '', false);
		$transportEditFacadeMock = $this->getMock(TransportEditFacade::class, [], [], '', false);

		$vatMock = $this->getMockBuilder(Vat::class)
			->setMethods(['getId', '__construct'])
			->disableOriginalConstructor()
			->getMock();
		$vatMock->expects($this->once())->method('getId')->will($this->returnValue(1));

		$settingMock = $this->getMockBuilder(Setting::class)
			->setMethods(['set', '__construct'])
			->disableOriginalConstructor()
			->getMock();
		$settingMock
			->expects($this->once())
			->method('set')
			->with($this->equalTo(Vat::SETTING_DEFAULT_VAT), $this->equalTo(1));

		$productServiceMock = $this->getMock(ProductService::class, [], [], '', false);

		$productPriceRecalculationSchedulerMock =  $this->getMockBuilder(ProductPriceRecalculationScheduler::class)
			->disableOriginalConstructor()
			->getMock();

		$vatFacade = new VatFacade(
			$emMock,
			$vatRepositoryMock,
			$vatServiceMock,
			$settingMock,
			$paymentEditFacadeMock,
			$productEditFacadeMock,
			$transportEditFacadeMock,
			$productServiceMock,
			$productPriceRecalculationSchedulerMock
		);
		$vatFacade->setDefaultVat($vatMock);
	}

}
