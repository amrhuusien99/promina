<?php 

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{

    abstract function crudName(): string;
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('id', 'DESC')->get();
    } 

    public function pagination($offset, $limit)
    {
        return $this->model->with($this->model->model_relations())->unArchive()->orderBy('id', 'DESC')->offset($offset)->limit(PAGINATION_COUNT)->get(); 
    }

    public function findOne($id)
    {
        return $this->model->find($id)->load($this->model->model_relations());
    }

    public function store($request)
    {
        $request = $this->handle_request($request);
        return $this->model->create($request);
    }

    public function storeWithRelations($request, string $relation, array $relationData)
    {
        $request = $this->handle_request($request);
        return $this->model->create($request)->{$relation}()->create($relationData);
    }

    public function update($request, $id)
    {
        $request = $this->handle_request($request);
        return $this->model->where("id", $id)->update($request);
    }

    public function updateWithRelations($request, $id, string $relation, array $relationData)
    {
        $request = $this->handle_request($request);
        return $this->model->where("id", $id)->update($request)->{$relation}()->sync($relationData);
    }

    public function activate($id)
    {
        $record = $this->model->find($id);
        $record->is_activate = $record->is_activate == 1 ? 0 : 1;
        return $record->save();
    }

    public function removeRecord($id)
    {
        $record = $this->model->find($id);
        return $record->delete(); 
    }

    public function delete($id)
    {
        return $this->model->where("id", $id)->update(['deleted_at' => date("Y-m-d h:m:s")]); 
    }

    public function search($request)
    {
        $query = $request->get('q');
        $records = [];
        
        if( !is_null($query) ){
            $searchButton = 0;
            $records = $this->model->with($this->model->model_relations())->modelSearch($query);
        }else{
            $searchButton = 1;
            $records = $this->model->latest()->with($this->model->model_relations())->unArchive()->limit(PAGINATION_COUNT)->get(); 
        }
        
        if($records && count($records) > 0){
            $records[0]->searchButton = $searchButton;
        }
        return $records;
    }

    public function archives($offset, $limit)
    {
        return $this->model->latest()->with($this->model->model_relations())->archive()->offset($offset)->limit(PAGINATION_COUNT)->get();
    }

    public function back($id)
    {
        return $this->model->where("id", $id)->update(['deleted_at' => NULL]);
    }

    public function archivesSearch($request)
    {
        $query = $request->get('q');
        $records = [];
        
        if( !is_null($query) ){
            $searchButton = 0;
            $records = $this->model->modelSearchInArchives($query);
        }else{
            $searchButton = 1;
            $records = $this->model->latest()->with($this->model->model_relations())->archive()->limit(PAGINATION_COUNT)->get();
        }
        
        if($records && count($records) > 0){
            $records[0]->searchButton = $searchButton;
        }
        return $records;
    }

    public function handle_request($request)
    {
        $request->password ? $request->merge(['password' => bcrypt($request->password)]) : "";
        if (!$request->hasFile('photo') == null) {
            $file = uploadIamge($request->file('photo'), $this->crudName()); // function on helper file to upload file
            $request->merge(['img' => $file]);
        }
        if (!$request->hasFile('photos') == null) {
            $files = uploadIamges($request->file('photos'), $this->crudName()); // function on helper file to upload files
            $request->merge(['imgs' => $files]);
        }
        $request = array_filter(array_intersect_key($request->all(), $this->model->fildes()));
        return $request;
    }

}
