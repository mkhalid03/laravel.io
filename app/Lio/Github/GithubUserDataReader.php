<?php namespace Lio\Github;

use OAuth;

class GithubUserDataReader
{
    public function getDataFromCode($code)
    {
        $data = $this->readFromGithub($code);

        return $this->formatData($data);
    }

    private function readFromGithub($code)
    {
        $github = OAuth::consumer('GitHub');

        $githubData = json_decode($github->request('user'), true);

        return $githubData;
    }

    private function formatData($data)
    {
        return [
            'id'         => $data['id'],
            'name'       => $data['login'],
            'email'      => $data['email'],
            'github_id'  => $data['id'],
            'github_url' => $data['html_url'],
            'image_url'  => $data['avatar_url'],
        ];
    }
}