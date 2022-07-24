<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\MenuStoreRequest;
use App\Http\Resources\Admin\Menu\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menus = auth()->user()->menus()->get();


        return MenuResource::collection($menus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request)
    {
        //
        abort_if(auth()->user()->access->limit <= auth()->user()->menus()->count(), 403, 'Вы исчерпали лимит.');

        $data = $request->validated();
        $data['published'] = $request->boolean('published');

        $data = $this->uploadImage($request, $data);

        $institutions = [
            'name' => $data['name'],
            'city_ id' => 1,
            'country_id' => 1,
            'currency_id' => 1
        ];

        $institution = auth()->user()
            ->institutions()
            ->create($institutions);


        $menu = $institution->menus()
            ->create($data);

        return MenuResource::make($menu);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuStoreRequest $request, Menu $menu)
    {
        //
        $data = $request->validated();
        $data['published'] = $request->boolean('published');

        $data = $this->uploadImage($request, $data);

        $menu->update($data);

        return  MenuResource::make($menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //

        $menu->delete();

        return  response()->noContent();
    }

    private function uploadImage($request, $data)
    {
        if ($request->hasFile('image')) {
            $data['image'] = Storage::url($request->file('image')->store('public/menus/images'));
        } else {
            if (!is_null($data['image'])) {
                unset($data['image']);
            }
        }

        return $data;
    }
}
