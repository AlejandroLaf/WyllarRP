<?php

namespace App\Http\Controllers;


class CampañaController extends Controller
{
    public function index()
    {
        return view('campañas.index');
    }

    // public function show(Post $post)
    // {
    //     return view('posts.show', [
    //         'post' => $post,
    //     ]);
    // }
}
