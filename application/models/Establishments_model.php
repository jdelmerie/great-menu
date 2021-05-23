<?
class Establishments_model extends CI_Model
{
    public $table = 'establishments';

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

    public function findUserEtab($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('user_id', $id);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    public function findUrl($url)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('url', $url);
        $query = $this->db->get();
        if (count($query->result()) > 0) {
            return $query->result()[0];
        }
    }

    // public function selectByUserId($user_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('establishments');
    //     $this->db->where('user_id', $user_id);
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function selectUserEtabs($user_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('establishments');
    //     $this->db->where('user_id', $user_id);
    //     $query = $this->db->get();
    //     return $query->result()[0];
    // }

    // public function add($data)
    // {
    //     $this->db->insert('establishments', $data);
    // }

    // public function selectById($etab_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('establishments');
    //     $this->db->where('id', $etab_id);
    //     $query = $this->db->get();
    //     return $query->result()[0];
    // }

    // public function update($etab_id, $data)
    // {
    //     $this->db->where('id', $etab_id);
    //     $this->db->set($data);
    //     $this->db->update('establishments');
    // }

    // public function countCat($etab_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('categories');
    //     $this->db->where('est_id', $etab_id);
    //     $count = $this->db->count_all_results();
    //     return $count;
    // }

    // public function countProd($etab_id)
    // {
    //     $this->db->select('*');
    //     $this->db->from('products');
    //     $this->db->join('categories', 'categories.id = products.cat_id');
    //     $this->db->join('establishments', 'establishments.id = categories.est_id');
    //     $this->db->where('est_id', $etab_id);
    //     $count = $this->db->count_all_results();
    //     return $count;
    // }
}
