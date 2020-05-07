<?php
namespace App\Http\Controllers\Cms;

use App\Model\Review;
use App\Model\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();

        $params = [
            'reviews' => $reviews,
            'title_page' => 'Recensioni',
        ];
        return view('cms.review.index',$params);
    }
}