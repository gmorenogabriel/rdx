<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\PostModel;


class Post extends Entity
{
    protected $datamap = [];
    protected $dates   = [
        'created_at', 
        'updated_at', 
        'deleted_at',
        'published_at',
    ];

    protected $casts   = [];

    protected  function setSlug(string $title){
        $slug = mb_url_title($title, '-');
        $postsModel = model('PostModel');
        
        while($postsModel->where('slug', $slug)->find() <> null){
            $slug = increment_string($slug, '_');   
        }
        $this->attributes['slug'] = $slug;
    }
    protected function getAuthor(){
        if(!empty($this->attributes['author'])){
            $uiModel = model('UserInfoModel');
             return $uiModel->where('id_user', $this->attributes['author'])->first();
        }
        return $this;
    }
    public function getCategories(){
        $cpModel =  model('CategoriesPosts');
        return $cpModel->where('id_post', $this->id)->join('categories','categories.id = categories_posts.id_category')->findAll() ?? []; 
    }
    public function getLink(){
       return base_url('public/covers/'. $this->cover);
        //<?php echo base_url('.public/cover/'.
    }
    public function getLinkArticle(){
        return base_url(route_to('article', $this->slug));
    }

}
