<?php namespace App\Models;

use CodeIgniter\Model;

use App\Entities\Post;

class PostModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Post::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'slug', 'body', 'cover', 'author', 'published_at'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    /* protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true; */

    // Callbacks
    protected $allowCallbacks = true;
    protected $afterInsert    = ['storeCategories'];
    protected $beforeUpdate   = [];

    protected $categories = [];

    public function published(){
        $this->where('published_at <=', date('Y-m-d H:i:s'));
        return $this;
    }
    // Luis Pastén - 39-. Guardar Artículos - Modulo de Artículos - Codeigniter 4
    // a los 6 minutos aprox.
    // Una vez que se inserte el Posts
    // el Callback nos permite tomar el valor del id
    protected function storeCategories(array $data){
        if(!empty($this->categories)){
            $cpModel = model('CategoriesPosts');
            $cats = [];
            foreach($this->categories as $v){
                $cats[] = [
                    'id_category' => $v,
                    'id_post' => $data['id'],
                ];
            }
            $cpModel->insertBatch($cats);
        }
        return $data;
    }
    public function assignCategories(array $categories){
        // d($this->categories = $categories);
        return $this->categories = $categories;
    }
    public function getPostsByCategory(string $category){
        return $this
            ->select('posts.*')
            ->join('categories_posts', 'posts.id = categories_posts.id_post')
            ->join('categories', 'categories.id = categories_posts.id_category')
            ->where('categories.name', $category);
    }
}
