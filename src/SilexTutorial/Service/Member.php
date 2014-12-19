<?php 

namespace SilexTutorial\Service;

class Member
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /** 
     * register
     *
     * @param array $data
     * @return void
     *
     */
    public function register(array $data)
    {
        try
        {
            $this->db->beginTransaction();
            $sql = "INSERT INTO member SET 
                email = :email, 
                password = :password,
                created_at = now()";
            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $data['password']);
            $stmt->execute();
        }
        catch(Exception $e)
        {
            $this->db->rollback();
            throw $e;
        }

        $this->db->commit();
    }
}

?>
