<?
$config = [
    'inscription/register' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|trim|valid_email|is_unique[users.email]',
        ],

        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required|trim|min_length[8]',
        ],

        [
            'field' => 'confirm_password',
            'label' => 'confirmation du mot du passe',
            'rules' => 'trim|required|matches[password]',
        ],
    ],

    'connexion/connect' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|trim|valid_email',
        ],

        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required|trim|min_length[8]',
        ],
    ],

    'connexion/add_etabs' => [
        [
            'field' => 'nom',
            'label' => 'nom',
            'rules' => 'required',
        ],

        [
            'field' => 'url',
            'label' => 'url',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'adresse',
            'label' => 'adresse',
            'rules' => 'required',
        ],

        [
            'field' => 'code_postale',
            'label' => 'code_postale',
            'rules' => 'required|exact_length[5]|numeric',
        ],

        [
            'field' => 'ville',
            'label' => 'ville',
            'rules' => 'required',
        ],

        [
            'field' => 'telephone',
            'label' => 'telephone',
            'rules' => 'exact_length[10]|numeric',
        ],

        [
            'field' => 'site',
            'label' => 'site',
            'rules' => 'valid_url',
        ],
    ],

    'connexion/forgetten_password_check' => [
        [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|trim|valid_email',
        ],
    ],

    'connexion/update_password' => [
        [
            'field' => 'password',
            'label' => 'mot de passe',
            'rules' => 'required|trim|min_length[8]',
        ],

        [
            'field' => 'confirm_password',
            'label' => 'confirmation du mot du passe',
            'rules' => 'trim|required|matches[password]',
        ],
    ],

    'etablissement/edit' => [
        [
            'field' => 'nom',
            'label' => 'nom',
            'rules' => 'required',
        ],

        [
            'field' => 'url',
            'label' => 'url',
            'rules' => 'trim|required',
        ],

        [
            'field' => 'adresse',
            'label' => 'adresse',
            'rules' => 'required',
        ],

        [
            'field' => 'code_postale',
            'label' => 'code_postale',
            'rules' => 'required|exact_length[5]|numeric',
        ],

        [
            'field' => 'ville',
            'label' => 'ville',
            'rules' => 'required',
        ],

        [
            'field' => 'telephone',
            'label' => 'telephone',
            'rules' => 'exact_length[10]|numeric',
        ],

        [
            'field' => 'site',
            'label' => 'site',
            'rules' => 'valid_url',
        ],
    ],

    
    'categories/add' => [
        [
            'field' => 'nom',
            'label' => 'nom',
            'rules' => 'required',
        ],

        [
            'field' => 'description',
            'label' => 'description',
            'rules' => 'max_length[100]',
        ],
    ],
    
    'categories/update' => [
        [
            'field' => 'nom',
            'label' => 'nom',
            'rules' => 'required',
        ],

        [
            'field' => 'description',
            'label' => 'description',
            'rules' => 'max_length[100]',
        ],
    ],

    'produits/add' => [
        [
            'field' => 'nom',
            'label' => 'nom',
            'rules' => 'required|max_length[128]|is_unique[products.name]',
        ],

        [
            'field' => 'categorie',
            'label' => 'catégorie',
            'rules' => 'required',
        ],

        [
            'field' => 'description',
            'label' => 'description',
            'rules' => 'max_length[256]',
        ],

        [
            'field' => 'price',
            'label' => 'prix',
            'rules' => 'integer',
        ],
    ],

    'produits/update' => [
        [
            'field' => 'nom',
            'label' => 'nom',
            'rules' => 'required|max_length[128]',
        ],

        [
            'field' => 'description',
            'label' => 'description',
            'rules' => 'max_length[256]',
        ],

        [
            'field' => 'price',
            'label' => 'prix',
            'rules' => 'integer|required|is_natural_no_zero',
        ],
    ],

    'quantites/add' => [
        [
            'field' => 'nom',
            'label' => 'nom',
            'rules' => 'required',
        ],
    ],

    'quantites/edit' => [
        [
            'field' => 'qtyname',
            'label' => 'nom',
            'rules' => 'required',
        ],
    ],


    
];
