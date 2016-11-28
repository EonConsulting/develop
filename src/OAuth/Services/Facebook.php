<?php
/**
 * Created by PhpStorm.
 * User: vamoose
 * Date: 2016/11/28
 * Time: 1:25 PM
 */

namespace EONConsulting\PHPSaasWrapper\src\OAuth\Services;


class Facebook {

    public function getAuthorizeUrl() {
        return "https://www.facebook.com/dialog/oauth?client_id=994353767267416&redirect_uri=http://eon.dev/_eon_authenticate&scope=email,public_profile";
    }

    public function getUserByCode($code) {
        $token = $this->getAccessTokenFromCode($code);

        return $this->normalizeUser($this->getUserByToken($token));
    }

    protected function getAccessTokenFromCode($code) {
        $response = $this->client->request('GET', 'https://graph.facebook.com/v2.3/oauth/access_token', [
            'query' => [
                'client_id' => '994353767267416',
                'client_secret' => 'b052197806a975a532d520cf0028d8fb',
                'redirect_uri' => 'http://tutorials.app:8000/socialauth',
                'code' => $code,
            ]
        ])->getBody();

        return json_decode($response)->access_token;
    }

    protected function getUserByToken($token) {
        $response = $this->client->request('GET', 'https://graph.facebook.com/me', [
            'query' => [
                'access_token' => $token,
                'fields' => 'id,name,email,picture'
            ],
        ])->getBody();

        return json_decode($response);
    }

    protected function normalizeUser($user) {
        return (object) [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'photo' => $user->picture->data->url,
        ];
    }

}