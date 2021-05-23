<?
class Customisation_model extends CI_Model
{
    public $table = 'customisation';

    /**
     * Requete pour select par id
     *
     * @param [type] $id
     * @return void
     */
    public function find($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('est_id', $id);
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
        $this->db->where('est_id', $id);
        $this->db->set($data);
        $this->db->update($this->table);
    }
}
