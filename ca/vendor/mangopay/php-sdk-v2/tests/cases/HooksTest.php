<?php

namespace MangoPay\Tests\Cases;

use MangoPay\SortDirection;
use MangoPay\Sorting;


/**
 * Tests basic methods for wallets
 */
class HooksTest extends Base
{

    function test_Hooks_Create()
    {
        $hook = $this->getJohnHook();

        $this->assertTrue($hook->Id > 0);
    }

    function test_Hooks_Get()
    {
        $hook = $this->getJohnHook();

        $getHook = $this->_api->Hooks->Get($hook->Id);

        $this->assertSame($hook->Id, $getHook->Id);
    }

    function test_Hooks_Update()
    {
        $hook = $this->getJohnHook();
        $hook->Url = "http://test123.com";

        $saveHook = $this->_api->Hooks->Update($hook);

        $this->assertSame($hook->Id, $saveHook->Id);
        $this->assertSame("http://test123.com", $saveHook->Url);
    }

    function test_Hooks_All()
    {
        $hook = $this->getJohnHook();
        $pagination = new \MangoPay\Pagination(1, 1);
        $sorting = new Sorting();
        $sorting->AddField("CreationDate", SortDirection::ASC);

        $list = $this->_api->Hooks->GetAll($pagination, $sorting);

        $this->assertInstanceOf('\MangoPay\Hook', $list[0]);
        $this->assertSame($hook->Id, $list[0]->Id);
        $this->assertSame(1, $pagination->Page);
        $this->assertSame(1, $pagination->ItemsPerPage);
    }
}