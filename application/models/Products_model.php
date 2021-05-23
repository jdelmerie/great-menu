<?
class Products_model extends CI_Model
{
    public $table = 'products';

    /**
     * Requete avoir le nombre de membres
     *
     * @param [type] $id
     * @return void
     */
    public function count($id)
    {
        $this->db->join('categories', 'categories.id = products.cat_id');
        $this->db->join('establishments', 'establishments.id = categories.est_id');
        $this->db->where('est_id', $id);
        return $this->db->count_all_results($this->table);
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

    public function update($id, $cat_id, $data)
    {
        $this->db->where(['id' => $id, 'cat_id' => $cat_id]);
        $this->db->set($data);
        $this->db->update($this->table);
    }

    public function findAll($id)
    {
        $this->db->select('products.id as id, products.cat_id as cat_id, products.name as prod_name, products.composition, products.price, products.prices_categories, products.image, categories.id as cat_id, categories.name as cat_name');
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id = products.cat_id');
        $this->db->where('cat_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Requete pour supprimer
     *
     * @param [type] $id
     * @return void
     */
    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}
