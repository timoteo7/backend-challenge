<?php namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Media;
use App\Models\Variation;
use Illuminate\Support\Collection;

trait RESTActions {


    public function index()
    {
        $m = self::MODEL;
        return response()->json([
            'data' => $m::all()
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        $m = self::MODEL;
        $model = $m::find($id);
        if(is_null($model)){
            return response()->json([
                'message' => "Not found"
            ], Response::HTTP_NOT_FOUND);
        }
        return response()->json([
            'data' => $model
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $m = self::MODEL;
        $this->validate($request, $m::$rules);
        $input = $request->except(['images']);

        $created_model = $m::create($input);

        if ($request->has('variations'))
            foreach ($request['variations'] as $value)
                $created_model->variations()->create(['cor' => $value ]);

        if ($request->has('images')) {
            if(count($request['images']) > 0){
                $images = $request['images'];
    
                foreach ($images as $name => $id) {
                    $created_model->addMedia($id, $name);
                }
            }
        }

        $modelName = explode("\\", $m);
        $message = $modelName[2] . " created successfully.";
        return response()->json([
            'data' => $created_model,
            'message' => $message
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $m = self::MODEL;
        if ($m == 'App\Models\Product' )
            $this->validate($request, ['descricao' => 'present', 'valor' => 'present']);
        $model = $m::find($id);
        if (is_null($model)) {
            return response()->json([
                'message' => "Not found"
            ], Response::HTTP_NOT_FOUND);
        }
        $input = $request->except(['_method' , 'images']);

        $model->update($input);

        if ($request->has('variations')) {
            Variation::where('product_id', $model->id)->delete();
            foreach ($request['variations'] as $value)
                $model->variations()->create(['cor' => $value ]);
        }

        if (isset($request->images)) {
            $images = $request->images;

            foreach($images as $name => $id){
                $media = Media::findOrFail($id);
                $old_media = $model->getMediaByTag($name);
                isset($old_media) ?  $model->updateMedia($old_media, $media, $name) : $model->addMedia($media, $name);
            }
        }

        $modelName = explode("\\", $m);
        $message = $modelName[2] . " updated successfully.";
        return response()->json([
            'data' => $model,
            'message' => $message
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $m = self::MODEL;
        $model = $m::find($id);
        // $related_media = $model->getMediaCollection();

        // dd($related_media instanceof Collection);

        if (is_null($model)) {
            return response()->json([
                'message' => "Not found"
            ], Response::HTTP_NOT_FOUND);
        }

        if ($model->getTable() == 'products' )
            Variation::where('product_id', $model->id)->delete();
        
        /*
        if($related_media){
            if($related_media instanceof Collection){
                foreach($related_media as $image){
                    $model->removeMediaByTag($image->id, $image->pivot->tag);
                }
            } else {
                $model->removeMediaByTag($related_media->id, $related_media->pivot->tag);
            }
        }*/
        
        $model->destroy($id);

        return response()->json([
            'message' => "Deleted successfully."
        ], Response::HTTP_OK);
    }

    public function BatchDestroy(Request $request)
    {
        if (isset($request['itemsIDs'])) {
            $itemsIDs = json_decode($request['itemsIDs']);
            foreach ($itemsIDs as $id) {
                $this->destroy($id);
            }
        }
        return response()->json([
              'message' => "Deleted successfully.",
        ]);
    }
}
