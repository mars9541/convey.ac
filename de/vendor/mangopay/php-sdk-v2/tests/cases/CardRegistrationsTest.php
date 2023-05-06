<?php

namespace MangoPay\Tests\Cases;


/**
 * Tests methods for card registrations
 */
class CardRegistrationsTest extends Base
{

    function test_CardRegistrations_Create()
    {
        $cardRegistration = $this->getJohnsCardRegistration();
        $user = $this->getJohn();

        $this->assertTrue($cardRegistration->Id > 0);
        $this->assertNotNull($cardRegistration->AccessKey);
        $this->assertNotNull($cardRegistration->PreregistrationData);
        $this->assertNotNull($cardRegistration->CardRegistrationURL);
        $this->assertEquals($user->Id, $cardRegistration->UserId);
        $this->assertEquals('EUR', $cardRegistration->Currency);
        $this->assertEquals(\MangoPay\CardRegistrationStatus::Created, $cardRegistration->Status);
    }

    function test_CardRegistrations_Get()
    {
        $cardRegistration = $this->getJohnsCardRegistration();

        $getCardRegistration = $this->_api->CardRegistrations->Get($cardRegistration->Id);

        $this->assertTrue($getCardRegistration->Id > 0);
        $this->assertEquals($cardRegistration->Id, $getCardRegistration->Id);
    }

    function test_CardRegistrations_Update()
    {
        $cardRegistration = $this->getJohnsCardRegistration();
        $registrationData = $this->getPaylineCorrectRegistartionData($cardRegistration);
        $cardRegistration->RegistrationData = $registrationData;

        $getCardRegistration = $this->_api->CardRegistrations->Update($cardRegistration);

        $this->assertEquals($registrationData, $getCardRegistration->RegistrationData);
        $this->assertNotNull($getCardRegistration->CardId);
        $this->assertSame(\MangoPay\CardRegistrationStatus::Validated, $getCardRegistration->Status);
        $this->assertSame('000000', $getCardRegistration->ResultCode);
    }

    function test_CardRegistrations_UpdateError()
    {
        $user = $this->getJohn();
        $cardRegistrationNew = new \MangoPay\CardRegistration();
        $cardRegistrationNew->UserId = $user->Id;
        $cardRegistrationNew->Currency = 'EUR';
        $cardRegistration = $this->_api->CardRegistrations->Create($cardRegistrationNew);
        $cardRegistration->RegistrationData = "Wrong-data";

        $getCardRegistration = $this->_api->CardRegistrations->Update($cardRegistration);

        $this->assertEquals(\MangoPay\CardRegistrationStatus::Error, $getCardRegistration->Status);
        $this->assertNotNull($getCardRegistration->ResultCode);
        $this->assertNotNull($getCardRegistration->ResultMessage);
    }

    function test_Cards_CheckCardExisting()
    {
        $cardRegistration = $this->getJohnsCardRegistration();
        $cardRegistration = $this->_api->CardRegistrations->Get($cardRegistration->Id);

        $card = $this->_api->Cards->Get($cardRegistration->CardId);

        $this->assertTrue($card->Id > 0);
        $this->assertEquals($card->Validity, \MangoPay\CardValidity::Unknown);
    }

    function test_Cards_Update()
    {
        $cardPreAuthorization = $this->getJohnsCardPreAuthorization();
        $card = $this->_api->Cards->Get($cardPreAuthorization->CardId);
        $cardToUpdate = new \MangoPay\Card();
        $cardToUpdate->Id = $card->Id;
        $cardToUpdate->Validity = \MangoPay\CardValidity::Invalid;

        $updatedCard = $this->_api->Cards->Update($cardToUpdate);

        $this->assertEquals($card->Validity, \MangoPay\CardValidity::Valid);
        $this->assertEquals($updatedCard->Validity, \MangoPay\CardValidity::Valid);
        $this->assertFalse($updatedCard->Active);
    }

}
