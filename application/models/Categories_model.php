<?
class Categories_model extends CI_Model
{
    public $table = 'categories';

    /**
     * Requete avoir le nombre de categories
     *
     * @param [type] $id
     * @return void
     */
    public function count($id)
    {
        $this->db->where('est_id', $id);
        return $this->db->count_all_results($this->table);
    }

    public function findAll($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('est_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function find($id)
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
     * Requete pour ajouter des données
     *
     * @param [type] $data
     * @return void
     */
    public function add($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $etab_id, $data)
    {
        $this->db->where(['id' => $id, 'est_id' => $etab_id]);
        $this->db->set($data);
        $this->db->update($this->table);
    }

    /**
     * Requete pour supprimer
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        // $this->db->delete($this->table, ['id' => $id]);
        // if ($this->db->affected_rows() > 0) {
        //     return true; // to the controller
        // } else {
        //     return false; // to the controller
        // }

        if (!$this->db->delete($this->table, ['id' => $id])) {
            return $this->db->error();
        }
        return false;
    }
}
