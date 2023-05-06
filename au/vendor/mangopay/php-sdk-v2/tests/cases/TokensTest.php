<?php

namespace MangoPay\Tests\Cases;


/**
 * Tests for holding authentication token in instance
 */
class TokensTest extends Base
{

    function test_forceToken()
    {
        $authHlp = new \MangoPay\Libraries\AuthenticationHelper($this->_api);

        $oldToken = $this->_api->OAuthTokenManager->GetToken($authHlp->GetAutenticationKey());
        $newToken = $this->_api->AuthenticationManager->CreateToken();

        $this->assertNotEquals($oldToken->access_token, $newToken->access_token);
    }

    function test_storeToken()
    {
        $authHlp = new \MangoPay\Libraries\AuthenticationHelper($this->_api);
        $token = new \MangoPay\Libraries\OAuthToken();
        $token->access_token = 'access test';
        $token->token_type = 'type test';
        $token->expires_in = 500;
        $token->autentication_key = $authHlp->GetAutenticationKey();
        $this->_api->OAuthTokenManager->StoreToken($token);

        $storedToken = $this->_api->OAuthTokenManager->GetToken($authHlp->GetAutenticationKey());

        $this->assertEquals('access test', $storedToken->access_token);
        $this->assertEquals('type test', $storedToken->token_type);

        $token->expires_in = 0;
        $this->_api->OAuthTokenManager->StoreToken($token);
    }

    function test_storeToken_differentAutenticationKey()
    {
        $authHlp = new \MangoPay\Libraries\AuthenticationHelper($this->_api);
        $token = new \MangoPay\Libraries\OAuthToken();
        $token->access_token = 'access test';
        $token->token_type = 'type test';
        $token->expires_in = 500;
        $token->autentication_key = 'old_value';
        $this->_api->OAuthTokenManager->StoreToken($token);

        $storedToken = $this->_api->OAuthTokenManager->GetToken('new_value');

        $this->assertNotEquals('access test', $storedToken->access_token);
        $this->assertNotEquals('type test', $storedToken->token_type);
        $this->assertEquals($authHlp->GetAutenticationKey(), $storedToken->autentication_key);

        $token->expires_in = 0;
        $this->_api->OAuthTokenManager->StoreToken($token);
    }

    function test_stadnardUseToken()
    {
        $authHlp = new \MangoPay\Libraries\AuthenticationHelper($this->_api);
        $token = $this->_api->OAuthTokenManager->GetToken($authHlp->GetAutenticationKey());

        $this->_api->Users->GetAll();
        $tokenAfterCall = $this->_api->OAuthTokenManager->GetToken($authHlp->GetAutenticationKey());

        $this->assertEquals($token->access_token, $tokenAfterCall->access_token);
        $this->assertEquals($token->token_type, $tokenAfterCall->token_type);
    }

    function test_isTokenLeaking()
    {
        $authHlp = new \MangoPay\Libraries\AuthenticationHelper($this->_api);
        $api = $this->buildNewMangoPayApi();

        $token1 = $this->_api->OAuthTokenManager->GetToken($authHlp->GetAutenticationKey());
        $token2 = $api->OAuthTokenManager->GetToken($authHlp->GetAutenticationKey());

        $this->assertEquals($token1->access_token, $token2->access_token);
        $this->assertEquals($token1->token_type, $token2->token_type);
    }
}
