<?
class Users_model extends CI_Model
{
    public $table = 'users';

    /**
     * Requete pour select par id
     *
     * @param [type] $id
     * @return void
     */
    public function findId($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    /**
     * Requete pour select par email
     *
     * @param [type] $email
     * @return void
     */
    public function findEmail($email)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('email', $email);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    /**
     * Requete pour ajouter des données
     *
     * @param [type] $data
     * @return void
     */
    public function add($data)
    {
        $this->db->insert($this->table, $data);
    }

    /**
     * Requete pour mettre à jour les données
     *
     * @param [type] $id
     * @param [type] $data
     * @return void
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->set($data);
        $this->db->update($this->table);
    }

    /**
     * Requete pour vérifier que l'email dans le cas d'un mot de passe oublié
     *
     * @param [type] $email
     * @return void
     */
    public function mail_exists($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Requete pour mettre à jour le nouveau mot de passe
     *
     * @param [type] $email
     * @param [type] $data
     * @return void
     */
    public function resetPwd($email, $data)
    {
        $this->db->where('email', $email);
        $this->db->set($data);
        $this->db->update($this->table);
    }

}
