<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Project::generateSlug($form_data['name']);
        $form_data['project_start'] = date('Y-m-d');

        if(array_key_exists('image', $form_data)){
            //salvo nome originale
            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
            //salvo percorso img
            //con putFileas al posto di put e passando il nome dell'immagine, tengo invariato il nome dell'immagine e non uno casuale generato da Laravel
            $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
        }

        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project->save();

        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $dateOfStart = date_create($project->project_start);
        $dateOfFinish = date_create($project->end_of_project);
        $dateOfStart_formatted = date_format($dateOfStart, 'd/m/Y');
        $dateOfFinish_formatted = date_format($dateOfFinish, 'd/m/Y');

        return view('admin.projects.show', compact('project', 'dateOfStart_formatted', 'dateOfFinish_formatted'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {

        $form_data = $request->all();

        if($project->name !== $form_data['name']){
            $form_data['slug']  = Project::generateSlug($form_data['name']);
        }else{
            $form_data['slug']  = $project->slug;
        }

        if(array_key_exists('image', $form_data)){

            //la elimino dallo storage
            if($project->image_path){
                Storage::disk('public')->delete($project->image_path);
            }
            //salvo nome originale
            $form_data['image_original_name'] = $request->file('image')->getClientOriginalName();
            //salvo percorso img
            //con putFileas al posto di put e passando il nome dell'immagine, tengo invariato il nome dell'immagine e non uno casuale generato da Laravel
            $form_data['image_path'] = Storage::put('uploads', $form_data['image']);
        }

        $project->update($form_data);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //la elimino dallo storage
        if($project->image_path){
            Storage::disk('public')->delete($project->image_path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('deleted', "The project $project->name was successfully deleted");
    }
}
