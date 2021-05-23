<?
class Quantity_model extends CI_Model
{
    public $table = 'prices_categories';

    public function findAll($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('cat_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function find_cat_by_qty($id)
    {
        $this->db->select('categories.id as cat_id, categories.name as cat_name, prices_categories.id as qty_id, prices_categories.cat_id as qty_cat_id, prices_categories.name as qty_name, est_id, categories.image as cat_image');
        $this->db->from('categories');
        $this->db->join($this->table, 'categories.id = prices_categories.cat_id', 'right');
        $this->db->where('categories.est_id', $id);
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

    public function add($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where(['id' => $id]);
        $this->db->set($data);
        $this->db->update($this->table);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}
