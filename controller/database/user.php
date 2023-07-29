<?
class User implements Serializable
{
    public $user_id;
    public $username;
    public $role;
    function  __construct($user_id, $username, $role)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->role = $role;
    }

    public function serialize()
    {
        return serialize([
            'user_id' => $this->user_id,
            'username' => $this->username,
            'role' => $this->role
        ]);
    }

    public function unserialize($data)
    {
        $data = unserialize($data);
        $this->user_id = $data['user_id'];
        $this->username = $data['username'];
        $this->role = $data['role'];
    }
}
?>