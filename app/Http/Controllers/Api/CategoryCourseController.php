<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storecategory_courseRequest;
use App\Http\Requests\Updatecategory_courseRequest;
use App\Models\CategoryCourse;
use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas =[];
        $CategoryCourses = CategoryCourse::all();
        foreach ($CategoryCourses as $CategoryCourse) {

            $image = $CategoryCourse->getMedia()->first()->getUrl();
            $data = [
                'data' => $CategoryCourse,
                'image' => $image
            ];
            $datas [] = $data;
        }
        return response()->json([
            'status' => true,
            'data' => $datas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Storecategory_courseRequest $request)
    {

        $categoryCourse=CategoryCourse::create([
            'name' => $request->name,
        ]);
        $image= $categoryCourse->addMediaFromRequest('img')->toMediaCollection();
        $categoryCourse->update([
            'img'=>$image->getUrl()
        ]);

        return response()->json([
            'message'=>'sucsessfully',
            'date'=>$categoryCourse,
        ]);
//
//        $CategoryCourse = CategoryCourse::create([
//            'name' => $request->name,
//        ]);
//        $image=$CategoryCourse->addMediaFromRequest('img')->toMediaCollection();
//
//        $CategoryCourse->update([
//            'img'=>$image->getUrl()
//        ]);




//        $categoryCourse= CategoryCourse::create([
//            'name' => $request->name
//        ]);
//
//        $image=$categoryCourse->addMediaFromRequest('img')->toMediaCollection();
//
//        $categoryCourse->update([
//            'img'=>$image->getUrl()
//        ]);
//
//
//        return response()->json([
//            'message' => 'created successfully',
//            'Course' =>$categoryCourse,
//        ], 201);

//        $image=$categorycourse->addMediaFromRequest('img')->toMediaCollection();
//
//        $categorycourse->update([
//            'img'=>$image->getUrl()
//        ]);
//        return response()->json([
//            'message' => 'CategoryCourse created successfully',
//            'data' => $categorycourse
//        ], 201);
    }
//        if(!$request->hasFile('image')) {
//            return response()->json(['upload_file_not_found'], 400);
//        }
//        $file = $request->file('image');
//        if(!$file->isValid()) {
//            return response()->json(['invalid_file_upload'], 400);
//        }
//        $path = public_path() . '/uploads/images/store/';
//        $file->move($path, $file->getClientOriginalName());
//        return response()->json(compact('path'));


//        $fileName="user_image";
//         $path=$request->file( 'img')->move(public_path( "/"),$fileName );
//          $photoURl= url( '/'.$fileName );
//           return  response( )->json(['url' => $photoURl],200);


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatecategory_courseRequest $request, $id)
    {
        //$categorycourse->update($request->validate());

        $categorycourse = CategoryCourse::where('id', $id)->get()->first();

        $categorycourse->update([
            'name' => $request->name,
        ]);
        if ($request->hasFile('img')) {
            $categorycourse->media()->delete();
            $image = $categorycourse->addMediaFromRequest('img')->toMediaCollection();
            $categorycourse->update([
                'img' => $image->getUrl()
            ]);
            return response()->json([
                'status' => true,
                'message' => ' updated successfully',
                'data' => CategoryCourse::find($id)
            ], 200);
        }

    }

//        ]);
//            $category->media()->delete();
//        $category->addMedia('img')->toMediaCollection();


    //   $category =CategoryCourse::find($id);
    //   $category->addMediaFromRequest('image')->toMediaCollection();


    //  public function edit($id)
    // {
    // $categorycourse=CategoryCourse::find($id);
//        if (!$categorycourse) {
//            return response()->json([
//                'status' => false,
//                'message' => 'user not found'
//            ], 404);
//        }
//        return response()->json([
//            'status' => true,
//            'message' => 'successfully',
//            'data' =>$categorycourse
//        ],);
    //}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CategoryCourse::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete successfully'
        ], 200);
    }

    public function users_numbers()
    {
        $date2 = [];
        $datas = [];
        $categorycourses = CategoryCourse::with('courses')->get();
        $allMembers = 0;
        foreach ($categorycourses as $categorycourse) {
            foreach ($categorycourse->courses as $course) {
                $allMembers += $course->sales_number;
            }
        }
        $courseMember = 0;
        $i = 0;
//        $categor = [];
//        foreach ($categorycourses as $categorycourse) {
////            foreach ($categorycourse->courses as $category){
////                dd($category);
//                $collection = collect($categorycourse->courses);
////                dd($collection);
//            $sum = $collection->groupBy(['category_course_id'])->map(function ($item){
//                return  $item->sum('sales_number');
//            });
//            $datas []= $sum;
////            }
//        }


//        dd($datas);
//           $tests =  $categorycourse->courses()->get(['sales_number','category_course_id']);
//           $asd = ['category_course_id']
//           $sum = 0;
//           foreach ($tests as $test) {
//               $num = $test->sales_number;
//               $sum += $num;
//           }
//           foreach ($tests as $test) {
//               $data = ['category'=>$test->category_course_id ];
//           }
        foreach ($categorycourses as $categorycourse) {
            $sum = 0;
            foreach ($categorycourse->courses as $category) {

//                $courseMember = $course->sales_number;
                $sum += $category->sales_number;
//                if(array_key_exists($i,$datas)){
//                    $datas[$i][$course->category_course_id] += $course->sales_number;
//                }else{
//                    $datas[] = array($course->category_course_id => $course->sales_number);
//                }
//                dump($datas[$i][$course->category_course_id]);
//                dump($i);
//               dump($datas);
//               dump($course->category_course_id);
//               dump('-------------');

//                $i += 1;
            }
            $date2[] = ['category_id' => $categorycourse->id, 'sale_number' => $sum];

//            dump($courseMember);
//            dump('-------------');


            $data = [
                'category_name' => $categorycourse->name,
                'percent' => $courseMember = 0 ? 0 . '%' : $courseMember * 100 / $allMembers,
            ];
//            $datas[] = $data;

        }
        dd($date2);

    }


        public function addCourse(){
            $datas=[];
        $CategoryCourses = CategoryCourse::all();
        foreach ($CategoryCourses as $CategoryCourse) {

            $data = [
                'data' => $CategoryCourse->name,
            ];
            $datas [] = $data;
        }
        return response()->json([
            'status' => true,
            'data' => $datas
        ]);

    }
    }
