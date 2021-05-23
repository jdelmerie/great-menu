<?if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Template
{
    public $template_data = array();

    public function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }

    public function load($template = '', $view = '', $view_data = array(), $return = false)
    {
        $this->CI = &get_instance();
        $this->set('contents', $this->CI->load->view($view, $view_data, true));
        // $this->set('nav_list',
        //     array(
        //         '/dashboard' => 'Accueil',
        //         '/etablissement' => 'Fonctionnalités',
        //         '/personnallitation' => 'Associations'));
        return $this->CI->load->view($template, $this->template_data, $return);
    }

    public function get_maintenance($etab_id)
    {
        $CI = &get_instance();
        $CI->db->select('id, name, maintenance');
        $CI->db->from('establishments');
        $CI->db->where('id', $etab_id);
        $query = $CI->db->get();
        $result = $query->result()[0];
        return $result->maintenance;
    }
}
