<?php
namespace Example\User;

// so this would be glue to a service layer
// or not exist at all with the action calling the service layer
class UserDomain
{
    protected $users = [];
    protected $model;

    // how you manage data access is up to you
    // I'm going to serialize from a file, store then in UserModel classes
    // which are implemented using Equip\Data, which provides traits and interfaces for
    // make immutable objects that only allow predefined properties
    public function __construct(UserModel $model)
    {
        $this->model = $model;

        if (file_exists('/tmp/users.json'))
        {
            $json = json_decode(file_get_contents('/tmp/users.json'), true);
            foreach($json as $user)
            {
                $this->users[$user['username']] = $model->withData($user);
            }
        }
    }

    public function createUser(array $fields)
    {
        if (isset($this->users[$fields['username']]))
        {
            throw new \Exception("Duplicate username: $fields[username]");
        }
        $this->users[$fields['username']] = $this->model->withData($fields);
        file_put_contents('/tmp/users.json', json_encode($this->users));

        return $this->users[$fields['username']];
    }

    public function listUsers()
    {
        return $this->users;
    }

    public function getUser($username)
    {
        if (isset($this->users[$username]))
        {
            return $this->users[$username];
        }
        return null;
    }

    public function deleteUser($username)
    {
        $user = $this->getUser($username);
        if ($user !== null)
        {
            unset($this->users[$username]);
            file_put_contents('/tmp/users.json', json_encode($this->users));
        }
        return $user;
    }
}
