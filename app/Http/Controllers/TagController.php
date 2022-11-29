<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function tag()
    {
        $tags = Tag::all();
        return view('admin.tag.tag', [
            'tags' => $tags
        ]);
    }

    function tag_store(TagRequest $request)
    {

        Tag::insert(
            [
                'tag_name' => $request->tag_name,
            ],
        );
        return back();
    }
}
