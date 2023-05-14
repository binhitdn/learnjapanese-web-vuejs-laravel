<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Card;

class CourseController extends Controller
{
    // Lấy danh sách khóa học của user
    public function index($user_id) {
        $courses = Course::where('user_id', $user_id)->get();
        $cards = Card::where('course_id', $user_id)->get();
        return view('courses.index', compact('courses'));
    }
    public function getAllCourses()
    {
        $courses = Course::all();
        return response()->json($courses);
    }
    public function getCourseById($id)
    {
        $course = Course::find($id);
        return response()->json($course);
    }


    // Thêm mới khóa học
    public function create($user_id) {
        return view('courses.create', compact('user_id'));
    }
    public function store(Request $request) {
        echo $request->title;
        $course = new Course();
        $course->user_id = $request->user_id;
        $course->title = $request->name;
        $course->description = $request->description;
        $course->image = $request->image;
        $course->save();

        // Lưu vào card
        foreach ($request->cards as $cardData) {
        $card = new Card();
        $card->course_id = $course->id;
        $card->term = $cardData['term'];
        $card->definition = $cardData['definition'];
        $card->save();
    }
        

        return redirect()->route('courses.index', ['user_id' => $request->user_id]);
    }

    // Chỉnh sửa khóa học
    public function edit($course_id) {
        $course = Course::find($course_id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request) {
        $course = Course::find($request->id);
        $course->name = $request->name;
        $course->description = $request->description;
        $course->save();

        $card = Card::where('course_id', $request->id)->delete();
        foreach ($request->cards as $cardData) {
            $card = new Card();
            $card->course_id = $course->id;
            $card->term = $cardData['term'];
            $card->definition = $cardData['definition'];
            $card->save();
        }

        return redirect()->route('courses.index', ['user_id' => $course->user_id]);
    }

    // Xóa khóa học
    public function destroy($course_id) {
        $course = Course::find($course_id);
        $course->cards()->delete();
        $course->delete();

        return redirect()->route('courses.index', ['user_id' => $course->user_id]);
    }

    // Thêm mới card cho khóa học
    public function createCard($course_id) {
        $course = Course::find($course_id);
        return view('cards.create', compact('course'));
    }

    public function storeCard(Request $request) {
        $card = new Card();
        $card->course_id = $request->course_id;
        $card->title = $request->title;
        $card->description = $request->description;
        $card->save();

        return redirect()->route('courses.edit', ['course_id' => $request->course_id]);
    }

    // Chỉnh sửa card của khóa học
    public function editCard($card_id) {
        $card = Card::find($card_id);
        return view('cards.edit', compact('card'));
    }

    public function updateCard(Request $request) {
        $card = Card::find($request->id);
        $card->title = $request->title;
        $card->description = $request->description;
        $card->save();

        return redirect()->route('courses.edit', ['course_id' => $card->course_id]);
    }

    // Xóa card của khóa học
    public function destroyCard($card_id) {
        $card = Card::find($card_id);
        $card->delete();

        return redirect()->route('courses.edit', ['course_id' => $card->course_id]);
    }
}

