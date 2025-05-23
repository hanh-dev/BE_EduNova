<?php
namespace App\Http\Controllers;
 use App\Services\AcademyService;
 use Illuminate\Http\Request;
 
class AcademyController extends Controller
{
    protected $service;

    public function __construct(AcademyService $service) {
        $this->service = $service;
    }
    public function index() {
        try {
            $academies = $this->service->list();
            return response()->json($academies, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function store(Request $request) {
       try {
         $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'media_type' => 'required|in:image,video',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240',
        ]);
          if ($request->hasFile('media_file')) {
            $data['media_file'] = $request->file('media_file');
        }   
        return response()->json($this->service->create($data), 201);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    public function show($id) {
        $academy = $this->service->get($id);
        return response()->json($this->service->list());

    }
    public function update(Request $request, $id) {
        try {
              $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'media_type' => 'required|in:image,video',
            'media_file' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240',
        ]);
          if ($request->hasFile('media_file')) {
            $data['media_file'] = $request->file('media_file');
        }
        return response()->json($this->service->update($id, $data));
    }
    catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function destroy($id) {
    try {
        $this->service->delete($id);
        return response()->json(null, 204);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
