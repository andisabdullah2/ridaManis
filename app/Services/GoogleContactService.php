<?php
namespace App\Services;

use Google_Client;
use Google_Service_PeopleService;
use Google_Service_PeopleService_Person;
use Google_Service_PeopleService_Name;
use Google_Service_PeopleService_EmailAddress;
use Google_Service_PeopleService_PhoneNumber;

class GoogleContactService
{
    protected $client;
    protected $service;

   public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setAuthConfig(storage_path('credentials.json'));
        $this->client->addScope(\Google_Service_PeopleService::CONTACTS);
        $this->client->setAccessType('offline');

        $token = session('google_token');

        if (!$token) {
            throw new \Exception('Token Google tidak ditemukan. Harap login terlebih dahulu.');
        }

        // Validasi dan refresh token jika perlu
        $this->client->setAccessToken($token);

        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                session(['google_token' => $this->client->getAccessToken()]); // update token baru ke session
            } else {
                throw new \Exception('Token kadaluarsa dan refresh token tidak tersedia.');
            }
        }

        $this->service = new \Google_Service_PeopleService($this->client);
    }


    public function addContact($data)
    {
        $person = new Google_Service_PeopleService_Person();

        $name = new Google_Service_PeopleService_Name();
        $name->setGivenName($data['nama']);
        $person->setNames([$name]);

        if ($data['email']) {
            $email = new Google_Service_PeopleService_EmailAddress();
            $email->setValue($data['email']);
            $person->setEmailAddresses([$email]);
        }

        if ($data['nomor']) {
            $phone = new Google_Service_PeopleService_PhoneNumber();
            $phone->setValue($data['nomor']);
            $person->setPhoneNumbers([$phone]);
        }

        return $this->service->people->createContact($person);
    }
}
